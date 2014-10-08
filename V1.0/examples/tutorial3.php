<?php

require('../mailin.php');
/*
 * This will initiate the API with the endpoint and your access and secret key.
 *
 */
$mailin = new Mailin('https://api.sendinblue.com/v1.0','Your access key','Your secret key');
/*
 * This will send an SMS
 *
 */
var_dump($mailin->send_sms("1231231313","From!","This is a test","http://example.com","tag1"));

?>
