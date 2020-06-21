<?php

/**
* @file providing the service to save/update form data.
*
*/

namespace  Drupal\custom_config_form\Services;

interface CustomConfigInterface {
    public  function saveData($username,$email,$password); 
	public  function updateData($userid,$password);
}
?>