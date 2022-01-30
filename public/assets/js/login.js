$(function () {

  $("#loginForm input").jqBootstrapValidation({
      preventSubmit: true,
      submitError: function ($form, event, errors) {
      },
      submitSuccess: function ($form, event) {
          event.preventDefault();
          var password = $("input#password").val();
          var email = $("input#email").val();

          $this = $("#loginButton");
          $this.prop("disabled", true);

          $.ajax({
              url: baseUrl + "/login",
              type: "POST",
              data: {
                  email: email,
                  password: password,
                  _token: $('meta[name="csrf-token"]').attr('content'),
              },
              cache: false,
              success: function () {
                  $('#success').html("<div class='alert alert-success'>");
                  $('#success > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                          .append("</button>");
                  $('#success > .alert-success')
                          .append("<strong>Login Success. </strong>");
                  $('#success > .alert-success')
                          .append('</div>');
                  $('#loginForm').trigger("reset");
                  window.location.replace(baseUrl);
              },
              error: function (res) {
                let message = "Sorry, it seems that our server is not responding. Please try again later!";
                  if (res.status === 403) {
                    message = "email or password is wrong"
                  }
                  $('#success').html("<div class='alert alert-danger'>");
                  $('#success > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                          .append("</button>");
                  $('#success > .alert-danger').append($("<strong>").text(message));
                  $('#success > .alert-danger').append('</div>');
                  $('#loginForm').trigger("reset");
              },
              complete: function () {
                  setTimeout(function () {
                      $this.prop("disabled", false);
                  }, 1000);
              }
          });
      },
      filter: function () {
          return $(this).is(":visible");
      },
  });

});