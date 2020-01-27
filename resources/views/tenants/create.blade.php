@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary">
                
                <nav class="navbar navbar-expand-md navbar-dark bg-primary">
                    
                        <a class="navbar-brand" href="#">
                            <i class="fa fa-id-card"></i>&nbsp;{{ __('Create New Tenant') }}
                            @if($from=='properties')
                                {{ __(' in ') }}{{$property->name}}
                            @endif
                        </a>
                                <div class="navbar-collapse">
                                <!-- Left Side Of Navbar -->
                                <ul class="navbar-nav mr-auto">
                                     
                                </ul>

                                <!-- Right Side Of Navbar -->
                                <ul class="navbar-nav ml-auto">
                                   
                                        <li class="nav-item">
                                            <a class="nav-link shadow-sm" href="/tenants"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;{{ __('Back') }}</a>
                                        </li>
                                       
                                </ul>
                            </div>
                    </nav>
                
                </div>

                <div class="card-body">
                <form method="POST" action="{{action('TenantsController@store') }}">
                        @csrf
                        <div class="row">
                        <div class="col-md-10">
                        <div class="form-group row">
                            <label for="firstname" class="col-md-4 col-form-label text-md-left">{{ __('Firstname') }}</label>

                            <div class="col-md-8">
                                <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" required autocomplete="firstname" autofocus>

                                @error('firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="lastname" class="col-md-4 col-form-label text-md-left">{{ __('Lastname') }}</label>

                            <div class="col-md-8">
                                <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>

                                @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="surname" class="col-md-4 col-form-label text-md-left">{{ __('Surname') }}</label>

                            <div class="col-md-8">
                                <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required autocomplete="surname" autofocus>

                                @error('surname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-left">{{ __('Tenant Email') }}</label>

                            <div class="col-md-8">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phonenumber" class="col-md-4 col-form-label text-md-left">{{ __('Phonenumber') }}</label>

                            <div class="col-md-8">
                                <input id="phonenumber" type="text" class="form-control @error('phonenumber') is-invalid @enderror" name="phonenumber" value="{{ old('phonenumber') }}" required autocomplete="phonenumber" />

                                @error('phonenumber')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="next_of_kin_name" class="col-md-4 col-form-label text-md-left">{{ __('Next of Kin`s Name') }}</label>

                            <div class="col-md-8">
                                <input id="next_of_kin_name" type="text" class="form-control @error('next_of_kin_name') is-invalid @enderror" name="next_of_kin_name" value="{{ old('next_of_kin_name') }}" required autocomplete="next_of_kin_name" />

                                @error('next_of_kin_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="next_of_kin_phone" class="col-md-4 col-form-label text-md-left">{{ __('Next of Kin`s Phone') }}</label>

                            <div class="col-md-8">
                                <input id="next_of_kin_phone" type="text" class="form-control @error('next_of_kin_phone') is-invalid @enderror" name="next_of_kin_phone" value="{{ old('next_of_kin_phone') }}" required autocomplete="next_of_kin_phone" />

                                @error('next_of_kin_phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        @if($from=='tenants')
                            @include('tenants.from_tenants')
                        @elseif($from=='properties')
                            @include('tenants.from_properties')
                        @else
                            @include('tenants.from_units')
                        @endif
                        
                    </div>

                    <div class="col-md-2">
                            <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4 text-md-right ">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </div>
                    </div>
                    </form>
                               
                </div>
            </div>
        </div>
    </div>
@include('scripts.cascaded'); 
@endsection
