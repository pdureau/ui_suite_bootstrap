# Forms

## Form controls

https://getbootstrap.com/docs/5.2/forms/form-control.

### Sizing

https://getbootstrap.com/docs/5.2/forms/form-control/#sizing:

```php
$form['example_lg'] = [
  '#type' => 'textfield',
  '#title' => $this->t('Example'),
  '#attributes' => [
    'class' => [
      'form-control-lg',
    ],
  ],
];

$form['example_sm'] = [
  '#type' => 'textfield',
  '#title' => $this->t('Example'),
  '#attributes' => [
    'class' => [
      'form-control-sm',
    ],
  ],
];
```

### Readonly plain text

https://getbootstrap.com/docs/5.2/forms/form-control/#readonly-plain-text:

```php
$form['example_readonly_plain_text'] = [
  '#type' => 'textfield',
  '#title' => $this->t('Example'),
  '#attributes' => [
    'class' => [
      'form-control-plaintext',
    ],
    'readonly' => TRUE,
  ],
  '#value' => 'Example',
];
```

## Select

https://getbootstrap.com/docs/5.2/forms/select.

### Sizing

https://getbootstrap.com/docs/5.2/forms/select/#sizing:

```php
$form['example_select_lg'] = [
  '#type' => 'select',
  '#title' => $this->t('Example'),
  '#options' => [
    'option_1' => $this->t('Option 1'),
    'option_2' => $this->t('Option 2'),
  ],
  '#attributes' => [
    'class' => [
      'form-select-lg',
    ],
  ],
];

$form['example_select_sm'] = [
  '#type' => 'select',
  '#title' => $this->t('Example'),
  '#options' => [
    'option_1' => $this->t('Option 1'),
    'option_2' => $this->t('Option 2'),
  ],
  '#attributes' => [
    'class' => [
      'form-select-sm',
    ],
  ],
];
```

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
