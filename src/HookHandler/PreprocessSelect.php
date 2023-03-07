<?php

declare(strict_types = 1);

namespace Drupal\ui_suite_bootstrap\HookHandler;

use Drupal\ui_suite_bootstrap\Utility\Variables;

/**
 * Pre-processes variables for the "select" theme hook.
 */
class PreprocessSelect {

  /**
   * The Variables object.
   *
   * @var \Drupal\ui_suite_bootstrap\Utility\Variables
   */
  protected $variables;

  /**
   * An element object provided in the variables array, may not be set.
   *
   * @var \Drupal\ui_suite_bootstrap\Utility\Element|false
   */
  protected $element;

  /**
   * Prepare variables.
   *
   * @param array $variables
   *   The hook preprocess variables.
   */
  public function preprocess(array &$variables): void {
    if (!isset($variables['element'])) {
      return;
    }

    $this->variables = Variables::create($variables);
    $this->element = $this->variables->element;
    if (!$this->element) {
      return;
    }

    // Create variables for #input_group and #input_group_button flags.
    $variables['input_group'] = $this->element->getProperty('input_group') || $this->element->getProperty('input_group_button');

    // Get input group attributes.
    // Cannot use map directly because of the attributes management.
    $this->variables->offsetSet('input_group_attributes', $this->element->getProperty('input_group_attributes'));

    // Map the element properties.
    $this->variables->map([
      'attributes' => 'attributes',
      'field_prefix' => 'prefix',
      'field_suffix' => 'suffix',
    ]);
  }

}
