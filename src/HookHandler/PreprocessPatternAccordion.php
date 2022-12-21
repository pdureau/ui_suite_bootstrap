<?php

declare(strict_types = 1);

namespace Drupal\ui_suite_bootstrap\HookHandler;

use Drupal\Component\Utility\Html;
use Drupal\Core\Render\Element;

/**
 * Handle the accordion pattern.
 */
class PreprocessPatternAccordion {

  /**
   * Add variables for the accordion.
   *
   * @param array $variables
   *   The preprocessed variables.
   */
  public function preprocess(array &$variables): void {
    $accordion_item_settings = [];

    // Transmits heading level.
    if (isset($variables['heading_level']) && $variables['heading_level']) {
      $accordion_item_settings['#heading_level'] = $variables['heading_level'];
    }

    if (\array_key_exists('keep_open', $variables) && !$variables['keep_open']) {
      $accordion_id = Html::getUniqueId('bootstrap-accordion');
      // Add unique id to the accordion.
      $variables['accordion_id'] = $accordion_id;
      $accordion_item_settings['#accordion_id'] = $accordion_id;
    }

    if (isset($variables['content'])) {
      $this->setAccordionItemSettings($variables['content'], $accordion_item_settings);
    }
  }

  /**
   * Prepare accordion item settings from accordion.
   *
   * @param array $item
   *   The render element to parse.
   * @param array $settings
   *   The setting to add.
   */
  protected function setAccordionItemSettings(array &$item, array $settings): void {
    if (isset($item['#type'])
      && \in_array($item['#type'], ['pattern', 'pattern_preview'], TRUE)
      && $item['#id'] == 'accordion_item'
    ) {
      foreach ($settings as $key => $value) {
        if (!isset($item[$key])) {
          $item[$key] = $value;
        }
      }
      // Stop recursion when an accordion_item is found, no need to enter in it.
      return;
    }

    $children = Element::children($item);
    foreach ($children as $key) {
      $this->setAccordionItemSettings($item[$key], $settings);
    }
  }

}
