@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary">
                
                <nav class="navbar navbar-expand-md navbar-dark bg-primary ">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <i class="fa fa-building"></i>&nbsp;Accounts
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
                                            <a class="nav-link shadow-sm" href="accounts/pdf"><i class="fa fa-print"></i>&nbsp;&nbsp;{{ __('Pdf') }}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link shadow-sm" href="{{route('print-excel')}}"><i class="fa fa-print"></i>&nbsp;&nbsp;{{ __('excel') }}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link shadow-sm" href="accounts/create"><i class="fa fa-plus"></i>&nbsp;&nbsp;{{ __('New') }}</a>
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
                    @if (count($tnt_accounts) >=1 )
                        <div class="table-responsive">
                        <table class="table table-striped">
                        <thead>
                          <tr>
                            <th class="text-success"><i class="fa fa-window-restore"></i></th>
                              <th>House/Unit</th>
                              <th>Tenant</th>
                              <th>Rent</th>
                              <th>Last Payment Made</th>
                              <th>Date</th>
                              <th>Payment Mode </th>
                              <th>Receipt No/Mpesa ID </th>
                              <th>Debit/Credit Bal</th>
                              <th>payments Made-by</th>
                              <th><small>History</small></th>
                              <th><small>Edit</small></th>
                              <th><small>Delete</small></th>
                          </tr>
                      </thead>
                        <tbody>
                       @foreach($tnt_accounts as $ta)
                            <tr>
                                <td>
                                {{-- unit account history {{route('unit-account-history', $ta->unit->id)}} --}}
                                <a href="#"><i class="fa fa-history"></i></a>
                                </td>
                                <td>
                                {{-- unit account details {{route('unit-account-details', $ta->unit->id)}} --}}
                                <a href="#">{{$ta->unit->unit_house_number}}</a><br><small>{{$ta->property->name}}</small>
                                </td>
                                <td>
                                {{-- Unit Tenant details {{route('unit-tenant-details', $ta->tenant->id)}} --}}
                                <a href="#">{{$ta->tenant->firstname}}&nbsp;{{$ta->tenant->lastname}}&nbsp;{{$ta->tenant->surname}}</a>
                                </td>


                                <td>{{$ta->unit->rent_charge}}</td>
                                <td>{{$ta->amt_payed}}</td>
                                <td>{{ date('F, Y', strtotime($ta->updated_at))}}<br><small><small>({{$ta->updated_at}})</small></small></td>
                                <td>{{$ta->pymt_mode->name}}</td>
                                <td>{{$ta->payment_mode_value}}</td>
                                <td>{{$ta->balance_bf}}</td>
                                <td>{{$ta->payment_made_by}}</td></small>
                                {{-- view transaction his--}}
                                <td><small><a href="{{ route('accounts.show', $ta->id)}}"><i class="fa fa-eye"></i></a></small></td>
                                <td><small><a class="text-success" href="{{ route('accounts.edit', $ta->id)}}"><i class="fa fa-pencil"></i></a></small></td>
                                <td><small><a class="text-danger" href="{{ route('accounts.destroy', $ta->id)}}"><i class="fa fa-close"></i></a></small></td>
                                
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

@endsection