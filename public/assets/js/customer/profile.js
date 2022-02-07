$(function () {
  $("#updateProfilePictureButton").on('click', function() {
    $("#updateProfilePictureForm").submit();
  });

  $("#updatePasswordButton").on('click', function() {
    $("#updatePasswordForm").submit();
  });

  $("#updateProfiledButton").on('click', function() {
    $("#updateProfileForm").submit();
  });

  $("#updateContactButton").on('click', function() {
    $("#updateContactForm").submit();
  });

  $('.datepicker').datepicker({
    uiLibrary: 'bootstrap4',
    format: 'dddd, d mmmm yyyy'
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

  $("#updateProfileForm input").jqBootstrapValidation({
    preventSubmit: true,
    submitError: function ($form, event, errors) {
    },
    submitSuccess: function ($form, event) {
        event.preventDefault();
        var first_name = $("input#first_name").val();
        var last_name = $("input#last_name").val();
        var birth_date = $("input#birth_date").val();
        var gender = $("input[name=gender]:checked").val();

        $this = $("#updateProfiledButton");
        $this.prop("disabled", true);

        $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: baseUrl + "/customer/update-profile",
            type: "PUT",
            data: {
              first_name: first_name,
              last_name: last_name,
              birth_date: birth_date,
              gender: gender
          },
            cache:false,
            success: function (res) {
                $('#success_change_profile').html("<div class='alert alert-success'>");
                $('#success_change_profile > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                        .append("</button>");
                $('#success_change_profile > .alert-success')
                        .append("<strong>update profile is Success. </strong>");
                $('#success_change_profile > .alert-success')
                        .append('</div>');
                // $('#updateProfileForm').trigger("reset");
                $(".txt-name").text(first_name + ' ' + last_name);
                $(".txt-gender").text(gender);
                $(".txt-birth-date").text(birth_date);
            },
            error: function (res) {
              let message = "Sorry, it seems that our server is not responding. Please try again later!";
              if (res.status === 422) {
                  var error = res.responseJSON.errors;
                  message = error.join(' ');
              }
                $('#success_change_profile').html("<div class='alert alert-danger'>");
                $('#success_change_profile > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                        .append("</button>");
                $('#success_change_profile > .alert-danger').append($("<strong>").text(message));
                $('#success_change_profile > .alert-danger').append('</div>');
                // $('#updateProfileForm').trigger("reset");
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

  $("#updateContactForm input").jqBootstrapValidation({
    preventSubmit: true,
    submitError: function ($form, event, errors) {
    },
    submitSuccess: function ($form, event) {
        event.preventDefault();
        var phone_number = $("input#phone_number").val();

        $this = $("#updateContactButton");
        $this.prop("disabled", true);

        $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: baseUrl + "/customer/update-contact",
            type: "PUT",
            data: {
              phone_number: phone_number,
          },
            cache:false,
            success: function (res) {
                $('#success_change_contact').html("<div class='alert alert-success'>");
                $('#success_change_contact > .alert-success').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                        .append("</button>");
                $('#success_change_contact > .alert-success')
                        .append("<strong>Change contact is Success. </strong>");
                $('#success_change_contact > .alert-success')
                        .append('</div>');
                
                $(".txt-phone-number").text(phone_number);
            },
            error: function (res) {
              let message = "Sorry, it seems that our server is not responding. Please try again later!";
              if (res.status === 422) {
                  var error = res.responseJSON.errors;
                  message = error.join(' ');
              }
                $('#success_change_contact').html("<div class='alert alert-danger'>");
                $('#success_change_contact > .alert-danger').html("<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;")
                        .append("</button>");
                $('#success_change_contact > .alert-danger').append($("<strong>").text(message));
                $('#success_change_contact > .alert-danger').append('</div>');
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

function dateToDateTime(