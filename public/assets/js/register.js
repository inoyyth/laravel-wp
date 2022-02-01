$(function () {

  $("#registerForm input").jqBootstrapValidation({
      preventSubmit: true,
      submitError: function ($form, event, errors) {
      },
      submitSuccess: function ($form, event) {
          event.preventDefault();
          var password = $("input#password").val();
          var email = $("input#email").val();
          var first_name = $("input#first_name").val();
          var last_name = $("input#last_name").val();
          var username = $("input#email").val();

          $this = $("#registerButton");
          $this.prop("disabled", true);

          $.ajax({
              url: baseUrl + "/register",
              type: "POST",
              data: {
                  username: username,
                  email: email,
                  password: password,
                  first_name: first_name,
                  last_name: last_name,
                  _token: $('meta[name="csrf-token"]').attr('content'),
              },
              cache: false,
              success: function () {
                  $('#success').html("<div class='alert alert-success'>");
                  $('#success > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                          .append("</button>");
                  $('#success > .alert-success')
                          .append("<strong>Register Success, Please login. </strong>");
                  $('#success > .alert-success')
                          .append('</div>');
                  $('#registerButton').trigger("reset");
                //   window.location.replace(baseUrl);
              },
              error: function (res) {
                  console.log(res);
                let message = "Sorry, it seems that our server is not responding. Please try again later!";
                  if (res.status === 422) {
                      var error = res.responseJSON.errors;
                      message = error.join(' ');
                  }
                  if (res.status === 500) {
                    var error = res.responseJSON.message;
                    if (error.code === "existing_user_login") {
                        message = 'Sorry, that username already exists';
                    }
                  }

                  $('#success').html("<div class='alert alert-danger'>");
                  $('#success > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                          .append("</button>");
                  $('#success > .alert-danger').append($("<strong>").text(message));
                  $('#success > .alert-danger').append('</div>');
                  $('#registerButton').trigger("reset");
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