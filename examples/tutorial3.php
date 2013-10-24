<?php

require('../mailin.php');
/*
 * This will initiate the API with the endpoint and your access and secret key.
 *
 */
$mailin = new Mailin('https://api.mailinblue.com/v1.0','Your access key','Your secret key');
/*
 * This will send an SMS
 *
 */
var_dump($mailin->send_sms("This is a test","tag1","http://desinerd.com","Dipankar","919811452098"));

?>
