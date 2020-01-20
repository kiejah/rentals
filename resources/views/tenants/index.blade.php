@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary">
                
                <nav class="navbar navbar-expand-md navbar-dark bg-primary ">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <i class="fa fa-user"></i>&nbsp;Tenants
                        </a>
                       
                            <div class=" navbar-collapse">
                                <!-- Left Side Of Navbar -->
                                <ul class="navbar-nav mr-auto">
                                    
                                </ul>

                                <!-- Right Side Of Navbar -->
                                <ul class="navbar-nav ml-auto">
                                   
                                        <li class="nav-item">
                                            <a class="nav-link shadow-sm" href="/tenants/create">{{ __('New') }}&nbsp;&nbsp;<i class="fa fa-user-plus"></i></a>
                                        </li>
                                       
                                </ul>
                            </div>
                </nav>
                
                </div>

                <div class="card-body">
                 @if (isset($_GET['message'])!='')
                    <p class="alert text-danger">{{ $_GET['message'] }}</p>
                 @endif

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table-responsive table table-striped">
                        <thead>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>surname</th>
                            <th>Email</th>
                            <th>Phonenumber</th>
                            <th>Next of Kin Name</th>
                            <th>Next of Kin Email</th>
                            <th>In Property</th>
                            <th>House/Unit No</th>
                            <th><small>View</small></th>
                            <th><small>Edit</small></th>
                            <th><small>Delete</small></th>
                            
                        </thead>
                        <tbody>
                         @if (count($tenants) >=1 )
                        
                        @foreach ($tenants as $tenant )
                        
                            <td>{{$tenant->firstname}}</td>                          
                            <td>{{$tenant->lastname}}</td>                            
                            <td>{{$tenant->surname}}</td>                            
                            <td>{{$tenant->email}}</td>                            
                            <td>{{$tenant->phonenumber}}</td>                            
                            <td>{{$tenant->next_of_kin_name}}</td>                            
                            <td>{{$tenant->next_of_kin_phone}}</td>                            
                            <td>{{$tenant->property->name}}</td>                            
                            <td>{{$tenant->unit->unit_house_number}}</td>

                            <td><small><a href="#"><i class="fa fa-eye"></i></a></small></td>
                            <td><small><a class="text-success" href="tenants/{{$tenant->id}}/edit"><i class="fa fa-pencil"></i></a></small></td>
                            <td><small><a class="text-danger" href="#"><i class="fa fa-close"></i></a></small></td>
                        </tr>
                            
                        @endforeach
                        
                    @else
                        <tr>
                         <td colspan="5">No Tenants Yet</td>
                        </tr>
                    @endif
                    <tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
