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
          <button class="btn btn-warning btn-sm" id="editProfiletBtn" data-toggle="modal" data-target="#changeAddresseModal">Edit</button>
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

<!-- Modal update address-->
<div class="modal fade" id="changeAddresseModal" tabindex="-1" role="dialog" aria-labelledby="changeAddressModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Address</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="success_change_password"></div>
        <form name="updatePasswordForm" id="updatePasswordForm" novalidate="novalidate">
          <div class="control-group">
            <label for="name">Address Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Your Address Name"
                required="required" data-validation-required-message="Please enter your address name" />
            <p class="help-block text-danger"></p>
          </div>
          <div class="form-row">
            <div class="control-group col-lg-6">
                <label for="first_name">First Name</label>
                <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Your First Name"
                    required="required" data-validation-required-message="Please enter your first name" />
                <p class="help-block text-danger"></p>
            </div>
            <div class="control-group col-lg-6">
              <label for="last_name">Last Name</label>
              <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Your Last Name"
                  required="required" data-validation-required-message="Please enter your last name" />
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="form-row">
            <div class="control-group col-lg-6">
                <label for="company">Company</label>
                <input type="text" class="form-control" name="company" id="company" placeholder="Your Company"
                    required="required" data-validation-required-message="Please enter your company" />
                <p class="help-block text-danger"></p>
            </div>
            <div class="control-group col-lg-6">
              <label for="email">Email</label>
              <input type="email" class="form-control" name="email" id="email" placeholder="Your Email"
                  required="required" data-validation-required-message="Please enter your email" />
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="control-group">
            <label for="address_line_1">Address Line 1</label>
            <input type="text" class="form-control" name="address_line_1" id="address_line_1" placeholder="Your Address Line 1"
                required="required" data-validation-required-message="Please enter your address line 1" />
            <p class="help-block text-danger"></p>
          </div>
          <div class="control-group">
            <label for="address_line_2">Address Line 2</label>
            <input type="text" class="form-control" name="address_line_2" id="address_line_2" placeholder="Your Address Line 2"
                required="required" data-validation-required-message="Please enter your address line 2" />
            <p class="help-block text-danger"></p>
          </div>
          <div class="control-group">
            <label for="phone">Phone</label>
            <input type="text" class="form-control" name="phone" id="phone" placeholder="Your Phone Number"
                required="required" data-validation-required-message="Please enter your phone number" />
            <p class="help-block text-danger"></p>
          </div>
          <div class="form-row">
            <div class="control-group col-lg-6">
                <label for="province">Province</label>
                <select class="form-control" name="province" id="province" placeholder="Your Province"
                    required="required" data-validation-required-message="Please select your province">
                  <option value="">Select Province</option>
                </select>
                <p class="help-block text-danger"></p>
            </div>
            <div class="control-group col-lg-6">
              <label for="city">City</label>
              <select class="form-control" name="city" id="city" placeholder="Your City"
                  required="required" data-validation-required-message="Please select your city">
                <option value="">Select City</option>
              </select>
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="form-row">
            <div class="control-group col-lg-6">
                <label for="district">District</label>
                <select class="form-control" name="district" id="district" placeholder="Your District"
                    required="required" data-validation-required-message="Please select your district">
                  <option value="">Select District</option>
                </select>
                <p class="help-block text-danger"></p>
            </div>
            <div class="control-group col-lg-6">
              <label for="zip">Zip/Postal</label>
              <input type="number" class="form-control" name="zip" id="zip" placeholder="Your Zip/Postal"
                  required="required" data-validation-required-message="Please enter your zip/postal" />
              <p class="help-block text-danger"></p>
            </div>
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
