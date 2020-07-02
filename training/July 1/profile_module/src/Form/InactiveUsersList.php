<?php

namespace Drupal\profile_module\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Form\drupal_set_message;
use Drupal\profile_module\Event\FormActivityEvent;
use Drupal\Core\Entity\t;
use Drupal\user\Entity\User;
/**
 * Class FormActivityAjax.
 *
 * @package Drupal\profile_module\Form
 */
class InactiveUsersList extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $database = \Drupal::database();
    $query = $database->select('users_field_data', 'u');    
    $query->condition('u.uid', 0, '>');
    $query->condition('u.status', 0, '=');
    $query->fields('u', ['uid', 'name', 'status', 'mail']);
    $result = $query->execute();
    $users_list = $result->fetchAll();
    if(!empty($users_list)){
      foreach($users_list as $key => $value){    
          $value = (array)$value;         
          $users[$value['uid']] = ['name'=>$value['name'],'mail'=>$value['mail'],'status'=>'Inactive'];
      }
    }
    
    $header = array(
      'name' => t('Name'),
      'mail' => t('Email'),
      'status' => t('Status')
    );    
   

    $form['table'] = array(
      '#type' => 'tableselect',
      '#header' => $header,
      '#options' => $users,
      '#multiple' => TRUE,
      '#empty' => $this->t('No users found'),
    );
   
	
	 $form['actions']['#type'] = 'actions';

    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Save'),
      '#button_type' => 'primary'
    );

    return $form;
  }


  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'inactive_users';
  }

  /**
   * {@inheritdoc}
   */
   
   
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $table = $form_state->getValue('table');
    $checked = array_filter($table);
    if(!empty($checked)){
      foreach($checked as $id){
        $update = User::load($id);
        $update->set('status',1);
        $update->save();
      }
    }
  }


}
