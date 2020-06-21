<?php

/**
* @file providing the service to save/update form data.
*
*/

namespace  Drupal\role_module\Services;

use Drupal\role_module\Services\RoleModuleInterface;
use Drupal\Core\Config\ConfigFactoryInterface;

class RoleModuleService implements RoleModuleInterface {

 protected $value;
 protected $configFile;

 public function __construct(ConfigFactoryInterface $config){
    $this->configFile = $config;
 }

 public function saveData($name,$roll_no){
    $id='u-'.$roll_no;    
    $current_user = \Drupal::currentUser();
    $user_id = $current_user->id();         
    $config = $this->configFile->getEditable('role_module.settings');    
    $config->set($id, ['name'=>$name,'roll_no'=>$roll_no,'role'=>'Authenticated User','status'=>0,'user_id'=>$user_id]);
    $config->save();
 }
 
public function updateData($user_id,$roll_no){
   $user_id = (int)$user_id;
   $user = \Drupal\user\Entity\User::load($user_id);
   $user->addRole('student');
   $user->save();
   $config = $this->configFile->getEditable('role_module.settings');
   $config->set('u-'.$roll_no.'.status', 1);
   $config->set('u-'.$roll_no.'.role', 'student');
   $config->save();
}

}
?>