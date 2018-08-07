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

namespace Google\AdsApi\Examples\Dfp\v201805\ReconciliationReportRowService;

require __DIR__ . '/../../../../vendor/autoload.php';

use Google\AdsApi\Common\OAuth2TokenBuilder;
use Google\AdsApi\Dfp\DfpSession;
use Google\AdsApi\Dfp\DfpSessionBuilder;
use Google\AdsApi\Dfp\Util\v201805\StatementBuilder;
use Google\AdsApi\Dfp\v201805\ReconciliationReportRowService;
use Google\AdsApi\Dfp\v201805\ServiceFactory;

/**
 * This example gets a reconciliation report's rows for line items that served
 * through DFP.
 *
 * It is meant to be run from a command line (not as a webpage) and requires
 * that you've setup an `adsapi_php.ini` file in your home directory with your
 * API credentials and settings. See README.md for more info.
 */
class GetReconciliationReportRowsForReconciliationReport
{

    const RECONCILIATION_REPORT_ID = 'INSERT_RECONCILIATION_REPORT_ID_HERE';

    public static function runExample(
        ServiceFactory $serviceFactory,
        DfpSession $session,
        $reconciliationReportId
    ) {
        $reconciliationReportRowService =
            $serviceFactory->createReconciliationReportRowService($session);

        // Create a statement to select reconciliation report rows.
        $pageSize = StatementBuilder::SUGGESTED_PAGE_LIMIT;
        $statementBuilder = (new StatementBuilder())->where(
            'reconciliationReportId = ' . $reconciliationReportId . ' AND lineItemId != :lineItemId'
        )
            ->orderBy('id ASC')
            ->limit($pageSize)
            ->withBindVariableValue('lineItemId', 0);

        // Retrieve a small amount of reconciliation report rows at a time, paging
        // through until all reconciliation report rows have been retrieved.
        $totalResultSetSize = 0;
        do {
            $page = $reconciliationReportRowService->getReconciliationReportRowsByStatement(
                $statementBuilder->toStatement()
            );

            // Print out some information for each reconciliation report row.
            if ($page->getResults() !== null) {
                $totalResultSetSize = $page->getTotalResultSetSize();
                $i = $page->getStartIndex();
                foreach ($page->getResults() as $reconciliationReportRow) {
                    printf(
                        "%d) Reconciliation report row with ID %d,"
                        . " reconciliation source '%s', and"
                        . " reconciled volume %d was found.%s",
                        $i++,
                        $reconciliationReportRow->getId(),
                        $reconciliationReportRow->getReconciliationSource(),
                        $reconciliationReportRow->getReconciledVolume(),
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
            intval(self::RECONCILIATION_REPORT_ID)
        );
    }
}

GetReconciliationReportRowsForReconciliationReport::main();
