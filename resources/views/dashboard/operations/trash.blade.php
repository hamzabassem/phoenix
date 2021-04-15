<?php $count = 0; ?>
@extends('dashboard.layout.master')
@section('content')
    <div class="page-wrapper" style="width: 100%;
    margin-left: 0px;
    margin-top: -75px;">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-7 align-self-center">
                    <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">{{Lang::get('site.Trash')}}</h4>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb m-0 p-0">
                                <li class="breadcrumb-item"><a href="{{route('dashhome')}}"
                                                               class="text-muted">{{Lang::get('site.Home')}}</a></li>
                                <li class="breadcrumb-item text-muted active"
                                    aria-current="page">{{Lang::get('site.Trash')}}</li>
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

                            <span class="card-title">{{Lang::get('site.Deleted Items')}}</span>


                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{Lang::get('site.id')}}</th>
                                    <th scope="col">{{Lang::get('site.Bill Number')}}</th>
                                    <th scope="col">{{Lang::get('site.operation')}}</th>
                                    <th scope="col">{{Lang::get('site.Description')}}</th>
                                    <th scope="col">{{Lang::get('site.quantity')}}</th>
                                    <th scope="col">{{Lang::get('site.Added By')}}</th>
                                    <th scope="col">{{Lang::get('site.created at')}}</th>
                                    <th scope="col">{{Lang::get('site.Edit')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $count = 0;
                                @endphp
                                @foreach($items as $value)
                                    @php $count++ @endphp
                                    <tr>
                                        <th scope="row">{{$count}}</th>
                                        @if($value->quantity > 0)
                                            <td>{{$value->import_bill}}</td>
                                            <td><h5>{{Lang::get('site.Import')}} <i
                                                        class=" fas fa-level-down-alt"></i></h5></td> @else
                                            <td>{{$value->export_bill}}</td>
                                            <td> <h5>{{Lang::get('site.Export')}} <i class="fas fa-level-up-alt"></i>
                                                </h5> @endif</td>
                                            <td>{{$value->description}}</td>
                                            <td>{{$value->quantity}}</td>
                                            <td>{{\App\User::findOrFail($value->user_id)->name}}</td>
                                            <td>{{$value->created_at}}</td>
                                            <td style="width: 120px;">

                                                <a class="ed" href="{{route('restorei',['id' => $value->id])}}">
                                                    <button id="button" type="button" class="btn btn-success"><i
                                                            class="fas fa-undo"></i>
                                                        <span class="tooltiptext">{{Lang::get('site.restore')}}</span>
                                                    </button>

                                                </a>

                                                <a class="de" href="{{route('deletei',['id' => $value->id])}}">
                                                    <button id="button" type="button" class="btn btn-danger"><i
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
                        <span style="margin-left: 25px" class="card-title">{{Lang::get('site.Deleted Categories')}}</span>
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{Lang::get('site.id')}}</th>
                                    <th scope="col">{{Lang::get('site.Name')}}</th>
                                    <th scope="col">{{Lang::get('site.Description')}}</th>
                                    <th scope="col">{{Lang::get('site.storage')}}</th>
                                    <th scope="col">{{Lang::get('site.buying price')}}</th>
                                    <th scope="col">{{Lang::get('site.selling')}}</th>
                                    <th scope="col">{{Lang::get('site.notify')}}</th>
                                    <th scope="col">{{Lang::get('site.created at')}}</th>
                                    <th scope="col">{{Lang::get('site.Edit')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $count = 0;
                                @endphp
                                @foreach($categories as $value)
                                    @php
                                        $count ++
                                    @endphp
                                    <tr>
                                        <th scope="row">{{$count}}</th>
                                        <td>{{$value->name}}</td>
                                        <td>{{$value->description}}</td>
                                        <td>{{$value->storage}}</td>
                                        <td>{{$value->buying_price}}</td>
                                        <td>{{$value->selling_price}}</td>
                                        <td>{{$value->notify}}</td>
                                        <td>{{$value->created_at}}</td>
                                        <td style="width: 120px;">
                                            <a class="ed" href="{{route('restorec', ['id' => $value->id])}}">
                                                <button type="button" class="btn btn-success"><i
                                                        class="fas fa-undo"></i>
                                                    <span class="tooltiptext">{{Lang::get('site.restore')}}</span>
                                                </button>
                                            </a>
                                            <a class="de" href="{{route('deletec', ['id' => $value->id])}}">
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
            <div style="margin-right: 30px" class="form-actions">
                <div class="text-right">
                    <a href="{{route('empty')}}">
                        <button id="button" type="button" class="btn btn-primary"><i class=" fas fa-level-down-alt"></i>
                            {{Lang::get('site.empty')}}</button>
                    </a>
                </div>
            </div>
            <br>

        </div>

    </div>

@endsection


