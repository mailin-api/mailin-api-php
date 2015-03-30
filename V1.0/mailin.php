<?php
/**
 * Mailin REST client
 */ 
class Mailin
{
	public $access_key;
	public $secret_key;
	public $base_url;
	public $curl_opts = array();
	public function __construct($base_url,$access_key,$secret_key) 
	{
		if(!function_exists('curl_init')) 
		{
			throw new Exception('Mailin requires CURL module');
		}
		$this->base_url = $base_url;
		$this->access_key = $access_key;
		$this->secret_key = $secret_key;
	}
	/**
	 * Do CURL request with authorization
	 */
	private function do_request($resource,$method,$input)
	{
		$called_url = $this->base_url."/".$resource;
		$ch = curl_init($called_url);
		$c_date_time = date("r");
		$md5_content = "";
		if($input!="") {
		  $md5_content = md5($input);
		}
		$content_type = "application/json";
		$sign_string = $method."\n".$md5_content."\n".$content_type."\n".$c_date_time."\n".$called_url;
		$time_header = 'X-mailin-date:'.$c_date_time;
		$auth_header = 'Authorization:'.$this->access_key.":".base64_encode(hash_hmac('sha1' , utf8_encode($sign_string) ,$this->secret_key));
		$content_header = "Content-Type:application/json";
		if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
			// Windows only over-ride
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		}
		curl_setopt($ch, CURLOPT_HTTPHEADER, array($time_header,$auth_header,$content_header));
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $input);
		$data = curl_exec($ch);
		if(curl_errno($ch))
		{
    		echo 'Curl error: ' . curl_error($ch). '\n';
		}
		curl_close($ch);
		return json_decode($data,true);
	}
	public function get($resource,$input)
	{
		return $this->do_request($resource,"GET",$input);
	}	
	public function put($resource,$input)
	{
		return $this->do_request($resource,"PUT",$input);
	}
	public function post($resource,$input)
	{
		return $this->do_request($resource,"POST",$input);
	}
	public function delete($resource,$input)
	{
		return $this->do_request($resource,"DELETE",$input);
	}
        public function get_account()
        {
                return $this->get("account","");
        }
        public function get_smtp_details()
        {
                return $this->get("account/smtpdetail","");
        }
        public function create_child_account($email,$password,$company_org,$first_name,$last_name,$credits,$associate_ip)
        {
                return $this->post("account",json_encode(array("child_email"=>$email,"password"=>$password,"company_org"=>$company_org,"first_name"=>$first_name,"last_name"=>$last_name,"credits"=>$credits,"associate_ip"=>$associate_ip)));
        }
        public function update_child_account($child_authkey,$company_org,$first_name,$last_name,$password,$associate_ip,$disassociate_ip)
        {
                return $this->put("account",json_encode(array("auth_key"=>$child_authkey,"company_org"=>$company_org,"first_name"=>$first_name,"last_name"=>$last_name,"password"=>$password,"associate_ip"=>$associate_ip,"disassociate_ip"=>$disassociate_ip)));
        }
        public function delete_child_account($child_authkey)
        {
                return $this->delete("account/".$child_authkey,"");
        }
        public function get_child_account($child_authkey)
        {
                return $this->post("account/getchild",json_encode(array("auth_key"=>$child_authkey)));
        }
        public function add_remove_child_credits($child_authkey,$add_credits,$remove_credits)
        {
                return $this->post("account/addrmvcredit",json_encode(array("auth_key"=>$child_authkey,"add_credit"=>$add_credits,"rmv_credit"=>$remove_credits)));
        }
        public function send_sms($to,$from,$text,$web_url,$tag,$type)
        {
                return $this->post("sms",json_encode(array("text"=>$text,"tag"=>$tag,"web_url"=>$web_url,"from"=>$from,"to"=>$to,"type"=>$type)));
        }
        public function create_sms_campaign($camp_name,$sender,$content,$bat_sent,$listids,$exclude_list,$scheduled_date)
        {
                return $this->post("sms",json_encode(array("name"=>$camp_name,"sender"=>$sender,"content"=>$content,"bat"=>$bat_sent,"listid"=>$listids,"exclude_list"=>$exclude_list, "scheduled_date"=>$scheduled_date)));
        }
        public function update_sms_campaign($id,$camp_name,$sender,$content,$bat_sent,$listids,$exclude_list,$scheduled_date)
        {
                return $this->put("sms/".$id,json_encode(array("name"=>$camp_name,"sender"=>$sender,"content"=>$content,"bat"=>$bat_sent,"listid"=>$listids,"exclude_list"=>$exclude_list, "scheduled_date"=>$scheduled_date)));
        }
        public function send_bat_sms($campid,$mobilephone)
        {
                return $this->get("sms/".$campid,json_encode(array("to"=>$mobilephone)));
        }
        public function get_campaigns($type,$status,$page,$page_limit)
        {
                return $this->get("campaign",json_encode(array("type"=>$type,"status"=>$status,"page"=>$page,"page_limit"=>$page_limit)));
        }
        public function get_campaign($id)
        {
                return $this->get("campaign/".$id,"");
        }
        public function create_campaign($category,$from_name,$name,$bat_sent,$html_content,$html_url,$listid,$scheduled_date,$subject,$from_email,$reply_to,$to_field,$exclude_list,$attachmentUrl,$inline_image)
        {
                return $this->post("campaign",json_encode(array("category"=>$category,"from_name"=>$from_name,"name"=>$name,"bat"=>$bat_sent,"html_content"=>$html_content,"html_url"=>$html_url,"listid"=>$listid,"scheduled_date"=>$scheduled_date,"subject"=>$subject,"from_email"=>$from_email,"reply_to"=>$reply_to,"to_field"=>$to_field,"exclude_list"=>$exclude_list,"attachment_url"=>$attachmentUrl,"inline_image"=>$inline_image)));
        }
        public function delete_campaign($id)
        {
                return $this->delete("campaign/".$id,"");
        }
        public function update_campaign($id,$category,$from_name,$name,$bat_sent,$html_content,$html_url,$listid,$scheduled_date,$subject,$from_email,$reply_to,$to_field,$exclude_list,$attachmentUrl,$inline_image)
        {
                return $this->put("campaign/".$id,json_encode(array("category"=>$category,"from_name"=>$from_name,"name"=>$name,"bat"=>$bat_sent,"html_content"=>$html_content,"html_url"=>$html_url,"listid"=>$listid,"scheduled_date"=>$scheduled_date,"subject"=>$subject,"from_email"=>$from_email,"reply_to"=>$reply_to,"to_field"=>$to_field,"exclude_list"=>$exclude_list,"attachment_url"=>$attachmentUrl,"inline_image"=>$inline_image)));
        }
        public function campaign_report_email($id,$lang,$email_subject,$email_to,$email_content_type,$email_bcc,$email_cc,$email_body)
        {
                return $this->post("campaign/".$id."/report",json_encode(array("lang"=>$lang,"email_subject"=>$email_subject,"email_to"=>$email_to,"email_content_type"=>$email_content_type,"email_bcc"=>$email_bcc,"email_cc"=>$email_cc,"email_body"=>$email_body)));
        }
        public function campaign_recipients_export($id,$notify_url,$type)
        {
                return $this->post("campaign/".$id."/recipients",json_encode(array("notify_url"=>$notify_url,"type"=>$type)));
        }
        public function send_bat_email($campid,$email_to)
        {
                return $this->post("campaign/".$campid."/test",json_encode(array("emails"=>$email_to)));
        }
        public function create_trigger_campaign($category,$from_name,$name,$bat_sent,$html_content,$html_url,$listid,$scheduled_date,$subject,$from_email,$reply_to,$to_field,$exclude_list,$recurring,$attachmentUrl,$inline_image)
        {
                return $this->post("campaign",json_encode(array("category"=>$category,"from_name"=>$from_name,"trigger_name"=>$name,"bat"=>$bat_sent,"html_content"=>$html_content,"html_url"=>$html_url,"listid"=>$listid,"scheduled_date"=>$scheduled_date,"subject"=>$subject,"from_email"=>$from_email,"reply_to"=>$reply_to,"to_field"=>$to_field,"exclude_list"=>$exclude_list,"recurring"=>$recurring,"attachment_url"=>$attachmentUrl,"inline_image"=>$inline_image)));
        }
        public function update_trigger_campaign($id,$category,$from_name,$name,$bat_sent,$html_content,$html_url,$listid,$scheduled_date,$subject,$from_email,$reply_to,$to_field,$exclude_list,$recurring,$attachmentUrl,$inline_image)
        {
                return $this->put("campaign/".$id,json_encode(array("category"=>$category,"from_name"=>$from_name,"trigger_name"=>$name,"bat"=>$bat_sent,"html_content"=>$html_content,"html_url"=>$html_url,"listid"=>$listid,"scheduled_date"=>$scheduled_date,"subject"=>$subject,"from_email"=>$from_email,"reply_to"=>$reply_to,"to_field"=>$to_field,"exclude_list"=>$exclude_list,"recurring"=>$recurring,"attachment_url"=>$attachmentUrl,"inline_image"=>$inline_image)));
        }
        public function campaign_share_link($campaign_ids)
        {
                return $this->post("campaign/sharelink",json_encode(array("camp_ids"=>$campaign_ids)));
        }
        public function update_campaign_status($id,$status)
        {
                return $this->put("campaign/".$id."/updatecampstatus",json_encode(array("status"=>$status)));
        }
        public function get_processes()
        {
                return $this->get("process","");
        }
        public function get_process($id)
        {
                return $this->get("process/".$id,"");
        }
        public function get_lists()
        {
                return $this->get("list","");
        }
        public function get_list($id)
        {
                return $this->get("list/".$id,"");
        }
        public function create_list($list_name,$list_parent)
        {
                return $this->post("list",json_encode(array("list_name"=>$list_name,"list_parent"=>$list_parent)));
        }
        public function delete_list($id)
        {
                return $this->delete("list/".$id,"");
        }
        public function update_list($id,$list_name,$list_parent)
        {
                return $this->put("list/".$id,json_encode(array("list_name"=>$list_name,"list_parent"=>$list_parent)));
        }
        public function display_list_users($listids,$page,$page_limit)
        {
                return $this->post("list/display",json_encode(array("listids"=>$listids, "page"=>$page, "page_limit"=>$page_limit)));
        }
        public function add_users_list($id,$users)
        {
                return $this->post("list/".$id."/users",json_encode(array("users"=>$users)));
        }
        public function delete_users_list($id,$users)
        {
                return $this->delete("list/".$id."/delusers",json_encode(array("users"=>$users)));
        }
        public function send_email($to,$subject,$from,$html,$text,$cc,$bcc,$replyto,$attachment,$headers)
        {
                return $this->post("email",json_encode(array("cc"=>$cc,"text"=>$text,"bcc"=>$bcc,"replyto"=>$replyto,"html"=>$html,"to"=>$to,"attachment"=>$attachment,"from"=>$from,"subject"=>$subject,"headers"=>$headers)));
        }
        public function get_webhooks()
        {
                return $this->get("webhook","");
        }
        public function get_webhook($id)
        {
                return $this->get("webhook/".$id,"");
        }
        public function create_webhook($url,$description,$events)
        {
                return $this->post("webhook",json_encode(array("url"=>$url,"description"=>$description,"events"=>$events)));
        }
        public function delete_webhook($id)
        {
                return $this->delete("webhook/".$id,"");
        }
        public function update_webhook($id,$url,$description,$events)
        {
                return $this->put("webhook/".$id,json_encode(array("url"=>$url,"description"=>$description,"events"=>$events)));
        }
        public function get_statistics($aggregate,$tag,$days,$end_date,$start_date)
        {
                return $this->post("statistics",json_encode(array("aggregate"=>$aggregate,"tag"=>$tag,"days"=>$days,"end_date"=>$end_date,"start_date"=>$start_date)));
        }
        public function get_user($email)
        {
                return $this->get("user/".$email,"");
        }
        public function create_user($attributes,$blacklisted,$email,$listid)
        {
                return $this->post("user",json_encode(array("attributes"=>$attributes,"blacklisted"=>$blacklisted,"email"=>$email,"listid"=>$listid)));
        }
        public function delete_user($email)
        {
                return $this->delete("user/".$email,"");
        }
        public function update_user($email,$attributes,$blacklisted,$listid,$listid_unlink)
        {
                return $this->put("user/".$email,json_encode(array("attributes"=>$attributes,"blacklisted"=>$blacklisted,"listid"=>$listid,"listid_unlink"=>$listid_unlink)));
        }
        public function import_users($url,$listids,$notify_url,$name,$folder_id)
        {
                return $this->post("user/import",json_encode(array("url"=>$url,"listids"=>$listids,"notify_url"=>$notify_url,"name"=>$name,"list_parent"=>$folder_id)));
        }
        public function export_users($export_attrib,$filter,$notify_url)
        {
                return $this->post("user/export",json_encode(array("export_attrib"=>$export_attrib,"filter"=>$filter,"notify_url"=>$notify_url)));
        }
        public function create_update_user($email,$attributes,$blacklisted,$listid,$listid_unlink,$blacklisted_sms)
        {
            return $this->post("user/createdituser",json_encode(array("email"=>$email,"attributes"=>$attributes,"blacklisted"=>$blacklisted,"listid"=>$listid,"listid_unlink"=>$listid_unlink,"blacklisted_sms"=>$blacklisted_sms)));
        }
        public function get_attributes()
        {
                return $this->get("attribute","");
        }
        public function get_attribute($type)
        {
                return $this->get("attribute/".$type,"");
        }
        public function create_attribute($type,$data)
        {
                return $this->post("attribute",json_encode(array("type"=>$type,"data"=>$data)));
        }
        public function delete_attribute($type,$data)
        {
                return $this->post("attribute/".$type,json_encode(array("data"=>$data)));
        }
        public function get_report($limit,$start_date,$end_date,$offset,$date,$days,$email)
        {
                return $this->post("report",json_encode(array("limit"=>$limit,"start_date"=>$start_date,"end_date"=>$end_date,"offset"=>$offset,"date"=>$date,"days"=>$days,"email"=>$email)));
        }
        public function get_folders()
        {
                return $this->get("folder","");
        }
        public function get_folder($id)
        {
                return $this->get("folder/".$id,"");
        }
        public function create_folder($name)
        {
                return $this->post("folder",json_encode(array("name"=>$name)));
        }
        public function delete_folder($id)
        {
                return $this->delete("folder/".$id,"");
        }
        public function update_folder($id,$name)
        {
                return $this->put("folder/".$id,json_encode(array("name"=>$name)));
        }
        public function delete_bounces($start_date,$end_date,$email)
        {
                return $this->post("bounces",json_encode(array("start_date"=>$start_date,"end_date"=>$end_date,"email"=>$email)));
        }
        public function send_transactional_template($id,$to,$cc,$bcc,$attr,$attachmentUrl,$attachment)
        {
                return $this->put("template/".$id,json_encode(array("cc"=>$cc,"to"=>$to,"attr"=>$attr,"bcc"=>$bcc,"attachment_url"=>$attachmentUrl,"attachment"=>$attachment)));
        }
        public function create_template($from_name,$name,$bat_sent,$html_content,$html_url,$subject,$from_email,$reply_to,$to_field,$status,$attach)
        {
                return $this->post("template",json_encode(array("from_name"=>$from_name,"template_name"=>$name,"bat"=>$bat_sent,"html_content"=>$html_content,"html_url"=>$html_url,"subject"=>$subject,"from_email"=>$from_email,"reply_to"=>$reply_to,"to_field"=>$to_field,"status"=>$status,"attachment"=>$attach)));
        }
        public function update_template($id,$from_name,$name,$bat_sent,$html_content,$html_url,$subject,$from_email,$reply_to,$to_field,$status,$attach)
        {
                return $this->put("template/".$id,json_encode(array("from_name"=>$from_name,"template_name"=>$name,"bat"=>$bat_sent,"html_content"=>$html_content,"html_url"=>$html_url,"subject"=>$subject,"from_email"=>$from_email,"reply_to"=>$reply_to,"to_field"=>$to_field,"status"=>$status,"attachment"=>$attach)));
        }
        public function get_senders($option)
        {
                return $this->get("advanced",json_encode(array("option"=>$option)));
        }
        public function create_sender($sender_name,$sender_email,$ip_domain)
        {
                return $this->post("advanced",json_encode(array("name"=>$sender_name,"email"=>$sender_email,"ip_domain"=>$ip_domain)));
        }
        public function update_sender($id,$sender_name,$sender_email,$ip_domain)
        {
                return $this->put("advanced/".$id,json_encode(array("name"=>$sender_name,"email"=>$sender_email,"ip_domain"=>$ip_domain)));
        }
        public function delete_sender($id)
        {
                return $this->delete("advanced/".$id,"");
        }
}
?>
