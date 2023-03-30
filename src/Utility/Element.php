<?php

declare(strict_types = 1);

namespace Drupal\ui_suite_bootstrap\Utility;

use Drupal\Component\Render\FormattableMarkup;
use Drupal\Component\Render\MarkupInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Element as CoreElement;

/**
 * Provides helper methods for Drupal render elements.
 *
 * @see \Drupal\Core\Render\Element
 */
class Element extends DrupalAttributes {

  /**
   * The current state of the form.
   *
   * @var \Drupal\Core\Form\FormStateInterface|null
   */
  protected $formState;

  /**
   * {@inheritdoc}
   */
  protected $attributePrefix = '#';

  /**
   * Element constructor.
   *
   * @param array|string $element
   *   A render array element.
   * @param \Drupal\Core\Form\FormStateInterface|null $form_state
   *   The current state of the form.
   */
  public function __construct(&$element = [], ?FormStateInterface $form_state = NULL) {
    if (!\is_array($element)) {
      $element = [
        '#markup' => $element instanceof MarkupInterface ? $element : new FormattableMarkup($element, []),
      ];
    }
    $this->array = &$element;
    $this->formState = $form_state;
  }

  /**
   * Magic get method.
   *
   * This is only for child elements, not properties.
   *
   * @param string $key
   *   The name of the child element to retrieve.
   *
   * @throws \InvalidArgumentException
   *   Throws this error when the name is a property (key starting with #).
   *
   * @return \Drupal\ui_suite_bootstrap\Utility\Element
   *   The child element object.
   */
  public function &__get($key) {
    if (CoreElement::property($key)) {
      throw new \InvalidArgumentException('Cannot dynamically retrieve element property. Please use  \Drupal\ui_suite_bootstrap\Utility\Element::getProperty instead.');
    }
    $instance = new self($this->offsetGet($key, []), $this->formState);
    return $instance;
  }

  /**
   * Magic set method.
   *
   * This is only for child elements, not properties.
   *
   * @param string $key
   *   The name of the child element to set.
   * @param mixed $value
   *   The value of $name to set.
   *
   * @throws \InvalidArgumentException
   *   Throws this error when the name is a property (key starting with #).
   */
  public function __set($key, $value) {
    if (CoreElement::property($key)) {
      throw new \InvalidArgumentException('Cannot dynamically retrieve element property. Use  \Drupal\ui_suite_bootstrap\Utility\Element::setProperty instead.');
    }
    $this->offsetSet($key, $value instanceof Element ? $value->getArray() : $value);
  }

  /**
   * Magic isset method.
   *
   * This is only for child elements, not properties.
   *
   * @param string $name
   *   The name of the child element to check.
   *
   * @throws \InvalidArgumentException
   *   Throws this error when the name is a property (key starting with #).
   *
   * @return bool
   *   TRUE or FALSE
   */
  public function __isset($name) {
    if (CoreElement::property($name)) {
      throw new \InvalidArgumentException('Cannot dynamically check if an element has a property. Use  \Drupal\ui_suite_bootstrap\Utility\Element::unsetProperty instead.');
    }
    return parent::__isset($name);
  }

  /**
   * Magic unset method.
   *
   * This is only for child elements, not properties.
   *
   * @param mixed $name
   *   The name of the child element to unset.
   *
   * @throws \InvalidArgumentException
   *   Throws this error when the name is a property (key starting with #).
   */
  public function __unset($name) {
    if (CoreElement::property($name)) {
      throw new \InvalidArgumentException('Cannot dynamically unset an element property. Use  \Drupal\ui_suite_bootstrap\Utility\Element::hasProperty instead.');
    }
    parent::__unset($name);
  }

  /**
   * Sets the #access property on an element.
   *
   * @param bool|\Drupal\Core\Access\AccessResultInterface $access
   *   The value to assign to #access.
   *
   * @return static
   */
  public function access($access = NULL) {
    return $this->setProperty('access', $access);
  }

