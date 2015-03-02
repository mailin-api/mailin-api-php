<?php

require('Mailin.php');
/*
 * This will initiate the API with the endpoint and your access key.
 *
 */
$mailin = new Mailin('https://api.sendinblue.com/v2.0','Your access key');
/*
 * This will get all your campaigns
 *
 */
var_dump($mailin->get_campaigns_v2());

?>
