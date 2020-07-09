@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <span class="font-weight-bold align-middle">{{ __('List of Companies') }}</span>
                    <a href="{{ url('add_company') }}">
                        <span class="btn btn-primary float-right">+</span>
                    </a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class='table'>
                        <thead>
                            <tr>
                                <td>Company</td>
                                <td>Email</td>
                                <td>Website</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($comps) == 0)
                                <tr><td colspan="6" class="text-center">No Records Found!</td><tr>
                            @else
                                @foreach ($comps as $comp)
                                    <tr>
                                        <td>{{ $comp->name }}</td>
                                        <td>{{ $comp->email }}</td>
                                        <td>{{ $comp->website }}</td>
                                        <td data-id="{{$comp->com_id}}" data-token="{{ csrf_token() }}" data-entity="company">
                                            <a href="{{ url('modify_company/'.$comp->com_id) }}">
                                                <span class="btn btn-success">Edit</span>
                                            </a>
                                            <a href="{{ url('view_company_emplyees/'.$comp->com_id) }}">
                                                <span class="btn btn-primary">Employee List</span>
                                            </a>
                                            <span class="btn btn-danger rem_tr">Delete</span>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <span class="float-right">{{ $comps->links() }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
