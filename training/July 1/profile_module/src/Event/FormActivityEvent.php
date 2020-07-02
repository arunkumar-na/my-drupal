<?php

namespace Drupal\profile_module\Event;

use Symfony\Component\EventDispatcher\Event;

class FormActivityEvent extends Event {

  const FORMSUBMIT = 'profile_module.submit';
  public $uid;

  public function __construct($uid)
  {    
    $this->uid = $uid;
  }

}