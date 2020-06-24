<?php

/**
* @file providing the service to save/update form data.
*
*/

namespace  Drupal\custom_config_form\Services;

use Drupal\custom_config_form\Services\CustomConfigInterface;
use Drupal\Core\Config\ConfigFactoryInterface;

class CustomConfigFormService implements CustomConfigInterface{

 protected $value;
 protected $configFile;

 public function __construct(ConfigFactoryInterface $config){
    $this->configFile = $config;
 }

 public function saveData($username,$email,$password){
    $id='u-'.rand(10,99);
    $config = $this->configFile->getEditable('custom_config_form.settings')->delete();    
    $config = $this->configFile->getEditable('custom_config_form.settings');    
    $config->set($id, ['username'=>$username,'email'=>$email,'password'=>$password]);
    $config->save();
 }
 
  public function updateData($userid,$password){
    $config = $this->configFile->getEditable('custom_config_form.settings');
    $config->set($userid.'.password', $password);
    $config->save();
 }

}
?>