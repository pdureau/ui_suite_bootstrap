<?php

declare(strict_types = 1);

namespace Drupal\ui_suite_bootstrap\HookHandler;

use Drupal\Core\Form\FormStateInterface;

/**
 * Theme search block form.
 */
class FormSearchBlockFormAlter {

  /**
   * Theme search block form.
   *
   * @param array $form
   *   The form structure.
   * @param \Drupal\Core\Form\FormStateInterface $formState
   *   The form state.
   * @param string $form_id
   *   The form ID.
   */
  public function alter(array &$form, FormStateInterface $formState, string $form_id): void {
    if (!isset($form['keys'])) {
      return;
    }

    $form['keys']['#input_group_button'] = TRUE;
  }

}
