<?php

namespace Google\AdsApi\Examples\Dfp\sandbox\v201805;

require __DIR__ . '/../../../../vendor/autoload.php';

use DateTime;
use DateTimeZone;
use Google\AdsApi\Common\OAuth2TokenBuilder;
use Google\AdsApi\Dfp\DfpSession;
use Google\AdsApi\Dfp\DfpSessionBuilder;
use Google\AdsApi\Dfp\v201805\ServiceFactory;
use Google\AdsApi\Dfp\v201805\Order;
use Google\AdsApi\Dfp\v201805\OrderService;
use Google\AdsApi\Dfp\Util\v201805\DfpDateTimes;
use Google\AdsApi\Dfp\v201805\AdUnitTargeting;
use Google\AdsApi\Dfp\v201805\CostType;
use Google\AdsApi\Dfp\v201805\CreativePlaceholder;
use Google\AdsApi\Dfp\v201805\CreativeRotationType;
use Google\AdsApi\Dfp\v201805\CustomCriteria;
use Google\AdsApi\Dfp\v201805\CustomCriteriaComparisonOperator;
use Google\AdsApi\Dfp\v201805\CustomCriteriaSet;
use Google\AdsApi\Dfp\v201805\CustomCriteriaSetLogicalOperator;
use Google\AdsApi\Dfp\v201805\Goal;
use Google\AdsApi\Dfp\v201805\GoalType;
use Google\AdsApi\Dfp\v201805\InventoryTargeting;
use Google\AdsApi\Dfp\v201805\LineItem;
use Google\AdsApi\Dfp\v201805\LineItemService;
use Google\AdsApi\Dfp\v201805\LineItemType;
use Google\AdsApi\Dfp\v201805\Money;
use Google\AdsApi\Dfp\v201805\NetworkService;
use Google\AdsApi\Dfp\v201805\Size;
use Google\AdsApi\Dfp\v201805\StartDateTimeType;
use Google\AdsApi\Dfp\v201805\Targeting;
use Google\AdsApi\Dfp\v201805\UnitType;
use Google\AdsApi\Dfp\v201805\LineItemCreativeAssociation;
use Google\AdsApi\Dfp\v201805\LineItemCreativeAssociationService;

class Auth{
    public static function createAuth()
    {
        $oAuth2Credential = (new OAuth2TokenBuilder())->fromFile()
            ->build();

        $session = (new DfpSessionBuilder())->fromFile()
            ->withOAuth2Credential($oAuth2Credential)
            ->build();

        return [new ServiceFactory(), $session];
    }
}
class CreateOrders
{

    public static function create(
        ServiceFactory $serviceFactory,
        DfpSession $session,
        $advertiserId,
        $salespersonId,
        $traffickerId,
        $orderName
    ) {
        $orderService = $serviceFactory->createOrderService($session);

        $order = new Order();
        $order->setName($orderName.' | #' . uniqid());
        $order->setAdvertiserId($advertiserId);
        $order->setSalespersonId($salespersonId);
        $order->setTraffickerId($traffickerId);

        $results = $orderService->createOrders([$order]);

        foreach ($results as $i => $order) {
            return $order;
        }
    }
}

