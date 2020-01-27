@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary">
                
                <nav class="navbar navbar-expand-md navbar-dark bg-primary">
                    
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <i class="fa fa-home"></i>&nbsp;{{ __('Create New Unit') }}
                            @if($from=='properties')
                                {{ __('in '.$property->name) }}
                            @endif
                        </a>
                                <div class="navbar-collapse">
                                <!-- Left Side Of Navbar -->
                                <ul class="navbar-nav mr-auto">
                                     
                                </ul>

                                <!-- Right Side Of Navbar -->
                                <ul class="navbar-nav ml-auto">
                                   
                                        <li class="nav-item">
                                            <a class="nav-link shadow-sm" href="/units">{{ __('Back') }}&nbsp;&nbsp;<i class="fa fa-back"></i></a>
                                        </li>
                                       
                                </ul>
                            </div>
                    </nav>
                
                </div>

                <div class="card-body">
                <form method="POST" action="{{action('UnitsController@store') }}">
                        @csrf
                        <div class="row">
                        <div class="col-md-10">

                        @if($from=='properties')
                            @include('units.from_properties')
                        @else
                            @include('units.from_units')
                        @endif
                        <div class="form-group row">
                            <label for="unit_house_number" class="col-md-4 col-form-label text-md-left">{{ __('House Number') }}</label>

                            <div class="col-md-8">
                                <input id="unit_house_number" type="text" class="form-control @error('unit_house_number') is-invalid @enderror" name="unit_house_number" value="{{ old('unit_house_number') }}" required autocomplete="unit_house_number" autofocus>

                                @error('p_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="unit_type" class="col-md-4 col-form-label text-md-left">{{ __('Unit Type') }}</label>

                            <div class="col-md-8">
                                <select class="form-control" name="unit_type" id="unit_type" class="form-control @error('unit_type') is-invalid @enderror">
                                 @foreach ($unit_types as $unit_type )
                                     <option value="{{$unit_type->id}}">{{$unit_type->unit_type_name}}-{{$unit_type->standard}}</option>
                                 @endforeach
                                  </select>

                                @error('unit_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="rent_charge" class="col-md-4 col-form-label text-md-left">{{ __('Rent Charges') }}</label>

                            <div class="col-md-8">
                                <input id="rent_charge" type="text" class="form-control @error('rent_charge') is-invalid @enderror" name="rent_charge" value="{{ old('rent_charge') }}" required autocomplete="rent_charge">
                            </div>
                        </div>
                        
                        
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
@endsection