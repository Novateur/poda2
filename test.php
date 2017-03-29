<?php 
// Install:
// composer require automattic/woocommerce

// Setup:
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
require __DIR__ . '/inc/wc-api/vendor/autoload.php';

use Automattic\WooCommerce\Client;
 $consumer_key = "ck_2b6de8f43c7439aead5fddf9c809a5025a70967a";
    $consumer_secret = "cs_8b2ecb7770b6f10336dfd066e71aa8fefd24a155";
    $wc = new Client(
    'http://localhost:8888/sandbox/printanything/', // Your store URL
    $consumer_key, // Your consumer key
    $consumer_secret, // Your consumer secret
    [
        'version' => 'v3' // WooCommerce API version
    ]
);  
    $orderList = $wc->get('orders', array('fields' => 'order_number,created_at,total_line_items_quantity,total,status'));//an Array
    $orderCount = count($orderList[orders]);

function getOrder(){
    global $orderList;
    global $orderCount;
    foreach($orderList as $key => $keyVal){
//        echo "<pre>"; 
        return $keyVal;
    }
}
    function viewOrder($orderNo){
        global $wc;
        $orderValues = array();
        $order = $wc->get('orders/'.$orderNo); //Full order details link
       
        $customerName = $order[order][customer][first_name]." ".$order[order][customer][last_name] ;//Customer Name in Full
        
        $lineItems = $order[order][line_items]; //List of items ordered
        $lineItemsCount = count($lineItems);
        
        for ($i=0; $i<$lineItemsCount; $i++){
        $lineItemsPName = $order[order][line_items][$i][name]; //Line items Product name
        $lineItemsPQty = $order[order][line_items][$i][quantity]; //Line item product quantity
        $lineItemsPTot = $order[order][line_items][$i][total] ; //Line item total price paid
        $lineItemsPSKU = $order[order][line_items][$i][sku]; //Line items SKU details
        $lineItemsPMeta = $order[order][line_items][$i][meta]; //Array of Line item product Meta property information
        $lineItemsPMetaCount = count($lineItemsPMeta); //Count of product meta information
             echo"<pre>";
            print_r($lineItemsPMetaCount);
            
            for($j=0; $j<$lineItemsPMetaCount; $j++){
                $label = $lineItemsPMeta[$j][label];
                $value = $lineItemsPMeta[$j][value];
                print_r($label.": ".$value." <br/>");
            }
            
//            echo"<pre>";
//            print_r($orderValues);
//            for($j=0; $j<$lineItemsPMetaCount; $j++){
////                $lineItemsPMetaLabel = $lineItemsPMeta[$j][label]; //Line Item Meta label
////                $lineItemsPMetaValue = $lineItemsPMeta[$j][value]; //Line Item Meta Value
////                $meta = array();
////                $meta [$j] = $lineItemsPMetaLabel;
////                $meta [$j] = $lineItemsPMetaValue; 
////                $metaCount = array();
////                $metaCount[] = $j;
////                print_r($lineItemsPMeta[$j]);
////                 echo "<pre>";
////                print_r($lineItemsPMetaLabel." ".$lineItemsPMetaValue." ");
//                
////                $metaCount[] = $meta;
////                echo"<pre>";
////                print_r($meta);
////                $orderValues[meta] = $metaCount;
//            }
            
//            $orderValues [serial_no] = $i;
            $orderValues [customer_name] = $customerName;
            $orderValues [line_item_name] = $lineItemsPName;
            $orderValues [line_item_qty] = $lineItemsPQty;
            $orderValues [line_item_tot] = $lineItemsPTot;
            $orderValues [line_item_sku] = $lineItemsPSKU;
            $orderValues [line_item_meta] = $lineItemsPMeta;           
        }
//        echo"<pre>";
//        print_r($orderValues);
//            return $orderValues;
        
    }
    function viewOrder2($orderNo){
        global $wc;
        $orderValues = array();
        $order = $wc->get('orders/'.$orderNo); //Full order details link
//        $postMeta = get_post_meta($orderNo); get_post_meta_by_id();
       
        $customerName = $order[order][customer][first_name]." ".$order[order][customer][last_name] ;//Customer Name in Full
        
        $lineItems = $order[order][line_items]; //List of items ordered
        $lineItemsCount = count($lineItems);
        echo "<pre>";
//        print_r($postMeta);
            print_r($order);
    }

viewOrder2(7440);
    ?>