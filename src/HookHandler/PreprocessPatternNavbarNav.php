<?php

declare(strict_types = 1);

namespace Drupal\ui_suite_bootstrap\HookHandler;

use Drupal\Core\Url;

/**
 * Handle variables needed for the pattern.
 */
class PreprocessPatternNavbarNav {

  /**
   * Handle variables needed for the pattern.
   *
   * @param array $variables
   *   The preprocessed variables.
   */
  public function preprocess(array &$variables): void {
    foreach ($variables['items'] as &$item) {
      if (!($item['url'] instanceof Url)) {
        $item['url'] = Url::fromUri($item['url']);
      }

      // Add 'nav-link' class.
      $item['url']->mergeOptions([
        'attributes' => [
          'class' => [
            'nav-link',
          ],
        ],
      ]);

      // Add 'dropdown-item' patterns to below links.
      if (isset($item['below']) && !empty($item['below'])) {
        foreach ($item['below'] as &$sub_level_item) {
          if (!($sub_level_item['url'] instanceof Url)) {
            $sub_level_item['url'] = Url::fromUri($sub_level_item['url']);
          }

          if ($sub_level_item['url']->isRouted() && $sub_level_item['url']->getRouteName() === '<nolink>') {
            /** @var array $sub_level_item_attributes */
            $sub_level_item_attributes = $sub_level_item['url']->getOption('attributes');
            // Divider.
            if (isset($sub_level_item_attributes['class']) && \in_array('dropdown-divider', $sub_level_item_attributes['class'], TRUE)) {
              $sub_level_item = [
                '#type' => 'pattern',
                '#id' => 'dropdown_item',
                '#variant' => 'dropdown_divider',
              ];
            }
            // Header.
            elseif (isset($sub_level_item_attributes['class']) && \in_array('dropdown-header', $sub_level_item_attributes['class'], TRUE)) {
              $sub_level_item = [
                '#type' => 'pattern',
                '#id' => 'dropdown_item',
                '#variant' => 'dropdown_header',
                '#content' => $sub_level_item['title'],
              ];
            }
            // Text only.
            else {
              $sub_level_item = [
                '#type' => 'pattern',
                '#id' => 'dropdown_item',
                '#variant' => 'dropdown_item_text',
                '#content' => $sub_level_item['title'],
              ];
            }
          }
          else {
            $sub_level_item = [
              '#type' => 'pattern',
              '#id' => 'button',
              '#variant' => 'dropdown_item',
              '#label' => $sub_level_item['title'],
              '#url' => $sub_level_item['url']->toString(),
            ];
          }
        }
      }
    }
  }

}
