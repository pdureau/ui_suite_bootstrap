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
    'is_inline' => FALSE,
    'is_reverse' => FALSE,
    'is_switch' => FALSE,
  ];

  /**
   * List of additional properties on radios.
   */
  public const RADIOS_PROPERTIES = [
    'is_inline' => FALSE,
    'is_reverse' => FALSE,
  ];

  /**
   * List of additional properties for input group feature.
   */
  public const INPUT_GROUP_PROPERTIES = [
    'field_prefix' => [],
    'field_suffix' => [],
    'input_group' => FALSE,
    'input_group_attributes' => [],
    'input_group_button' => FALSE,
  ];

  /**
   * List of form elements supporting input group.
   */
  public const INPUT_GROUP_ELEMENTS = [
    'color',
    'date',
    'email',
    'entity_autocomplete',
    'file',
    'language_select',
    'machine_name',
    'managed_file',
    'number',
    'password',
    'password_confirm',
    'search',
    'select',
    'tel',
    'text_format',
    'textarea',
    'textfield',
    'url',
    'weight',
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
      foreach (static::CHECKBOX_PROPERTIES as $property => $property_default_value) {
        $info['checkbox']["#{$property}"] = $property_default_value;
      }
    }

    if (isset($info['checkboxes'])) {
      foreach (static::CHECKBOX_PROPERTIES as $property => $property_default_value) {
        $info['checkboxes']["#{$property}"] = $property_default_value;
      }
      $info['checkboxes']['#process'][] = [
        ElementProcess::class,
        'processCheckboxes',
      ];
    }

    if (isset($info['radios'])) {
      foreach (static::RADIOS_PROPERTIES as $property => $property_default_value) {
        $info['radios']["#{$property}"] = $property_default_value;
      }
      $info['radios']['#process'][] = [
        ElementProcess::class,
        'processRadios',
      ];
    }

    // Input group.
    foreach (static::INPUT_GROUP_ELEMENTS as $form_element_id) {
      if (!isset($info[$form_element_id])) {
        continue;
      }

      foreach (static::INPUT_GROUP_PROPERTIES as $property => $property_default_value) {
        $info[$form_element_id]["#{$property}"] = $property_default_value;
      }
      $info[$form_element_id]['#process'][] = [
        ElementProcess::class,
        'processInputGroup',
      ];
    }
  }

}
