# SendinBlue Php Library

This is the SendinBlue Php library. It implements the various exposed APIs that you can read more about on https://apidocs.sendinblue.com.


## Quickstart

 * You will need to first get the Access key and Secret key from [SendinBlue](https://www.sendinblue.com).

 * Assuming that you have cloned this git repo, or downloaded mailin.php and its in the same directory than the script. You can use this small sample script to get started

```PHP
<?php
require('mailin.php');
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
$text= "This is the text";
$cc = array("cc@example.net"=>"cc whom!"); 
$bcc = array("bcc@example.net"=>"bcc whom!");
$replyto = array("replyto@email.com","reply to!"); 
$attachment = array(); //provide the absolute url of the attachment/s 
$headers = array("Content-Type"=> "text/html; charset=iso-8859-1","X-Ewiufkdsjfhn"=> "hello","X-Custom" => "Custom");
var_dump($mailin->send_email($to,$subject,$from,$html,$text,$cc,$bcc,$replyto,$attachment,$headers));

?>
```

 * To explore more, you should visit the [SendinBlue API documentation](https://apidocs.sendinblue.com).

## Available functions

List of API calls that you can make. Please do note that the order of parameters are important.

### Campaign calls

 * get_account() - Get your account information
 * get_smtp_details() - Get your SMTP account information
 * create_child_account($email,$password,$company_org,$first_name,$last_name,$credits,$associate_ip) - Create a Reseller child account
 * update_child_account($child_authkey,$company_org,$first_name,$last_name,$password,$associate_ip,$disassociate_ip) - Update a Reseller child account
 * delete_child_account($child_authkey) - Delete a Reseller child account
 * get_child_account($child_authkey) - Get Reseller child accounts
 * add_remove_child_credits($childauthkey,$add_credits,$remove_credits) - Add/Remove Reseller child credits
 * get_campaigns($type,$status,$page,$page_limit) - Get list of all campaigns or of specific type or status or both
 * get_campaign($id) - Get specific campaign object
 * create_campaign($category,$from_name,$name,$bat_sent,$html_content,$html_url,$listid,$scheduled_date,$subject,$from_email,$reply_to,$to_field,$exclude_list,$attachmentUrl,$inline_image) - Create a campaign
 * delete_campaign($id) - Delete a campaign
 * update_campaign($id,$category,$from_name,$name,$bat_sent,$html_content,$html_url,$listid,$scheduled_date,$subject,$from_email,$reply_to,$to_field,$exclude_list,$attachmentUrl,$inline_image) - Update campaign information
 * campaign_report_email($id,$lang,$email_subject,$email_to,$email_content_type,$email_bcc,$email_cc,$email_body) - Sending reports to specific emails
 * campaign_recipients_export($id,$notify_url,$type) - Export recipients of a campaign
 * send_bat_email($campid,$email_to) - Send a test Email (bat)
 * create_trigger_campaign($category,$from_name,$name,$bat_sent,$html_content,$html_url,$listid,$scheduled_date,$subject,$from_email,$reply_to,$to_field,$exclude_list,$recurring,$attachmentUrl,$inline_image) - Create a trigger campaign
 * update_trigger_campaign($id,$category,$from_name,$name,$bat_sent,$html_content,$html_url,$listid,$scheduled_date,$subject,$from_email,$reply_to,$to_field,$exclude_list,$recurring,$attachmentUrl,$inline_image) - Update trigger campaign information
 * campaign_share_link($campaign_ids) - Get campaign share link
 * update_campaign_status($id,$status) - Modify a campaign status
 * get_folders() - Get list of all the folder details.
 * get_folder($id) - Get all the folder details for folder with id <id>
 * create_folder($name) - Create a folder
 * delete_folder($id) - Delete folder with folder id <id>
 * update_folder($id,$name) - Update folder with folder id <id>
 * get_lists() - Get all the lists
 * get_list($id) - Get information about a list
 * create_list($list_name,$list_parent) - Create a list
 * delete_list($id) - Delete a list
 * update_list($id,$list_name,$list_parent) - Updating a list
 * display_list_users($listids,$page,$page_limit) - Display details of all users for the given lists
 * add_users_list($id,$users) - Add users to a list
 * delete_users_list($id,$users) - Delete users from a list
 * get_attributes() - Listing all attributes
 * get_attribute($type) - Listing a certain type attributes
 * create_attribute($type,$data) - Creating attributes
 * delete_attribute($type,$data) - Deleting attributes of the given type
 * get_user($email) - Get information about a user/email
 * create_update_user($email,$attributes,$blacklisted,$listid,$listid_unlink,$blacklisted_sms) - Create/Update a user information
 * delete_user($email) - Deleting user from db is not permitted but this action will unlink him from all lists
 * import_users($url,$listids,$notify_url,$name,$folder_id) - Import users/emails
 * export_users($export_attrib,$filter,$notify_url) - Export users/emails
 * get_processes() - Get information about all background processes
 * get_process($id) - Get information about a specific process
 * get_senders($option) - Get information about all/specific senders
 * create_sender($sender_name,$sender_email,$ip_domain) - Create a sender
 * delete_sender($id) - Delete a sender
 * update_sender($id,$sender_name,$sender_email,$ip_domain) - Update a sender

### SMTP calls

 * get_report($limit,$start_date,$end_date,$offset,$date,$days,$email) - Retrieve information for all report events
 * get_statistics($aggregate,$tag,$days,$end_date,$start_date) - Get aggregate statistics about emails sent
 * get_webhooks() - List registered webhooks
 * get_webhook($id) - Get information about a webhook
 * create_webhook($url,$description,$events) - Registering a webhook
 * delete_webhook($id) - Deleting a webhook
 * update_webhook($id,$url,$description,$events) - Editing a webhook
 * delete_bounces($start_date,$end_date,$email) - Deleting bounces
 * send_email($to,$subject,$from,$html,$text,$cc,$bcc,$replyto,$attachment,$headers) - Sending out a transactional email
 * send_transactional_template($id,$to,$cc,$bcc,$attr,$attachmentUrl,$attachment) - Send templates created on SendinBlue, through SendinBlue smtp.
 * create_template($from_name,$name,$bat_sent,$html_content,$html_url,$subject,$from_email,$reply_to,$to_field,$status,$attach) - Create a template 
 * update_template($id,$from_name,$name,$bat_sent,$html_content,$html_url,$subject,$from_email,$reply_to,$to_field,$status,$attach) - Update template information

### SMS call

 * send_sms($to,$from,$text,$web_url,$tag,$type) - Sending a SMS
 * create_sms_campaign($camp_name,$sender,$content,$bat_sent,$listids,$exclude_list,$scheduled_date) - Create a SMS campaign
 * update_sms_campaign($id,$camp_name,$sender,$content,$bat_sent,$listids,$exclude_list,$scheduled_date) - Update a SMS campaign
 * send_bat_sms($campid,$mobilephone) - Send a test SMS campaign

####Recommendation:

If you face any error like "Curl error: SSL certificate problem, verify that the CA cert is OK. Details: error:14090086:SSL routines:func(144):reason(134)\n", with our library then by adding the below line of code just before curl_exec() ( line no. 48 ) in mailin.php file, you may no longer face this issue.
```PHP
curl_setopt($ch, CURLOPT_CAINFO, "PATH_TO/cacert.pem");
```
The content of the file is available here: http://curl.haxx.se/ca/cacert.pem