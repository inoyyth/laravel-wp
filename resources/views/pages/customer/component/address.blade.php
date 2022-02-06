<div class="row">
  <div class="col-lg-7 col-sm-12">
    @foreach ($user->acf->customer_shipping_address as $k=>$item)
    <div class="card mb-3">
      <div class="card-header">
        <div class="d-flex justify-content-between">
          <h6 class="mb-0">{{ Str::title($item->customer_shipping_address_title)}} 
            <span class='font-italic main-address-title' id="main-address-title-{{$k}}">
              {{ $item->customer_shipping_address_is_main_address ? '(Main Address)' : '' }}
            </span>
          </h6>
          <button class="btn btn-warning btn-sm" id="editProfiletBtn" data-toggle="modal" data-target="#changeProfileModal">Edit</button>
        </div>
      </div>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-11">
              <dl class="row mb-0">
                <dt class="col-sm-4 font-weight-normal">Name</dt>
                <dd class="col-sm-8 font-italic text-capitalize"> {{ Str::title($item->customer_shipping_address_first_name . ' ' . $item->customer_shipping_address_last_name) }}</dd>
                <dt class="col-sm-4 font-weight-normal">Phone</dt>
                <dd class="col-sm-8 font-italic">{{ $item->customer_shipping_address_phone}}</dd>
                <dt class="col-sm-4 font-weight-normal">Addres Line 1</dt>
                <dd class="col-sm-8 font-italic text-capitalize text-truncate">{{ $item->customer_shipping_address_address_line_1 }}</dd>
                <dt class="col-sm-4 font-weight-normal">Addres Line 1</dt>
                <dd class="col-sm-8 font-italic text-capitalize text-truncate">{{ $item->customer_shipping_address_address_line_2 }}</dd>
              </dl>
            </div>
            <div class="col-lg-1 d-flex align-items-center">
              <input type="checkbox" class="form-control-lg align-self-center main_address_checkbox" onchange="updateDefaultAddress({{$k}},{{count($user->acf->customer_shipping_address)}})" {{ $item->customer_shipping_address_is_main_address ? 'checked disabled' : '' }} id="main-address-{{$k}}">
            </div>
          </div>
        </div>
    </div>
    @endforeach
  </div>
</div>

<!-- Modal update password-->
<div class="modal fade" id="changePasswordeModal" tabindex="-1" role="dialog" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="success_change_password"></div>
        <form name="updatePasswordForm" id="updatePasswordForm" novalidate="novalidate">
          <div class="control-group">
              <input type="password" class="form-control" name="password" id="password" placeholder="Your New Password"
                  required="required" data-validation-required-message="Please enter your password" />
              <p class="help-block text-danger"></p>
          </div>
          <div class="control-group">
            <input type="password" class="form-control" name="cpassword" id="cpassword" placeholder="Retype Password"
                data-validation-match-match="password" 
                data-validation-match-message="Password not match" 
                data-validation-match-match
                required="required" data-validation-required-message="Please retype your password" />
            <p class="help-block text-danger"></p>
        </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="updatePasswordButton">Save changes</button>
      </div>
    </div>
  </div>
</div>

@push('script')
<script src="{{ asset('assets/js/customer/address.js')}}"></script>
@endpush
