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

namespace Google\AdsApi\Examples\Dfp\v201805\ProductPackageItemService;

require __DIR__ . '/../../../../vendor/autoload.php';

use Google\AdsApi\Common\OAuth2TokenBuilder;
use Google\AdsApi\Dfp\DfpSession;
use Google\AdsApi\Dfp\DfpSessionBuilder;
use Google\AdsApi\Dfp\Util\v201805\StatementBuilder;
use Google\AdsApi\Dfp\v201805\ProductPackageItemService;
use Google\AdsApi\Dfp\v201805\ServiceFactory;

/**
 * This example gets all product package items belonging to a product package.
 *
 * <p>It is meant to be run from a command line (not as a webpage) and requires
 * that you've setup an `adsapi_php.ini` file in your home directory with your
 * API credentials and settings. See README.md for more info.
 */
class GetProductPackageItemsForProductPackage
{

    const PRODUCT_PACKAGE_ID = 'INSERT_PRODUCT_PACKAGE_ID_HERE';

    public static function runExample(
        ServiceFactory $serviceFactory,
        DfpSession $session,
        $productPackageId
    ) {
        $productPackageItemService =
            $serviceFactory->createProductPackageItemService($session);

        // Create a statement to select product package items.
        $pageSize = StatementBuilder::SUGGESTED_PAGE_LIMIT;
        $statementBuilder = (new StatementBuilder())->where('productPackageId = :productPackageId')
            ->orderBy(
                'id ASC'
            )
            ->limit($pageSize)
            ->withBindVariableValue('productPackageId', $productPackageId);

        // Retrieve a small amount of product package items at a time, paging
        // through until all product package items have been retrieved.
        $totalResultSetSize = 0;
        do {
            $page = $productPackageItemService->getProductPackageItemsByStatement(
                $statementBuilder->toStatement()
            );

            // Print out some information for each product package item.
            if ($page->getResults() !== null) {
                $totalResultSetSize = $page->getTotalResultSetSize();
                $i = $page->getStartIndex();
                foreach ($page->getResults() as $productPackageItem) {
                    printf(
                        "%d) Product package item with ID %d, product ID %d,"
                        . " and product package ID %d was found.%s",
                        $i++,
                        $productPackageItem->getId(),
                        $productPackageItem->getProductId(),
                        $productPackageItem->getProductPackageId(),
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
            intval(self::PRODUCT_PACKAGE_ID)
        );
    }
}

GetProductPackageItemsForProductPackage::main();
