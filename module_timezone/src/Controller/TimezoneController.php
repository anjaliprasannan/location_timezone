<?php
/**
 * @file
 * Contains \Drupal\module_timezone\Controller\TimezoneController.
 */
namespace Drupal\module_timezone\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Request;
use Drupal\Core\Routing\RouteMatchInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Drupal\Core\Url;
use Drupal\Core\Access\AccessResult;
use Drupal\Core\Session\AccountInterface;
use Drupal\user\Entity\User;

/**
 * Class to implement TimezoneController. 
 *
 * {@inheritdoc}
 */
class TimezoneController extends ControllerBase {

  /**
   * Manage the generation of blocks in the controller.
   *
   * @var Drupal\Core\Block\BlockManager
   */
  private $blockManager;

  /**
   * constructor
   * {@inheritdoc}
   */
  public function __construct() {
    $this->blockManager = \Drupal::service('plugin.manager.block');
  }

 /**
  * Function to render admin dashoard.
  */
  public function adminDashboard() {
    $render_array['block_timezone'] = $this->addBlock('block_timezone');
    return $render_array;
  }

  /**
   * Return render array for the block to be added.
   */
  private function addBlock($block_id) {
    $config = [];
    $render = [];
    $plugin_block = $this->blockManager->createInstance($block_id, $config);

    $access_result = $plugin_block->access(\Drupal::currentUser());

    // Return empty render array if user doesn't have access.
    if (is_object($access_result) && !$access_result->isForbidden() || is_bool($access_result) && $access_result) {
      $render = $plugin_block->build();
    }
    return $render;
  }
 
}
