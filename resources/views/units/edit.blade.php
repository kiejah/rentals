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
                <form method="POST" action="{{route('units.update',[$unit->id]) }}">
                        @csrf
                         <input type="hidden" name="_method" value="put">
                        <div class="row">
                        <div class="col-md-10">
                        <div class="form-group row">
                            <label for="in_property" class="col-md-4 col-form-label text-md-left">{{ __('In Property') }}</label>

                            <div class="col-md-8">
                                <select class="form-control" name="in_property" id="in_property" class="form-control @error('in_property') is-invalid @enderror">
                                <option value="{{$unit->in_property}}" selected>{{$unit->property->name}}</option>
                                 @foreach ($properties as $property )
                                    
                                     <option value="{{$property->id}}">{{$property->name}}</option>
                                 @endforeach
                                  </select>

                                @error('in_property')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="unit_house_number" class="col-md-4 col-form-label text-md-left">{{ __('House Number') }}</label>

                            <div class="col-md-8">
                                <input id="unit_house_number" type="text" class="form-control @error('unit_house_number') is-invalid @enderror" name="unit_house_number" value="{{ $unit->unit_house_number }}" required autocomplete="unit_house_number"/>

                                @error('unit_house_number')
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
                                     <option value="{{$unit->unit_type}}" selected>{{$unit->unitType->unit_type_name}}-{{$unit->unitType->standard}}</option>
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
                                <input id="rent_charge" type="text" class="form-control @error('rent_charge') is-invalid @enderror" name="rent_charge" value="{{ $unit->rent_charge }}" required autocomplete="rent_charge">
                            </div>
                        </div>
                        @if($unit->tenant_id == 0)
                            <div class="form-group row">
                                <label for="occupancy" class="col-md-4 col-form-label text-md-left">{{ __('Occupancy') }}</label>

                                <div class="col-md-8">
                                    <label for="occupancy" class="col-md-8 col-form-label text-md-left">{{ __('Vacant') }}</label>
                                    <input name="occupancy" id="occupancy" type="hidden" value="Vacant">

                                </div>
                            </div>

                        @else
                            <div class="form-group row">
                                <label for="occupancy" class="col-md-4 col-form-label text-md-left">{{ __('Occupancy') }}</label>

                                <div class="col-md-8">
                                    <select class="form-control" name="occupancy" id="occupancy" class="form-control @error('occupancy') is-invalid @enderror" onchange="
                                    var currOccupancy= document.getElementById('occupancy').value;
                                    var tenant_id= document.getElementById('tenant_id').firstChild.value;
                                   // alert(tenant_id);
                                    if(currOccupancy==='Vacant'){
                                        document.getElementById('tenant_id').value='0';
                                        document.getElementById('tenant_id').setAttribute('disabled','disabled');
                                    }else{
                                        document.getElementById('tenant_id').removeAttribute('disabled');
                                        document.getElementById('tenant_id').value = tenant_id;
                                    }
                                    ">
                                    <option value="{{ $unit->occupancy }}" selected>{{ $unit->occupancy }}</option>
                                    <option value="Vacant">Vacant</option>
                                    </select>

                                </div>
                            </div>
                        @endif
                        

                        @if($unit->tenant_id > 0)
                        <div class="form-group row">
                            <label for="tenant_id" class="col-md-4 col-form-label text-md-left">{{ __('Tenant Name') }}</label>

                            <div class="col-md-8" id="occupancyDiv">
                                <select class="form-control" name="tenant_id" id="tenant_id" class="form-control @error('tenant_id') is-invalid @enderror">
                                <option value="{{$unit->tenant_id }}" selected>
                                {{$unit->tenant['firstname']." ".$unit->tenant['lastname']." ". $unit->tenant['surname']}}
                                
                                 </option>
                                <option value="0"><b>None</b></option>
                                 @foreach ($tenants as $tenant )
                                     <option value="{{$tenant->id}}">
                                     {{$tenant->firstname}}&nbsp;
                                     {{$tenant->lastname}}&nbsp;
                                     {{$tenant->surname}}
                                     </option>
                                 @endforeach
                                  </select> 

                                @error('tenant_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        @else
                            <input name="tenant_id" id="tenant_id" type="hidden" value="0">
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
@endsection