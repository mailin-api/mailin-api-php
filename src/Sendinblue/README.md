# SendinBlue Php Library

This is the SendinBlue Php library. It implements the various exposed APIs that you can read more about on https://apidocs.sendinblue.com.


## Installation and Quickstart

 * You will need to first get the Access key from [SendinBlue](https://www.sendinblue.com).

 * You can install the SendinBlue API using [Composer](https://packagist.org/packages/mailin-api/mailin-api-php). Just add the following to your composer.json:

    ```{
        "require": {
            "mailin-api/mailin-api-php": "dev-master"
        }
    }```

   You will then need to:
 * Run ``composer install`` to get these dependencies added to your vendor directory
 * Add the autoloader to your application with this line: ``require("vendor/autoload.php")``

You can use below sample script to get started.

```PHP
<?php
use Sendinblue\Mailin
/*
 * This will initiate the API with the endpoint and your access key.
 *
 */
$mailin = new Mailin('https://api.sendinblue.com/v2.0','Your access key');  

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

List of API calls that you can make, you can click to read more about it. Please do note that the order of parameters are important.

### Campaign calls

 * [get_account](https://apidocs.sendinblue.com/account/#1)() - Get your account information
 * [get_smtp_details](https://apidocs.sendinblue.com/account/#7)() - Get your SMTP account information
 * [create_child_account](https://apidocs.sendinblue.com/account/#2)($email,$password,$company_org,$first_name,$last_name,$credits,$associate_ip) - Create a Reseller child account
 * [update_child_account](https://apidocs.sendinblue.com/account/#3)($child_authkey,$company_org,$first_name,$last_name,$password,$associate_ip,$disassociate_ip) - Update a Reseller child account
 * [delete_child_account](https://apidocs.sendinblue.com/account/#4)($child_authkey) - Delete a Reseller child account
 * [get_reseller_child](https://apidocs.sendinblue.com/account/#5)($child_authkey) - Get Reseller child accounts
 * [add_remove_child_credits](https://apidocs.sendinblue.com/account/#6)($childauthkey,$add_credits,$remove_credits) - Add/Remove Reseller child credits
 * [get_campaigns_v2](https://apidocs.sendinblue.com/campaign/#1)($type,$status,$page,$page_limit) - Get list of all campaigns or of specific type or status or both
 * [get_campaign_v2](https://apidocs.sendinblue.com/campaign/#1)($id) - Get specific campaign object
 * [create_campaign](https://apidocs.sendinblue.com/campaign/#2)($category,$from_name,$name,$bat_sent,$html_content,$html_url,$listid,$scheduled_date,$subject,$from_email,$reply_to,$to_field,$exclude_list,$attachmentUrl,$inline_image) - Create a campaign
 * [delete_campaign](https://apidocs.sendinblue.com/campaign/#3)($id) - Delete a campaign
 * [update_campaign](https://apidocs.sendinblue.com/campaign/#4)($id,$category,$from_name,$name,$bat_sent,$html_content,$html_url,$listid,$scheduled_date,$subject,$from_email,$reply_to,$to_field,$exclude_list,$attachmentUrl,$inline_image) - Update campaign information
 * [campaign_report_email](https://apidocs.sendinblue.com/campaign/#5)($id,$lang,$email_subject,$email_to,$email_content_type,$email_bcc,$email_cc,$email_body) - Sending reports to specific emails
 * [campaign_recipients_export](https://apidocs.sendinblue.com/campaign/#6)($id,$notify_url,$type) - Export recipients of a campaign
 * [send_bat_email](https://apidocs.sendinblue.com/campaign/#7)($campid,$email_to) - Send a test Email (bat)
 * [create_trigger_campaign](https://apidocs.sendinblue.com/campaign/#8)($category,$from_name,$name,$bat_sent,$html_content,$html_url,$listid,$scheduled_date,$subject,$from_email,$reply_to,$to_field,$exclude_list,$recurring,$attachmentUrl,$inline_image) - Create a trigger campaign
 * [update_trigger_campaign](https://apidocs.sendinblue.com/campaign/#9)($id,$category,$from_name,$name,$bat_sent,$html_content,$html_url,$listid,$scheduled_date,$subject,$from_email,$reply_to,$to_field,$exclude_list,$recurring,$attachmentUrl,$inline_image) - Update trigger campaign information
 * [share_campaign](https://apidocs.sendinblue.com/campaign/#10)($campaign_ids) - Get campaign share link
 * [update_campaign_status](https://apidocs.sendinblue.com/campaign/#11)($id,$status) - Modify a campaign status
 * [get_folders](https://apidocs.sendinblue.com/folder/#1)($page,$page_limit) - Get list of all the folder details.
 * [get_folder](https://apidocs.sendinblue.com/folder/#2)($id) - Get all the folder details for folder with id <id>
 * [create_folder](https://apidocs.sendinblue.com/folder/#3)($name) - Create a folder
 * [delete_folder](https://apidocs.sendinblue.com/folder/#4)($id) - Delete folder with folder id <id>
 * [update_folder](https://apidocs.sendinblue.com/folder/#5)($id,$name) - Update folder with folder id <id>
 * [get_lists](https://apidocs.sendinblue.com/list/#1)($page,$page_limit) - Get all the lists
 * [get_list](https://apidocs.sendinblue.com/list/#2)($id) - Get information about a list
 * [create_list](https://apidocs.sendinblue.com/list/#3)($list_name,$list_parent) - Create a list
 * [delete_list](https://apidocs.sendinblue.com/list/#4)($id) - Delete a list
 * [update_list](https://apidocs.sendinblue.com/list/#5)($id,$list_name,$list_parent) - Updating a list
 * [display_list_users](https://apidocs.sendinblue.com/list/#8)($listids,$page,$page_limit) - Display details of all users for the given lists
 * [add_users_list](https://apidocs.sendinblue.com/list/#6)($id,$users) - Add users to a list
 * [delete_users_list](https://apidocs.sendinblue.com/list/#7)($id,$users) - Delete users from a list
 * [get_attributes](https://apidocs.sendinblue.com/attribute/#1)() - Listing all attributes
 * [get_attribute](https://apidocs.sendinblue.com/attribute/#2)($type) - Listing a certain type attributes
 * [create_attribute](https://apidocs.sendinblue.com/attribute/#3)($type,$data) - Creating attributes
 * [delete_attribute](https://apidocs.sendinblue.com/attribute/#4)($type,$data) - Deleting attributes of the given type
 * [get_user](https://apidocs.sendinblue.com/user/#2)($email) - Get information about a user/email
 * [create_update_user](https://apidocs.sendinblue.com/user/#1)($email,$attributes,$blacklisted,$listid,$listid_unlink,$blacklisted_sms) - Create/Update a user information
 * [delete_user](https://apidocs.sendinblue.com/user/#3)($email) - Deleting user from db is not permitted but this action will unlink him from all lists
 * [import_users](https://apidocs.sendinblue.com/user/#4)($url,$listids,$notify_url,$name,$folder_id) - Import users/emails
 * [export_users](https://apidocs.sendinblue.com/user/#5)($export_attrib,$filter,$notify_url) - Export users/emails
 * [get_processes](https://apidocs.sendinblue.com/process/#1)($page,$page_limit) - Get information about all background processes
 * [get_process](https://apidocs.sendinblue.com/process/#2)($id) - Get information about a specific process
 * [get_senders](https://apidocs.sendinblue.com/sender-management/#1)($option) - Get information about all/specific senders
 * [create_sender](https://apidocs.sendinblue.com/sender-management/#2)($sender_name,$sender_email,$ip_domain) - Create a sender
 * [delete_sender](https://apidocs.sendinblue.com/sender-management/#3)($id) - Delete a sender
 * [update_sender](https://apidocs.sendinblue.com/sender-management/#4)($id,$sender_name,$sender_email,$ip_domain) - Update a sender

### SMTP calls

 * [get_report](https://apidocs.sendinblue.com/report/)($limit,$start_date,$end_date,$offset,$date,$days,$email) - Retrieve information for all report events
 * [get_statistics](https://apidocs.sendinblue.com/statistics/)($aggregate,$tag,$days,$end_date,$start_date) - Get aggregate statistics about emails sent
 * [get_webhooks](https://apidocs.sendinblue.com/webhooks/#1)($is_plat) - Get list of all registered webhooks or of specific type
 * [get_webhook](https://apidocs.sendinblue.com/webhooks/#2)($id) - Get information about a webhook
 * [create_webhook](https://apidocs.sendinblue.com/webhooks/#3)($url,$description,$events,$is_plat) - Registering a webhook
 * [delete_webhook](https://apidocs.sendinblue.com/webhooks/#5)($id) - Deleting a webhook
 * [update_webhook](https://apidocs.sendinblue.com/webhooks/#4)($id,$url,$description,$events) - Editing a webhook
 * [delete_bounces](https://apidocs.sendinblue.com/bounces/)($start_date,$end_date,$email) - Deleting bounces
 * [send_email](https://apidocs.sendinblue.com/tutorial-sending-transactional-email/)($to,$subject,$from,$html,$text,$cc,$bcc,$replyto,$attachment,$headers) - Sending out a transactional email
 * [send_transactional_template](https://apidocs.sendinblue.com/template/)($id,$to,$cc,$bcc,$attr,$attachmentUrl,$attachment) - Send templates created on SendinBlue, through SendinBlue smtp.
 * [create_template](https://apidocs.sendinblue.com/template/#2)($from_name,$name,$bat_sent,$html_content,$html_url,$subject,$from_email,$reply_to,$to_field,$status,$attach) - Create a template 
 * [update_template](https://apidocs.sendinblue.com/template/#3)($id,$from_name,$name,$bat_sent,$html_content,$html_url,$subject,$from_email,$reply_to,$to_field,$status,$attach) - Update template information

### SMS call

 * [send_sms](https://apidocs.sendinblue.com/mailin-sms/#1)($to,$from,$text,$web_url,$tag,$type) - Sending a SMS
 * [create_sms_campaign](https://apidocs.sendinblue.com/mailin-sms/#2)($camp_name,$sender,$content,$bat_sent,$listids,$exclude_list,$scheduled_date) - Create a SMS campaign
 * [update_sms_campaign](https://apidocs.sendinblue.com/mailin-sms/#3)($id,$camp_name,$sender,$content,$bat_sent,$listids,$exclude_list,$scheduled_date) - Update a SMS campaign
 * [send_bat_sms](https://apidocs.sendinblue.com/mailin-sms/#4)($campid,$mobilephone) - Send a test SMS campaign

####Recommendation:

If you face any error like "Curl error: SSL certificate problem, verify that the CA cert is OK. Details: error:14090086:SSL routines:func(144):reason(134)\n", with our library then by adding the below line of code just before curl_exec() ( line no. 37 ) in mailin.php file, you may no longer face this issue.
```PHP
curl_setopt($ch, CURLOPT_CAINFO, "PATH_TO/cacert.pem");
```
The content of the file is available here: http://curl.haxx.se/ca/cacert.pem