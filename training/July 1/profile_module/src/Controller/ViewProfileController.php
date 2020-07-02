<?php 

namespace Drupal\profile_module\Controller;

use Drupal\Core\Controller\ControllerBase;

class ViewProfileController extends ControllerBase {

  
   public function viewProfile($uid) {   
		$database = \Drupal::database();
		$query = $database->select('form_activity', 'u'); 
		$query->condition('u.uid', $uid);
		$query->fields('u', ['uid', 'firstname', 'lastname', 'bio', 'gender']);
		$result = $query->execute();
		$user_profile = $result->fetchAll();
		
		$user_profile = (array)$user_profile;
		//echo "<pre>"; print_r($user_profile); exit;
		//$userdata = json_decode(json_encode($userdata), true);
		
		return [
			'#theme' => 'view_profile',
			'#content' => $user_profile,
		];
  }
  
  


}

?>