<?php

namespace Drupal\form_activity\Event;

use Symfony\Component\EventDispatcher\Event;

class FormActivityEvent extends Event {

  const FORMSUBMIT = 'form_activity.submit';
  protected $logger_message;

  public function __construct($logger_message)
  {
    $this->logger_message = $logger_message;
  }

  public function getLoggerMessage()
  {
    return $this->logger_message;
  }
}