  /**
   * Appends a property with a value.
   *
   * @param string $name
   *   The name of the property to set.
   * @param mixed $value
   *   The value of the property to set.
   *
   * @return static
   */
  public function appendProperty($name, $value) {
    $property = &$this->getProperty($name);
    $value = $value instanceof Element ? $value->getArray() : $value;

    // If property isn't set, just set it.
    if (!isset($property)) {
      $property = $value;
      return $this;
    }

    if (\is_array($property)) {
      $property[] = Element::create($value)->getArray();
    }
    else {
      $property .= (string) $value;
    }

    return $this;
  }

  /**
   * Identifies the children of an element array, optionally sorted by weight.
   *
   * The children of a element array are those key/value pairs whose key does
   * not start with a '#'. See drupal_render() for details.
   *
   * @param bool $sort
   *   Boolean to indicate whether the children should be sorted by weight.
   *
   * @return array
   *   The array keys of the element's children.
   *
   * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
   */
  public function childKeys($sort = FALSE) {
    return CoreElement::children($this->array, $sort);
  }

  /**
   * Retrieves the children of an element array, optionally sorted by weight.
   *
   * The children of a element array are those key/value pairs whose key does
   * not start with a '#'. See drupal_render() for details.
   *
   * @param bool $sort
   *   Boolean to indicate whether the children should be sorted by weight.
   *
   * @return \Drupal\ui_suite_bootstrap\Utility\Element[]
   *   An array child elements.
   *
   * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
   */
  public function children($sort = FALSE) {
    $children = [];
    foreach ($this->childKeys($sort) as $child) {
      $children[$child] = new self($this->array[$child]);
    }
    return $children;
  }

  /**
   * Adds a specific Bootstrap class to color a button based on its text value.
   *
   * @param bool $override
   *   Flag determining whether or not to override any existing set class.
   *
   * @return static
   *
   * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
   */
  public function colorize($override = TRUE) {
    $button = $this->isButton();

    // @todo Be able to use for other stuff than button.
    $prefix = $button ? 'btn' : 'has';

    // List of classes, based on the prefix.
    $classes = [
      "{$prefix}-primary",
      "{$prefix}-secondary",
      "{$prefix}-success",
      "{$prefix}-danger",
      "{$prefix}-warning",
      "{$prefix}-info",
      "{$prefix}-light",
      "{$prefix}-dark",
      "{$prefix}-link",
      "{$prefix}-outline-primary",
      "{$prefix}-outline-secondary",
      "{$prefix}-outline-success",
      "{$prefix}-outline-danger",
      "{$prefix}-outline-warning",
      "{$prefix}-outline-info",
      "{$prefix}-outline-light",
      "{$prefix}-outline-link",
      // Default should be last.
      "{$prefix}-outline-dark",
    ];

    // Set the class to "btn-outline-dark" if it shouldn't be colorized.
    $class = FALSE;

    // Search for an existing class.
    if (!$class || !$override) {
      foreach ($classes as $value) {
        if ($this->hasClass($value)) {
          $class = $value;
          break;
        }
      }
    }

    // Find a class based on the value of "value", "title" or "button_type".
    if (!$class) {
      $value = $this->getProperty('value', $this->getProperty('title', ''));
      $class = "{$prefix}-" . Bootstrap::cssClassFromString($value, $button ? $this->getProperty('button_type', 'outline-dark') : 'outline-dark');
    }

    // Remove any existing classes and add the specified class.
    if ($class) {
      $this->removeClass($classes)->addClass($class);
      if ($button && $this->getProperty('split')) {
        $this->removeClass($classes, $this::SPLIT_BUTTON)->addClass($class, $this::SPLIT_BUTTON);
      }
    }

    return $this;
  }

  /**
   * Creates a new \Drupal\ui_suite_bootstrap\Utility\Element instance.
   *
   * @param array|string $element
   *   A render array element or a string.
   * @param \Drupal\Core\Form\FormStateInterface|null $form_state
   *   A current FormState instance, if any.
   *
   * @return \Drupal\ui_suite_bootstrap\Utility\Element
   *   The newly created element instance.
   */
  public static function create(&$element = [], ?FormStateInterface $form_state = NULL) {
    return $element instanceof self ? $element : new self($element, $form_state);
  }

