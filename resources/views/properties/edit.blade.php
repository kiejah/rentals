@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary">
                
                <nav class="navbar navbar-expand-md navbar-dark bg-primary">
                    
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <i class="fa fa-building"></i>&nbsp;{{ __('Edit '.$property->name.' Property' ) }}
                        </a>
                                <div class="navbar-collapse">
                                <!-- Left Side Of Navbar -->
                                <ul class="navbar-nav mr-auto">
                                     
                                </ul>

                                <!-- Right Side Of Navbar -->
                                <ul class="navbar-nav ml-auto">
                                   
                                        <li class="nav-item">
                                            <a class="nav-link shadow-sm" href="/properties">{{ __('Back') }}&nbsp;&nbsp;<i class="fa fa-back"></i></a>
                                        </li>
                                       
                                </ul>
                            </div>
                    </nav>
                
                </div>

                <div class="card-body">
                <form method="post" action="{{ route('properties.update',[$property->id]) }}">
                        @csrf
                        <input type="hidden" name="_method" value="put">
                        <div class="row">
                        <div class="col-md-10">

                        <div class="form-group row">
                            <label for="p_name" class="col-md-4 col-form-label text-md-left">{{ __('Property Name') }}</label>

                            <div class="col-md-8">
                                <input id="p_name" type="text" class="form-control @error('p_name') is-invalid @enderror" name="p_name" required autocomplete="p_name" autofocus value="{{$property->name}}">

                                @error('p_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="p_location" class="col-md-4 col-form-label text-md-left">{{ __('Property Location') }}</label>

                            <div class="col-md-8">
                                <input id="p_location" type="text" class="form-control @error('p_location') is-invalid @enderror" name="p_location" value="{{$property->location}}" required autocomplete="p_location">

                                @error('p_location')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="no_units" class="col-md-4 col-form-label text-md-left">{{ __('Number of Units') }}</label>

                            <div class="col-md-8">
                                <input id="no_units" type="number" class="form-control @error('no_units') is-invalid @enderror" name="no_units" required autocomplete="no_units" value="{{$property->number_of_units}}">

                                @error('no_units')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="caretaker_name" class="col-md-4 col-form-label text-md-left">{{ __('Caretaker`s Name') }}</label>

                            <div class="col-md-8">
                                <input id="caretaker_name" type="text" class="form-control @error('caretaker_name') is-invalid @enderror"  name="caretaker_name" required autocomplete="caretaker_name" value="{{$property->caretaker_name}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="p_description" class="col-md-4 col-form-label text-md-left">{{ __('Property Description') }}</label>

                            <div class="col-md-8">
                                  <textarea required class="form-control" class="form-control @error('p_description') is-invalid @enderror" name="p_description" id="p_description" rows="3">{{$property->description}}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-2">
                            <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4 text-md-right ">
                                <button type="submit" class="btn btn-success">
                                    {{ __('Update') }}
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
@endsection