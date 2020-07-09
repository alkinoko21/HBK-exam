@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <span class="font-weight-bold align-middle">{{ $company[0]->name }} Employees</span>
                    <a href="{{ url('add_employee/'.$com_id) }}">
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
                                <td>First Name</td>
                                <td>Last Name</td>
                                <td>Email</td>
                                <td>Contact</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($data) == 0)
                                <tr><td colspan="6" class="text-center">No Records Found!</td><tr>
                            @else
                                @foreach ($data as $d)
                                    <tr>
                                        <td>{{ $d->fname }}</td>
                                        <td>{{ $d->lname }}</td>
                                        <td>{{ $d->email }}</td>
                                        <td>{{ $d->phone }}</td>
                                        <td data-id="{{$d->emp_id}}" data-token="{{ csrf_token() }}" data-entity="employee">
                                            <a href="{{ url('modify_employee/'.$d->emp_id) }}">
                                                <span class="btn btn-success">Edit</span>
                                            </a>
                                            <span class="btn btn-danger rem_tr">Delete</span>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <span class="float-right">{{ $data->links() }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
