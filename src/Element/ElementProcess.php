<?php

declare(strict_types = 1);

namespace Drupal\ui_suite_bootstrap\Element;

use Drupal\Core\Form\FormStateInterface;
use Drupal\ui_suite_bootstrap\HookHandler\ElementInfoAlter;

/**
 * Element Process methods.
 */
class ElementProcess {

  /**
   * Processes a checkboxes form element.
   */
  public static function processCheckboxes(array &$element, FormStateInterface $form_state, array &$complete_form): array {
    if (\count($element['#options']) > 0) {
      foreach ($element['#options'] as $key => $choice) {
        // Integer 0 is not a valid #return_value, so use '0' instead.
        // @see \Drupal\Core\Render\Element\Checkboxes::processCheckboxes().
        if ($key === 0) {
          $key = '0';
        }
        foreach (ElementInfoAlter::CHECKBOX_PROPERTIES as $property) {
          if (isset($element["#{$property}"])) {
            $element[$key] += [
              "#{$property}" => $element["#{$property}"],
            ];
          }
        }
      }
    }
    return $element;
  }

  /**
   * Processes a radios form element.
   */
  public static function processRadios(array &$element, FormStateInterface $form_state, array &$complete_form): array {
    if (\count($element['#options']) > 0) {
      foreach ($element['#options'] as $key => $choice) {
        foreach (ElementInfoAlter::RADIOS_PROPERTIES as $property) {
          if (isset($element["#{$property}"])) {
            $element[$key] += [
              "#{$property}" => $element["#{$property}"],
            ];
          }
        }
      }
    }
    return $element;
  }

}
