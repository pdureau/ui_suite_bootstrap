# Forms

## Checkboxes and radios

https://getbootstrap.com/docs/5.2/forms/checks-radios.

### Switch

https://getbootstrap.com/docs/5.2/forms/checks-radios/#switches:

```php
$form['checkbox_switch'] = [
  '#type' => 'checkbox',
  '#title' => $this->t('Example'),
  '#is_switch' => TRUE,
];

$form['checkboxes_switch'] = [
  '#type' => 'checkboxes',
  '#title' => $this->t('Example'),
  '#options' => [
    'option_1' => $this->t('Option 1'),
    'option_2' => $this->t('Option 2'),
  ],
  // Transform all checkboxes into switch.
  '#is_switch' => TRUE,
  'option_2' => [
    // Per option behavior.
    '#is_switch' => FALSE,
  ],
];
```

### Inline

https://getbootstrap.com/docs/5.2/forms/checks-radios/#inline:

```php
$form['radios_inline'] = [
  '#type' => 'radios',
  '#title' => $this->t('Example'),
  '#options' => [
    'option_1' => $this->t('Option 1'),
    'option_2' => $this->t('Option 2'),
  ],
  '#is_inline' => TRUE,
];

$form['checkboxes_inline'] = [
  '#type' => 'checkboxes',
  '#title' => $this->t('Example'),
  '#options' => [
    'option_1' => $this->t('Option 1'),
    'option_2' => $this->t('Option 2'),
  ],
  '#is_inline' => TRUE,
];
```

### Reverse

https://getbootstrap.com/docs/5.2/forms/checks-radios/#reverse:

```php
$form['radios_reverse'] = [
  '#type' => 'radios',
  '#title' => $this->t('Example'),
  '#options' => [
    'option_1' => $this->t('Option 1'),
    'option_2' => $this->t('Option 2'),
  ],
  '#is_reverse' => TRUE,
];

$form['checkboxes_reverse'] = [
  '#type' => 'checkboxes',
  '#title' => $this->t('Example'),
  '#options' => [
    'option_1' => $this->t('Option 1'),
    'option_2' => $this->t('Option 2'),
  ],
  '#is_reverse' => TRUE,
];
```
