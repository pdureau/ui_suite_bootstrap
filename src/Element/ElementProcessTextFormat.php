<?php

declare(strict_types = 1);

namespace Drupal\ui_suite_bootstrap\Element;

use Drupal\Core\Form\FormStateInterface;
use Drupal\ui_suite_bootstrap\Utility\DrupalAttributes;
use Drupal\ui_suite_bootstrap\Utility\Element;

/**
 * Element Process methods for text format.
 */
class ElementProcessTextFormat {

  /**
   * Ensure the format select list is placed before the about link.
   */
  public const FORMAT_WEIGHT = -10;

  /**
   * Processes a text format form element.
   */
  public static function processTextFormat(array &$element, FormStateInterface $form_state, array &$complete_form): array {
    $element_object = Element::create($element);
    if (isset($element_object->format)) {
      $element_object->format->addClass([
        'border',
        'border-top-0',
        'p-3',
        'mb-3',
        'd-flex',
        'align-items-center',
      ]);

      // Guidelines (removed).
      $element_object->format->guidelines->setProperty('access', FALSE);

      // Format (select).
      $element_object->format->format->setProperty('title_display', 'invisible');
      $element_object->format->format->addClass([
        'me-auto',
      ], DrupalAttributes::WRAPPER);
      $element_object->format->format->setProperty('weight', static::FORMAT_WEIGHT);
      // Allow to detect that this select list is from a text format element.
      // Value textarea already have this property.
      $element_object->format->format->setProperty('format', $element_object->getProperty('format', []));

      // Help (link).
      $element_object->format->help->addClass([
        'ms-auto',
      ]);
      $element_object->format->help->about->setAttribute('title', \t('Opens in new window'));
    }

    return $element;
  }

}
