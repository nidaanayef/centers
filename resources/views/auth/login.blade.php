@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-right">{{ __('تسجيل الدخول') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                          <div class="form-group row ">
                          <div class="col-md-3 text-right">
                          </div>
                          <div class="col-md-4 text-right">
                                <input id="manager_identity" class="form-control @error('manager_identity') is-invalid @enderror  text-right" name="manager_identity" value="{{ old('manager_identity') }}" required autocomplete="manager_identity" autofocus>
                                </div>
                          
                      <div class="col-sm-2 text-right">
                            <label for="manager_identity" >{{ __('اسم المستخدم') }}</label>

                            </div>
                           
                                <div class="col-md-3 text-right">
                          </div>
                                @error('manager_identity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                        </div> 
                       

                        <div class="form-group row">
                        <div class="col-md-3 text-right">
                          </div>
                          <div class="col-md-4 ">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror text-right" name="password" required autocomplete="current-password">
                            </div>
                            <div class="col-md-2 text-right">
                            <label for="password" >{{ __('كلمة السر') }}</label>
                            </div>
                            <div class="col-md-3 text-right">
                          </div>

                           
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                         
                        </div>

                        <div class="form-group row">
                        <div class="col-3">
                        </div>

                        <div class="col-md-2">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('تسجيل الدخول') }}
                                </button>

                              
                            </div>
                            <div class="col-3 ">
                                <div class="form-check">
                                <label class="form-check-label mr-4" for="remember">
                                        {{ __(' تذكرني') }}
                                    </label>
                                    <input class="form-check-input  mr-4" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                  
                                </div>
                            </div>
                            <div class="col-4 ">
                        </div>

                     

                       
                            
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection