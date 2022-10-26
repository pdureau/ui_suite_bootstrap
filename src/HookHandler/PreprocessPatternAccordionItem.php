<?php

declare(strict_types = 1);

namespace Drupal\ui_suite_bootstrap\HookHandler;

use Drupal\Component\Utility\Html;

/**
 * Handle the accordion item pattern, internal to the accordion pattern.
 */
class PreprocessPatternAccordionItem {

  /**
   * Add variables for the accordion item.
   *
   * @param array $variables
   *   The preprocessed variables.
   */
  public function preprocess(array &$variables): void {
    $variables['accordion_item_id'] = Html::getUniqueId('bootstrap-accordion-item');
  }

}
