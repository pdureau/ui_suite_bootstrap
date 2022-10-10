<?php

declare(strict_types = 1);

namespace Drupal\ui_suite_bootstrap\HookHandler;

/**
 * Handle CSS classes.
 */
class PreprocessPatternCard {

  /**
   * Handle CSS classes.
   *
   * @param array $variables
   *   The preprocessed variables.
   */
  public function preprocess(array &$variables): void {
    // @todo If header, parse its content and if nav pattern found, add class
    // matching the variant.
    if (!\array_key_exists('image', $variables) || !\is_array($variables['image'])) {
      return;
    }

    $image_class = '';
    if ($variables['variant'] === 'default' && $variables['image_position'] === 'top') {
      $image_class = 'card-img-top';
    }
    elseif ($variables['variant'] === 'default' && $variables['image_position'] === 'bottom') {
      $image_class = 'card-img-bottom';
    }
    elseif ($variables['variant'] === 'horizontal') {
      $image_class = 'img-fluid rounded-start';
    }

    if (!empty($image_class)) {
      foreach ($variables['image'] as &$item) {
        $this->addCardImageClass($item, $image_class);
      }
    }
  }

  /**
   * Add expected class in card's image.
   */
  protected function addCardImageClass(&$item, string $image_class): void {
    if (!\is_array($item)) {
      return;
    }

    if (\array_key_exists('#theme', $item)) {
      if ($item['#theme'] === 'image') {
        $item['#attributes']['class'][] = $image_class;
      }
      if ($item['#theme'] === 'image_formatter') {
        $item['#item_attributes']['class'][] = $image_class;
      }
    }

    foreach ($item as &$next) {
      $this->addCardImageClass($next, $image_class);
    }
  }

}
