<?php

declare(strict_types = 1);

namespace Drupal\ui_suite_bootstrap\HookHandler;

use Drupal\Component\Utility\Html;

/**
 * Handle CSS classes and variables structure.
 */
class PreprocessPatternCarousel {

  /**
   * Handle CSS classes and variables structure.
   *
   * @param array $variables
   *   The preprocessed variables.
   */
  public function preprocess(array &$variables): void {
    $variables['carousel_id'] = Html::getUniqueId('bootstrap-carousel');

    // Move first image of each slide in a specific array key.
    if (\array_key_exists('slides', $variables) && \is_array($variables['slides'])) {
      foreach ($variables['slides'] as &$slide) {
        $slide['image'] = $this->extractCarouselImage($slide);
      }
    }

    // Nicer preview with fixed width and local backgrounds.
    if ($variables['context']->getType() == 'preview') {
      $variables['attributes']['style'] = 'width: 800px';
    }
  }

  /**
   * Extract image from carousel slide.
   */
  protected function extractCarouselImage(&$item) {
    if (!\is_array($item)) {
      return FALSE;
    }

    if (\array_key_exists('#theme', $item)) {
      if ($item['#theme'] === 'image' || $item['#theme'] === 'image_formatter') {
        $image = $item;
        $item = [];
        return $image;
      }
    }
    foreach ($item as &$next) {
      $dig = $this->extractCarouselImage($next);
      if ($dig) {
        return $dig;
      }
    }

    return FALSE;
  }

}
