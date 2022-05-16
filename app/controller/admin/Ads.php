<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ads extends Controller
{
    public function process() { 
        $AuthUser                       = $this->getVariable("AuthUser");
        $Route                          = $this->getVariable("Route");    
        $Config['nav']                  = 'ads';
        $Config['page']                 = 'ads';
  
        
        // Filter
        $Listings = $this->db->from(null,'
            SELECT 
            ads.id,
            ads.name,
            ads.status
            FROM `ads` ')
            ->all();
 
        
        $this->setVariable('Listings', $Listings); 
        $this->setVariable('Filter', $Filter); 
        $this->setVariable('Config', $Config); 
 
        if(Input::cleaner($Route->params->id)) {
            $Ads        = $this->db->from('ads')->where('id',$Route->params->id,'=')->first();
            $Data           = json_decode($Ads['ads_data'], true);     
        }
        $this->setVariable('Ads',$Ads); 
        $this->setVariable('Data',$Data); 
        if(Input::cleaner($_POST['_ACTION']) == 'save' AND !$Ads['id']) {
            $this->save();
        } elseif(Input::cleaner($_POST['_ACTION']) == 'save' AND $Ads['id']) {
            $this->update();
        }
        $this->view('ads', 'admin');
    }
    public function update() {
        $Ads        = $this->getVariable("Ads"); 
        $Data       = $this->getVariable("Data");   
        if (empty($Notify)) {

            $foo = new \Verot\Upload\Upload($_FILES['image']);
            if ($foo->uploaded) {

                unlink(UPLOADPATH . '/ads/'.$Data['image']);
                $foo->allowed = array('image/*');
                $foo->file_auto_rename      = true;
                $foo->file_new_name_body    = Input::seo($_POST['name']);
                $foo->image_convert = 'webp';
                $foo->Process(UPLOADPATH . '/ads/');
                $Image = $foo->file_dst_name;

            } elseif(!Input::cleaner($_POST['ads_code']) AND $Data['image']) {
                $Image = $Data['image'];
            }

            if($_POST['ads_code']) {
                $Type = 'code';
                $Settings['image']  = null;
            }elseif($Image) {
                $Type = 'image';
                
                $Settings['image']  = $Image;
                $Settings['link']   = Input::cleaner($_POST['link']);
         
            }

            $dataarray          = array( 
                "type"              => $Type,
                "ads_data"          => json_encode($Settings, JSON_UNESCAPED_UNICODE),
                "ads_code"          => htmlspecialchars($_POST['ads_code']),
                "status"            => Input::cleaner($_POST['status'],2)
            );   
            $this->db->update('ads')->where('id',$Ads['id'])->set($dataarray);
            $Notify['type']     = 'success';
            $Notify['text']     = __('Changes Saved'); 
            $this->notify($Notify);
            header("location: ".APP.'/admin/ads/'.$Ads['id']);
        }else{ 
            $this->notify($Notify);
        } 
        return $this;
    }
}
