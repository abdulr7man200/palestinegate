<x-guest-layout>
   <!-- Confirm Password - Bootstrap Brain Component -->
<div class="bg-light py-3 py-md-5">
    <div class="container">
      <div class="row justify-content-md-center">
        <div class="col-12 col-md-11 col-lg-8 col-xl-7 col-xxl-6">
          <div class="bg-white p-4 p-md-5 rounded shadow-sm">
            <div class="row">
              <div class="col-12">
                <div class="mb-5">
                  <h3>Confirm Your Password</h3>
                </div>
              </div>
            </div>
  
            <!-- Confirm Password Form -->
            <form method="POST" action="{{ route('password.confirm') }}">
              @csrf
  
              <div class="row gy-3 gy-md-4 overflow-hidden">
                <!-- Password -->
                <div class="col-12">
                  <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                  <input type="password" class="form-control" name="password" id="password" required autocomplete="current-password">
                </div>
  
                <!-- Submit Button -->
                <div class="col-12">
                  <div class="d-grid">
                    <button class="btn btn-lg btn-primary" type="submit">Confirm</button>
                  </div>
                </div>
              </div>
            </form>
  
            <!-- Additional Links -->
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
