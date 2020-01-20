@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary">
                
                <nav class="navbar navbar-expand-md navbar-dark bg-primary">
                    
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <i class="fa fa-bank"></i>&nbsp;{{ __('Make New Payment') }}
                        </a>
                                <div class="navbar-collapse">
                                <!-- Left Side Of Navbar -->
                                <ul class="navbar-nav mr-auto">
                                     
                                </ul>

                                <!-- Right Side Of Navbar -->
                                <ul class="navbar-nav ml-auto">
                                   
                                        <li class="nav-item">
                                            <a class="nav-link shadow-sm" href="/accounts"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;{{ __('Back') }}</a>
                                        </li>
                                       
                                </ul>
                            </div>
                    </nav>
                
                </div>

                <div class="card-body">
                <form method="POST" action="{{action('TenantAccountsController@store') }}">
                        @csrf
                        <div class="row">
                        <div class="col-md-10">

                        <div class="form-group row">
                            <label for="in_property_id" class="col-md-4 col-form-label text-md-left">{{ __('In Property') }}</label>

                            <div class="col-md-8">
                                <select class="form-control" name="in_property_id" id="in_property_id" class="form-control @error('in_property_id') is-invalid @enderror" onChange="withProperty()">
                                    <option value='select'>--Select Property</option>
                                 @foreach ($properties as $property )
                                     <option value="{{$property->id}}">{{$property->name}}</option>
                                 @endforeach
                                  </select>

                                @error('in_property_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="in_unit_id" class="col-md-4 col-form-label text-md-left">{{ __('In Unit') }}</label>

                            <div class="col-md-8" id="inUnitContent">
                                

                               
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="monthly_rent" class="col-md-4 col-form-label text-md-left">{{ __('Monthly Rent') }}</label>

                            <div class="col-md-8">
                                <input id="monthly_rent" type="text" class="form-control @error('monthly_rent') is-invalid @enderror" name="monthly_rent" value="{{ old('monthly_rent') }}" required autocomplete="monthly_rent" onClick="getRentAmmount()" readonly>

                                @error('monthly_rent')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="balance_bf" class="col-md-4 col-form-label text-md-left">{{ __('Balance Brought Forward') }}</label>

                            <div class="col-md-8">
                                <input id="balance_bf" type="text" class="form-control @error('balance_bf') is-invalid @enderror" name="balance_bf" required autocomplete="balance_bf" readonly value='0'>

                                @error('balance_bf')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row" style="display:none">
                            <label for="balance_cf" class="col-md-4 col-form-label text-md-left">{{ __('Balance Carried Forward') }}<br>(<small>inexcess payed previously</small>)</label>

                            <div class="col-md-8">
                                <input id="balance_cf" type="text" class="form-control @error('balance_cf') is-invalid @enderror" name="balance_cf" value="0" required autocomplete="balance_cf" readonly />

                                @error('balance_cf')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="amt_payable" class="col-md-4 col-form-label text-md-left">{{ __('Amount Payable') }}</label>

                            <div class="col-md-8">
                                <input id="amt_payable" type="text" class="form-control @error('amt_payable') is-invalid @enderror" name="amt_payable" value="{{ old('amt_payable') }}" required autocomplete="amt_payable" onClick="getAmtPayable()" >

                                @error('amt_payable')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="amt_payed" class="col-md-4 col-form-label text-md-left">{{ __('Amount Payed') }}</label>

                            <div class="col-md-8">
                                <input id="amt_payed" type="text" class="form-control @error('amt_payed') is-invalid @enderror" name="amt_payed" value="{{ old('amt_payed') }}" required autocomplete="amt_payed">
                                @error('amt_payed')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="payment_mode" class="col-md-4 col-form-label text-md-left">{{ __('Payment Mode') }}</label>

                            <div class="col-md-8">
                                <select class="form-control" name="payment_mode" id="payment_mode" class="form-control @error('payment_mode') is-invalid @enderror" onChange="paymentMode()">
                                    <option value=''>--Select Payment Mode</option>
                                 @foreach ($payment_modes as $pm )
                                     <option value="{{$pm->id}}">{{$pm->name}}</option>
                                 @endforeach
                                  </select>

                                @error('payment_mode')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row" id="PaymentMode">
                            
                        </div>
                        
                        
                        <div class="form-group row">
                            <label for="payment_made_by" class="col-md-4 col-form-label text-md-left">{{ __('Payment Made By') }}</label>

                            <div class="col-md-4">
                                <input id="payment_made_by" type="text" class="form-control @error('payment_made_by') is-invalid @enderror" name="payment_made_by" value="{{ old('payment_made_by') }}" required autocomplete="payment_made_by" />

                                @error('payment_made_by')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <label for="payment_made_by_phonenumber" class="col-md-2 col-form-label text-md-left">{{ __('Phonenumber') }}</label>

                            <div class="col-md-2">
                                <input id="payment_made_by_phonenumber" type="text" class="form-control @error('payment_made_by_phonenumber') is-invalid @enderror" name="payment_made_by_phonenumber" value="{{ old('payment_made_by_phonenumber') }}" autocomplete="payment_made_by_phonenumber" />

                                @error('payment_made_by')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            
                        </div>
                        <div class="form-group row">
                            <label for="date_payed" class="col-md-4 col-form-label text-md-left">{{ __('Date Payed') }}</label>

                            <div class="col-md-8">
                                <input id="date_payed" type="date" class="form-control @error('date_payed') is-invalid @enderror" name="date_payed" value="{{ old('date_payed') }}" required autocomplete="date_payed" />

                                @error('date_payed')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
