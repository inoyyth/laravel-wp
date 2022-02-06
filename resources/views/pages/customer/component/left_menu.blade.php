<div class="list-group">
  <a href="{{ route('customer.main') }}" class="list-group-item list-group-item-action {{ Route::current()->getName() == 'customer.main' ? 'active' : '' }}">Profile</a>
  <a href="{{ route('customer.address') }}" class="list-group-item list-group-item-action {{ Route::current()->getName() == 'customer.address' ? 'active' : '' }}">Address Info</a>
  <a href="#" class="list-group-item list-group-item-action">Billing Info</a>
  <a class="list-group-item list-group-item-action">Bank Account</a>
  <a class="list-group-item list-group-item-action">Notification</a>
</div>
<div class="pt-5">
  <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100" data-toggle="collapse" href="#navbar-chat" style="height: 65px; margin-top: -1px; padding: 0 30px;">
    <h6 class="m-0">Inbox</h6>
    <i class="fa fa-angle-down text-dark"></i>
  </a>
  <nav class="collapse position-relative navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0 bg-light" id="navbar-chat" style="width: auto;">
    <div class="navbar-nav w-100 overflow-hidden" style="height: auto;">
      <a href="" class="nav-item nav-link">Chat <span class="badge badge-danger badge-pill float-right">4</span></a>
      <a href="" class="nav-item nav-link">Discussion</a>
      <a href="" class="nav-item nav-link">Product Review</a>
    </div>
  <nav>
</div>
