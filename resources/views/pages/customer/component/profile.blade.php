<div class="row">
  <div class="col-lg-5 col-sm-6">
    <div class="card" style="width: auto;">
      <img class="card-img-top pb-0 pt-4 px-4" id="profileImageUrl" style="object-fit: cover;" src="{{ $user->avatar_url }}" alt="Card image cap">
      <div class="card-body">
        <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#changeProfilePictureModal" type="button">Upload Photo</button>
      </div>
    </div>
    <div class="card mt-1" style="width: auto;">
      <div class="card-body">
        <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#changePasswordeModal" type="button">Change Password</button>
      </div>
    </div>
  </div>
  <div class="col-lg-7 col-sm-6">
    <div class="card">
      <div class="card-header">
        <div class="d-flex justify-content-between">
          <h6 class="mb-0">Change Profile</h6>
          <button class="btn btn-warning btn-sm" id="editProfiletBtn" data-toggle="modal" data-target="#changeProfileModal">Edit</button>
        </div>
      </div>
      <div class="card-body">
        <dl class="row mb-0">
          <dt class="col-sm-4 font-weight-normal">Name</dt>
          <dd class="col-sm-8 font-italic">{{ Str::title($user->first_name . ' ' . $user->last_name) }}</dd>
          <dt class="col-sm-4 font-weight-normal">Birth Date</dt>
          <dd class="col-sm-8 font-italic">{{ \Carbon\Carbon::parse(SharedHelper::searchArrayByValue($user->meta_data, 'key', 'birth_date')->value)->isoFormat('dddd, D MMMM Y') }}</dd>
          <dt class="col-sm-4 font-weight-normal">Gender</dt>
          <dd class="col-sm-8 font-italic">{{ Str::title(SharedHelper::searchArrayByValue($user->meta_data, 'key', 'gender')->value) }}</dd>
        </dl>
      </div>
    </div>
    <div class="card mt-3">
      <div class="card-header">
        <div class="d-flex justify-content-between">
          <h6 class="mb-0">Change Contact</h6>
          <button class="btn btn-warning btn-sm" id="editContactBtn">Edit</button>
        </div>
      </div>
      <div class="card-body">
        <dl class="row">
          <dt class="col-sm-4 font-weight-normal">Email</dt>
          <dd class="col-sm-8 font-italic">{{$user->email}}</dd>
          <dt class="col-sm-4 font-weight-normal">Phone Number</dt>
          <dd class="col-sm-8 font-italic">{{SharedHelper::searchArrayByValue($user->meta_data, 'key', 'phone_number')->value}}</dd>
        </dl>
      </div>
    </div>
  </div>
</div>

<!-- Modal upload picture-->
<div class="modal fade" id="changeProfilePictureModal" tabindex="-1" role="dialog" aria-labelledby="changeProfilePictureModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Change Profile Picture</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="success"></div>
        <form name="updateProfilePictureForm" id="updateProfilePictureForm" enctype="multipart/form-data" novalidate="novalidate">
          <div class="control-group">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="file" class="form-control" name="profileImage" id="profileImage" placeholder="Your Picture"
                  required="required" data-validation-required-message="Please choose your picture" />
              <p class="help-block text-danger"></p>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="updateProfilePictureButton">Save changes</button>
      </div>
    </div>
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
              <input type="password" class="form-control" name="password" id="password" placeholder="Your Password"
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

<!-- Modal update profile-->
<div class="modal fade" id="changeProfileModal" tabindex="-1" role="dialog" aria-labelledby="changeProfileModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Change Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="success_change_password"></div>
        <form name="updateProfileForm" id="updateProfileForm" novalidate="novalidate">
          <div class="control-group">
              <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Your first name"
                  required="required" data-validation-required-message="Please enter your first name" />
              <p class="help-block text-danger"></p>
          </div>
          <div class="control-group">
            <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Your last name"
                required="required" data-validation-required-message="Please enter your last name" />
            <p class="help-block text-danger"></p>
          </div>
          <div class="control-group">
            <input type="text" class="form-control" name="birth_date" id="birt_date" placeholder="Your birth date"
                required="required" data-validation-required-message="Please choose your birth date" />
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
<script src="{{ asset('assets/js/customer/profile.js')}}"></script>
@endpush
