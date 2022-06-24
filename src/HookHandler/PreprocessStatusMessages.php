<?php

declare(strict_types = 1);

namespace Drupal\ui_suite_bootstrap\HookHandler;

use Drupal\Component\Render\MarkupInterface;
use Drupal\Component\Utility\Html;
use Drupal\Core\Render\Markup;

/**
 * Handle links and placeholders.
 */
class PreprocessStatusMessages {

  /**
   * Handle links and placeholders.
   *
   * @param array $variables
   *   The preprocessed variables.
   */
  public function preprocess(array &$variables): void {
    foreach ($variables['message_list'] as $message_type => $message_list) {
      foreach ($message_list as $message_key => $message) {
        if ($message instanceof MarkupInterface) {
          $message = (string) $message;
          $dom = Html::load($message);

          $emphasises = $dom->getElementsByTagName('em');
          foreach ($emphasises as $emphasise) {
            // Remove 'placeholder' class.
            $existing_class = $emphasise->getAttribute('class');
            $classes = explode(' ', $existing_class);
            $placeholder_key = array_search('placeholder', $classes);
            if ($placeholder_key !== FALSE) {
              unset($classes[$placeholder_key]);
            }
            if (empty($classes)) {
              $emphasise->removeAttribute('class');
            }
            else {
              $emphasise->setAttribute('class', implode(' ', $classes));
            }
          }

          $links = $dom->getElementsByTagName('a');
          foreach ($links as $link) {
            // Add 'alert-link' class.
            $existing_class = $link->getAttribute('class');
            $classes = explode(' ', $existing_class);
            $classes = array_filter($classes);
            $classes[] = 'alert-link';
            $link->setAttribute('class', implode(' ', $classes));
          }

          $variables['message_list'][$message_type][$message_key] = Markup::create(Html::serialize($dom));
        }
      }
    }
  }

}
