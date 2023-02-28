<?php

declare(strict_types = 1);

namespace Drupal\ui_suite_bootstrap\HookHandler;

use Drupal\ui_suite_bootstrap\Element\ElementProcess;

/**
 * Element Info Alter.
 */
class ElementInfoAlter {

  /**
   * List of additional properties on checkbox.
   */
  public const CHECKBOX_PROPERTIES = [
    'is_inline',
    'is_reverse',
    'is_switch',
  ];

  /**
   * List of additional properties on radios.
   */
  public const RADIOS_PROPERTIES = [
    'is_inline',
    'is_reverse',
  ];

  /**
   * Alter form element info.
   *
   * @param array $info
   *   An associative array with structure identical to that of the return value
   *   of \Drupal\Core\Render\ElementInfoManagerInterface::getInfo().
   */
  public function alter(array &$info): void {
    // Sort the types for easier debugging.
    \ksort($info, \SORT_NATURAL);

    if (isset($info['checkbox'])) {
      foreach (static::CHECKBOX_PROPERTIES as $property) {
        $info['checkbox']["#{$property}"] = FALSE;
      }
    }

    if (isset($info['checkboxes'])) {
      foreach (static::CHECKBOX_PROPERTIES as $property) {
        $info['checkboxes']["#{$property}"] = FALSE;
      }
      $info['checkboxes']['#process'][] = [
        ElementProcess::class,
        'processCheckboxes',
      ];
    }

    if (isset($info['radios'])) {
      foreach (static::RADIOS_PROPERTIES as $property) {
        $info['radios']["#{$property}"] = FALSE;
      }
      $info['radios']['#process'][] = [
        ElementProcess::class,
        'processRadios',
      ];
    }
  }

}
