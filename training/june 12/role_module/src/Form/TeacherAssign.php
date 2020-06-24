<?php

namespace Drupal\role_module\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\drupal_set_message;

/**
 * Implements the SimpleForm form controller.
 *
 * This example demonstrates a simple form with a single text input element. We
 * extend FormBase which is the simplest form base class used in Drupal.
 *
 * @see \Drupal\Core\Form\FormBase
 */
class TeacherAssign extends FormBase {

    public $userid;
    public $u_id;

  /**
   * Build the simple form.
   *
   * A build form method constructs an array that defines how markup and
   * other form elements are included in an HTML form.
   *
   * @param array $form
   *   Default form array structure.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   Object containing current form state.
   *
   * @return array
   *   The render array defining the elements of the form.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {  
    
    $config =  \Drupal::service('config.factory')->getEditable('role_module.settings');
    $config_data = $config->get();
    $users = array();

    if(!empty($config_data)){
      foreach($config_data as $key => $value){
        if($value['status']==0){
          $users[$value['roll_no'].'~'.$value['user_id']] = ['name'=>$value['name'],'roll_no'=>$value['roll_no'],'role'=>$value['role'],'status'=>'Pending'];
        }
        else{
          $users[$value['roll_no'].'~'.$value['user_id']] = ['name'=>$value['name'],'roll_no'=>$value['roll_no'],'role'=>$value['role'],'status'=>'Approved','#disabled'=>TRUE];
        }
      }
    }
  
   $header = array(
      'name' => t('Name'),
      'roll_no' => t('Roll Number'),
      'role' => t('role'),
      'status' => t('Status')
    );    
   

    $form['table'] = array(
      '#type' => 'tableselect',
      '#header' => $header,
      '#options' => $users,
      '#multiple' => TRUE,
      '#empty' => $this->t('No users found'),
    );
 
    
    // Group submit handlers in an actions element with a key of "actions" so
    // that it gets styled correctly, and so that other modules may add actions
    // to the form. This is not required, but is convention.
    $form['actions'] = [
      '#type' => 'actions',
    ];

    // Add a submit button that handles the submission of the form.
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('SAVE'),
    ];

    return $form;
  }

  /**
   * Getter method for Form ID.
   *
   * The form ID is used in implementations of hook_form_alter() to allow other
   * modules to alter the render array built by this form controller. It must be
   * unique site wide. It normally starts with the providing module's name.
   *
   * @return string
   *   The unique ID of the form defined by this class.
   */
  public function getFormId() {
    return 'custom_config_form_update';
  }


  public function validateForm(array &$form, FormStateInterface $form_state) {
    /* $password = $form_state->getValue('password');
    if ($password=='') {
      $form_state->setErrorByName('form', $this->t('Password is required'));
    } */
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    /*
     * This would normally be replaced by code that actually does something
     * with the title.
     */   
    $table = $form_state->getValue('table');  
    foreach($table as $tab){
      $split_key = explode('~',$tab);
      $roll_no = isset($split_key[0])?$split_key[0]:0;
      $user_id = isset($split_key[1])?$split_key[1]:0;
      if(!empty($roll_no) && !empty($user_id)){
        $call_service = \Drupal::service('role_module.role_service')->updateData($user_id,$roll_no);
      }
    } 
    $this->messenger()->addMessage($this->t("Student request approved successfully."));
  }

}
