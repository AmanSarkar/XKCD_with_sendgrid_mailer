<?php

require 'vendor/autoload.php'; 

$Api_key= "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";
$email = new \SendGrid\Mail\Mail(); 
$email->setFrom("rtcamp.test.project@gmail.com", "Aman");
$email->setSubject("Sending with SendGrid is Fun");
$email->addTo("$email", "its me");
//$email->addContent("text/plain", "hemant");
$email->addContent(
    "text/html", "<strong>and easy to do anywhere, even with PHP</strong>"
);

$sendgrid = new \SendGrid($Api_key);
if($sendgrid->send($email)){
    echo "success";
}else{
    echo "unsucessful";
}


try {
    $response = $sendgrid->send($email);
    print $response->statusCode() . "\n";
    print_r($response->headers());
    print $response->body() . "\n";
} catch (Exception $e) {
    echo 'Caught exception: '. $e->getMessage() ."\n";
}

?>