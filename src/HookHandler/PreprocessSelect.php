<?php

declare(strict_types = 1);

namespace Drupal\ui_suite_bootstrap\HookHandler;

use Drupal\ui_suite_bootstrap\Utility\Variables;

/**
 * Pre-processes variables for the "select" theme hook.
 */
class PreprocessSelect extends PreprocessInput {

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

    $this->validation();

    // Map the element properties.
    $this->variables->map([
      'attributes' => 'attributes',
    ]);
  }

}
