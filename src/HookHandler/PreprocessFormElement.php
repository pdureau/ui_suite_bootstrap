<?php

declare(strict_types = 1);

namespace Drupal\ui_suite_bootstrap\HookHandler;

use Drupal\Core\Template\Attribute;
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
   * @var \Drupal\ui_suite_bootstrap\Utility\Element|false
   */
  protected $element;

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
    if (!$this->element) {
      return;
    }
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
      // If the element is a sub-element of a text_format do not add the class.
      if (!$this->element->hasProperty('format')) {
        $this->variables->addClass('mb-3');
      }
    }

    // Input group.
    // Create variables for input_group flags.
    $this->variables->offsetSet(
      'input_group',
      $this->element->getProperty('input_group_after')
      || $this->element->getProperty('input_group_before')
    );
    // Get input group attributes.
    /** @var array $input_group_attributes */
    $input_group_attributes = $this->element->getProperty('input_group_attributes', []);
    // Validation.
    if ($this->element->getProperty('errors')) {
      $input_group_attributes = new Attribute($input_group_attributes);
      $input_group_attributes->addClass('has-validation');
    }
    // Cannot use map directly because of the attributes' management.
    $this->variables->offsetSet('input_group_attributes', $input_group_attributes);

    // Map the element properties.
    $this->variables->map([
      'input_group_after' => 'input_group_after',
      'input_group_before' => 'input_group_before',
    ]);

    // Floating label.
    // Override title_display if using #floating_label.
    if ($this->element->hasProperty('floating_label') && $this->element->getProperty('floating_label')) {
      $this->element->setProperty('title_display', 'floating');
      $this->variables->map([
        'title_display' => 'title_display',
      ]);
      $this->variables->map([
        'title_display' => 'label_display',
      ]);
    }
    $this->variables->offsetSet('floating_label_attributes', new Attribute([
      'class' => [
        'form-floating',
        // Validation.
        ($this->variables->offsetGet('input_group') && $this->element->getProperty('errors')) ? 'is-invalid' : '',
      ],
    ]));

    // Validation.
    $errors_display = $this->element->getProperty('errors_display', 'feedback');
    $this->variables->offsetSet('errors_attributes', new Attribute([
      'class' => [
        'form-item--error-message',
        'invalid-' . $errors_display,
      ],
    ]));
    if ($errors_display == 'tooltip') {
      $this->variables->addClass('position-relative');
    }

    // Layout: horizontal form.
    if ($this->element->getProperty('title_display') == 'inline') {
      $this->variables->offsetSet('inner_wrapper', TRUE);
      $label->addClass('col-form-label');
      /** @var array $inner_wrapper_attributes */
      $inner_wrapper_attributes = $this->element->getProperty('inner_wrapper_attributes', []);
      $inner_wrapper_attributes = new Attribute($inner_wrapper_attributes);
      // Cannot use map directly because of the attributes' management.
      $this->variables->offsetSet('inner_wrapper_attributes', $inner_wrapper_attributes);
    }
  }

}
