@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary">
                
                <nav class="navbar navbar-expand-md navbar-dark bg-primary ">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <i class="fa fa-building"></i>&nbsp;Properties
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <!-- Left Side Of Navbar -->
                                <ul class="navbar-nav mr-auto">
                                    
                                </ul>

                                <!-- Right Side Of Navbar -->
                                <ul class="navbar-nav ml-auto">
                                        <li class="nav-item">
                                            <a class="nav-link shadow-sm btn-secondary" href="{{route('print-excel-properties')}}"><i class="fa fa-print"></i>&nbsp;&nbsp;{{ __('Print') }}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link shadow-sm btn-success" href="properties/create"><i class="fa fa-plus"></i>&nbsp;&nbsp;{{ __('Property') }}</a>
                                        </li>
                                       
                                </ul>
                            </div>
                </nav>
                
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (count($properties) >=1 )
                        <div class="table-responsive">
                        <table class="table table-striped">
                        <thead>
                            <th>Name</th>
                            <th>Location</th>
                            <th>Number of Units</th>
                            <th>Caretaker's Name</th>
                            <th>Description</th>
                            <th><small><small>Add <br>Unit</small></small></th>
                            <th><small><small>Add <br>Tenant</small></small></th>
                            <th><small>View</small></th>
                            <th><small>Edit</small></th>
                            {{--  <th><small>Delete</small></th>  --}}
                            
                        </thead>
                        <tbody>
                        @foreach ($properties as $property )
                        <tr>
                            <td>{{$property->name}}</td>
                            <td>{{$property->location}}</td>
                            <td>{{$property->number_of_units}}</td>
                            <td>{{$property->caretaker_name}}</td>
                            <td>{{$property->description}}</td>
                            
                            <td><small><a class="shadow-sm" href="{{ route('add-unit', ['id' => $property->id]) }}"><i class="fa fa-plus"></i></a></small></td>
                            <td><small><a class="text-secondary shadow-sm" href="{{ route('add-tenant', ['id' => $property->id]) }}"><i class="fa fa-user-plus"></i></a></small></td>
                            <td><small><a class="shadow-sm" href="properties/{{$property->id}}"><i class="fa fa-eye"></i></a></small></td>
                            <td><small><a class="text-success shadow-sm" href="properties/{{$property->id}}/edit"><i class="fa fa-pencil"></i></a></small></td>
                            {{--  <td><small>
                            <a class="text-danger shadow-sm" href="#" onclick="
                            var result= confirm('Confirm you wish to delete the {{$property->name}} property');
                            if(result){
                                event.preventDefault();
                                document.getElementById('delete-form').submit();
                            }
                            
                            ">                            
                            <i class="fa fa-close"></i>
                            </a></small>
                            <form id="delete-form" action="{{ route('properties.destroy',[$property->id])}}" method="POST" style="display:none;">
                            <input type="hidden" name="_method" value="delete"/>
                            {{ csrf_field() }}
                            </form>
                            </td>  --}}
                        </tr>
                            
                        @endforeach
                        </tbody>
                    @endif
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection