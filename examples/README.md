# Examples

 * tutorial1.php - Sending a transactional email
 * tutorial2.php - Get all campaigns
 * tutorial3.php - Send an SMS

## Available functions

List of API calls that you can make, you can click to read more about it. Please do note that the order of parameters are important.


### Campaign calls

 * [get_account](https://apidocs.sendinblue.com/account/)() - Get your account information
 * [get_campaigns](https://apidocs.sendinblue.com/campaign/#1)($type) - Get list of all campaigns or of specific type: "classic", "trigger", "sms"
 * [get_campaign](https://apidocs.sendinblue.com/campaign/#1)($id) - Get specific campaign object
 * [create_campaign](https://apidocs.sendinblue.com/campaign/#2)($category,$from_name,$name,$bat_sent,$html_content,$html_url,$listid,$scheduled_date,$subject,$from_email,$reply_to) - Create a campaign
 * [delete_campaign](https://apidocs.sendinblue.com/campaign/#3)($id) - Delete a campaign
 * [update_campaign](https://apidocs.sendinblue.com/campaign/#4)($id,$category,$from_name,$name,$bat_sent,$html_content,$html_url,$listid,$scheduled_date,$subject,$from_email,$reply_to) - Update campaign information
 * [campaign_report_email](https://apidocs.sendinblue.com/campaign/#5)($id,$lang,$email_subject,$email_to,$email_content_type,$email_bcc,$email_cc,$email_body) - Sending reports to specific emails
 * [campaign_recipients_export](https://apidocs.sendinblue.com/campaign/#6)($id,$notify_url,$type) - Export recipients of a campaign
 * [get_folders](https://apidocs.sendinblue.com/folder/#1)() - Get list of all the folder details.
 * [get_folder](https://apidocs.sendinblue.com/folder/#2)($id) - Get all the folder details for folder with id <id>
 * [create_folder](https://apidocs.sendinblue.com/folder/#3)($name) - Create a folder
 * [delete_folder](https://apidocs.sendinblue.com/folder/#4)($id) - Delete folder with folder id <id>
 * [update_folder](https://apidocs.sendinblue.com/folder/#5)($id,$name) - Update folder with folder id <id>
 * [get_lists](https://apidocs.sendinblue.com/list/#1)() - Get all the lists
 * [get_list](https://apidocs.sendinblue.com/list/#2)($id) - Get information about a list
 * [create_list](https://apidocs.sendinblue.com/list/#3)($list_name,$list_parent) - Create a list
 * [delete_list](https://apidocs.sendinblue.com/list/#4)($id) - Delete a list
 * [update_list](https://apidocs.sendinblue.com/list/#5)($id,$list_name,$list_parent) - Updating a list
 * [add_users_list](https://apidocs.sendinblue.com/list/#6)($id,$users) - Add users to a list
 * [delete_users_list](https://apidocs.sendinblue.com/list/#7)($id,$users) - Delete users from a list
 * [get_attributes](https://apidocs.sendinblue.com/attribute/#1)() - Listing all attributes
 * [get_attribute](https://apidocs.sendinblue.com/attribute/#2)($type) - Listing a certain type attributes
 * [create_attribute](https://apidocs.sendinblue.com/attribute/#3)($type,$data) - Creating attributes
 * [delete_attribute](https://apidocs.sendinblue.com/attribute/#4)($type,$data) - Deleting attributes of the given type
 * [get_user](https://apidocs.sendinblue.com/user/#2)($email) - Get information about a user/email
 * [create_user](https://apidocs.sendinblue.com/user/#1)($attributes,$blacklisted,$email,$listid) - Add a new user/email
 * [delete_user](https://apidocs.sendinblue.com/user/#4)($email) - Deleting user from db is not permitted but this action will unlink him from all lists
 * [update_user](https://apidocs.sendinblue.com/user/#3)($email,$attributes,$blacklisted,$listid,$listid_unlink) - Edit a user/email information
 * [import_users](https://apidocs.sendinblue.com/user/#5)($url,$listids,$notify_url,$name) - Import users/emails
 * [export_users](https://apidocs.sendinblue.com/user/#6)($export_attrib,$filter,$notify_url) - Export users/emails
 * [get_processes](https://apidocs.sendinblue.com/process/#1)() - Get information about all background processes
 * [get_process](https://apidocs.sendinblue.com/process/#2)($id) - Get information about a specific process

### SMTP calls

 * [get_report](https://apidocs.sendinblue.com/report/)($limit,$start_date,$end_date,$offset,$date,$days,$email) - Retrieve information for all report events
 * [get_statistics](https://apidocs.sendinblue.com/statistics/)($aggregate,$tag,$days,$end_date,$start_date) - Get aggregate statistics about emails sent
 * [get_webhooks](https://apidocs.sendinblue.com/webhooks/#1)() - List registered webhooks
 * [get_webhook](https://apidocs.sendinblue.com/webhooks/#2)($id) - Get information about a webhook
 * [create_webhook](https://apidocs.sendinblue.com/webhooks/#3)($url,$description,$events) - Registering a webhook
 * [delete_webhook](https://apidocs.sendinblue.com/webhooks/#5)($id) - Deleting a webhook
 * [update_webhook](https://apidocs.sendinblue.com/webhooks/#4)($id,$url,$description,$events) - Editing a webhook
 * [delete_bounces](https://apidocs.sendinblue.com/bounces/)($start_date,$end_date,$email) - Deleting bounces
 * [send_email](https://apidocs.sendinblue.com/tutorial-sending-transactional-email/)($to,$subject,$from,$html,$text,$cc,$bcc,$replyto,$attachment,$headers) - Sending out a transactional email
 * [send_transactional_template](https://apidocs.sendinblue.com/template/)($id,$to,$cc,$bcc,$attr) - Send templates created on mailin, through mailin smtp.

### SMS call

 * [send_sms](https://apidocs.sendinblue.com/sms/)($to,$from,$text,$web_url,$tag) - Sending a SMS
