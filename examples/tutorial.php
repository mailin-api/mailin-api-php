<?php

require('../mailin.php');
/*
 * This will initiate the API with the endpoint and your access and secret key.
 *
 */
$mailin = new Mailin('http://api.mailinblue.com/v1.0','Your access key','Your secret key');
/*
 * This will send an email to to@email.com, without any CC or BCC without any attachements.
 *
 */
$mailin->send_email({"to@email.com":"name1"},{},{},[],{"replyto@email.com":"Reply name"},"Subject","Text body","HTML body",[]);

?>
