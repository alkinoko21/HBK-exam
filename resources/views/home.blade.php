@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card"><!-- 
                <div class="card-header">
                    <span class="font-weight-bold align-middle">{{ __('List of Companies') }}</span>
                </div> -->

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        <a class="col-sm-6" href="{{ url('company_list') }}">
                            <div class="card1">
                              <div class="container1">
                                <h4><b>Company</b></h4>
                                <p>View Company List</p>
                              </div>
                            </div>
                        </a>
                        <a class="col-sm-6" href="{{ url('company_list') }}">
                            <div class="card1">
                              <div class="container1">
                                <h4><b>Employee</b></h4>
                                <p>View Employee List</p>
                              </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
