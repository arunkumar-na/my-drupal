<?php

namespace Drupal\custom_config_form\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\drupal_set_message;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Implements the SimpleForm form controller.
 *
 * This example demonstrates a simple form with a single text input element. We
 * extend FormBase which is the simplest form base class used in Drupal.
 *
 * @see \Drupal\Core\Form\FormBase
 */
class CustomConfigFormUpdate extends FormBase {

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
  public function buildForm(array $form, FormStateInterface $form_state, $userid = NULL) {   
    $form['password'] = [
      '#type' => 'password_confirm',
      '#title' => $this->t('Change Password'),
      '#required' => TRUE,
    ];

    $this->u_id = $userid;

    
 
    
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
    $password = $form_state->getValue('password');
    if ($password=='') {
      $form_state->setErrorByName('form', $this->t('Password is required'));
    }
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    /*
     * This would normally be replaced by code that actually does something
     * with the title.
     */   
    $password = $form_state->getValue('password');  
    $userid = $this->u_id; 
    $call_service = \Drupal::service('custom_config_form.my_form')->updateData($userid,$password);
    $this->messenger()->addMessage($this->t("Password Changed Successfully"));
    $response = new RedirectResponse("/my-drupal/web/my-form/change-password");
    $response->send();
  }

}
