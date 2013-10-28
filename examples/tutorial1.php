<?php

require('../mailin.php');
/*
 * This will initiate the API with the endpoint and your access and secret key.
 *
 */
$mailin = new Mailin('https://api.mailinblue.com/v1.0','Your access key','Your secret key');
/*
 * This will send an email to to@email.com, without any CC or BCC without any attachements.
 *
 */
var_dump($mailin->send_email(array(),"This is the text",array(),array("replyto@email.com","reply to!"),"This is the HTML",array("to@email.com"=>"to whom!"),array(),array("sender@email.com","sender email!"),"Subject"));

?>
