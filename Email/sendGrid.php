
<?php

require 'sendgrid-php/sendgrid-php.php';

function sendGridEmail($to, $content, $subject) { 
    $api_key = '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';    

    $sg_from = new SendGrid\Email('נתינת לולב', 'netinatlulav@gmail.com');
    $sg_to = new SendGrid\Email(null, $to);
    $sg_content = new SendGrid\Content('text/html', file_get_contents($content));
    $mail = new SendGrid\Mail($sg_from, $subject, $sg_to, $sg_content);

    $sg = new \SendGrid($api_key);

    $response = $sg->client->mail()->send()->post($mail);

    /**
    echo $response->statusCode();
    echo '<br>';
    echo $response->headers();
    echo '<br>';
    echo $response->body();
    */


    /**

    $url = 'https://api.sendgrid.com/api/mail.send.json';

    $params = array(
        'to'        => $to,
        'from'      => 'netinatlulav@gmail.com',
        'fromname'  => 'נתינת לולב',
        'subject'   => $subject,
        'html'      => file_get_contents($emailContent)
    );

    // Generate curl request
    $request = curl_init($url);

    // Tell PHP not to use SSLv3 (instead opting for TLS)
    curl_setopt($request, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
    curl_setopt($request, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$sendgrid_apikey));

    // Tell curl to use HTTP POST
    curl_setopt($request, CURLOPT_POST, true);

    // Tell curl that this is the body of the POST
    curl_setopt($request, CURLOPT_POSTFIELDS, $params);

    // Tell curl not to return headers, but do return the response
    curl_setopt($request, CURLOPT_HEADER, true);
    curl_setopt($request, CURLOPT_RETURNTRANSFER, true);

    // obtain response
    $response = curl_exec($request);
    echo $to;
    echo '<br>';
    echo $response;
    echo '<br>';
    echo 'done';
    curl_close($request);


    **********************

    $user = 'azure_33ca61b8551a9085ec131c1b69f20437@azure.com';
    $pass = 'R7GuPp77I6zgh6Q';
    $url = 'https://api.sendgrid.com/v3/mail/send';
    $api_key = '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';


    $headr = array();
    $headr[] = 'Authorization: Bearer '.$api_key;
    $headr[] = 'Content-type: application/json';

    $postfields = array(
        'from' => array(
            'email' => 'netinatlulav@gmail.com',
            'name' => 'נתינת לולב'
        ),
        'personalizations' => array(array(
            'to' => array(array('email' => $to)),
            'subject' => $subject
        )),
        'content' => array(array(
            'type' => 'text/plain',
            'value' => file_get_contents($emailContent)
        ))
    );

    // Generate curl request
    $request = curl_init($url);

    curl_setopt($request, CURLOPT_POST, true);
    curl_setopt($request, CURLOPT_HTTPHEADER, $headr);
    curl_setopt($request, CURLOPT_POSTFIELDS, json_encode($postfields));

    // Tell PHP not to use SSLv3 (instead opting for TLS)
    curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
    curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

    // obtain response
    $response = curl_exec($request);
    echo 'r'.$response.'r';

    curl_close($request);
    */
}
