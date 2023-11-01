/**
 * @author Peter Mwambi <calebmwambi@gmail.com>
 * @date Fri Oct 13 2023 00:11:47 GMT+0300 (East Africa Time)
 * @version miracle v1.2.0
 * @abstract This script handles all form handler methods
 * @requires JQuery v3.5.0 and above
 */

const forms = [
  "client-registration-form",
  "client-login-form",
  "admin-registration-form",
];

const formHandlers = {
  spinner: $(".form-spinner"),
  messageBody: $(".alert"),
  message: $(".alert-message"),
  controlMessage: $(".control-message"),
  button: $("button[type='submit']"),
};

localStorage.setItem(
  "default-control-message",
  formHandlers.controlMessage.html()
);

localStorage.setItem("default-button-message", formHandlers.button.html());

function runQuery(formName) {
  let form = $("#" + formName);
  $(form).submit(function (e) {
    e.preventDefault();
    formHandlers.spinner.removeClass("d-none");
    formHandlers.controlMessage.html("Please Wait...");
    formHandlers.button.attr("disabled", "disabled");
    formHandlers.button.html("Please wait...");
    setTimeout(() => {
      $.ajax({
        type: "post",
        url: formName,
        data: new FormData(this),
        dataType: "json",
        contentType: false,
        cache: false,
        processData: false,
        error: (response) => {
          let json = response.responseJSON;
          if (formHandlers.messageBody.hasClass("d-none")) {
            formHandlers.messageBody.removeClass("d-none");
          }
          formHandlers.controlMessage.html(
            localStorage.getItem("default-control-message")
          );
          formHandlers.messageBody.removeClass("d-none");
          formHandlers.spinner.addClass("d-none");
          formHandlers.message.html(json.message);

          setTimeout(function () {
            formHandlers.messageBody.addClass("d-none");
            formHandlers.button.removeAttr("disabled");
            formHandlers.button.html(
              localStorage.getItem("default-button-message")
            );
          }, 4000);
        },
        success: (response) => {},
      });
    }, 3000);
  });
}

forms.forEach(runQuery);
