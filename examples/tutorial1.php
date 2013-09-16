<?php

require('../mailin.php');
/*
 * This will initiate the API with the endpoint and your access and secret key.
 *
 */
$mailin = new Mailin('http://api.mailinblue.com/v1.0','Your access key','Your secret key');
/*
 * This will create a new campaign
 *
 */