class CreateLineItems
{
    public static function create(
        ServiceFactory $serviceFactory,
        DfpSession $session,
        $orderId,
        $hb_pb_key_id,
        $hb_pb_value_id,
        $hb_adid_key_id,
        $hb_adid_value_id,
        $hb_bidder_key_id,
        $hb_bidder_value_id,
        $lineItemName,
        $adUnit,
        $creativesIds,
        $sizes,
        $lineItemCPM
    ) {
        $lineItemService = $serviceFactory->createLineItemService($session);

        // Create inventory targeting.
        $inventoryTargeting = new InventoryTargeting();

        // Create ad unit targeting for the root ad unit (i.e. the whole network).
        $adUnitTargeting = new AdUnitTargeting();
        $adUnitTargeting->setAdUnitId($adUnit);
        $adUnitTargeting->setIncludeDescendants(true);

        $inventoryTargeting->setTargetedAdUnits([$adUnitTargeting]);

        // Create targeting.
        $targeting = new Targeting();
        $targeting->setInventoryTargeting($inventoryTargeting);

        // Custom targeting
        // $hb_pb = new CustomCriteria();
        // $hb_pb->setKeyId(11775270);
        // $hb_pb->setOperator(CustomCriteriaComparisonOperator::IS);
        // $hb_pb->setValueIds([$hb_pb_value_id]);
        //
        // $hb_adid = new CustomCriteria();
        // $hb_adid->setKeyId($hb_adid_key_id);
        // $hb_adid->setOperator(CustomCriteriaComparisonOperator::IS);
        // $hb_adid->setValueIds([$hb_adid_value_id]);
        //
        // $hb_bidder = new CustomCriteria();
        // $hb_bidder->setKeyId($hb_bidder_key_id);
        // $hb_bidder->setOperator(CustomCriteriaComparisonOperator::IS);
        // $hb_bidder->setValueIds([$hb_bidder_value_id]);
        //
        // $customCriteriaSet = new CustomCriteriaSet();
        // $customCriteriaSet->setLogicalOperator(
        //     CustomCriteriaSetLogicalOperator::AND_VALUE
        // );
        // $customCriteriaSet->setChildren(
        //     [$hb_pb,$hb_adid,$hb_bidder]
        // );
        //
        // $targeting->setCustomTargeting($customCriteriaSet);

        // Now setup the line item.
        $lineItem = new LineItem();
        $lineItem->setName($lineItemName.' '. uniqid());
        $lineItem->setOrderId($orderId);
        $lineItem->setLineItemType(LineItemType::PRICE_PRIORITY);
        $lineItem->setTargeting($targeting);
        $lineItem->setAllowOverbook(true);

        // Create placeholders
        $arr_sizes = [];
        foreach ($sizes as $size) {
            $temp = new CreativePlaceholder();
            $temp->setSize(new Size($size['width'], $size['height'], false));
            array_push($arr_sizes, $temp);
        }
        $lineItem->setCreativePlaceholders($arr_sizes);

        $lineItem->setCreativeRotationType(CreativeRotationType::EVEN);

        $lineItem->setStartDateTimeType(StartDateTimeType::IMMEDIATELY);
        $lineItem->setUnlimitedEndDateTime(true);

        $lineItem->setCostType(CostType::CPM);
        $lineItem->setCostPerUnit(new Money('EUR', $lineItemCPM * 1000000));

        $goal = new Goal();
        $goal->setGoalType(GoalType::NONE);
        $lineItem->setPrimaryGoal($goal);

        // Create the line items on the server.
        $results = $lineItemService->createLineItems([$lineItem]);

        // Print out some information for each created line item.
        $line_items_arr = [];
        foreach ($results as $i => $lineItem) {
            printf(
                "%d) Line item with ID %d, belonging to order ID %d, and name"
                . " '%s' was created.%s",
                $i,
                $lineItem->getId(),
                $lineItem->getOrderId(),
                $lineItem->getName(),
                PHP_EOL
            );
            array_push($line_items_arr, $lineItem->getId());
            $licas = new CreateLicas();
            $licas->create(
                $serviceFactory,
                $session,
                $line_items_arr,
                $creativesIds,
                $sizes
            );
        }

    }
}
class CreateLicas
{
    public static function create(
        ServiceFactory $serviceFactory,
        DfpSession $session,
        $lineItems,
        $creativesIds,
        $sizes
    ) {
        $licaService = $serviceFactory->createLineItemCreativeAssociationService($session);
        $lica_arr = [];
        foreach ($lineItems as $lineItem) {
            foreach ($creativesIds as $creative) {
                $lica = new LineItemCreativeAssociation();
                $lica->setCreativeId(intval($creative));
                $lica->setLineItemId(intval($lineItem));

                foreach ($sizes as $size) {
                    $lica->setSizes([new Size($size['width'], $size['height'], false)]);
                }

                array_push($lica_arr, $lica);
            }
        }

        // Create the LICAs on the server.
        $results = $licaService->createLineItemCreativeAssociations($lica_arr);

        // Print out some information for each created LICA.
        foreach ($results as $i => $lica) {
            printf(
                "%d) LICA with line item ID %d, creative ID %d, and"
                . " status '%s' was created.%s",
                $i,
                $lica->getLineItemId(),
                $lica->getCreativeId(),
                $lica->getStatus(),
                PHP_EOL
            );
        }


    }
}

// define basic setting
$advertiser_id = 4606091510;
$sales_person_id = 244521067;
$trafficker_id = 244521067;
$order_to_line_item_limit = 450;
$rate_from = 0;
$rate_to = 50;
$granularity = 0.1;
$prebid_order_name_pattern = 'Prebid ';
$prebid_line_item_name_pattern = 'Prebid line item ';
$creatives_ids = [
    138240542780
];
$ad_unit = 21732932399;
$sizes = [
    [
        'height' => 400,
        'width' => 240
    ],
    [
        'height' => 600,
        'width' => 300
    ]
];
$hb_pb_key_id = 11775270;
$hb_pb_value_id = 1;
$hb_adid_key_id = 11775273;
$hb_adid_value_id = 1;
$hb_bidder_key_id = 11775276;
$hb_bidder_value_id = 1;

// calculate the number of orders
$number_of_line_items = (1/$granularity) * $rate_to;
$number_of_orders = $number_of_line_items/$order_to_line_item_limit;
$number_of_orders = ceil($number_of_orders);

// auth first
$auth = new Auth();
$creds = $auth->createAuth();

// create orders
for ($i=1; $i <= $number_of_orders; $i++) {
    // generate a proper order name
    $range_up = $order_to_line_item_limit * $i;
    $range_down = ($order_to_line_item_limit * $i - $order_to_line_item_limit) + 1;
    $range =  $range_down. ' - '.$range_up;
    $order_name = $prebid_order_name_pattern.$range;

    $orders = new CreateOrders();
    $order = $orders->create(
        $creds[0],
        $creds[1],
        $advertiser_id,
        $sales_person_id,
        $sales_person_id,
        $order_name
    );

    $created_order_id = $order->getId();

    // create a set of line items for the order
    $line_items_arr = [];
    for ($k=$range_down; $k <= $range_up ; $k++) {
        if( $k > $number_of_line_items ) {return;}
        // calculate CPM
        $cpm = $granularity * $k;
        $cpm = number_format((float)$cpm, 2, '.', '');
        // generate friendly line item name
        $line_item_name = $prebid_line_item_name_pattern.$k;

        $line_item = new CreateLineItems();
        $created_line_item = $line_item->create(
            $creds[0],
            $creds[1],
            $created_order_id,
            $hb_pb_key_id,
            $hb_pb_value_id,
            $hb_adid_key_id,
            $hb_adid_value_id,
            $hb_bidder_key_id,
            $hb_bidder_value_id,
            $line_item_name,
            $ad_unit,
            $creatives_ids,
            $sizes,
            $cpm
        );
    }
}

?>
