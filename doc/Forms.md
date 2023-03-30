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

Drupal core has two form element properties `#field_prefix` and `#field_suffix`.

UI Suite Bootstrap introduces 2 new properties (among others, see the examples):
* `#input_group_after`
* `#input_group_before`

If a form element only provides `#field_prefix`, it is used to populate
`#input_group_before`. If a form element provides both `#field_prefix` and
`#input_group_before`, only `#input_group_before` will be used.

`#field_prefix` is expected to be a string while `#input_group_before` is
expected to be an array (of strings or other render elements) to allow for more
complex usage (multiple addons, submit buttons).

The same logic applies for `#field_suffix` and `#input_group_after`.

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
  '#field_prefix' => '@',
];

$form['input_group_example_2'] = [
  '#type' => 'textfield',
  '#title' => $this->t('Example'),
  '#title_display' => 'hidden',
  '#attributes' => [
    'placeholder' => $this->t("Recipient's username"),
  ],
  '#field_suffix' => '@example.com',
];

$form['input_group_example_3'] = [
  '#type' => 'textfield',
  '#title' => $this->t('Your vanity URL'),
  '#field_prefix' => 'https://example.com/users/',
];

$form['input_group_example_4'] = [
  '#type' => 'textfield',
  '#title' => $this->t('Example'),
  '#title_display' => 'hidden',
  '#field_prefix' => '$',
  '#field_suffix' => '.00',
];

$form['input_group_example_5'] = [
  '#type' => 'textarea',
  '#title' => $this->t('Example'),
  '#title_display' => 'hidden',
  '#field_prefix' => $this->t('With textarea'),
];
```

### Sizing

https://getbootstrap.com/docs/5.2/forms/input-group/#sizing:

```php
$form['input_group_sizing_sm'] = [
  '#type' => 'textfield',
  '#title' => $this->t('Example'),
  '#title_display' => 'hidden',
  '#input_group_attributes' => [
    'class' => [
      'input-group-sm',
    ],
  ],
  '#field_prefix' => $this->t('Small'),
];

$form['input_group_sizing'] = [
  '#type' => 'textfield',
  '#title' => $this->t('Example'),
  '#title_display' => 'hidden',
  '#field_prefix' => $this->t('Default'),
];

$form['input_group_sizing_lg'] = [
  '#type' => 'textfield',
  '#title' => $this->t('Example'),
  '#title_display' => 'hidden',
  '#input_group_attributes' => [
    'class' => [
      'input-group-lg',
    ],
  ],
  '#field_prefix' => $this->t('Large'),
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
  '#input_group_before' => [
    '$',
    '0.00',
  ],
];

