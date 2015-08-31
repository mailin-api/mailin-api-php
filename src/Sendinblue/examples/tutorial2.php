<?php

use Sendinblue\Mailin;
/*
 * This will initiate the API with the endpoint and your access key.
 *
 */
$mailin = new Mailin('https://api.sendinblue.com/v2.0','Your access key');

/*
 * This will get all your campaigns
 *
 */
/** Prepare variables for easy use **/ 

$data = array( "type"=>"classic",
			"status"=>"queued",
			"page"=>1,
			"page_limit"=>10
			);

var_dump($mailin->get_campaigns_v2($data));

?>