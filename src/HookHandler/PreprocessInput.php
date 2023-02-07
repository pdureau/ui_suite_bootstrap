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
   * @var \Drupal\bootstrap\Utility\Element|false
   */
  protected $element;

  /**
   * {@inheritdoc}
   */
  public function preprocess(array &$variables): void {
    if (!isset($variables['element'])) {
      return;
    }

    $this->variables = Variables::create($variables);
    $this->element = $this->variables->element;

    // Form control.
    // @see https://getbootstrap.com/docs/5.2/forms/form-control
    if ($this->element
      && !$this->element->isButton()
      && !$this->element->isType($this->ignoreFormControlTypes)
    ) {
      if (!$this->element->hasClass('form-control-plaintext')) {
        $this->variables->addClass('form-control');

        if ($this->element->isType('color')) {
          $this->variables->addClass('form-control-color');
        }
      }
    }
  }

}
