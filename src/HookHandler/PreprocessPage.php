<?php

declare(strict_types = 1);

namespace Drupal\ui_suite_bootstrap\HookHandler;

/**
 * Handle CSS classes.
 */
class PreprocessPage {

  /**
   * Handle CSS classes.
   *
   * @param array $variables
   *   The preprocessed variables.
   */
  public function preprocess(array &$variables): void {
    // @todo It would be better to have a setting, like bootstrap_barrio do with
    // bootstrap_barrio_fluid_container ('container-fluid' : 'container')
    $variables['container'] = 'container';
  }

}
