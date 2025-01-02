<x-guest-layout>
<!-- Forgot Password Form - Bootstrap Brain Component -->
<div class="bg-light py-3 py-md-5">
    <div class="container">
      <div class="row justify-content-md-center">
        <div class="col-12 col-md-11 col-lg-8 col-xl-7 col-xxl-6">
          <div class="bg-white p-4 p-md-5 rounded shadow-sm">
            <div class="row">
              <div class="col-12">
                <div class="mb-5">
                  <h3>Reset Your Password</h3>
                  <p class="text-secondary">Forgot your password? No problem. Just let us know your email address, and we will email you a password reset link to create a new one.</p>
                </div>
              </div>
            </div>
            <!-- Session Status -->
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
            <form method="POST" action="{{ route('password.email') }}">
              @csrf
              <div class="row gy-3 gy-md-4 overflow-hidden">
                <!-- Email -->
                <div class="col-12">
                  <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                  <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" placeholder="name@example.com" required autofocus>
                  @error('email')
                  <p class="text-sm text-danger mt-1">{{ $message }}</p>
                  @enderror
                </div>
                <!-- Submit Button -->
                <div class="col-12">
                  <div class="d-grid">
                    <button class="btn btn-lg btn-primary" type="submit">Send Password Reset Link</button>
                  </div>
                </div>
              </div>
            </form>
            <div class="row">
              <div class="col-12">
                <hr class="mt-5 mb-4 border-secondary-subtle">
                <div class="d-flex justify-content-md-end">
                  <a href="{{ route('login') }}" class="link-secondary text-decoration-none">Back to Login</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
</x-guest-layout>
