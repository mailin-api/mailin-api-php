<?php

require('../mailin.php');
/*
 * This will initiate the API with the endpoint and your access and secret key.
 *
 */
$mailin = new Mailin('https://api.sendinblue.com/v1.0','Your access key','Your secret key');
/*
 * This will get all your campaigns
 *
 */
var_dump($mailin->get_campaigns());

?>
