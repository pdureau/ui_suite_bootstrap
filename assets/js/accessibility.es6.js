((Drupal, once) => {
  Drupal.ui_suite_bootstrap_accessibility =
    Drupal.ui_suite_bootstrap_accessibility || {};

  Drupal.ui_suite_bootstrap_accessibility.pointer_elements = ["a", "input"];

  function preventClick(element) {
    if (
      Drupal.ui_suite_bootstrap_accessibility.pointer_elements.includes(
        element.tagName.toLowerCase()
      )
    ) {
      element.setAttribute("tabindex", "-1");
      element.setAttribute("aria-disabled", "true");
    } else {
      const children = Array.from(element.children);
      children.forEach((child) => {
        // Do not prevent click in the case of a clickable element inside a
        // non-clickable container.
        if (!child.classList.contains("pe-auto")) {
          preventClick(child);
        }
      });
    }
  }

  Drupal.behaviors.ui_suite_bootstrap_accessibility = {
    attach(context) {
      // https://getbootstrap.com/docs/5.2/utilities/interactions/#pointer-events.
      // Add aria-disabled and tabindex on clickable elements with the "pe-none"
      // class.
      const unclickableElements = once(
        "unclickable-element",
        ".pe-none",
        context
      );
      unclickableElements.forEach(preventClick);
    },
  };
})(Drupal, once);
