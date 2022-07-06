<?php
/**
 * @file
 * Contains module_timezone.module.
 */

/**
 * Implements hook_theme().
 */
function module_timezone_theme($existing, $type, $theme, $path) {
  return [
    'my_custom_template' => [
      'variables' => ['timezone' => NULL, 'current_time' => NULL],
    ],
  ];
}
?>