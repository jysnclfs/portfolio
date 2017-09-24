@extends('layouts.app')

@section('title', 'Settings')

@section('stylesheets')
   <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
   <script>tinymce.init({ selector:'textarea', plugins:'link', height:150 });</script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@endsection

@section('content')

  @include('partials._nav-admin')

  <div class="container mt-5">
    <div class="row">
      <div class="col-lg-4">
          <!-- update-profile-picture -->
          @include('admin.update-profile-pic')

        <div class="list-group mb-2">
          <a href="{{ route('settings.index') }}" id class="list-group-item d-flex justify-content-between align-items-center active" data-toggle="" data-target="#change_password">
            Back
            <i class="fa fa-chevron-right"></i>
          </a>
        </div>
      </div>

        <div class="col-lg-8">
          <div class="card mt-2 mb-2">
            <div class="card-up">
              <i class="fa fa-users indigo"></i>
              <div class="data">
                <h5>Change Password</h5>
              </div>
            </div>
            <div class="card-block">
              <!-- @if (Session::has('success'))
                <div class="alert alert-success">
                  {{ Session::get('success') }}
                </div>
              @endif
              @if (Session::has('error'))
                <div class="alert alert-danger">
                  {{ Session::get('error') }}
                </div>
              @endif -->
              <form class="px-3" action="{{ route('change-password.update', $user->id) }}" method="post" data-parsley-validate>
                {{ csrf_field() }}{{ method_field('PATCH') }}
                  <div class="md-form {{ $errors->has('oldpassword') ? 'has-danger' : '' }}">
                    <input type="password" name="oldpassword" value="" class="form-control" required>
                    <label for="">Current Password</label>
                    @if ($errors->has('oldpassword'))
                      <span class="text-danger">
                        <strong>{{ $errors->first('oldpassword') }}</strong>
                      </span>
                    @endif
                  </div>
                  <div class="md-form{{ $errors->has('password') ? ' has-danger' : '' }}">
                    <input id="password" type="password" class="form-control" name="password" value="" required>
                    <label for="password" class="form-label">New Password</label>
                    @if ($errors->has('password'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                  </div>

                  <div class="md-form">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                    <label for="password-confirm" class="form-label">Confirm Password</label>
                  </div>

                  <div class="float-right">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <a href="{{ route('settings.index') }}" class="btn btn-danger">Cancel</a>
                  </div>
              </form>
            </div>
          </div>
        </div>
    </div>
  </div>
@endsection

@section('scripts')

  <script src="{{ asset('js/parsley.min.js') }}" type="text/javascript"></script>

  <script type="text/javascript">
    $('form').parsley();
  </script>

  @include('partials._notifications')

@endsection