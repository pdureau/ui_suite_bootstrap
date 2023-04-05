/**
 * @file
 * Use jquery-validation methods for form validation.
 */

(($, Drupal) => {
  Drupal.behaviors.ui_suite_bootstrap_jquery_validate = {
    attach() {
      // check if validator exists, if not, do nothing.
      if ($.validator === undefined) {
        return;
      }

      const elementErrorClass = "is-invalid";
      const elementValidClass = "is-valid";
      // @todo add option to choose between feedback and tooltip.
      // Tooltip will require to add position-relative class on the wrapper div.
      const messageErrorClass = "invalid-feedback";
      const messageValidClass = "valid-feedback";
      const inputGroupClass = "has-validation";

      // Set default css classes for element (input, normally)
      // and the label created after to display the error.
      $("form").validate({
        errorElement: "div",
        // Default behavior is to add the same classes to both the element and
        // the error message.
        // Use errorClass and validClass for the class on the error message.
        errorClass: messageErrorClass,
        validClass: messageValidClass,
        // Use highlight and unhighlight methods to add different classes
        // to the element.
        highlight(element) {
          $(element).addClass(elementErrorClass).removeClass(elementValidClass);

          // Input group.
          $(element).parent(".input-group").addClass(inputGroupClass);
          $(element)
            .parent(".form-floating")
            .parent(".input-group")
            .addClass(inputGroupClass);

          // Form floating.
          $(element)
            .parent(".form-floating")
            .addClass(elementErrorClass)
            .removeClass(elementValidClass);
        },
        unhighlight(element) {
          $(element).removeClass(elementErrorClass).addClass(elementValidClass);

          // Input group.
          $(element).parent(".input-group").addClass(inputGroupClass);
          $(element)
            .parent(".form-floating")
            .parent(".input-group")
            .addClass(inputGroupClass);

          // Form floating.
          $(element)
            .parent(".form-floating")
            .removeClass(elementErrorClass)
            .addClass(elementValidClass);
        },
        errorPlacement(error, element) {
          // If the element is in an input group, place the error message as
          // last children of the input group.
          if (element.parents(".input-group").length) {
            element.closest(".input-group").append(error);
          }
          // If the element is a checkbox or a radio, place the error message
          // after the label.
          else if (
            element.parents(".form-check").length &&
            element.closest(".form-check").find(".form-check-label").length
          ) {
            element
              .closest(".form-check")
              .find(".form-check-label")
              .after(error);
          }
          // If the element is not in an input group or checkbox/radio, place
          // the error message directly after the input.
          else {
            error.insertAfter(element);
          }
        },
      });
    },
  };
})(jQuery, Drupal);
