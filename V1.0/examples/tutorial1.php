<?php

require('../mailin.php');
/*
 * This will initiate the API with the endpoint and your access and secret key.
 *
 */
$mailin = new Mailin('https://api.sendinblue.com/v1.0','Your access key','Your secret key');  

/** Prepare variables for easy use **/ 

$to = array("to@example.net"=>"to whom!"); //mandatory
$subject = "My subject"; //mandatory
$from = array("from@email.com","from email!"); //mandatory
$html = "This is the <h1>HTML</h1>"; //mandatory
$text = "This is the text";
$cc = array("cc@example.net"=>"cc whom!"); 
$bcc = array("bcc@example.net"=>"bcc whom!");
$replyto = array("replyto@email.com","reply to!"); 
$attachment = array(); //provide the absolute url of the attachment/s 
$headers = array("Content-Type"=> "text/html; charset=iso-8859-1","X-Ewiufkdsjfhn"=> "hello","X-Custom" => "Custom");

var_dump($mailin->send_email($to,$subject,$from,$html,$text,$cc,$bcc,$replyto,$attachment,$headers));