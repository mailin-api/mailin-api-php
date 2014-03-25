<?php
require('mailin.php');
/*
This will initiate the API with the endpoint and your access and secret key.
*/
$mailin = new Mailin('https://api.sendinblue.com/v1.0','Your access key','Your secret key');
/*
This will get the list of all your campaigns
*/
$mailin->get_campaigns();
?>