$form['input_group_multiple_addons_suffix'] = [
  '#type' => 'textfield',
  '#title' => $this->t('Example'),
  '#title_display' => 'hidden',
  '#input_group_after' => [
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
  '#input_group_before' => [
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
  '#input_group_before' => [
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
  '#field_prefix' => $this->t('Options'),
];
```

### Custom file input

https://getbootstrap.com/docs/5.2/forms/input-group/#custom-file-input:

```php
$form['input_group_file'] = [
  '#type' => 'file',
  '#title' => $this->t('Example'),
  '#title_display' => 'hidden',
  '#field_prefix' => $this->t('Upload'),
];
```

## Floating labels

https://getbootstrap.com/docs/5.2/forms/floating-labels.

We handle a new value for `#title_display: floating`.

UI Suite Bootstrap introduces a new property: `#floating_label`.

When this property is set to `TRUE`, it has the same behavior as setting
`#title_display` to `floating`.

This is useful for example in Webform UI, which let you set `#title_display` but
as there won't be the `floating` option, you can enter `#floating_label` in the
YAML of its advanced options.

Also if no placeholder attributes is set. UI Suite Bootstrap will fallback to
the label itself.

### Example

https://getbootstrap.com/docs/5.2/forms/floating-labels/#example:

```php
$form['floating_label_property'] = [
  '#type' => 'textfield',
  '#title' => $this->t('With #floating_label property'),
  '#floating_label' => TRUE,
];

$form['floating_label_email'] = [
  '#type' => 'email',
  '#title' => $this->t('Email address'),
  '#title_display' => 'floating',
  '#attributes' => [
    'placeholder' => $this->t('name@example.com'),
  ],
];

$form['floating_label_password'] = [
  '#type' => 'password',
  '#title' => $this->t('Password'),
  '#title_display' => 'floating',
  '#attributes' => [
    'placeholder' => $this->t('Password'),
  ],
];

$form['floating_label_value'] = [
  '#type' => 'email',
  '#title' => $this->t('Input with value'),
  '#title_display' => 'floating',
  '#default_value' => 'test@example.com',
  '#attributes' => [
    'placeholder' => $this->t('name@example.com'),
  ],
];
```

### Textareas

https://getbootstrap.com/docs/5.2/forms/floating-labels/#textareas:

```php
$form['floating_label_textarea'] = [
  '#type' => 'textarea',
  '#title' => $this->t('Comments'),
  '#title_display' => 'floating',
  '#attributes' => [
    'placeholder' => $this->t('Leave a comment here'),
  ],
];
```

### Selects

https://getbootstrap.com/docs/5.2/forms/floating-labels/#selects:

```php
$form['floating_label_select'] = [
  '#type' => 'select',
  '#title' => $this->t('Works with selects'),
  '#title_display' => 'floating',
  '#options' => [
    'option_1' => $this->t('Option 1'),
    'option_2' => $this->t('Option 2'),
    'option_3' => $this->t('Option 3'),
  ],
];
```

### Readonly plaintext

https://getbootstrap.com/docs/5.2/forms/floating-labels/#readonly-plaintext:

```php
$form['floating_label_readonly'] = [
  '#type' => 'email',
  '#title' => $this->t('Empty input'),
  '#title_display' => 'floating',
  '#attributes' => [
    'placeholder' => $this->t('name@example.com'),
    'class' => [
      'form-control-plaintext',
    ],
    'readonly' => TRUE,
  ],
];

$form['floating_label_readonly_value'] = [
  '#type' => 'email',
  '#title' => $this->t('Input with value'),
  '#title_display' => 'floating',
  '#default_value' => 'name@example.com',
  '#attributes' => [
    'placeholder' => $this->t('name@example.com'),
    'class' => [
      'form-control-plaintext',
    ],
    'readonly' => TRUE,
  ],
];
```

### Input groups

https://getbootstrap.com/docs/5.2/forms/floating-labels/#input-groups:

```php
$form['floating_label_input_group'] = [
  '#type' => 'textfield',
  '#title' => $this->t('Username'),
  '#title_display' => 'floating',
  '#attributes' => [
    'placeholder' => $this->t('Username'),
  ],
  '#field_prefix' => '@',
];
```

## Validation

### Custom styles

https://getbootstrap.com/docs/5.2/forms/validation/#custom-styles

Not supported out-of-the-box.

### Server side

https://getbootstrap.com/docs/5.2/forms/validation/#server-side:

```php
public function buildForm(array $form, FormStateInterface $form_state) {
  $form['validation_textfield'] = [
    '#type' => 'textfield',
    '#title' => $this->t('Textfield'),
    '#description' => $this->t('Must be at least 5 characters in length.'),
  ];

  $form['validation_textfield_tooltip'] = [
    '#type' => 'textfield',
    '#title' => $this->t('Textfield with tooltip'),
    '#errors_display' => 'tooltip',
  ];

  $form['validation_textfield_input_group'] = [
    '#type' => 'textfield',
    '#title' => $this->t('Textfield with input group'),
    '#description' => $this->t('Must be at least 5 characters in length.'),
    '#field_prefix' => '@',
    '#field_suffix' => '.com',
  ];

  $form['validation_textfield_floating_label'] = [
    '#type' => 'textfield',
    '#title' => $this->t('Textfield with floating label'),
    '#title_display' => 'floating',
    '#description' => $this->t('Must be at least 5 characters in length.'),
  ];

  $form['validation_textfield_floating_label_input_group'] = [
    '#type' => 'textfield',
    '#title' => $this->t('Textfield with floating label and input group'),
    '#title_display' => 'floating',
    '#description' => $this->t('Must be at least 5 characters in length.'),
    '#field_prefix' => '@',
    '#field_suffix' => '.com',
  ];

  $form['validation_select'] = [
    '#type' => 'select',
    '#title' => $this->t('Select'),
    '#description' => $this->t('Must be choice 1.'),
    '#empty_option' => $this->t('Choose'),
    '#options' => [
      'choice_1' => $this->t('Choice 1'),
      'choice_2' => $this->t('Choice 2'),
      'choice_3' => $this->t('Choice 3'),
    ],
  ];

  $form['validation_select_with_input_group'] = [
    '#type' => 'select',
    '#title' => $this->t('Select with input group'),
    '#description' => $this->t('Must be choice 1.'),
    '#empty_option' => $this->t('Choose'),
    '#options' => [
      'choice_1' => $this->t('Choice 1'),
      'choice_2' => $this->t('Choice 2'),
      'choice_3' => $this->t('Choice 3'),
    ],
    '#field_prefix' => $this->t('I choose'),
    '#field_suffix' => $this->t('wisely.'),
  ];

  $form['validation_textarea'] = [
    '#type' => 'textarea',
    '#title' => $this->t('Textarea'),
    '#description' => $this->t('Must be at least 5 characters in length.'),
  ];

  $form['validation_textarea_with_input_group'] = [
    '#type' => 'textarea',
    '#title' => $this->t('Textarea with input group'),
    '#description' => $this->t('Must be at least 5 characters in length.'),
    '#field_prefix' => $this->t('With textarea'),
  ];

  $form['validation_checkbox'] = [
    '#type' => 'checkbox',
    '#title' => $this->t('Checkbox'),
    '#description' => $this->t('Must be checked.'),
  ];

  $form['validation_checkboxes'] = [
    '#type' => 'checkboxes',
    '#title' => $this->t('Checkboxes'),
    '#description' => $this->t('Must be choice 1.'),
    '#options' => [
      'choice_1' => $this->t('Choice 1'),
      'choice_2' => $this->t('Choice 2'),
      'choice_3' => $this->t('Choice 3'),
    ],
  ];

  $form['validation_radios'] = [
    '#type' => 'radios',
    '#title' => $this->t('Radios'),
    '#description' => $this->t('Must be checked.'),
    '#options' => [
      'choice_1' => $this->t('Choice 1'),
      'choice_2' => $this->t('Choice 2'),
      'choice_3' => $this->t('Choice 3'),
    ],
  ];

  $form['actions'] = [
    '#type' => 'actions',
  ];

  $form['actions']['submit'] = [
    '#type' => 'submit',
    '#value' => $this->t('Submit'),
  ];

  return $form;
}

public function validateForm(array &$form, FormStateInterface $form_state) {
  $minimal_length = [
    'validation_textfield',
    'validation_textfield_tooltip',
    'validation_textfield_input_group',
    'validation_textarea',
    'validation_textarea_with_input_group',
    'validation_textfield_floating_label',
    'validation_textfield_floating_label_input_group',
  ];
  foreach ($minimal_length as $minimal_length_field) {
    if ($form_state->hasValue($minimal_length_field) && strlen($form_state->getValue($minimal_length_field)) < 5) {
      $form_state->setErrorByName($minimal_length_field, $this->t('Must be at least 5 characters long.'));
    }
  }

  $choice_1 = [
    'validation_select',
    'validation_select_with_input_group',
    'validation_radios',
  ];
  foreach ($choice_1 as $choice_1_field) {
    if ($form_state->hasValue($choice_1_field) && $form_state->getValue($choice_1_field) != 'choice_1') {
      $form_state->setErrorByName($choice_1_field, $this->t('Please choose choice 1.'));
    }
  }
  if ($form_state->hasValue('validation_checkboxes') && $form_state->getValue('validation_checkboxes')['choice_1'] != 'choice_1') {
    $form_state->setErrorByName('validation_checkboxes', $this->t('The validation_checkboxes must be choice 1.'));
  }

  if ($form_state->hasValue('validation_checkbox') && !$form_state->getValue('validation_checkbox')) {
    $form_state->setErrorByName('validation_checkbox', $this->t('The validation_checkbox must be checked.'));
  }
}
```

### Tooltips

https://getbootstrap.com/docs/5.2/forms/validation/#tooltips:

```php
$form['validation_textfield_tooltip'] = [
  '#type' => 'textfield',
  '#title' => $this->t('Textfield with tooltip'),
  '#errors_display' => 'tooltip',
];
```

## Layout

https://getbootstrap.com/docs/5.2/forms/layout.

### Utilities

https://getbootstrap.com/docs/5.2/forms/layout/#utilities:

Currently out of the box, `mb-3` is added automatically.

To do in custom implementations.

### Form grid

https://getbootstrap.com/docs/5.2/forms/layout/#form-grid.

To do in custom implementations.

See Gutters' example.

### Gutters

https://getbootstrap.com/docs/5.2/forms/layout/#gutters.

To do in custom implementations.

Example of custom implementation:

```php
$form['#attributes'] = [
  'class' => [
    'row',
    'g-3',
  ],
];

$form['layout_gutters_email'] = [
  '#type' => 'email',
  '#title' => $this->t('Email'),
  '#wrapper_attributes' => [
    'class' => [
      'col-md-6',
    ],
  ],
];

$form['layout_gutters_password'] = [
  '#type' => 'password',
  '#title' => $this->t('Password'),
  '#wrapper_attributes' => [
    'class' => [
      'col-md-6',
    ],
  ],
];

$form['layout_gutters_address_1'] = [
  '#type' => 'textfield',
  '#title' => $this->t('Address'),
  '#attributes' => [
    'placeholder' => $this->t('1234 Main St'),
  ],
  '#wrapper_attributes' => [
    'class' => [
      'col-12',
    ],
  ],
];

$form['layout_gutters_address_2'] = [
  '#type' => 'textfield',
  '#title' => $this->t('Address 2'),
  '#attributes' => [
    'placeholder' => $this->t('Apartment, studio, or floor'),
  ],
  '#wrapper_attributes' => [
    'class' => [
      'col-12',
    ],
  ],
];

$form['layout_gutters_city'] = [
  '#type' => 'textfield',
  '#title' => $this->t('City'),
  '#wrapper_attributes' => [
    'class' => [
      'col-md-6',
    ],
  ],
];

$form['layout_gutters_state'] = [
  '#type' => 'select',
  '#title' => $this->t('State'),
  '#empty_option' => $this->t('Choose...'),
  '#options' => [
    'choice_1' => $this->t('Choice 1'),
    'choice_2' => $this->t('Choice 2'),
    'choice_3' => $this->t('Choice 3'),
  ],
  '#wrapper_attributes' => [
    'class' => [
      'col-md-4',
    ],
  ],
];

$form['layout_gutters_zip'] = [
  '#type' => 'textfield',
  '#title' => $this->t('Zip'),
  '#wrapper_attributes' => [
    'class' => [
      'col-md-2',
    ],
  ],
];

$form['layout_gutters_checkbox_wrapper'] = [
  '#type' => 'container',
  '#attributes' => [
    'class' => [
      'col-12',
    ],
  ],
];

$form['layout_gutters_checkbox_wrapper']['layout_gutters_checkbox'] = [
  '#type' => 'checkbox',
  '#title' => $this->t('Check me out'),
];

$form['layout_gutters_submit_wrapper'] = [
  '#type' => 'container',
  '#attributes' => [
    'class' => [
      'col-12',
    ],
  ],
];

$form['layout_gutters_submit_wrapper']['layout_gutters_submit'] = [
  '#type' => 'submit',
  '#value' => $this->t('Sign in'),
  '#attributes' => [
    'class' => [
      'btn-primary',
    ],
  ],
];
```

### Horizontal form

When using `#title_display: inline`, the `col-form-label` is automatically added
on the label.

You will have to control the alignment using `#wrapper_attributes`,
`#label_attributes` and `#inner_wrapper_attributes` properties.

The last property, `#inner_wrapper_attributes`, is a new one used in UI Suite
Bootstrap form handling.

https://getbootstrap.com/docs/5.2/forms/layout/#horizontal-form:

```php
$form['layout_horizontal_email'] = [
  '#type' => 'email',
  '#title' => $this->t('Email'),
  '#title_display' => 'inline',
  '#label_attributes' => [
    'class' => [
      'col-sm-2',
    ],
  ],
  '#wrapper_attributes' => [
    'class' => [
      'row',
    ],
  ],
  '#inner_wrapper_attributes' => [
    'class' => [
      'col-sm-10',
    ],
  ],
];

$form['layout_horizontal_password'] = [
  '#type' => 'password',
  '#title' => $this->t('Password'),
  '#title_display' => 'inline',
  '#label_attributes' => [
    'class' => [
      'col-sm-2',
    ],
  ],
  '#wrapper_attributes' => [
    'class' => [
      'row',
    ],
  ],
  '#inner_wrapper_attributes' => [
    'class' => [
      'col-sm-10',
    ],
  ],
];

$form['layout_horizontal_radios'] = [
  '#type' => 'radios',
  '#title' => $this->t('Radios'),
  '#title_display' => 'inline',
  '#options' => [
    'choice_1' => $this->t('First radio'),
    'choice_2' => $this->t('Second radio'),
    'choice_3' => $this->t('Third disabled radio'),
  ],
  '#label_attributes' => [
    'class' => [
      'col-sm-2',
      'pt-0',
    ],
  ],
  '#wrapper_attributes' => [
    'class' => [
      'row',
    ],
  ],
  '#inner_wrapper_attributes' => [
    'class' => [
      'col-sm-10',
    ],
  ],
  'choice_3' => [
    '#disabled' => TRUE,
  ],
];


$form['layout_horizontal_checkbox_wrapper_row'] = [
  '#type' => 'container',
  '#attributes' => [
    'class' => [
      'row',
      'mb-3',
    ],
  ],
];

$form['layout_horizontal_checkbox_wrapper_row']['layout_horizontal_checkbox_wrapper_col'] = [
  '#type' => 'container',
  '#attributes' => [
    'class' => [
      'col-sm-10',
      'offset-sm-2',
    ],
  ],
];

$form['layout_horizontal_checkbox_wrapper_row']['layout_horizontal_checkbox_wrapper_col']['layout_horizontal_checkbox'] = [
  '#type' => 'checkbox',
  '#title' => $this->t('Example checkbox'),
];

$form['layout_horizontal_submit'] = [
  '#type' => 'submit',
  '#value' => $this->t('Sign in'),
  '#attributes' => [
    'class' => [
      'btn-primary',
    ],
  ],
];
```

With description:

```php
$form['layout_horizontal_description'] = [
  '#type' => 'email',
  '#title' => $this->t('Email'),
  '#title_display' => 'inline',
  '#description' => $this->t('Description'),
  '#label_attributes' => [
    'class' => [
      'col-sm-2',
    ],
  ],
  '#wrapper_attributes' => [
    'class' => [
      'row',
    ],
  ],
  '#inner_wrapper_attributes' => [
    'class' => [
      'col-sm-10',
    ],
  ],
];

$form['layout_horizontal_description_before'] = [
  '#type' => 'email',
  '#title' => $this->t('Email'),
  '#title_display' => 'inline',
  '#description' => $this->t('Description'),
  '#description_display' => 'before',
  '#label_attributes' => [
    'class' => [
      'col-sm-2',
    ],
  ],
  '#wrapper_attributes' => [
    'class' => [
      'row',
    ],
  ],
  '#inner_wrapper_attributes' => [
    'class' => [
      'col-sm-10',
    ],
  ],
];
```

#### Horizontal form label sizing

https://getbootstrap.com/docs/5.2/forms/layout/#horizontal-form-label-sizing:

```php
$form['layout_horizontal_email_sizing_sm'] = [
  '#type' => 'email',
  '#title' => $this->t('Email'),
  '#title_display' => 'inline',
  '#attributes' => [
    'placeholder' => 'col-form-label-sm',
    'class' => [
      'form-control-sm',
    ],
  ],
  '#label_attributes' => [
    'class' => [
      'col-sm-2',
      'col-form-label-sm',
    ],
  ],
  '#wrapper_attributes' => [
    'class' => [
      'row',
    ],
  ],
  '#inner_wrapper_attributes' => [
    'class' => [
      'col-sm-10',
    ],
  ],
];

$form['layout_horizontal_email_sizing_normal'] = [
  '#type' => 'email',
  '#title' => $this->t('Email'),
  '#title_display' => 'inline',
  '#attributes' => [
    'placeholder' => 'col-form-label',
  ],
  '#label_attributes' => [
    'class' => [
      'col-sm-2',
    ],
  ],
  '#wrapper_attributes' => [
    'class' => [
      'row',
    ],
  ],
  '#inner_wrapper_attributes' => [
    'class' => [
      'col-sm-10',
    ],
  ],
];

$form['layout_horizontal_email_sizing_lg'] = [
  '#type' => 'email',
  '#title' => $this->t('Email'),
  '#title_display' => 'inline',
  '#attributes' => [
    'placeholder' => 'col-form-label-lg',
    'class' => [
      'form-control-lg',
    ],
  ],
  '#label_attributes' => [
    'class' => [
      'col-sm-2',
      'col-form-label-lg',
    ],
  ],
  '#wrapper_attributes' => [
    'class' => [
      'row',
    ],
  ],
  '#inner_wrapper_attributes' => [
    'class' => [
      'col-sm-10',
    ],
  ],
];
```

### Column sizing

https://getbootstrap.com/docs/5.2/forms/layout/#column-sizing.

To do in custom implementations.

See Gutters' example.

### Auto-sizing

https://getbootstrap.com/docs/5.2/forms/layout/#auto-sizing.

To do in custom implementations.

See Gutters' example.

### Inline forms

https://getbootstrap.com/docs/5.2/forms/layout/#inline-forms.

To do in custom implementations.

See Gutters' example.
