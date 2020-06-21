<?php

/**
* @file providing the service to save/update form data.
*
*/

namespace  Drupal\role_module\Services;

interface RoleModuleInterface {
    public  function saveData($name,$roll_no); 
	public  function updateData($user_id,$roll_no);
}
?>