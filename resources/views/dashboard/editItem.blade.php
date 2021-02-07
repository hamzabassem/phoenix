@extends('dashboard.layout.master')
@section('content')
    <div class="page-wrapper" style="width: 100%;
    margin-left: 0px;
    margin-top: -75px;

">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-7 align-self-center">
                    <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">{{Lang::get('site.Edit operation on this item')}}</h4>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb m-0 p-0">
                                <li class="breadcrumb-item"><a href="{{route('dashhome')}}" class="text-muted">{{Lang::get('site.Home')}}</a></li>
                                <li class="breadcrumb-item text-muted active" aria-current="page">{{Lang::get('site.Edit Operation')}}</li>
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
                            @foreach($item as $value)
                            <h4 class="card-title">{{$value->operation}} {{Lang::get('site.Item')}} </h4>
                            <form action="{{route('updateitem',['id' => $value->id])}}" method="post">
                                @csrf
                                <div class="form-body">
                                    <div class="row">
                                    </div>
                                    <div class="row">
                                        <div class="col-md-11">
                                            <div class="form-group">
                                                <label class="col-lg-3">{{Lang::get('site.Description')}}</label>
                                                <textarea class="form-control" name="description" placeholder="description" rows="3">{{$value->description}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-11">
                                            <div class="form-group">
                                                <label class="col-lg-3">{{Lang::get('site.quantity')}}</label>
                                                <input type="text" class="form-control" name="quantity" value="{{$value->quantity}}" placeholder="quantity">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-11">
                                            <div class="form-group">
                                                <label class="col-lg-3">{{Lang::get('site.storage')}}</label>
                                                <input type="text" class="form-control" name="storage" value="{{$value->storage}}" placeholder="storage place">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-11">
                                            <div class="form-group">
                                                <input type="hidden" class="form-control" value="{{$value->category_id}}" name="categoryid" >
                                            </div>
                                        </div>
                                        <div class="col-md-11">
                                            <div class="form-group">
                                                <input type="hidden" class="form-control" value="{{$value->operation}}" name="action" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-info">{{Lang::get('site.Submit')}}</button>
                                        <button type="reset" class="btn btn-dark">{{Lang::get('site.Reset')}}</button>
                                    </div>
                                </div>
                            </form>
                                @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
