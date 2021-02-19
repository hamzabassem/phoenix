@extends('dashboard.manager.managerMaster')
@section('managercontent')
    <div class="page-wrapper" style="width: 100%;
    margin-left: 0px;
    margin-top: -75px;"
    >
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-7 align-self-center">
                    <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">
                        Manager {{auth()->user()->name}}</h4>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb m-0 p-0">
                                <li class="breadcrumb-item"><a href="{{route('manager')}}" class="text-muted">Home</a>
                                </li>
                                <li class="breadcrumb-item text-muted active" aria-current="page">Manager</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="col-5 align-self-center">
                    <div class="customize-input float-right">
                        <select
                            class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius">
                            <option selected>{{date('Y-m-d')}}</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            @include('dashboard.layout.messages')
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Users Information</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">email</th>
                                    <th scope="col">phone</th>
                                    <th scope="col">lang</th>
                                    <th scope="col">days</th>
                                    <th scope="col">created at</th>
                                    <th scope="col">edit</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $value)
                                    <tr>
                                        <th scope="row">{{$value->id}}</th>
                                        <td>{{$value->name}}</td>
                                        @if($value->days == -1)
                                            <td style="color: darkred">{{$value->email}}</td>
                                        @else
                                            <td>{{$value->email}}</td>
                                        @endif
                                        <td>{{$value->phone}}</td>
                                        <td>{{$value->lang}}</td>
                                        <td>{{$value->days}}</td>
                                        <td>{{$value->created_at}}</td>
                                        <td>
                                            <a href="{{route('deleteuser', ['id' => $value->id])}}">
                                                <button type="button" class="btn btn-danger"><i
                                                        class="fas fa-trash-alt"></i>
                                                    Delete
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div style="margin-right: 30px" class="form-actions">
                        <div class="text-right">
                            <a href="{{route('addmanager')}}">
                                <button id="button" type="button" class="btn btn-primary"><i></i>
                                    Add Manager
                                </button>
                            </a>
                        </div>
                    </div>
                    <br>
                    {{$users->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
