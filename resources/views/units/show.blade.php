@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary">
                
                <nav class="navbar navbar-expand-md navbar-dark bg-primary">
                    
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <i class="fa fa-home"></i>&nbsp;{{ __('Edit '.$unit->unit_house_number.' Unit') }}
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
                        <div class="row">

                        <div class="col-md-6">
                        <div class="form-group row">
                            <label for="in_property" class="col-md-4 col-form-label text-md-left">{{ __('In Property') }}</label>

                            <div class="col-md-8">
                                {{$unit->property->name}}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="unit_house_number" class="col-md-4 col-form-label text-md-left">{{ __('House Number') }}</label>

                            <div class="col-md-8">
                                {{ $unit->unit_house_number }}

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="unit_type" class="col-md-4 col-form-label text-md-left">{{ __('Unit Type') }}</label>

                            <div class="col-md-8">
                                {{$unit->unitType->unit_type_name}}-{{$unit->unitType->standard}}
                                 

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="rent_charge" class="col-md-4 col-form-label text-md-left">{{ __('Rent Charges') }}</label>

                            <div class="col-md-8">
                            
                            {{ $unit->rent_charge }}
                            </div>
                        </div>
                        @if($unit->tenant_id == 0)
                            <div class="form-group row">
                                <label for="occupancy" class="col-md-4 col-form-label text-md-left">{{ __('Occupancy') }}</label>

                                <div class="col-md-8">
                                    {{ __('Vacant') }}
                                </div>
                            </div>

                        @else
                            <div class="form-group row">
                                <label for="occupancy" class="col-md-4 col-form-label text-md-left">{{ __('Occupancy') }}</label>

                                <div class="col-md-8">
                                    {{ __('Occupied') }}

                                </div>
                            </div>
                        @endif
                        

                        @if($unit->tenant_id > 0)
                        <div class="form-group row">
                            <label for="tenant_id" class="col-md-4 col-form-label text-md-left">{{ __('Tenant Name') }}</label>

                            <div class="col-md-8">
                                
                                {{$unit->tenant['firstname']." ".$unit->tenant['lastname']." ". $unit->tenant['surname']}}
                                
                            </div>
                        </div>
                        @else
                            <label for="tenant_id" class="col-md-4 col-form-label text-md-left">{{ __('No Tenant') }}</label>
                        @endif
                        
                    </div>
                    
                    <div class="col-md-6">
                        <label for="rent_charge"><b>{{ __('Current Tenant Details') }}</b></label>
                        <div class="form-group row">
                           <label for="tenant_id" class="col-md-4 col-form-label text-md-left">{{ __('Tenant Email') }}</label>

                            <div class="col-md-8">
                                
                                {{$unit->tenant['email']}}
                                
                            </div>

                        </div>
                        <div class="form-group row">
                           <label for="tenant_id" class="col-md-4 col-form-label text-md-left">{{ __('Tenant Phone') }}</label>

                            <div class="col-md-8">
                                
                                {{$unit->tenant['phonenumber']}}
                                
                            </div>

                        </div>
                        <div class="form-group row">
                           <label for="tenant_id" class="col-md-4 col-form-label text-md-left">{{ __('Next of Kin') }}</label>

                            <div class="col-md-8">
                                
                                {{$unit->tenant['next_of_kin_name']}}
                                
                            </div>

                        </div>
                        <div class="form-group row">
                           <label for="tenant_id" class="col-md-4 col-form-label text-md-left">{{ __('Kin\'s Phonenumber') }}</label>

                            <div class="col-md-8">
                                
                                {{$unit->tenant['next_of_kin_phone']}}
                                
                            </div>

                        </div>

                    </div>

                    </div>
                               
                </div>
            </div>
        </div>
        <div class="col-md-12">
        <div class="card-header">
        <h5>Unit History and Details</h5>
        
        </div>
        <div class="card-body">
        
        </div>
        </div>
    </div>
@endsection