  /**
   * Traverses the element to find the closest button.
   *
   * @return \Drupal\ui_suite_bootstrap\Utility\Element|false
   *   The first button element or FALSE if no button could be found.
   */
  public function &findButton() {
    $button = FALSE;
    foreach ($this->children() as $child) {
      if ($child->isButton()) {
        $button = $child;
        break;
      }
      $result = &$child->findButton();
      if ($result) {
        $button = $result;
        break;
      }
    }
    return $button;
  }

  /**
   * Retrieves the render array for the element.
   *
   * @return array
   *   The element render array, passed by reference.
   */
  public function &getArray() {
    return $this->array;
  }

  /**
   * Retrieves a context value from the #context element property, if any.
   *
   * @param string $name
   *   The name of the context key to retrieve.
   * @param mixed $default
   *   Optional. The default value to use if the context $name isn't set.
   *
   * @return mixed|null
   *   The context value or the $default value if not set.
   */
  public function &getContext($name, $default = NULL) {
    $context = &$this->getProperty('context', []);
    if (!isset($context[$name])) {
      $context[$name] = $default;
    }
    return $context[$name];
  }

  /**
   * Returns the error message filed against the given form element.
   *
   * Form errors higher up in the form structure override deeper errors as well
   * as errors on the element itself.
   *
   * @throws \BadMethodCallException
   *   When the element instance was not constructed with a valid form state
   *   object.
   *
   * @return string|null
   *   Either the error message for this element or NULL if there are no errors.
   */
  public function getError() {
    if (!$this->formState) {
      throw new \BadMethodCallException('The element instance must be constructed with a valid form state object to use this method.');
    }
    return $this->formState->getError($this->array);
  }

  /**
   * Retrieves the render array for the element.
   *
   * @param string $name
   *   The name of the element property to retrieve, not including the # prefix.
   * @param mixed $default
   *   The default to set if property does not exist.
   *
   * @return mixed
   *   The property value, NULL if not set.
   */
  public function &getProperty($name, $default = NULL) {
    return $this->offsetGet("#{$name}", $default);
  }

  /**
   * Returns the visible children of an element.
   *
   * @return array
   *   The array keys of the element's visible children.
   */
  public function getVisibleChildren() {
    return CoreElement::getVisibleChildren($this->array);
  }

  /**
   * Indicates whether the element has an error set.
   *
   * @throws \BadMethodCallException
   *   When the element instance was not constructed with a valid form state
   *   object.
   *
   * @return bool
   *   TRUE if has error.
   */
  public function hasError(): bool {
    $error = $this->getError();
    return isset($error);
  }

  /**
   * Indicates whether the element has a specific property.
   *
   * @param string $name
   *   The property to check.
   *
   * @return bool
   *   TRUE if has property.
   */
  public function hasProperty($name): bool {
    return $this->offsetExists("#{$name}");
  }

  /**
   * Indicates whether the element is a button.
   *
   * @return bool
   *   TRUE or FALSE.
   */
  public function isButton() {
    $button_types = ['button', 'submit', 'reset', 'image_button'];
    return !empty($this->array['#is_button']) || $this->isType($button_types) || $this->hasClass('btn');
  }

  /**
   * Indicates whether the given element is empty.
   *
   * An element that only has #cache set is considered empty, because it will
   * render to the empty string.
   *
   * @return bool
   *   Whether the given element is empty.
   */
  public function isEmpty() {
    return CoreElement::isEmpty($this->array);
  }

  /**
   * Indicates whether a property on the element is empty.
   *
   * @param string $name
   *   The property to check.
   *
   * @return bool
   *   Whether the given property on the element is empty.
   */
  public function isPropertyEmpty($name) {
    return $this->hasProperty($name) && empty($this->getProperty($name));
  }

  /**
   * Checks if a value is a render array.
   *
   * @param mixed $value
   *   The value to check.
   *
   * @return bool
   *   TRUE if the given value is a render array, otherwise FALSE.
   */
  public static function isRenderArray($value) {
    return \is_array($value) && (isset($value['#type'])
      || isset($value['#theme']) || isset($value['#theme_wrappers'])
      || isset($value['#markup']) || isset($value['#attached'])
      || isset($value['#cache']) || isset($value['#lazy_builder'])
      || isset($value['#create_placeholder']) || isset($value['#pre_render'])
      || isset($value['#post_render']) || isset($value['#process']));
  }

