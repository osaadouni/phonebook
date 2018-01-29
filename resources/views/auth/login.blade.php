@extends('layouts.app')

@section('content')
<div class="container">

<div class="panel">
    <p class="panel-heading">
        Login 
    </p>
    <div class="panel-block">

        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}

            <div class="field">
              <label class="label">Email</label>
              <div class="control has-icons-left has-icons-right">
                    <input id="email" type="email" class="input {{ $errors->has('email') ? ' is-danger' : '' }}" name="email" value="{{ old('email') }}" required autofocus placeholder="E-mail address">
                <span class="icon is-small is-left">
                  <i class="fas fa-envelope"></i>
                </span>
                <span class="icon is-small is-right">
                  <i class="fas fa-exclamation-triangle"></i>
                </span>
              </div>
                 @if ($errors->has('email'))
                <p class="help is-danger">
                This email is invalid
                        <strong>{{ $errors->first('email') }}</strong>
                    </p>
                 @endif
            </div>
                

        
        <div class="field">
          <label class="label">Password:</label>
          <div class="control">
                  <input id="password" type="password" class="input {{ $errors->has('password') ? ' is-danger' : '' }}" name="password" required placeholder="Password">
          </div>
              @if ($errors->has('password'))
          <p class="help is-danger">
                    <strong>{{ $errors->first('password') }}</strong>
              </p>
              @endif
        </div>

        <div class="field">
          <div class="control">
            <label class="checkbox">
            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
            </label>
          </div>
        </div>

        <div class="field is-grouped">
            <div class="control">
                <button type="submit" class="button is-link">Login</button>
            </div>
            <a class="btn btn-link" href="{{ route('password.request') }}">
                Forgot Your Password?
            </a>
        </div>

        </form>
        </div>
    </div>
 
</div>
@endsection
