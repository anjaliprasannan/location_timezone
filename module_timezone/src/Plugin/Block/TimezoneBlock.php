<?php

namespace Drupal\module_timezone\Plugin\Block;

use Drupal\user\Entity\User;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Link;
use Drupal\Core\Url;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\module_timezone\getTimeZone;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a 'Admin Configuration Settings Block'.
 *
 * @Block(
 *   id = "block_timezone",
 *   admin_label = @Translation("Admin Configuration Settings Block")
 * )
 */
class TimezoneBlock extends BlockBase implements ContainerFactoryPluginInterface {

  // store service
  protected $get_timezone = NULL;
  
  /*
   * static create function provided by the ContainerFactoryPluginInterface.
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('module_timezone.get_timezone')
    );
  }
  
  /*
   * BlockBase plugin constructor that's expecting the GetTimeZone object provided by create().
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, GetTimeZone $get_timezone) {
    // instantiate the BlockBase parent first
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    
    // then save the store service passed to this constructor via dependency injection
    $this->get_timezone = $get_timezone;
  }
  
  /**
   * {@inheritdoc}
   */
  public function build() {
    \Drupal::service('page_cache_kill_switch')->trigger();
    $timezone = \Drupal::config('module_timezone.settings')->get('time_zone');
    $renderable = [
      '#theme' => 'my_custom_template',
      '#timezone' => $timezone,
      '#current_time' => $this->get_timezone->get_timezone(),
    ];
    return $renderable;
  }
  
  /**
    * {@inheritdoc}
    */
    public function getCacheMaxAge() {
      return 0;
  }
}
