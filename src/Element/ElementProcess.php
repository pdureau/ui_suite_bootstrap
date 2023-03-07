<?php

declare(strict_types = 1);

namespace Drupal\ui_suite_bootstrap\Element;

use Drupal\Component\Utility\NestedArray;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Template\Attribute;
use Drupal\ui_suite_bootstrap\HookHandler\ElementInfoAlter;
use Drupal\ui_suite_bootstrap\Utility\Element;

/**
 * Element Process methods.
 */
class ElementProcess {

  /**
   * The weight of the prefix elements.
   */
  public const ADDON_PREFIX_WEIGHT = -1;

  /**
   * The weight of the suffix elements.
   */
  public const ADDON_SUFFIX_WEIGHT = 1;

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
        foreach (ElementInfoAlter::CHECKBOX_PROPERTIES as $property => $property_default_value) {
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
        foreach (ElementInfoAlter::RADIOS_PROPERTIES as $property => $property_default_value) {
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
   * Processes element supporting input group.
   */
  public static function processInputGroup(array &$element, FormStateInterface $form_state, array &$complete_form): array {
    $element_object = Element::create($element);
    if ($element_object->getProperty('input') && ($element_object->getProperty('input_group') || $element_object->getProperty('input_group_button'))) {
      static::processElementInputGroup($element_object, $form_state, $complete_form);
    }

    return $element;
  }

  /**
   * Processes element supporting input group.
   */
  public static function processElementInputGroup(Element $element, FormStateInterface $form_state, array &$complete_form): void {
    $input_group_addon_attributes = [
      'class' => [
        'input-group-text',
      ],
    ];
    /** @var array $prefix */
    $prefix = $element->getProperty('field_prefix');
    if (!empty($prefix)) {
      $processed_prefix = [
        '#weight' => static::ADDON_PREFIX_WEIGHT,
      ];
      foreach ($prefix as $prefix_addon) {
        // Allow to inject renderable array for advanced implementations.
        if (\is_array($prefix_addon)) {
          $processed_prefix[] = $prefix_addon;
        }
        else {
          $processed_prefix[] = [
            '#type' => 'html_tag',
            '#tag' => 'span',
            '#attributes' => $input_group_addon_attributes,
            '#value' => Element::create($prefix_addon)->renderPlain(),
          ];
        }
      }
      $element->setProperty('field_prefix', $processed_prefix);
    }
    /** @var array $suffix */
    $suffix = $element->getProperty('field_suffix');
    if (!empty($suffix)) {
      $processed_suffix = [
        '#weight' => static::ADDON_SUFFIX_WEIGHT,
      ];
      foreach ($suffix as $suffix_addon) {
        // Allow to inject renderable array for advanced implementations.
        if (\is_array($suffix_addon)) {
          $processed_suffix[] = $suffix_addon;
        }
        else {
          $processed_suffix[] = [
            '#type' => 'html_tag',
            '#tag' => 'span',
            '#attributes' => $input_group_addon_attributes,
            '#value' => Element::create($suffix_addon)->renderPlain(),
          ];
        }
      }
      $element->setProperty('field_suffix', $processed_suffix);
    }

    // Automatically inject the nearest button found after this element if
    // #input_group_button exists.
    if ($element->getProperty('input_group_button')) {
      // Obtain the parent array to limit search.
      /** @var array $array_parents */
      $array_parents = $element->getProperty('array_parents', []);

      // Remove the current element from the array.
      \array_pop($array_parents);

      // Retrieve the parent element.
      // @phpstan-ignore-next-line
      $parent = Element::create(NestedArray::getValue($complete_form, $array_parents), $form_state);

      // Find the closest button.
      $button = &$parent->findButton();
      if ($button) {
        // Since this button is technically being "moved", it needs to be
        // rendered now, so it doesn't get printed twice (in the original spot).
        $element->appendProperty('field_suffix', $button->render());
      }
    }

    // Prepare input group attributes.
    /** @var array $input_group_attributes */
    $input_group_attributes = $element->getProperty('input_group_attributes', []);
    $input_group_attributes = new Attribute($input_group_attributes);
    $input_group_attributes->addClass('input-group');
    $element->setProperty('input_group_attributes', $input_group_attributes);
  }

}
