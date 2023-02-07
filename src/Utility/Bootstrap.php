<?php

declare(strict_types = 1);

namespace Drupal\ui_suite_bootstrap\Utility;

use Drupal\Core\Extension\ThemeHandlerInterface;

/**
 * The primary class for the Drupal Bootstrap base theme.
 *
 * Provides many helper methods.
 */
class Bootstrap {

  /**
   * Tag used to invalidate caches.
   *
   * @var string
   */
  public const CACHE_TAG = 'theme_registry';

  /**
   * Matches a Bootstrap class based on a string value.
   *
   * @param string|array $value
   *   The string to match against to determine the class. Passed by reference
   *   in case it is a render array that needs to be rendered and typecast.
   * @param string $default
   *   The default class to return if no match is found.
   *
   * @return string
   *   The Bootstrap class matched against the value of $haystack or $default
   *   if no match could be made.
   */
  public static function cssClassFromString(&$value, $default = '') {
    static $lang;
    if (!isset($lang)) {
      $lang = \Drupal::languageManager()->getCurrentLanguage()->getId();
    }

    $theme = static::getTheme();
    $texts = $theme->getCache('cssClassFromString', [$lang]);

    // Ensure it's a string value that was passed.
    $string = static::toString($value);

    if ($texts->isEmpty()) {
      $data = [
        // Text that match these specific strings are checked first.
        'matches' => [
          // Primary class.
          \t('Download feature')->render() => 'primary',

          // Success class.
          \t('Add effect')->render() => 'success',
          \t('Add and configure')->render() => 'success',
          \t('Save configuration')->render() => 'success',
          \t('Install and set as default')->render() => 'success',

          // Info class.
          \t('Save and add')->render() => 'info',
          \t('Add another item')->render() => 'info',
          \t('Update style')->render() => 'info',

          // Outline danger class.
          \t('Discard changes')->render() => 'outline-danger',
        ],

        // Text containing these words anywhere in the string are checked last.
        'contains' => [
          // Primary class.
          \t('Confirm')->render() => 'primary',
          \t('Filter')->render() => 'primary',
          \t('Log in')->render() => 'primary',
          \t('Submit')->render() => 'primary',
          \t('Search')->render() => 'primary',
          \t('Settings')->render() => 'primary',
          \t('Upload')->render() => 'primary',

          // Secondary class.
          \t('Apply')->render() => 'secondary',
          \t('Update')->render() => 'secondary',

          // Success class.
          \t('Add')->render() => 'success',
          \t('Create')->render() => 'success',
          \t('Install')->render() => 'success',
          \t('Save')->render() => 'success',
          \t('Write')->render() => 'success',

          // Danger class.
          \t('Delete')->render() => 'danger',
          \t('Remove')->render() => 'danger',
          \t('Reset')->render() => 'danger',
          \t('Uninstall')->render() => 'danger',

          // Warning class.
          \t('Export')->render() => 'warning',
          \t('Import')->render() => 'warning',
          \t('Restore')->render() => 'warning',
          \t('Rebuild')->render() => 'warning',
        ],
      ];

      // Allow sub-themes to alter this array of patterns.
      /** @var \Drupal\Core\Theme\ThemeManagerInterface $theme_manager */
      $theme_manager = \Drupal::service('theme.manager');
      $theme_manager->alter('ui_suite_bootstrap_colorize_text', $data);

      $texts->setMultiple($data);
    }

    // Iterate over the array.
    foreach ($texts as $pattern => $strings) {
      foreach ($strings as $text => $class) {
        switch ($pattern) {
          case 'matches':
            if ($string === $text) {
              return $class;
            }
            break;

          case 'contains':
            if (\strpos(\mb_strtolower($string), \mb_strtolower($text)) !== FALSE) {
              return $class;
            }
            break;
        }
      }
    }

    // Return the default if nothing was matched.
    return $default;
  }

  /**
   * Retrieves a theme instance of \Drupal\ui_suite_bootstrap.
   *
   * @param string $name
   *   The machine name of a theme. If omitted, the active theme will be used.
   * @param \Drupal\Core\Extension\ThemeHandlerInterface|null $theme_handler
   *   The theme handler object.
   *
   * @return \Drupal\ui_suite_bootstrap\Utility\Theme
   *   A theme object.
   */
  public static function getTheme($name = NULL, ?ThemeHandlerInterface $theme_handler = NULL) {
    // Immediately return if theme passed is already instantiated.
    if ($name instanceof Theme) {
      return $name;
    }

    static $themes = [];

    // Retrieve the active theme.
    // Do not statically cache this as the active theme may change.
    if (!isset($name)) {
      $name = \Drupal::theme()->getActiveTheme()->getName();
    }

    if (!isset($theme_handler)) {
      $theme_handler = self::getThemeHandler();
    }

    if (!isset($themes[$name])) {
      $themes[$name] = new Theme($theme_handler->getTheme($name), $theme_handler);
    }

    return $themes[$name];
  }

  /**
   * Retrieves the theme handler instance.
   *
   * @return \Drupal\Core\Extension\ThemeHandlerInterface
   *   The theme handler instance.
   */
  public static function getThemeHandler() {
    static $theme_handler;
    if (!isset($theme_handler)) {
      $theme_handler = \Drupal::service('theme_handler');
    }
    return $theme_handler;
  }

  /**
   * Ensures a value is typecast to a string, rendering an array if necessary.
   *
   * @param string|array $value
   *   The value to typecast, passed by reference.
   *
   * @return string
   *   The typecast string value.
   */
  public static function toString(&$value) {
    return (string) (Element::isRenderArray($value) ? Element::create($value)->renderPlain() : $value);
  }

}
