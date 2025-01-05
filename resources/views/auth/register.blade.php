<x-guest-layout>
    <x-guest-layout>
        <!-- Registration Form - Bootstrap Brain Component -->
        <div class="bg-light py-3 py-md-5">
          <div class="container">
            <div class="row justify-content-md-center">
              <div class="col-12 col-md-11 col-lg-8 col-xl-7 col-xxl-6">
                <div class="bg-white p-4 p-md-5 rounded shadow-sm">
                  <div class="row">
                    <div class="col-12">
                      <div class="mb-5">
                        <h3>Create Your Account</h3>
                      </div>
                    </div>
                  </div>
                  <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="row gy-3 gy-md-4 overflow-hidden">
                      <!-- Name -->
                      <div class="col-12">
                        <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" placeholder="Your name" required autofocus autocomplete="name">
                        @error('name')
                          <p class="text-sm text-danger mt-1">{{ $message }}</p>
                        @enderror
                      </div>

                      <!-- Email -->
                      <div class="col-12">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" placeholder="name@example.com" required autocomplete="username">
                        @error('email')
                          <p class="text-sm text-danger mt-1">{{ $message }}</p>
                        @enderror
                      </div>

                      <!-- Date of Birth -->
                      <div class="col-12">
                        <label for="date_of_birth" class="form-label">Date of Birth <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}" required>
                        @error('date_of_birth')
                          <p class="text-sm text-danger mt-1">{{ $message }}</p>
                        @enderror
                      </div>

                      <!-- Phone Number -->
                      <div class="col-12">
                        <label for="phone" class="form-label">Phone Number <span class="text-danger">*</span></label>
                        <input type="tel" class="form-control" name="phone" id="phone" value="{{ old('phone') }}" placeholder="(555) 123-4567" required>
                        @error('phone')
                          <p class="text-sm text-danger mt-1">{{ $message }}</p>
                        @enderror
                      </div>

                      <!-- Password -->
                      <div class="col-12">
                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password" required autocomplete="new-password">
                        @error('password')
                          <p class="text-sm text-danger mt-1">{{ $message }}</p>
                        @enderror
                      </div>

                      <!-- Confirm Password -->
                      <div class="col-12">
                        <label for="password_confirmation" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirm your password" required autocomplete="new-password">
                        @error('password_confirmation')
                          <p class="text-sm text-danger mt-1">{{ $message }}</p>
                        @enderror
                      </div>


                      <!-- Submit Button -->
                      <div class="col-12">
                        <div class="d-grid">
                          <button class="btn btn-lg btn-primary" type="submit">Register Now</button>
                        </div>
                      </div>
                    </div>
                  </form>

                  <div class="row">
                    <div class="col-12">
                      <hr class="mt-5 mb-4 border-secondary-subtle">
                      <div class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-md-end">
                        <a href="{{ route('login') }}" class="link-secondary text-decoration-none">Already have an account?</a>
                        <a href="{{ route('password.request') }}" class="link-secondary text-decoration-none">Forgot password?</a>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </x-guest-layout>

</x-guest-layout>
