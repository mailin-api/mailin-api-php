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
		curl_setopt($ch, CURLOPT_HTTPHEADER, array($time_header,$auth_header,$content_header));
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $input);
		$data = curl_exec($ch);
		if(curl_errno($ch))
		{
    			echo "Curl error: ".curl_error($ch)."\n";
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
        public function send_sms($to,$text,$web_url,$tag,$from)
        {
                return $this->post("sms",json_encode(array("to"=>$to,"text"=>$text,"web_url"=>$web_url,"tag"=>$tag,"from"=>$from)));
        }
        public function get_campaigns()
        {
                return $this->get("campaign","");
        }
        public function get_campaign($id)
        {
                return $this->get("campaign/".$id,"");
        }
        public function create_campaign($category,$from_name,$name,$bat_sent,$tags,$html_content,$html_url,$listid,$scheduled_date,$subject)
        {
                return $this->post("campaign",json_encode(array("category"=>$category,"from_name"=>$from_name,"name"=>$name,"bat_sent"=>$bat_sent,"tags"=>$tags,"html_content"=>$html_content,"html_url"=>$html_url,"listid"=>$listid,"scheduled_date"=>$scheduled_date,"subject"=>$subject)));
        }
        public function delete_campaign($id)
        {
                return $this->delete("campaign/".$id,"");
        }
        public function update_campaign($id,$category,$from_name,$name,$bat_sent,$tags,$html_content,$html_url,$listid,$scheduled_date,$subject)
        {
                return $this->put("campaign/".$id,json_encode(array("category"=>$category,"from_name"=>$from_name,"name"=>$name,"bat_sent"=>$bat_sent,"tags"=>$tags,"html_content"=>$html_content,"html_url"=>$html_url,"listid"=>$listid,"scheduled_date"=>$scheduled_date,"subject"=>$subject)));
        }
        public function campaign_report_email($id,$lang,$email_subject,$email_to,$email_content_type,$email_bcc,$email_cc,$email_body)
        {
                return $this->post("campaign/".$id."/report",json_encode(array("lang"=>$lang,"email_subject"=>$email_subject,"email_to"=>$email_to,"email_content_type"=>$email_content_type,"email_bcc"=>$email_bcc,"email_cc"=>$email_cc,"email_body"=>$email_body)));
        }
        public function campaign_recipients_export($id,$notify_url,$type)
        {
                return $this->post("campaign/".$id."/report",json_encode(array("notify_url"=>$notify_url,"type"=>$type)));
        }
        public function get_processes()
        {
                return $this->get("process","");
        }
        public function get_process($id)
        {
                return $this->get("process/".$id,"");
        }
        public function get_campaignstats()
        {
                return $this->get("campaignstat","");
        }
        public function get_campaignstat($id)
        {
                return $this->get("campaignstat/".$id,"");
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
        public function add_users_list($id,$users)
        {
                return $this->post("list/".$id."/users",json_encode(array("users"=>$users)));
        }
        public function delete_users_list($id,$users)
        {
                return $this->delete("list/".$id."/users",json_encode(array("users"=>$users)));
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
        public function get_user($id)
        {
                return $this->get("user/".$id,"");
        }
        public function create_user($attributes,$blacklisted,$email,$listid)
        {
                return $this->post("user",json_encode(array("attributes"=>$attributes,"blacklisted"=>$blacklisted,"email"=>$email,"listid"=>$listid)));
        }
        public function delete_user($id)
        {
                return $this->delete("user/".$id,"");
        }
        public function update_user($id,$attributes,$blacklisted,$listid)
        {
                return $this->put("user/".$id,json_encode(array("attributes"=>$attributes,"blacklisted"=>$blacklisted,"listid"=>$listid)));
        }
        public function import_users($url,$listids,$notify_url,$name)
        {
                return $this->post("user/import",json_encode(array("url"=>$url,"listids"=>$listids,"notify_url"=>$notify_url,"name"=>$name)));
        }
        public function export_users($export_attrib,$filer,$notify_url)
        {
                return $this->post("user/export",json_encode(array("export_attrib"=>$export_attrib,"filer"=>$filer,"notify_url"=>$notify_url)));
        }
        public function get_attributes()
        {
                return $this->get("attribute","");
        }
        public function get_attribute($id)
        {
                return $this->get("attribute/".$id,"");
        }
        public function create_attribute($type,$data)
        {
                return $this->post("attribute",json_encode(array("type"=>$type,"data"=>$data)));
        }
        public function delete_attribute($id,$data)
        {
                return $this->post("attribute/".$id,json_encode(array("data"=>$data)));
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

}

?>

