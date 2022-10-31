<?php

declare(strict_types = 1);

namespace Drupal\ui_suite_bootstrap\HookHandler;

use Drupal\Component\Utility\NestedArray;
use Drupal\Core\Url;

/**
 * Handle variables needed for the pattern.
 */
class PreprocessPatternNavItem {

  /**
   * Handle variables needed for the pattern.
   *
   * @param array $variables
   *   The preprocessed variables.
   */
  public function preprocess(array &$variables): void {
    $nav_item_options = [
      'attributes' => [
        'class' => [
          'nav-link',
        ],
      ],
    ];

    // Manage active state.
    if (isset($variables['active']) && $variables['active']) {
      $nav_item_options = NestedArray::mergeDeep($nav_item_options, [
        'attributes' => [
          'class' => [
            'active',
          ],
        ],
      ]);
    }

    // Manage disabled state.
    if (isset($variables['disabled']) && $variables['disabled']) {
      $nav_item_options = NestedArray::mergeDeep($nav_item_options, [
        'attributes' => [
          'class' => [
            'disabled',
          ],
        ],
      ]);
    }

    if (\array_key_exists('link', $variables)) {
      if (isset($variables['link']) && !empty($variables['link'])) {
        if (!($variables['link']['#url'] instanceof Url)) {
          $variables['link']['#url'] = Url::fromUri($variables['link']['#url']);
        }

        if (isset($variables['link']['#url']) && $variables['link']['#url'] instanceof Url) {
          // Add 'nav-link' class.
          $variables['link']['#url']->mergeOptions($nav_item_options);
        }
      }
    }
  }

}
