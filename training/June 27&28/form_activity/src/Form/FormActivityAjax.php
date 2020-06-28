<?php

namespace Drupal\form_activity\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Form\drupal_set_message;
use Drupal\form_activity\Event\FormActivityEvent;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Entity\t;
/**
 * Class FormActivityAjax.
 *
 * @package Drupal\form_activity\Form
 */
class FormActivityAjax extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $taxonomy = 'Interest';
		$taxonomy_terms =\Drupal::entityTypeManager()->getStorage('taxonomy_term')->loadTree($taxonomy);
		  foreach ($taxonomy_terms as $term) {
		   $terms[$term->name] = $term->name; 
    }
	  
		$logged_user = \Drupal::currentUser();
    $u = \Drupal\user\Entity\User::load($logged_user->id());
    
		$u_id = $logged_user->id();
		$u_name = $logged_user->getUserName();	
	  
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
    
	  $form['interest'] = array(
		'#type' => 'select',
		'#title' => t('Intrest'),
		'#multiple' => false,
		'#options' => $terms,
	  );
	
	 $form['actions']['#type'] = 'actions';

    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Save'),
      '#button_type' => 'primary',
      '#ajax' => [
        'callback' => '::customFormSubmit',
      ],
    );

    return $form;
  }


  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'form_activity';
  }

  /**
   * {@inheritdoc}
   */
   
   
    public function customFormSubmit(array $form, FormStateInterface $form_state) {

				$response = new AjaxResponse();

				
				$form_values = array(
					'firstname' => $form_state->getValues()['first_name'],
					'lastname' => $form_state->getValues()['last_name'],
					'bio' => $form_state->getValues()['bio'],
					'gender' => $form_state->getValues()['gender'],
					'interest' => $form_state->getValues()['interest']   
				);				
				
				$inserted_id = db_insert('form_activity')->fields($form_values)->execute();
					
				drupal_set_message($this->t("@message", ['@message' => 'Form Submitted Successfully']));				  
			     echo  $insert; 
				$dispatcher = \Drupal::service('event_dispatcher');
				$event = new FormActivityEvent($form_values);
				$dispatcher->dispatch(FormActivityEvent::FORMSUBMIT, $event);
   }
   
   
  public function submitForm(array &$form, FormStateInterface $form_state) {
	
  }


}
