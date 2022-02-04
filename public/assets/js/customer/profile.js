$(function () {
  $("#updateProfilePictureButton").on('click', function() {
    $("#updateProfilePictureForm").submit();
  });

  $("#updatePasswordButton").on('click', function() {
    $("#updatePasswordForm").submit();
  });

  $("#updateProfilePictureForm input").jqBootstrapValidation({
      preventSubmit: true,
      submitError: function ($form, event, errors) {
      },
      submitSuccess: function ($form, event) {
          event.preventDefault();
          var formData = new FormData(document.getElementById("updateProfilePictureForm"));

          $this = $("#updateProfilePictureButton");
          $this.prop("disabled", true);

          $.ajax({
              url: baseUrl + "/customer/update-profile-picture",
              type: "POST",
              data:formData,
              cache:false,
              contentType: false,
              processData: false,
              success: function (res) {
                  console.log(res.data.data)
                  $('#success').html("<div class='alert alert-success'>");
                  $('#success > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                          .append("</button>");
                  $('#success > .alert-success')
                          .append("<strong>Upload Image Success. </strong>");
                  $('#success > .alert-success')
                          .append('</div>');
                  $('#updateProfilePictureForm').trigger("reset");
                  $("#profileImageUrl").attr('src',res.data.data);
              },
              error: function (res) {
                let message = "Sorry, it seems that our server is not responding. Please try again later!";
                  $('#success').html("<div class='alert alert-danger'>");
                  $('#success > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                          .append("</button>");
                  $('#success > .alert-danger').append($("<strong>").text(message));
                  $('#success > .alert-danger').append('</div>');
                  $('#updateProfilePictureForm').trigger("reset");
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

  $("#updatePasswordForm input").jqBootstrapValidation({
    preventSubmit: true,
    submitError: function ($form, event, errors) {
    },
    submitSuccess: function ($form, event) {
        event.preventDefault();
        var password = $("input#password").val();

        $this = $("#updatePasswordButton");
        $this.prop("disabled", true);

        $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: baseUrl + "/customer/change-password",
            type: "PUT",
            data: {
              password: password,
          },
            cache:false,
            success: function (res) {
                $('#success_change_password').html("<div class='alert alert-success'>");
                $('#success_change_password > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                        .append("</button>");
                $('#success_change_password > .alert-success')
                        .append("<strong>Change password is Success. </strong>");
                $('#success_change_password > .alert-success')
                        .append('</div>');
                $('#updatePasswordForm').trigger("reset");
            },
            error: function (res) {
              let message = "Sorry, it seems that our server is not responding. Please try again later!";
              if (res.status === 422) {
                  var error = res.responseJSON.errors;
                  message = error.join(' ');
              }
                $('#success_change_password').html("<div class='alert alert-danger'>");
                $('#success_change_password > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                        .append("</button>");
                $('#success_change_password > .alert-danger').append($("<strong>").text(message));
                $('#success_change_password > .alert-danger').append('</div>');
                $('#updatePasswordForm').trigger("reset");
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