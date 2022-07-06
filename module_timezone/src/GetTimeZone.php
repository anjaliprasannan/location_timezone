<?php

/**
* @file providing the service that get the site timezone.
*
*/

namespace  Drupal\module_timezone;

/**
 * Implements GetTimezone class
 */
class GetTimezone {

  protected $timezone;

  public function __construct() {
    $this->timezone = 'Hello World!';
  }

  /**
   * Implements get_timezone();
   */
  public function  get_timezone(){
    $config = \Drupal::config('module_timezone.settings');
    $timezone = $config->get('time_zone');
    $time_zone = new \DateTimeZone($timezone);
    $date = new \DateTime(null, $time_zone);

    $date =  $date->format('j M Y - g:i A');
    $this->timezone = $date;
    return $this->timezone;
  }

}