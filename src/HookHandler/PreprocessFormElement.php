<?php

declare(strict_types = 1);

namespace Drupal\ui_suite_bootstrap\HookHandler;

use Drupal\ui_suite_bootstrap\Utility\Element;
use Drupal\ui_suite_bootstrap\Utility\Variables;

/**
 * Pre-processes variables for the "form_element" theme hook.
 */
class PreprocessFormElement {

  /**
   * The Variables object.
   *
   * @var \Drupal\ui_suite_bootstrap\Utility\Variables
   */
  protected Variables $variables;

  /**
   * An element object provided in the variables array, may not be set.
   *
   * @var \Drupal\ui_suite_bootstrap\Utility\Element
   */
  protected Element $element;

  /**
   * Preprocess form element.
   *
   * @param array $variables
   *   The variables to preprocess.
   */
  public function preprocess(array &$variables): void {
    if (!isset($variables['element'])) {
      return;
    }

    $this->variables = Variables::create($variables);
    $this->element = $this->variables->element;
    $label = Element::create($variables['label']);

    // See https://getbootstrap.com/docs/5.2/forms/checks-radios
    if ($this->element->isType('checkbox') || $this->element->isType('radio')) {
      $label->addClass('form-check-label');
      $this->variables->addClass('form-check');

      if ($this->element->hasProperty('is_inline') && $this->element->getProperty('is_inline')) {
        $this->variables->addClass('form-check-inline');
      }
      if ($this->element->hasProperty('is_reverse') && $this->element->getProperty('is_reverse')) {
        $this->variables->addClass('form-check-reverse');
      }
      // Even if only for checkbox.
      if ($this->element->hasProperty('is_switch') && $this->element->getProperty('is_switch')) {
        $this->variables->addClass('form-switch');
      }
    }
    // For all other form elements add 'form-label' class.
    else {
      $label->addClass('form-label');
      $this->variables->addClass('mb-3');
    }

    // Input group.
    // Create variables for input_group flags.
    $this->variables->offsetSet('input_group',
      $this->element->getProperty('input_group_after') ||
      $this->element->getProperty('input_group_before')
    );
    // Get input group attributes.
    // Cannot use map directly because of the attributes' management.
    $this->variables->offsetSet('input_group_attributes', $this->element->getProperty('input_group_attributes'));

    // Map the element properties.
    $this->variables->map([
      'input_group_after' => 'input_group_after',
      'input_group_before' => 'input_group_before',
    ]);


  }

}