  /**
   * Checks if the element is a specific type of element.
   *
   * @param string|array $type
   *   The element type(s) to check.
   *
   * @return bool
   *   TRUE if element is or one of $type.
   */
  public function isType($type) {
    $property = $this->getProperty('type');
    return $property && \in_array($property, (\is_array($type) ? $type : [$type]), TRUE);
  }

  /**
   * Determines if an element is visible.
   *
   * @return bool
   *   TRUE if the element is visible, otherwise FALSE.
   */
  public function isVisible() {
    return CoreElement::isVisibleElement($this->array);
  }

  /**
   * Maps an element's properties to its attributes array.
   *
   * @param array $map
   *   An associative array whose keys are element property names and whose
   *   values are the HTML attribute names to set on the corresponding
   *   property; e.g., array('#property_name' => 'attribute_name'). If both
   *   names are identical except for the leading '#', then an attribute name
   *   value is sufficient and no property name needs to be specified.
   *
   * @return static
   */
  public function map(array $map) {
    CoreElement::setAttributes($this->array, $map);
    return $this;
  }

  /**
   * Prepends a property with a value.
   *
   * @param string $name
   *   The name of the property to set.
   * @param mixed $value
   *   The value of the property to set.
   *
   * @return static
   */
  public function prependProperty($name, $value) {
    $property = &$this->getProperty($name);
    $value = $value instanceof Element ? $value->getArray() : $value;

    // If property isn't set, just set it.
    if (!isset($property)) {
      $property = $value;
      return $this;
    }

    if (\is_array($property)) {
      \array_unshift($property, Element::create($value)->getArray());
    }
    else {
      $property = (string) $value . (string) $property;
    }

    return $this;
  }

  /**
   * Gets properties of a structured array element (keys beginning with '#').
   *
   * @return array
   *   An array of property keys for the element.
   */
  public function properties() {
    return CoreElement::properties($this->array);
  }

  /**
   * Renders the final element HTML.
   *
   * @return \Drupal\Component\Render\MarkupInterface
   *   The rendered HTML.
   */
  public function render() {
    /** @var \Drupal\Core\Render\Renderer $renderer */
    $renderer = \Drupal::service('renderer');
    return $renderer->render($this->array);
  }

  /**
   * Renders the final element HTML.
   *
   * @return \Drupal\Component\Render\MarkupInterface
   *   The rendered HTML.
   */
  public function renderPlain() {
    /** @var \Drupal\Core\Render\Renderer $renderer */
    $renderer = \Drupal::service('renderer');
    return $renderer->renderPlain($this->array);
  }

  /**
   * Renders the final element HTML.
   *
   * (Cannot be executed within another render context.)
   *
   * @return \Drupal\Component\Render\MarkupInterface
   *   The rendered HTML.
   */
  public function renderRoot() {
    /** @var \Drupal\Core\Render\Renderer $renderer */
    $renderer = \Drupal::service('renderer');
    return $renderer->renderRoot($this->array);
  }

  /**
   * Sets the current form state for the element.
   *
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   Optional. The current state of the form.
   *
   * @return static
   */
  public function setFormState(FormStateInterface $form_state) {
    $this->formState = $form_state;
    return $this;
  }

  /**
   * Sets the value for a property.
   *
   * @param string $name
   *   The name of the property to set.
   * @param mixed $value
   *   The value of the property to set.
   * @param bool $recurse
   *   Flag indicating wither to set the same property on child elements.
   *
   * @return static
   *
   * @SuppressWarnings(PHPMD.BooleanArgumentFlag)
   */
  public function setProperty($name, $value, $recurse = FALSE) {
    $this->array["#{$name}"] = $value instanceof Element ? $value->getArray() : $value;
    if ($recurse) {
      foreach ($this->children() as $child) {
        $child->setProperty($name, $value, $recurse);
      }
    }
    return $this;
  }

  /**
   * Removes a property from the element.
   *
   * @param string $name
   *   The name of the property to unset.
   *
   * @return static
   */
  public function unsetProperty($name) {
    unset($this->array["#{$name}"]);
    return $this;
  }

}
