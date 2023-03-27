<?php

declare(strict_types = 1);

namespace Drupal\ui_suite_bootstrap\Element;

use Drupal\Component\Utility\NestedArray;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Template\Attribute;
use Drupal\ui_suite_bootstrap\Utility\Element;

/**
 * Element Process methods for input group feature.
 */
class ElementProcessInputGroup {

  /**
   * Processes element supporting input group.
   */
  public static function processInputGroup(array &$element, FormStateInterface $form_state, array &$complete_form): array {
    $element_object = Element::create($element);
    if (
      $element_object->getProperty('input')
      && (
        $element_object->getProperty('field_prefix')
        || $element_object->getProperty('field_suffix')
        || $element_object->getProperty('input_group_after')
        || $element_object->getProperty('input_group_before')
        || $element_object->getProperty('input_group_button')
      )
    ) {
      static::processAddon($element_object, 'field_prefix', 'input_group_before');
      static::processAddon($element_object, 'field_suffix', 'input_group_after');

      if ($element_object->getProperty('input_group_button')) {
        static::processInputGroupButton($element_object, $form_state, $complete_form);
      }

      // Prepare input group attributes.
      /** @var array|\Drupal\Core\Template\Attribute $input_group_attributes */
      $input_group_attributes = $element_object->getProperty('input_group_attributes', []);
      $input_group_attributes = \is_array($input_group_attributes) ? new Attribute($input_group_attributes) : $input_group_attributes;
      $input_group_attributes->addClass('input-group');
      $element_object->setProperty('input_group_attributes', $input_group_attributes);
    }

    return $element;
  }

  /**
   * Add addon before or after the input.
   *
   * If the theme property is not empty, use it. Otherwise, fallback on the
   * Drupal native key.
   */
  protected static function processAddon(Element $element, string $drupal_element_addon_key, string $theme_addon_key): void {
    $addon_attributes = [
      'class' => [
        'input-group-text',
      ],
    ];
    /** @var array $addons */
    $addons = $element->getProperty($theme_addon_key, []);

    // Fallback on Drupal native #field_prefix/#field_suffix content.
    if (empty($addons)) {
      $addons = $element->getProperty($drupal_element_addon_key, '');
      if (!empty($addons)) {
        // Drupal #field_prefix/#field_suffix is a string.
        $addons = [$addons];
        $element->unsetProperty($drupal_element_addon_key);
      }
    }

    if (empty($addons)) {
      return;
    }
    $processed_addons = [];
    foreach ($addons as $addon) {
      // Allow to inject renderable array for advanced implementations.
      if (\is_array($addon)) {
        $processed_addons[] = $addon;
      }
      else {
        $processed_addons[] = [
          '#type' => 'html_tag',
          '#tag' => 'span',
          '#attributes' => $addon_attributes,
          '#value' => Element::create($addon)->renderPlain(),
        ];
      }
    }
    $element->setProperty($theme_addon_key, $processed_addons);
  }

  /**
   * Automatically inject the nearest button found after this element.
   */
  protected static function processInputGroupButton(Element $element, FormStateInterface $form_state, array &$complete_form): void {
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
      $element->appendProperty('input_group_after', $button->render());
    }
  }

}
