<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Channel extends Controller {
	public function process() {
		$AuthUser 				= $this->getVariable("AuthUser");
		$Route 					= $this->getVariable("Route");
		$Settings 				= $this->getVariable("Settings"); 
		$Config['nav'] 			= 'channels'; 

        // Query 
 
        if(Input::cleaner($Route->params->id)) {
            $Listing        = $this->db->from('channels')->where('id',$Route->params->id,'=')->first();
            $Data           = json_decode($Listing['data'], true);
 
        }
        $Config['title']        = str_replace('${title}', $Listing['name'], get($Settings, "data.channel_title", "seo"));
        $Config['description']  = str_replace('${title}', $Listing['name'], get($Settings, "data.channel_description", "seo"));
 
        $Config['url']          = channel($Listing['id'],$Listing['self']);  
        $Config['type']         = 'channel'; 
        $Config['id']           = $Listing['id'];   
        $Config['comments']     = true;  
        $this->setVariable("Data", $Data);
        $this->setVariable("Config",$Config);    
        $this->setVariable("Posts",$Posts);      
        $this->setVariable('Listing',$Listing);
		$this->view('channel', 'app');
	}
}
