<?php

require('Mailin.php');
/*
 * This will initiate the API with the endpoint and your access key.
 *
 */
$mailin = new Mailin('https://api.sendinblue.com/v2.0','Your access key');

/*
 * This will send a transactional SMS
 *
 */
/** Prepare variables for easy use **/ 

$data = array( "to" => "+331234567890",
			"from" => "From",
			"text" => "Good morning - test",
			"web_url" => "http://example.com",
			"tag" => "Tag1",
			"type" => ""
			);

var_dump($mailin->send_sms($data));

?>