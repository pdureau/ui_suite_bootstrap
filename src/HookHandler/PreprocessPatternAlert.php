<?php

declare(strict_types = 1);

namespace Drupal\ui_suite_bootstrap\HookHandler;

use Drupal\Component\Render\MarkupInterface;
use Drupal\Component\Utility\Html;
use Drupal\Core\Render\Markup;

/**
 * Handle links class in alert pattern.
 */
class PreprocessPatternAlert {

  /**
   * Add 'alert-link' class to links.
   *
   * @param array $variables
   *   The preprocessed variables.
   */
  public function preprocess(array &$variables): void {
    if (!isset($variables['message']) || !($variables['message'] instanceof MarkupInterface)) {
      return;
    }

    $message = (string) $variables['message'];
    $dom = Html::load($message);

    $links = $dom->getElementsByTagName('a');
    foreach ($links as $link) {
      $existing_class = $link->getAttribute('class');
      $classes = \explode(' ', $existing_class);
      $classes = \array_filter($classes);
      $classes[] = 'alert-link';
      $link->setAttribute('class', \implode(' ', $classes));
    }

    $variables['message'] = Markup::create(Html::serialize($dom));
  }

}
