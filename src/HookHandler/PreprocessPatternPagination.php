<?php

declare(strict_types = 1);

namespace Drupal\ui_suite_bootstrap\HookHandler;

/**
 * Ensure variable has proper type.
 */
class PreprocessPatternPagination {

  /**
   * Ensure variable has proper type.
   *
   * @param array $variables
   *   The preprocessed variables.
   */
  public function preprocess(array &$variables): void {
    $variables['current'] = (int) (string) $variables['current'];
  }

}
