# UI Suite Bootstrap

A site-builder friendly [Bootstrap](https://getbootstrap.com/) theme for
Drupal 8 and 9, using the [UI Suite](https://www.drupal.org/project/ui_suite).

Use Bootstrap directly from Drupal backoffice (layout builder, manage display,
views, blocks, flags...).

![Overview](doc/screenshot.png)

# How it works

![Overview](doc/schema.png)

## Components chapter implemented with [UI Patterns](https://www.drupal.org/project/ui_patterns)

Each component is a folder in templates/pattern/.

You can browse the pattern libraries directly inside Drupal: /patterns; for
example, the 'card' pattern is available here: /patterns/card.

Thanks to the ui_patterns ecosystem, patterns are automatically available
directly for site building in many Drupal entities, as
[layout plugins](https://ui-patterns.readthedocs.io/en/8.x-1.x/content/layout-plugin.html),
[views row plugins](https://ui-patterns.readthedocs.io/en/8.x-1.x/content/views.html),
[field formatter plugins](https://www.drupal.org/project/ui_patterns_field_formatters/),
[views styles plugins](https://www.drupal.org/project/ui_patterns_views_style)...

## Utilities chapter implemented with [UI Styles](https://www.drupal.org/project/ui_styles)

Utilities are implemented as styles in ui_suite_bootstrap.ui_styles.yml

You can browse the styles libraries directly inside Drupal: /styles.

The styles are automatically available for site building inside layout builder's
components (blocks) & sections (layouts).

## Layouts chapter implemented with [Layout Options](https://www.drupal.org/project/layout_options)

A simple grid_row component is already set as a pattern for simple use cases.

For more complex use cases, layouts are implemented in ui_suite_bootstrap.layout.yml
and ui_suite_bootstrap.layout_options.yml

Those layouts are automatically available as configurable layout plugins.

## Examples section implemented with [UI Examples](https://www.drupal.org/project/ui_examples)

4 example pages are integrated using only render arrays, inside
ui_suite_bootstrap.ui_examples.yml:

- [album](https://getbootstrap.com/docs/4.6/examples/album/)
- [pricing](https://getbootstrap.com/docs/4.6/examples/pricing/)
- [carousel](https://getbootstrap.com/docs/4.6/examples/carousel/)

You can browse the example pages directly inside Drupal: /examples

# Installation

```
$ composer require 'drupal/ui_suite_bootstrap:4.x'
```


## Manual installation

By default, the theme use https://www.bootstrapcdn.com/

If you prefer a local instalaltion, you need to override the libraries and place the Bootstrap library in the `libraries` folder:


```json
{
  "require": {
    "asset/bootstrap": "4.6.1",
    "composer/installers": "2.*"
  },
  "repositories": {
    "asset-bootstrap": {
      "type": "package",
      "package": {
        "name": "asset/bootstrap",
        "version": "4.6.1",
        "type": "drupal-library",
        "extra": {
          "installer-name": "bootstrap"
        },
        "dist": {
          "type": "zip",
          "url": "https://api.github.com/repos/twbs/bootstrap/zipball/043a03c95a2ad6738f85b65e53b9dbdfb03b8d10",
          "reference": "043a03c95a2ad6738f85b65e53b9dbdfb03b8d10"
        }
      }
    }
  },
  "extra": {
    "installer-paths": {
      "web/libraries/{$name}": [
        "type:drupal-library"
      ]
    }
  }
}
```


If you are using [Asset Packagist](https://asset-packagist.org), the
composer.json can be like:

```json
{
  "require": {
    "asset/bootstrap": "4.6.1",
    "composer/installers": "2.*",
    "oomphinc/composer-installers-extender": "2.*"
  },
  "repositories": {
    "asset-packagist": {
      "type": "composer",
      "url": "https://asset-packagist.org"
    }
  },
  "extra": {
    "installer-paths": {
      "app/libraries/{$name}": [
        "type:drupal-library",
        "type:bower-asset",
        "type:npm-asset"
      ]

    },
    "installer-types": [
      "bower-asset",
      "npm-asset"
    ]
  }
}
```

# Demo

See [ui\_suite\_bootstrap\_demo](https://www.drupal.org/project/ui_suite_bootstrap_demo) installation profile.

