<?php 
require __DIR__ . '/inc/wc-api/vendor/autoload.php';
use Automattic\WooCommerce\Client;

$podaobj = new poda("http://localhost/sandbox/printanything/", "ck_2b6de8f43c7439aead5fddf9c809a5025a70967a", "cs_8b2ecb7770b6f10336dfd066e71aa8fefd24a155");  

class poda{
    public $client; //Client address 
    public $consumer_key; //Client's consumer key
    public $consumer_secret; // Client Consumer secret
    public $wc;
    
    function __construct($c, $ckey, $csecret){
        $this->client = $c;
        $this->consumer_key = $ckey;
        $this->consumer_secret = $csecret;
        $this->wc = new Client($this->client, $this->consumer_key, $this->consumer_secret, ['version' => 'v3']);
    }
    
    function getOrder(){
    /*Function to get orders and display it on the timeline*/
    $orderList = $this->wc->get('orders', array('fields' => 'order_number,created_at,total_line_items_quantity,total,status'));//an Array
    $orderCount = count($orderList[orders]);
      foreach($orderList as $key => $keyVal){
        return $keyVal;
      }
    }
    function customerDetails($orderNo){
        $order = $this->wc->get('orders/'.$orderNo);
        $customer = $order[order][customer];
        return $customer;
    }
    
     function viewOrder($orderNo){
       /*  Function to view order details */
        $orderValues = array();
        $order = $this->wc->get('orders/'.$orderNo); //Full order details link
       
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
//            $orderValues [serial_no] = $i;
            $orderValues [customer_name] = $customerName;
            $orderValues [line_item_name] = $lineItemsPName;
            $orderValues [line_item_qty] = $lineItemsPQty;
            $orderValues [line_item_tot] = $lineItemsPTot;
            $orderValues [line_item_sku] = $lineItemsPSKU;
            $orderValues [line_item_meta] = $lineItemsPMeta;
            $orderValues [line_item_meta] = $lineItems;
//            echo"<pre>";
           
        }
        
    }
    /*View list of line items*/
    function lineItems($orderNo){
        $order = $this->wc->get('orders/'.$orderNo); 
        $lineItems = $order[order][line_items];
        return $lineItems;
    }
    /*Line Items Count*/
    function lineItemsCount($orderNo){
        $order = $this->wc->get('orders/'.$orderNo); 
        $countItems = count($order[order][line_items]);
        return $countItems;  
    }
    function cusOrderDetails($orderNo){
        $orderDetails = $this->wc->get('orders/'.$orderNo, array('fields' => 'customer'));
        return $orderDetails; 
    }

}

/*Database Connection Class*/
class dbConnect{
    public $db;
    
    function __construct($host, $dbname, $user, $pass){
        try{
             $connect = new  PDO('mysql:host='.$host.';dbname='.$dbname,$user,$pass);
            $this->db = $connect;
        }catch(PDOException $e){
            echo $e->getMessage()."<br>";
            die();
        }
        $db = null;
    }
    
    function nameQuery(){
        $sql = 'select * from student';
        foreach($this->db->query($sql) as $row){
            $names[]= $row[name];
        }
        return $names;
    }
    function registerPress(){
        
    }
//    function nameQuery(){
//        $sql = 'select * from student';
//        foreach($this->db->query($sql) as $row){
//            return $row[name];;
//        }
//        
//    }
}
?>