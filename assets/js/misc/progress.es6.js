/**
 * @file
 * Extends methods from core/misc/progress.js.
 */

(($, Drupal) => {
  /**
   * Theme function for the progress bar.
   *
   * @param {string} id
   *   The HTML ID of the progress bar.
   *
   * @return {string}
   *   The HTML for the progress bar.
   */
  Drupal.theme.progressBar = (id) => {
    // @todo use the pattern progress directly if possible in JS.
    return (
      `<div class="progress-wrapper" aria-live="polite">` +
      `<div class="progress__label"></div>` +
      `<div id="${id}" class="progress">` +
      `<div class="progress-bar-striped progress-bar-animated progress-bar" role="progressbar" aria-label="${Drupal.t(
        "Progress bar"
      )}" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">` +
      `</div>` +
      `</div>` +
      `<div class="progress__description"></div>` +
      `</div>`
    );
  };

  $.extend(
    Drupal.ProgressBar.prototype,
    /** @lends Drupal.ProgressBar */ {
      /**
       * Set the percentage and status message for the progressbar.
       *
       * @param {number} percentage
       *   The progression percentage.
       * @param {string} message
       *   The progression message.
       * @param {string} label
       *   The progress bar label.
       */
      setProgress(percentage, message, label) {
        if (percentage >= 0 && percentage <= 100) {
          $(this.element)
            .find(".progress-bar")
            .css("width", `${percentage}%`)
            .attr("aria-valuenow", percentage)
            .html(`${percentage}%`);
        }
        if (message) {
          // Remove the unnecessary whitespace at the end of the message.
          message = message.replace(/<br\/>&nbsp;|\s*$/, "");

          $(".progress__description", this.element).html(message);
        }
        if (label) {
          $(".progress__label", this.element).html(label);
        }
        if (this.updateCallback) {
          this.updateCallback(percentage, message, this);
        }
      },

      /**
       * Display errors on the page.
       *
       * @param {string} string
       *   The error message. In a 'pre' tag.
       */
      displayError(string) {
        // @todo use the pattern alert directly if possible in JS.
        const newError = $(
          `<div class="alert-danger alert-dismissible fade show alert">` +
            `<h4 class="alert-heading">${Drupal.t(
              "Error message"
            )}</h4>${string}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="${Drupal.t(
              "Close"
            )}"></button>` +
            `</div>`
        );
        $(this.element).before(newError).hide();

        if (this.errorCallback) {
          this.errorCallback(this);
        }
      },
    }
  );
})(jQuery, Drupal);
