<?php

declare(strict_types = 1);

namespace Drupal\ui_suite_bootstrap\HookHandler;

use Drupal\ui_suite_bootstrap\Utility\Variables;

/**
 * Pre-processes variables for the "input" theme hook.
 */
class PreprocessInput {

  /**
   * The types of elements to not receive the "form-control" class.
   *
   * @var array
   */
  protected array $ignoreFormControlTypes = [
    'checkbox',
    'hidden',
    'radio',
    'range',
  ];

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

    // Form control.
    // @see https://getbootstrap.com/docs/5.2/forms/form-control
    if (!$this->element->isButton()
      && !$this->element->isType($this->ignoreFormControlTypes)
    ) {
      if (!$this->element->hasClass('form-control-plaintext')) {
        $this->element->addClass('form-control');

        if ($this->element->isType('color')) {
          $this->element->addClass('form-control-color');
        }
      }
    }

    // Checks and radios.
    if ($this->element->isType('checkbox') || $this->element->isType('radio')) {
      $this->element->addClass('form-check-input');
    }
    // Switch checkbox.
    if ($this->element->hasProperty('is_switch') && $this->element->getProperty('is_switch')) {
      $this->element->setAttribute('role', 'switch');
    }

    // Range.
    if ($this->element->isType('range')) {
      $this->element->addClass('form-range');
    }

    // Button.
    if ($this->element->isButton()) {
      $this->element->colorize();
      $this->variables->offsetSet('label', $this->element->getProperty('value'));
    }

    // Map the element properties.
    $this->variables->map([
      'attributes' => 'attributes',
    ]);
  }

}
