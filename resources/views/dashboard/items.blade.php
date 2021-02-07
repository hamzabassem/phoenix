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
                    <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">{{Lang::get('site.Items Informations')}}</h4>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb m-0 p-0">
                                <li class="breadcrumb-item"><a href="{{route('dashhome')}}" class="text-muted">{{Lang::get('site.Home')}}</a></li>
                                <li class="breadcrumb-item text-muted active" aria-current="page">{{$category->name}}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="col-5 align-self-center">
                    <div class="customize-input float-right">
                        <select class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius">
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
                            <span class="card-title">{{Lang::get('site.Total Items')}} <span class="badge badge-pill badge-primary">( {{$quantity}} )</span></span>
                            <span class=" card-title">{{Lang::get('site.Category')}} <span class="badge badge-pill badge-primary"> {{$category->name}} </span></span>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{Lang::get('site.id')}}</th>
                                    <th scope="col">{{Lang::get('site.operation')}}</th>
                                    <th scope="col">{{Lang::get('site.Description')}}</th>
                                    <th scope="col">{{Lang::get('site.quantity')}}</th>
                                    <th scope="col">{{Lang::get('site.storage')}}</th>
                                    <th scope="col">{{Lang::get('site.created at')}}</th>
                                    <th scope="col">{{Lang::get('site.Edit')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($items as $value)
                                    <tr>
                                        <th scope="row">{{$value->id}}</th>
                                        <td>@if($value->quantity > 0)<h5>{{Lang::get('site.Import')}} <i class=" fas fa-level-down-alt"></i></h5> @else<h5>{{Lang::get('site.Export')}} <i class="fas fa-level-up-alt"></i></h5> @endif</td>
                                        <td>{{$value->description}}</td>
                                        <td>{{$value->quantity}}</td>
                                        <td>{{$value->storage}}</td>
                                        <td>{{$value->created_at}}</td>
                                        <td><a href="{{route('edititem',['id' => $value->id])}}"><button type="button" class="btn btn-success"><i class=" fas fa-pencil-alt"></i>
                                                    {{Lang::get('site.Edit')}}</button></a>
                                            <a href="{{route('deleteitem',['id' => $value->id])}}"><button type="button" class="btn btn-danger"><i class="fas fa-trash-alt"></i>
                                                    {{Lang::get('site.Delete')}}</button></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <br>

                        </div>
                    </div>
                </div>
            </div>
            <div style="margin-right: 30px" class="form-actions">
                <div class="text-right">
                    <a href="{{route('operation',['id' => $category->id,'action' =>'import'])}}"><button type="button" class="btn btn-primary"><i class=" fas fa-level-down-alt"></i>
                            {{Lang::get('site.Import')}}</button></a>
                    <a href="{{route('operation',['id' => $category->id,'action' =>'export'])}}">
                        <button type="button" class="btn btn-dark"><i class="fas fa-level-up-alt"></i>
                            {{Lang::get('site.Export')}}</button></a>
                </div>
            </div><br>

            {{$items->links()}}
        </div>

    </div>

@endsection
