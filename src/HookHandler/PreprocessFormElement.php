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
    /** @var \Drupal\ui_suite_bootstrap\Utility\Element $element */
    $element = $this->variables->element;
    $label = Element::create($variables['label']);

    // See https://getbootstrap.com/docs/5.2/forms/checks-radios
    if ($element->isType('checkbox') || $element->isType('radio')) {
      $this->variables->addClass('form-check');
      $label->addClass('form-check-label');

      if ($element->hasProperty('is_inline') && $element->getProperty('is_inline')) {
        $this->variables->addClass('form-check-inline');
      }
      if ($element->hasProperty('is_reverse') && $element->getProperty('is_reverse')) {
        $this->variables->addClass('form-check-reverse');
      }
      // Even if only for checkbox.
      if ($element->hasProperty('is_switch') && $element->getProperty('is_switch')) {
        $this->variables->addClass('form-switch');
      }
    }
    // For all other form elements add 'form-label' class.
    else {
      $label->addClass('form-label');
      $this->variables->addClass('mb-3');
    }
  }

}
