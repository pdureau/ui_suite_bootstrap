<?php

declare(strict_types = 1);

namespace Drupal\ui_suite_bootstrap\HookHandler;

use Drupal\Component\Utility\Html;
use Drupal\Core\Render\Element;

/**
 * Handle variables needed for the pattern.
 */
class PreprocessPatternNavbar {

  /**
   * Length of the word dark.
   */
  public const DARK_LENGTH = 4;

  /**
   * Pattern fields where render elements will be injected.
   */
  public const REGIONS_FIELDS = [
    'navigation',
    'navigation_collapsible',
  ];

  /**
   * Handle variables needed for the pattern.
   *
   * @param array $variables
   *   The preprocessed variables.
   */
  public function preprocess(array &$variables): void {
    $variables['navbar_id'] = Html::getUniqueId('bootstrap-navbar');

    if (\array_key_exists('brand', $variables) && \is_array($variables['brand'])) {
      $variables['brand'] = \_ui_suite_bootstrap_add_class($variables['brand'], 'navbar-brand');
    }

    if (\substr($variables['variant'], 0, self::DARK_LENGTH) === 'dark') {
      foreach (self::REGIONS_FIELDS as $region) {
        if (isset($variables[$region])) {
          $this->addDarkSetting($variables[$region]);
        }
      }
    }
  }

  /**
   * Add dark setting to navbar_nav pattern.
   *
   * @param array $item
   *   The render element to parse.
   */
  protected function addDarkSetting(array &$item): void {
    if (isset($item['#type'])
      && \in_array($item['#type'], ['pattern', 'pattern_preview'], TRUE)
      && $item['#id'] == 'navbar_nav'
    ) {
      $item['#dark'] = TRUE;
      // Stop recursion when a navbar_nav is found, no need to enter in it.
      return;
    }

    $children = Element::children($item);
    foreach ($children as $key) {
      $this->addDarkSetting($item[$key]);
    }
  }

}
