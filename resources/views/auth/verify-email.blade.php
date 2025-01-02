<x-guest-layout>
   <!-- Email Verification Info Section -->
<div class="bg-light py-3 py-md-5">
    <div class="container">
      <div class="row justify-content-md-center">
        <div class="col-12 col-md-11 col-lg-8 col-xl-7 col-xxl-6">
          <div class="bg-white p-4 p-md-5 rounded shadow-sm">
            <div class="row">
              <div class="col-12">
                <div class="mb-5">
                  <h3>Email Verification</h3>
                </div>
                <div class="mb-4 text-sm text-gray-600">
                  {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                </div>
  
                @if (session('status') == 'verification-link-sent')
                <div class="mb-4 font-medium text-sm text-green-600">
                  {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                </div>
                @endif
              </div>
            </div>
  
            <div class="mt-4 flex items-center justify-between">
              <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <div class="col-12">
                  <div class="d-grid">
                    <x-primary-button>
                      {{ __('Resend Verification Email') }}
                    </x-primary-button>
                  </div>
                </div>
              </form>
  
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <div class="col-12">
                  <button type="submit" class="btn btn-outline-secondary">
                    {{ __('Log Out') }}
                  </button>
                </div>
              </form>
            </div>
  
            <div class="row mt-4">
              <div class="col-12">
                <hr class="mt-5 mb-4 border-secondary-subtle">
                <div class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-md-end">
                  <a href="#!" class="link-secondary text-decoration-none">Create new account</a>
                  <a href="#!" class="link-secondary text-decoration-none">Forgot password</a>
                </div>
              </div>
            </div>
  
            
          </div>
        </div>
      </div>
    </div>
  </div>
  
</x-guest-layout>
