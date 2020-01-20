@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary">
                
                <nav class="navbar navbar-expand-md navbar-dark bg-primary ">
                        <a class="navbar-brand" href="{{ route('units.index') }}">
                            <i class="fa fa-trello"></i>&nbsp;Units
                        </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <!-- Left Side Of Navbar -->
                                <ul class="navbar-nav mr-auto">
                                   <li class="nav-item">
                                            <a title="Show all Vacant Units" class="nav-link shadow-sm" href="{{route('vacant-units')}}"><i class="fa fa-unlock-alt"></i>&nbsp;{{ __('Vacant') }}</a>
                                        </li>
                                    <li class="nav-item">
                                            <a title="Show all Occupied Units" class="nav-link shadow-sm" href="{{route('occupied-units')}}"><i class="fa fa-lock"></i>&nbsp;{{ __('Occupied') }}</a>
                                        </li>

                                </ul>

                                <!-- Right Side Of Navbar -->
                                <ul class="navbar-nav ml-auto">
                                   
                                        <li class="nav-item">
                                            <a title="Add New Unit" class="nav-link shadow-sm bg-secondary" href="units/create">{{ __('New') }}&nbsp;&nbsp;<i class="fa fa-plus-square"></i></a>
                                        </li>
                                       
                                </ul>
                            </div>
                </nav>
                
                </div>

                <div class="card-body">
                 @if (isset($_GET['message'])!='')
                    <p class="alert text-primary">{{ $_GET['message'] }}</p>
                 @endif

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                   
                        @include('units.table')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection