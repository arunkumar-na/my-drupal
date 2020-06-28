<?php

/**
 * @file
 * Contains \Drupal\form_activity\CustModuleEventSubScriber.
 */
namespace Drupal\form_activity\EventSubscriber;

use Drupal\Core\Config\ConfigCrudEvent;
use Drupal\Core\Config\ConfigEvents;
use Drupal\form_activity\Event\CustModuleSubmitEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


/**
 * Class CustModuleEventSubScriber.
 *
 * @package Drupal\form_activity
 */
class CustModuleEventSubScriber implements EventSubscriberInterface {

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {	
	return [
    FormActivityEvent::FORMSUBMIT => 'insertLog',
    ];

  }

  /**
   * Subscriber Callback for the event.
   * @param FormActivityEvent $form_activity_event
   */
  public function insertLog(FormActivityEvent $form_activity_event) {
	\Drupal::logger('form_activity')->notice("The Submitted form values are " . $form_activity_event->getLoggerMessage());
  }


}