<?php

require 'sendGrid.php';

$payment_status = $_POST['payment_status'];
if ($payment_status === 'Completed') {
    $payer_email = $_POST['payer_email'];    
    error_log(date('[Y-m-d H:i e] ')."Sending email to: ".$payer_email);

    sendGridEmail($payer_email, 'thanksEmail.htm', 'תודה שרכשתם עם נתינת לולב');        
    sleep(3);
    sendGridEmail($payer_email, 'shareEmail.htm', 'נתינת לולב - קונים ארבעת המינים והרווח לצדקה');        
}

/*


// STEP 1: read POST data

// Reading POSTed data directly from $_POST causes serialization issues with array data in the POST.
// Instead, read raw POST data from the input stream. 
$raw_post_data = file_get_contents('php://input');

$raw_post_array = explode('&', $raw_post_data);

$myPost = array();
foreach ($raw_post_array as $keyval) {
    $keyval = explode('=', $keyval);
    if (count($keyval) == 2) {
        $myPost[$keyval[0]] = urldecode($keyval[1]);
    }
}

// read the IPN message sent from PayPal and prepend 'cmd=_notify-validate'
$req = 'cmd=_notify-validate';
if (function_exists('get_magic_quotes_gpc')) {
    $get_magic_quotes_exists = true;
} 
foreach ($myPost as $key => $value) {        
    if ($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) { 
        $value = urlencode(stripslashes($value)); 
    } else {
        $value = urlencode($value);
    }
    $req .= "&$key=$value";
}


// STEP 2: POST IPN data back to PayPal to validate

$ch = curl_init('https://paypal.com/cgi-bin/webscr');                 
// $ch = curl_init('https://sandbox.paypal.com/cgi-bin/webscr');

curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_NONE);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));

curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FAILONERROR, true);
curl_setopt($ch, CURLOPT_FORBID_REUSE, true);


// In wamp-like environments that do not come bundled with root authority certificates,
// please download 'cacert.pem' from "http://curl.haxx.se/docs/caextract.html" and set 
// the directory path of the certificate as shown below:
curl_setopt($ch, CURLOPT_CAINFO, 'cacert.pem');
error_log(date('[Y-m-d H:i e] ').'Executing crul');
if (curl_exec($ch) === false) {
    error_log(date('[Y-m-d H:i e] ')."Crul error: ".curl_error($ch));
    curl_close($ch);
    exit;
}
curl_close($ch);

// STEP 3: Inspect IPN validation result and act accordingly

if (strcmp($res, "VERIFIED") == 0) {
    // The IPN is verified, process it:
    // check whether the payment_status is Completed
    // check that txn_id has not been previously processed
    // check that receiver_email is your Primary PayPal email
    // check that payment_amount/payment_currency are correct
    // process the notification

    // assign posted variables to local variables
    $item_name = $_POST['item_name'];
    $item_number = $_POST['item_number'];
    $payment_status = $_POST['payment_status'];
    $payment_amount = $_POST['mc_gross'];
    $payment_currency = $_POST['mc_currency'];
    $txn_id = $_POST['txn_id'];
    $receiver_email = $_POST['receiver_email'];
    $payer_email = $_POST['payer_email'];
    error_log(date('[Y-m-d H:i e] ')."Payer email: ".$payer_email);
    
    if ($payment_status === 'Completed') {
        sendGridEmail($payer_email, 'thanksEmail.htm', 'תודה שרכשתם עם נתינת לולב');        
        sleep(3);
        sendGridEmail($payer_email, 'shareEmail.htm', 'נתינת לולב - קונים ארבעת המינים והרווח לצדקה');        
    }

    // IPN message values depend upon the type of notification sent.
    // To loop through the &_POST array and print the NV pairs to the screen:
    // foreach($_POST as $key => $value) {
    //   echo $key." = ". $value."<br>";
    // }
} else if (strcmp($res, "INVALID") == 0) {
    // IPN invalid, log for manual investigation
    error_log(date('[Y-m-d H:i e] ')."INVALID");

    // echo "The response from IPN was: <b>" .$res ."</b>";
}
*/