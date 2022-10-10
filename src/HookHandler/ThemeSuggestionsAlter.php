<?php

declare(strict_types = 1);

namespace Drupal\ui_suite_bootstrap\HookHandler;

/**
 * Add theme suggestions.
 */
class ThemeSuggestionsAlter {

  /**
   * The types of elements to ignore for the "input__form_control" suggestion.
   */
  public const IGNORE_FORM_CONTROL_TYPES = [
    'checkbox',
    'hidden',
    'radio',
  ];

  /**
   * The form element types to be themed like buttons.
   */
  public const BUTTON_TYPES = [
    'button',
    'submit',
    'reset',
    'image_button',
  ];

  /**
   * Theme search block form.
   *
   * @param array $suggestions
   *   The list of suggestions.
   * @param array $variables
   *   The theme variables.
   */
  public function input(array &$suggestions, array $variables): void {
    // @todo Create helper to manipulate render arrays.
    if ($this->isButton($variables['element'])) {
      $hook = 'input__button';
      if ($this->isSplit($variables['element'])) {
        $hook .= '__split';
      }
      $suggestions[] = $hook;
    }
    elseif (!$this->isType($variables['element'], self::IGNORE_FORM_CONTROL_TYPES)) {
      $suggestions[] = 'input__form_control';
    }
  }

  /**
   * Check if element is of type button.
   *
   * @param array $element
   *   The render element to check.
   *
   * @return bool
   *   TRUE if element is of type button. FALSE otherwise.
   */
  protected function isButton(array $element): bool {
    return !empty($element['#is_button']) || $this->isType($element, self::BUTTON_TYPES) || $this->hasClass($element, 'btn');
  }

  /**
   * Check if element has split property.
   *
   * @param array $element
   *   The render element to check.
   *
   * @return bool
   *   TRUE if element has split property. FALSE otherwise.
   */
  protected function isSplit(array $element): bool {
    if (isset($element['#split']) && $element['#split']) {
      return TRUE;
    }
    return FALSE;
  }

  /**
   * Check if element's type is among the types.
   *
   * @param array $element
   *   The render element to check.
   * @param array $types
   *   The types to check.
   *
   * @return bool
   *   TRUE if element's type is among the types. FALSE otherwise.
   */
  protected function isType(array $element, array $types): bool {
    if (isset($element['#type']) && \in_array($element['#type'], $types, TRUE)) {
      return TRUE;
    }
    return FALSE;
  }

  /**
   * Check if element has class.
   *
   * @param array $element
   *   The render element to check.
   * @param string $class
   *   The class to check.
   *
   * @return bool
   *   TRUE if has class. FALSE otherwise.
   */
  protected function hasClass(array $element, string $class): bool {
    if (isset($element['#attributes']['class']) && \in_array($class, $element['#attributes']['class'], TRUE)) {
      return TRUE;
    }
    return FALSE;
  }

}
