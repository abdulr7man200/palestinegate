@extends('layouts.app')

@section('content')


<style>
    body{
    background: #f5f5f5;
    margin-top:20px;
}

.ui-w-80 {
    width: 80px !important;
    height: auto;
}

.btn-default {
    border-color: rgba(24,28,33,0.1);
    background: rgba(0,0,0,0);
    color: #4E5155;
}

label.btn {
    margin-bottom: 0;
}

.btn-outline-primary {
    border-color: #26B4FF;
    background: transparent;
    color: #26B4FF;
}

.btn {
    cursor: pointer;
}

.text-light {
    color: #babbbc !important;
}

.btn-facebook {
    border-color: rgba(0,0,0,0);
    background: #3B5998;
    color: #fff;
}

.btn-instagram {
    border-color: rgba(0,0,0,0);
    background: #000;
    color: #fff;
}

.card {
    background-clip: padding-box;
    box-shadow: 0 1px 4px rgba(24,28,33,0.012);
}

.row-bordered {
    overflow: hidden;
}

.account-settings-fileinput {
    position: absolute;
    visibility: hidden;
    width: 1px;
    height: 1px;
    opacity: 0;
}
.account-settings-links .list-group-item.active {
    font-weight: bold !important;
}
html:not(.dark-style) .account-settings-links .list-group-item.active {
    background: transparent !important;
}
.account-settings-multiselect ~ .select2-container {
    width: 100% !important;
}
.light-style .account-settings-links .list-group-item {
    padding: 0.85rem 1.5rem;
    border-color: rgba(24, 28, 33, 0.03) !important;
}
.light-style .account-settings-links .list-group-item.active {
    color: #4e5155 !important;
}
.material-style .account-settings-links .list-group-item {
    padding: 0.85rem 1.5rem;
    border-color: rgba(24, 28, 33, 0.03) !important;
}
.material-style .account-settings-links .list-group-item.active {
    color: #4e5155 !important;
}
.dark-style .account-settings-links .list-group-item {
    padding: 0.85rem 1.5rem;
    border-color: rgba(255, 255, 255, 0.03) !important;
}
.dark-style .account-settings-links .list-group-item.active {
    color: #fff !important;
}
.light-style .account-settings-links .list-group-item.active {
    color: #4E5155 !important;
}
.light-style .account-settings-links .list-group-item {
    padding: 0.85rem 1.5rem;
    border-color: rgba(24,28,33,0.03) !important;
}
</style>

<section class="site-hero inner-page overlay" style="background-image: url('Frontend/images/jerusalem.jpg');"
    data-stellar-background-ratio="0.5">
    <div class="container">
        <div class="row site-hero-inner justify-content-center align-items-center">
            <div class="col-md-10 text-center" data-aos="fade">
                <h1 class="heading mb-3">Account Settings</h1>
            </div>
        </div>
    </div>

    <a class="mouse smoothscroll" href="#next">
        <div class="mouse-icon">
            <span class="mouse-wheel"></span>
        </div>
    </a>
</section>


<div class="container light-style flex-grow-1 container-p-y">

    <h4 class="font-weight-bold py-3 mb-4">
    </h4>

    <div class="card overflow-hidden">
      <div class="row no-gutters row-bordered row-border-light">
        <div class="col-md-3 pt-0">
          <div class="list-group list-group-flush account-settings-links">
            {{-- <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-info" >Info</a> --}}
            <a class="list-group-item list-group-item-action active" data-toggle="list" href="#account-general">General</a>
            <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-change-password">Change password</a>
          </div>
        </div>
        <div class="col-md-9">
          <div class="tab-content">
            <div class="tab-pane fade active show" id="account-general">

              <hr class="border-light m-0">

              <div class="card-body">
                <form method="post" action="{{ route('profile.update') }}" >
                    @csrf
                    @method('patch')


                <div class="form-group">
                  <label class="form-label">Name</label>
                  <input type="text" class="form-control" name="name" value="{{ auth()->user()->name }}">
                  <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>
                <div class="form-group">
                  <label class="form-label">E-mail</label>
                  <input disabled type="text" class="form-control mb-1" value="{{ auth()->user()->email }}">
                </div>
                <div class="form-group">
                  <label class="form-label">Phone</label>
                  <input disabled name="phone" type="text" class="form-control mb-1" value="{{ auth()->user()->phone }}">
                </div>
                <div class="form-group">
                  <label class="form-label">Birthday</label>
                  <input name="date_of_birth" type="text" class="form-control mb-1" value="{{ auth()->user()->date_of_birth }}">
                </div>

                    @if (session('status') === 'profile-updated')
                    <p
                        x-data="{ show: true }"
                        x-show="show"
                        x-transition
                        x-init="setTimeout(() => show = false, 2000)"
                        class="text-2xl" style="color: green;"
                    >{{ __('Saved.') }}</p>
                @endif

                <button type="submit" class="btn btn-primary">Save changes</button>
                </form>

              </div>

            </div>
            <div class="tab-pane fade" id="account-change-password">
                <div class="card-body pb-2">
                    <form method="post" action="{{ route('password.update') }}">
                        @csrf
                        @method('PUT')

                        <!-- Current Password -->
                        <div class="form-group">
                            <label class="form-label">Current password</label>
                            <input type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" required>
                            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" style="color: red"/>

                        </div>

                        <!-- New Password -->
                        <div class="form-group">
                            <label class="form-label">New password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" style="color: red" />

                        </div>

                        <!-- Password Confirmation -->
                        <div class="form-group">
                            <label class="form-label">Repeat new password</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 " style="color: red"/>

                        </div>

                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                    @if (session('status') === 'password-updated')
                    <p x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-2xl text-gray-600" style="color: green">
                        {{ __('Your password has been updated.') }}
                    </p>
                @endif

                </div>
            </div>

            {{-- <div class="tab-pane fade" id="account-info">
              <div class="card-body pb-2">


                <div class="form-group">
                  <label class="form-label">Birthday</label>
                  <input type="text" class="form-control" value="May 3, 1995">
                </div>


              </div>
              <hr class="border-light m-0">
              <div class="card-body pb-2">

                <h6 class="mb-4">Contacts</h6>
                <div class="form-group">
                  <label class="form-label">Phone</label>
                  <input type="text" class="form-control" value="+0 (123) 456 7891">
                </div>


              </div>

            </div> --}}


          </div>
        </div>
      </div>
    </div>



  </div>
  <h4 class="font-weight-bold py-3 mb-4">
  </h4>
@endsection
