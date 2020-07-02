<?php

/**
 * @file
 * Contains \Drupal\profile_module\FormActivityEventSubscriber.
 */
namespace Drupal\profile_module\EventSubscriber;

use Drupal\Core\Config\ConfigCrudEvent;
use Drupal\Core\Config\ConfigEvents;
use Drupal\profile_module\Event\FormActivityEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;


/**
 * Class FormActivityEventSubscriber.
 *
 * @package Drupal\profile_module
 */
class FormActivityEventSubscriber implements EventSubscriberInterface {

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {	
	return [
    FormActivityEvent::FORMSUBMIT => 'redirectUser',
    ];

  }

  /**
   * Subscriber Callback for the event.
   * @param FormActivityEvent $uid
   */
  public function redirectUser(FormActivityEvent $uid) { 
    $uid = $uid->uid;
    $response = new RedirectResponse('/new-drupal/web/users/'.$uid);
    $response->send();
  }


}