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
                    <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">{{Lang::get('site.Edit Category')}}</h4>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb m-0 p-0">
                                <li class="breadcrumb-item"><a href="{{route('dashhome')}}" class="text-muted">{{Lang::get('site.Home')}}</a></li>
                                <li class="breadcrumb-item text-muted active" aria-current="page">{{Lang::get('site.Add New')}}</li>
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
                            <h4 class="card-title">{{Lang::get('site.Category Info')}}</h4>
                            @foreach($category as $value)
                            <form action="{{route('updatecategory',['id' => $value->id])}}" method="post">
                                @csrf

                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-11">
                                            <div class="form-group">
                                                <label class="col-lg-1">{{Lang::get('site.Name')}}</label>
                                                <input type="text" name="name" value="{{$value->name}}" class="form-control" placeholder="{{Lang::get('site.')}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-11">
                                            <div class="form-group">
                                                <label class="col-lg-3">{{Lang::get('site.Description')}}</label>
                                                <textarea class="form-control" name="description"  placeholder="{{Lang::get('site.')}}" rows="3">{{$value->description}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-11">
                                            <div class="form-group">
                                                <label class="col-lg-3">{{Lang::get('site.buying price')}}</label>
                                                <input type="text" class="form-control" name="buying_price" value="{{$value->buying_price}}" placeholder="{{Lang::get('site.')}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-11">
                                            <div class="form-group">
                                                <label class="col-lg-3">{{Lang::get('site.Selling')}}</label>
                                                <input type="text" class="form-control" name="selling_price" value="{{$value->selling_price}}" placeholder="{{Lang::get('site.')}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-11">
                                            <div class="form-group">
                                                <label class="col-lg-3">{{Lang::get('site.Notify me when less than')}}</label>
                                                <input type="text" class="form-control" name="notify" value="{{$value->notify}}" placeholder="{{Lang::get('site.')}}">
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
