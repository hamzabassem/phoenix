@extends('dashboard.layout.master')
@section('content')
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
                    <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">{{Lang::get('site.employee Info')}}</h4>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb m-0 p-0">
                                <li class="breadcrumb-item"><a href="{{route('dashhome')}}"
                                                               class="text-muted">{{Lang::get('site.Home')}}</a></li>
                                <li class="breadcrumb-item text-muted active"
                                    aria-current="page">{{Lang::get('site.employee Info')}}</li>
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
                            <h4 class="card-title">{{Lang::get('site.employee Info')}}</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{Lang::get('site.id')}}</th>
                                    <th scope="col">{{Lang::get('site.Name')}}</th>
                                    <th scope="col">{{Lang::get('site.Email')}}</th>
                                    <th scope="col">{{Lang::get('site.Phone number')}}</th>
                                    <th scope="col">{{Lang::get('site.level')}}</th>
                                    <th scope="col">{{Lang::get('site.state')}}</th>
                                    <th scope="col">{{Lang::get('site.created at')}}</th>
                                    <th scope="col">{{Lang::get('site.Edit')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $count = 0;
                                @endphp
                                @foreach($employees as $value)
                                    @php
                                        $count ++
                                    @endphp
                                    <tr>
                                        <th scope="row">{{$count}}</th>
                                        <td>{{$value->name}}</td>
                                        <td>{{$value->email}}</td>
                                        <td>{{$value->phone}}</td>
                                        @if($value->level == 2)
                                            <td>{{Lang::get('site.Store Manager')}}</td>
                                            @elseif($value->level == 3)
                                            <td>{{Lang::get('site.Selling Manager')}}</td>
                                            @else
                                            <td>{{Lang::get('site.Buying Manager')}}</td>
                                        @endif
                                        @if($value->state == 1)
                                        <td style="color: rgba(0,128,0,0.8)">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle-fill" viewBox="0 0 16 16">
                                                <circle cx="8" cy="8" r="8"/>
                                            </svg>
                                            {{Lang::get('site.Online')}}
                                        </td>
                                            @else
                                            <td>
                                                <svg style="color: rgba(110,0,0,0.8)" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle-fill" viewBox="0 0 16 16">
                                                    <circle cx="8" cy="8" r="8"/>
                                                </svg>
                                                {{Lang::get('site.Active')}} {{$value->updated_at->diffForHumans()}}
                                            </td>
                                        @endif
                                        <td>{{$value->created_at}}</td>
                                        <td style="width: 120px;">
                                            <a class="ed" href="{{route('editemployee', ['id' => $value->id])}}">
                                                <button type="button" class="btn btn-success"><i
                                                        class=" fas fa-pencil-alt"></i>
                                                    <span class="tooltiptext">{{Lang::get('site.Edit')}}</span>
                                                </button>
                                            </a>
                                            <a class="de" href="{{route('deleteemployee', ['id' => $value->id])}}">
                                                <button type="button" class="btn btn-danger"><i
                                                        class="fas fa-trash-alt"></i>
                                                    <span class="tooltiptext">{{Lang::get('site.Delete')}}</span>
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
