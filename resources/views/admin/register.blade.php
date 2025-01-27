@extends('admin.app')
@section('title', 'Register')

@section('content')

<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
  <div class="card" style="width: 460px;">
      <div class="card-header">
        <h4>No account?</h4>
        <p>Register to login</p>
      </div>
      <div class="card-body p-4">
        <form action="{{ route('store') }}" method="POST">
          @csrf
          <div class="form-group">
            <label for="email" class="font-weight-bold">Full Name</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-address-card"></i></span>
              </div>
              <input type="name" id="email" name="name" class="form-control" placeholder="Enter your fullname" required>
            </div>
          </div>
          <div class="form-group">
            <label for="email" class="font-weight-bold">Email Address</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
              </div>
              <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
            </div>
          </div>
          <div class="form-group">
            <label for="password" class="font-weight-bold">Password</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
              </div>
              <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
            </div>
          </div>
          {{-- <div class="form-check mb-3">
            <input type="checkbox" class="form-check-input" id="remember">
            <label class="form-check-label" for="remember">Remember me</label>
          </div> --}}
          <button type="submit" class="btn btn-primary btn-block">Log In</button>
        </form>
      </div>
      <div class="card-footer">
        <p>You have an account? <a href="{{ route('index') }}">Login</a></p>
      </div>
    </div>
</div>

@endsection