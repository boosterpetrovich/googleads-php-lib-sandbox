<?php
/**
 * Copyright 2016 Google Inc. All Rights Reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Google\AdsApi\Examples\Dfp\v201805\ProductService;

require __DIR__ . '/../../../../vendor/autoload.php';

use Google\AdsApi\Common\OAuth2TokenBuilder;
use Google\AdsApi\Dfp\DfpSession;
use Google\AdsApi\Dfp\DfpSessionBuilder;
use Google\AdsApi\Dfp\Util\v201805\StatementBuilder;
use Google\AdsApi\Dfp\v201805\ProductService;
use Google\AdsApi\Dfp\v201805\ServiceFactory;

/**
 * This example gets all products created from a product template.
 *
 * <p>It is meant to be run from a command line (not as a webpage) and requires
 * that you've setup an `adsapi_php.ini` file in your home directory with your
 * API credentials and settings. See README.md for more info.
 */
class GetProductsForProductTemplate
{

    const PRODUCT_TEMPLATE_ID = 'INSERT_PRODUCT_TEMPLATE_ID_HERE';

    public static function runExample(
        ServiceFactory $serviceFactory,
        DfpSession $session,
        $productTemplateId
    ) {
        $productService = $serviceFactory->createProductService($session);

        // Create a statement to select products.
        $pageSize = StatementBuilder::SUGGESTED_PAGE_LIMIT;
        $statementBuilder =
            (new StatementBuilder())->where('productTemplateId = :productTemplateId')
                ->orderBy(
                    'id ASC'
                )
                ->limit($pageSize)
                ->withBindVariableValue('productTemplateId', $productTemplateId);

        // Retrieve a small amount of products at a time, paging
        // through until all products have been retrieved.
        $totalResultSetSize = 0;
        do {
            $page = $productService->getProductsByStatement(
                $statementBuilder->toStatement()
            );

            // Print out some information for each product.
            if ($page->getResults() !== null) {
                $totalResultSetSize = $page->getTotalResultSetSize();
                $i = $page->getStartIndex();
                foreach ($page->getResults() as $product) {
                    printf(
                        "%d) Product with ID %d and name '%s' was found.%s",
                        $i++,
                        $product->getId(),
                        $product->getName(),
                        PHP_EOL
                    );
                }
            }

            $statementBuilder->increaseOffsetBy($pageSize);
        } while ($statementBuilder->getOffset() < $totalResultSetSize);

        printf("Number of results found: %d%s", $totalResultSetSize, PHP_EOL);
    }

    public static function main()
    {
        // Generate a refreshable OAuth2 credential for authentication.
        $oAuth2Credential = (new OAuth2TokenBuilder())->fromFile()
            ->build();

        // Construct an API session configured from an `adsapi_php.ini` file
        // and the OAuth2 credentials above.
        $session = (new DfpSessionBuilder())->fromFile()
            ->withOAuth2Credential($oAuth2Credential)
            ->build();

        self::runExample(
            new ServiceFactory(),
            $session,
            intval(self::PRODUCT_TEMPLATE_ID)
        );
    }
}

GetProductsForProductTemplate::main();
