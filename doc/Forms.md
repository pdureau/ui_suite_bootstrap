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

### Toggle buttons

https://getbootstrap.com/docs/5.2/forms/checks-radios/#toggle-buttons:

Not supported out-of-the-box.

## Input group

https://getbootstrap.com/docs/5.2/forms/input-group.

### Examples

https://getbootstrap.com/docs/5.2/forms/input-group/#basic-example:

```php
$form['input_group_example_1'] = [
  '#type' => 'textfield',
  '#title' => $this->t('Example'),
  '#title_display' => 'hidden',
  '#attributes' => [
    'placeholder' => $this->t('Username'),
  ],
  '#input_group' => TRUE,
  '#field_prefix' => [
    '@',
  ],
];

$form['input_group_example_2'] = [
  '#type' => 'textfield',
  '#title' => $this->t('Example'),
  '#title_display' => 'hidden',
  '#attributes' => [
    'placeholder' => $this->t("Recipient's username"),
  ],
  '#input_group' => TRUE,
  '#field_suffix' => [
    '@example.com',
  ],
];

$form['input_group_example_3'] = [
  '#type' => 'textfield',
  '#title' => $this->t('Your vanity URL'),
  '#input_group' => TRUE,
  '#field_prefix' => [
    'https://example.com/users/',
  ],
];

$form['input_group_example_4'] = [
  '#type' => 'textfield',
  '#title' => $this->t('Example'),
  '#title_display' => 'hidden',
  '#input_group' => TRUE,
  '#field_prefix' => [
    '$',
  ],
  '#field_suffix' => [
    '.00',
  ],
];

$form['input_group_example_5'] = [
  '#type' => 'textarea',
  '#title' => $this->t('Example'),
  '#title_display' => 'hidden',
  '#input_group' => TRUE,
  '#field_prefix' => [
    $this->t('With textarea'),
  ],
];
```

### Sizing

https://getbootstrap.com/docs/5.2/forms/input-group/#sizing:

```php
$form['input_group_sizing_sm'] = [
  '#type' => 'textfield',
  '#title' => $this->t('Example'),
  '#title_display' => 'hidden',
  '#input_group' => TRUE,
  '#input_group_attributes' => [
    'class' => [
      'input-group-sm',
    ],
  ],
  '#field_prefix' => [
    'Small',
  ],
];

$form['input_group_sizing_lg'] = [
  '#type' => 'textfield',
  '#title' => $this->t('Example'),
  '#title_display' => 'hidden',
  '#input_group' => TRUE,
  '#input_group_attributes' => [
    'class' => [
      'input-group-lg',
    ],
  ],
  '#field_prefix' => [
    'Large',
  ],
];
```

### Multiple inputs

https://getbootstrap.com/docs/5.2/forms/input-group/#multiple-inputs:

Not supported out-of-the-box.

### Multiple addons

https://getbootstrap.com/docs/5.2/forms/input-group/#multiple-addons:

```php
$form['input_group_multiple_addons_prefix'] = [
  '#type' => 'textfield',
  '#title' => $this->t('Example'),
  '#title_display' => 'hidden',
  '#input_group' => TRUE,
  '#field_prefix' => [
    '$',
    '0.00',
  ],
];

$form['input_group_multiple_addons_suffix'] = [
  '#type' => 'textfield',
  '#title' => $this->t('Example'),
  '#title_display' => 'hidden',
  '#input_group' => TRUE,
  '#field_suffix' => [
    '$',
    '0.00',
  ],
];
```

### Button addons

https://getbootstrap.com/docs/5.2/forms/input-group/#button-addons:

Created manually:

```php
$form['input_group_button_addons'] = [
  '#type' => 'textfield',
  '#title' => $this->t('Example'),
  '#title_display' => 'hidden',
  '#input_group' => TRUE,
  '#field_prefix' => [
    [
      '#type' => 'submit',
      '#value' => $this->t('Button'),
    ],
    [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
      '#attributes' => [
        'class' => [
          'btn-outline-secondary',
        ],
      ],
    ],
  ],
];
```

Automatic detection:

```php
$form['example_automatic_input_group_button'] = [
  '#type' => 'textfield',
  '#title' => $this->t('Example'),
  '#field_prefix' => [
    'Test',
    'Test 2'
  ],
  '#input_group_button' => TRUE,
];

$form['example_automatic_input_group_button_submit'] = [
  '#type' => 'submit',
  '#value' => $this->t('Submit'),
];
```

### Buttons with dropdowns

https://getbootstrap.com/docs/5.2/forms/input-group/#buttons-with-dropdowns:

Not supported out-of-the-box.

### Segmented buttons

https://getbootstrap.com/docs/5.2/forms/input-group/#segmented-buttons:

Not supported out-of-the-box.

### Custom select

https://getbootstrap.com/docs/5.2/forms/input-group/#custom-select:

```php
$form['input_group_select'] = [
  '#type' => 'select',
  '#title' => $this->t('Example'),
  '#title_display' => 'hidden',
  '#options' => [
    'option_1' => $this->t('Option 1'),
    'option_2' => $this->t('Option 2'),
    'option_3' => $this->t('Option 3'),
  ],
  '#input_group' => TRUE,
  '#field_prefix' => [
    $this->t('Options'),
  ],
];
```

### Custom file input

https://getbootstrap.com/docs/5.2/forms/input-group/#custom-file-input:

```php
$form['input_group_file'] = [
  '#type' => 'file',
  '#title' => $this->t('Example'),
  '#title_display' => 'hidden',
  '#input_group' => TRUE,
  '#field_prefix' => [
    $this->t('Upload'),
  ],
];
```
