@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary">
                
                <nav class="navbar navbar-expand-md navbar-dark bg-primary">
                    
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <i class="fa fa-building"></i>&nbsp;{{ __($property->name.' Property' ) }}
                        </a>
                                <div class="navbar-collapse">
                                <!-- Left Side Of Navbar -->
                                <ul class="navbar-nav mr-auto">
                                     
                                </ul>

                                <!-- Right Side Of Navbar -->
                                <ul class="navbar-nav ml-auto">
                                   
                                        <li class="nav-item">
                                            <a class="nav-link shadow-sm" href="{{ route('printunits', ['id' => $property->id]) }}"><i class="fa fa-print"></i>&nbsp;&nbsp;{{ __('Print') }}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link shadow-sm" href="/properties"><i class="fa fa-chevron-left"></i>&nbsp;&nbsp;{{ __('Back') }}</a>
                                        </li>
                                       
                                </ul>
                            </div>
                    </nav>
                
                </div>

                <div class="card-body">
                        <div class="row">
                        <div class="col-md-6">
                            <img class="img-fluid" src="{{url('/').'/images/1550905415_20.jpg'}}" style="max-height:300px"/>
                        </div>


                        <div class="col-md-5">
                            <div class="row">
                            <div class="col-md-10">

                                <div class="form-group row">
                                    <label for="p_name" class="col-md-12 col-form-label text-md-left">{{ __('Property Name: ') }}{{$property->name}}</label>
                                </div>

                                <div class="form-group row">
                                    <label for="p_location" class="col-md-12 col-form-label text-md-left">{{ __('Located at: ') }} {{$property->location}}</label>
                                </div>

                                <div class="form-group row">
                                    <label for="no_units" class="col-md-12 col-form-label text-md-left">{{ __('Has a Total of ') }} {{$property->number_of_units}} {{ __('Units') }}</label>
                                </div>
                                <div class="form-group row">
                                    <label for="p_description" class="col-md-12 col-form-label text-md-left">{{$property->description}}</label>
                                </div>

                                <div class="form-group row">
                                    <label for="caretaker_name" class="col-md-12 col-form-label text-md-left">{{$property->caretaker_name}}{{ __(' as the Property Caretaker') }}</label>
                                </div>
                            
                            </div>
                            </div>
                        </div>
                        
                    <div class="col-md-1">
                            
                            <div class="form-group row mb-0">
                                <div class="col-md-12 offset-md-4 ">
                                    <a title="Add Unit to this property" href="{{ route('add-unit', ['id' => $property->id]) }}" class="btn btn-primary">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </div>
                            </div>
                            <br>
                            <div class="form-group row mb-0">
                                <div class="col-md-12 offset-md-4 ">
                                    <a title="Edit this property" href="{{$property->id}}/edit" class="btn btn-secondary">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                </div>
                            </div>
                            <br>
                            <div class="form-group row">
                                <div class="col-md-12 offset-md-4 ">
                                    <a title="Delete this property" class="btn btn-danger" href="#" onclick="
                                    var result= confirm('Confirm you wish to delete the {{$property->name}} property');
                                    if(result){
                                        event.preventDefault();
                                        document.getElementById('delete-form').submit();
                                    }
                                    
                                    " >                            
                                    <i class="fa fa-close"></i>
                                    </a>
                                    <form id="delete-form" action="{{ route('properties.destroy',[$property->id])}}" method="POST" style="display:none;">
                                    <input type="hidden" name="_method" value="delete"/>
                                    {{ csrf_field() }}
                                    </form>
                                </div>
                            </div> 
                    </div>

                    </div>
                    <div class="row">
                        <div class="table-responsive">
                        @include('units.table')
                        </div>
                    </div>
                               
                </div>
            </div>
        </div>
    </div>
</div>
@endsection