<?php

declare(strict_types = 1);

namespace Drupal\ui_suite_bootstrap\HookHandler;

use Drupal\Component\Utility\Html;

/**
 * Handle variables needed for the pattern.
 */
class PreprocessPatternDropdown {

  /**
   * Handle variables needed for the pattern.
   *
   * @param array $variables
   *   The preprocessed variables.
   */
  public function preprocess(array &$variables): void {
    $variables['dropdown_id'] = Html::getUniqueId('bootstrap-dropdown');
  }

}
