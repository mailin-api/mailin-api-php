<?php

require('Mailin.php');
/*
 * This will initiate the API with the endpoint and your access key.
 *
 */
$mailin = new Mailin('https://api.sendinblue.com/v2.0','Your access key');
/*
 * This will send an SMS
 *
 */
var_dump($mailin->send_sms("1231231313","From!","This is a test","http://example.com","tag1"));

?>
