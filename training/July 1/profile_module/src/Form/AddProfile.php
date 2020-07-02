<?php

namespace Drupal\profile_module\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Form\drupal_set_message;
use Drupal\profile_module\Event\FormActivityEvent;
use Drupal\Core\Entity\t;
use Drupal\user\Entity\User;
use Drupal\Core\Ajax\AjaxResponse;
/**
 * Class AddProfile.
 *
 * @package Drupal\profile_module\Form
 */
class AddProfile extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['first_name'] = [
        '#type' => 'textfield',
        '#title' => $this->t('First Name'),
        '#size' => 60,
        '#maxlength' => 128,
        '#required' => True,
      ];
          
      $form['last_name'] = [
        '#type' => 'textfield',
        '#title' => $this->t('Last Name'),
        '#delta' => 2,
        '#required' => True,
      ];	
      
      $form['bio'] = [
        '#type' => 'textarea',
        '#title' => $this->t('Bio'),
      ];
      
      $form['gender'] = [
        '#type' => 'radios',
        '#title' => $this->t('Gender'),
        '#options' => ['Male' => $this->t('Male'), 'Female' => $this->t('Female')],
      ];
   
	
	$form['actions']['#type'] = 'actions';

    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Save'),
      '#button_type' => 'primary',      
    );

    return $form;
  }


  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'add_profile';
  }

  /**
   * {@inheritdoc}
   */

  
   
   
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $uid = \Drupal::currentUser()->id();
    $database = \Drupal::database();
    $form_values = array(
        'firstname' => $form_state->getValues()['first_name'],
        'lastname' => $form_state->getValues()['last_name'],
        'uid' => $uid,
        'bio' => $form_state->getValues()['bio'],
        'gender' => $form_state->getValues()['gender']   
    );  
    $del_prev = $database->delete('form_activity')->condition('uid', $uid)->execute();
    $inserted_id = db_insert('form_activity')->fields($form_values)->execute();       
    drupal_set_message($this->t("@message", ['@message' => 'Form Submitted Successfully']));
    $dispatcher = \Drupal::service('event_dispatcher');
    $event = new FormActivityEvent($uid);
    $dispatcher->dispatch(FormActivityEvent::FORMSUBMIT, $event);
  }


}
