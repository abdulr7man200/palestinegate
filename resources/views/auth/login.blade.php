<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="bg-light py-3 py-md-5">
        <div class="container">
          <div class="row justify-content-md-center">
            <div class="col-12 col-md-11 col-lg-8 col-xl-7 col-xxl-6">
              <div class="bg-white p-4 p-md-5 rounded shadow-sm">
                <div class="row">
                  <div class="col-12">
                    <div class="mb-5">
                      <h3>Log in</h3>
                    </div>
                  </div>
                </div>
                <form method="POST" action="{{ route('login') }}">
                  @csrf
                  <div class="row gy-3 gy-md-4 overflow-hidden">
                    <div class="col-12">
                      <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                      <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" required>
                    </div>
                    <div class="col-12">
                      <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                      <input type="password" class="form-control" name="password" id="password" value="" required>
                    </div>
                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember_me">
                        <label class="form-check-label text-secondary" for="remember_me">
                          Keep me logged in
                        </label>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="d-grid">
                        <button class="btn btn-lg btn-primary" type="submit">Log in now</button>
                      </div>
                    </div>
                  </div>
                </form>
                <div class="row">
                  <div class="col-12">
                    <hr class="mt-5 mb-4 border-secondary-subtle">
                    <div class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-md-end">
                      <a href="{{ route('register') }}" class="link-secondary text-decoration-none">Create new account</a>
                      @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="link-secondary text-decoration-none">Forgot password</a>
                      @endif
                    </div>
                  </div>
                </div>        
              </div>
            </div>
          </div>
        </div>
      </div>
      
      
</x-guest-layout>
