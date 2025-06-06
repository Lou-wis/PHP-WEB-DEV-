<?php
require_once "vendor/autoload.php";

use Omnipay\Omnipay;

define('CLIENT_ID', 'AfcykdAT8SPJB8O6EeC_kMqhLXrLLf87V2PFlJDJjyErqulCw94XN_V8DoHostetWOWtxuHvYXxH9a6V');
define('CLIENT_SECRET', 'ENeh0l6TdkWZP-J5ksUlQzRHymjqMyFg2UBLLvblau3A4A2hWpfTc6S2DuLNDCIehoaucxECv3ylPotC');

define('PAYPAL_RETURN_URL', 'http://localhost/SYSTEM_DEVELOPMENT/uni-aqua/user/success.php');
define('PAYPAL_CANCEL_URL', 'http://localhost/SYSTEM_DEVELOPMENT/uni-aqua/user/cancel.php');
define('PAYPAL_CURRENCY', 'PHP'); // set your currency here

// Connect with the database
$db = new mysqli('localhost', 'root', '', 'dbua'); 

if ($db->connect_errno) {
    die("Connect failed: ". $db->connect_error);
}

$gateway = Omnipay::create('PayPal_Rest');
$gateway->setClientId(CLIENT_ID);
$gateway->setSecret(CLIENT_SECRET);
$gateway->setTestMode(true); //set it to 'false' when go live

?>