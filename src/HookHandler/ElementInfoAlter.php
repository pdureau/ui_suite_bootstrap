<?php

declare(strict_types = 1);

namespace Drupal\ui_suite_bootstrap\HookHandler;

use Drupal\ui_suite_bootstrap\Element\ElementProcessCheckboxes;
use Drupal\ui_suite_bootstrap\Element\ElementProcessInputGroup;
use Drupal\ui_suite_bootstrap\Element\ElementProcessRadios;
use Drupal\ui_suite_bootstrap\Element\ElementProcessTextFormat;

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
    'input_group_attributes' => [],
    'input_group_after' => [],
    'input_group_before' => [],
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
   * List of additional properties for floating label feature.
   */
  public const FLOATING_LABEL_PROPERTIES = [
    'floating_label' => FALSE,
  ];

  /**
   * List of form elements supporting floating label.
   */
  public const FLOATING_LABEL_ELEMENTS = [
    'date',
    'email',
    'entity_autocomplete',
    'language_select',
    'machine_name',
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
        ElementProcessCheckboxes::class,
        'processCheckboxes',
      ];
    }

    if (isset($info['radios'])) {
      foreach (static::RADIOS_PROPERTIES as $property => $property_default_value) {
        $info['radios']["#{$property}"] = $property_default_value;
      }
      $info['radios']['#process'][] = [
        ElementProcessRadios::class,
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
        ElementProcessInputGroup::class,
        'processInputGroup',
      ];
    }

    // Floating label.
    foreach (static::FLOATING_LABEL_ELEMENTS as $form_element_id) {
      if (!isset($info[$form_element_id])) {
        continue;
      }

      foreach (static::FLOATING_LABEL_PROPERTIES as $property => $property_default_value) {
        $info[$form_element_id]["#{$property}"] = $property_default_value;
      }
    }

    // Text format.
    if (isset($info['text_format'])) {
      $info['text_format']['#process'][] = [
        ElementProcessTextFormat::class,
        'processTextFormat',
      ];
    }
  }

}
