<?php

declare(strict_types = 1);

namespace Drupal\ui_suite_bootstrap;

use Drupal\ui_skins\HookHandler\FormSystemThemeSettingsAlter;

/**
 * Handle some UI Skins specificities.
 */
class UiSkins {

  /**
   * The page top key for CSS variables.
   */
  public const PAGE_TOP_CSS_VARIABLES_KEY = 'ui_suite_bootstrap_form_required';

  /**
   * Inject CSS based on CSS variables overrides.
   *
   * Only CSS that cannot be handled directly in normal CSS with CSS variables.
   *
   * @param array $variables
   *   The preprocessed variables.
   */
  public function preprocessHtml(array &$variables): void {
    $ui_skins_css_variables_settings = \theme_get_setting(FormSystemThemeSettingsAlter::CSS_VARIABLES_THEME_SETTING_KEY);
    if (!\is_array($ui_skins_css_variables_settings)) {
      return;
    }

    $inline_css = '';
    // Required mark.
    if (isset($ui_skins_css_variables_settings['bs_danger'][':root'])) {
      $new_danger = \urlencode($ui_skins_css_variables_settings['bs_danger'][':root']);
      $inline_css .= ".fieldset-legend.form-required::after,.form-label.form-required::after,.required-mark::after{background-image: url(\"data:image/svg+xml,%3Csvg height='16' width='16' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='m0 7.562 1.114-3.438c2.565.906 4.43 1.688 5.59 2.35-.306-2.921-.467-4.93-.484-6.027h3.511c-.05 1.597-.234 3.6-.558 6.003 1.664-.838 3.566-1.613 5.714-2.325l1.113 3.437c-2.05.678-4.06 1.131-6.028 1.356.984.856 2.372 2.381 4.166 4.575l-2.906 2.059c-.935-1.274-2.041-3.009-3.316-5.206-1.194 2.275-2.244 4.013-3.147 5.206l-2.856-2.059c1.872-2.307 3.211-3.832 4.017-4.575-2.081-.402-4.058-.856-5.93-1.356' fill='" . $new_danger . "'/%3E%3C/svg%3E%0A\");";
    }
    // Required mark in contrast mode.
    if (isset($ui_skins_css_variables_settings['bs_white'][':root'])) {
      $new_white = \urlencode($ui_skins_css_variables_settings['bs_white'][':root']);
      $inline_css .= "@media screen and (-ms-high-contrast: active){.fieldset-legend.form-required::after,.form-label.form-required::after,.required-mark::after{background-image: url(\"data:image/svg+xml,%3Csvg height='16' width='16' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='m0 7.562 1.114-3.438c2.565.906 4.43 1.688 5.59 2.35-.306-2.921-.467-4.93-.484-6.027h3.511c-.05 1.597-.234 3.6-.558 6.003 1.664-.838 3.566-1.613 5.714-2.325l1.113 3.437c-2.05.678-4.06 1.131-6.028 1.356.984.856 2.372 2.381 4.166 4.575l-2.906 2.059c-.935-1.274-2.041-3.009-3.316-5.206-1.194 2.275-2.244 4.013-3.147 5.206l-2.856-2.059c1.872-2.307 3.211-3.832 4.017-4.575-2.081-.402-4.058-.856-5.93-1.356' fill='" . $new_white . "'/%3E%3C/svg%3E%0A\");}};";
    }

    if (empty($inline_css)) {
      return;
    }
    $variables['page_top'][static::PAGE_TOP_CSS_VARIABLES_KEY] = [
      '#type' => 'html_tag',
      '#tag' => 'style',
      '#value' => $inline_css,
    ];
  }

}
