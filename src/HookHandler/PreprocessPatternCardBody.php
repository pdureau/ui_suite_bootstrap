<?php

declare(strict_types = 1);

namespace Drupal\ui_suite_bootstrap\HookHandler;

/**
 * Handle CSS classes.
 */
class PreprocessPatternCardBody {

  /**
   * Handle CSS classes.
   *
   * @param array $variables
   *   The preprocessed variables.
   */
  public function preprocess(array &$variables): void {
    if (\array_key_exists('links', $variables) && \is_array($variables['links'])) {
      foreach ($variables['links'] as &$item) {
        $this->addCardLinkClass($item);
      }
    }
  }

  /**
   * Add expected class in card's link.
   *
   * @param mixed $item
   *   A render item.
   */
  protected function addCardLinkClass(&$item): void {
    if (!\is_array($item)) {
      return;
    }

    if (\array_key_exists('#type', $item)) {
      $class = 'card-link';
      if ($item['#type'] === 'link') {
        $item['#attributes']['class'][] = $class;
      }
      if ($item['#type'] === 'html_tag' && $item['#tag'] === 'a') {
        $item['#attributes']['class'][] = $class;
      }
    }

    foreach ($item as &$next) {
      $this->addCardLinkClass($next);
    }
  }

}
