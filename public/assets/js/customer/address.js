$(function () {
  // $(".main_address_checkbox").on('change', function() {
  //   var id = $(this).attr('id');
  //   console.log(console.log(id));
  // });

  
});

function updateDefaultAddress(id, dataLength) {
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: baseUrl + "/customer/set-default-address",
    type: "PUT",
    data: {
      id: id,
      data_length: dataLength,
    },
    cache:false,
    success: function (res) {
      $(".main_address_checkbox").prop("disabled", false);
      $('.main_address_checkbox').prop('checked', false);
      $("#main-address-" + id).prop("disabled", true);
      $("#main-address-" + id).prop("checked", true);
      $(".main-address-title").text('');
      $("#main-address-title-" + id).text('(Main Address)');
  
    },
    error: function (res) {
      alert("Sorry, it seems that our server is not responding. Please try again later!");
    }
  });
}