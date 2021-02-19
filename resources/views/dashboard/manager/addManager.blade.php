@extends('dashboard.manager.managerMaster')
@section('managercontent')
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
                    <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">{{Lang::get('site.Edit My Info')}}</h4>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb m-0 p-0">
                                <li class="breadcrumb-item"><a href="{{route('manager')}}" class="text-muted">{{Lang::get('site.Home')}}</a></li>
                                <li class="breadcrumb-item text-muted active" aria-current="page">{{Lang::get('site.Edit My Info')}}</li>
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
                            <h4 class="card-title">{{Lang::get('site.My Info')}}</h4>
                            <form action="{{route('storemanager')}}" method="post">
                                @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-11">
                                                <div class="form-group">

                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" value="en" id="customRadio1" name="lang"
                                                                   class="custom-control-input">
                                                            <label class="custom-control-label" for="customRadio1">English</label>
                                                        </div>
                                                        <div  class="custom-control custom-radio">
                                                            <input value="ar" type="radio" id="customRadio2" name="lang"
                                                                   class="custom-control-input">
                                                            <label class="custom-control-label" for="customRadio2">عربي</label>
                                                        </div>
                                                </div>


                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-11">
                                                <div class="form-group">
                                                    <label class="col-lg-1">{{Lang::get('site.Name')}}</label>
                                                    <input type="text"  name="name" class="form-control" placeholder="Name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-11">
                                                <div class="form-group">
                                                    <label class="col-lg-3">{{Lang::get('site.Email')}}</label>
                                                    <input class="form-control"  name="email" placeholder="email" rows="3">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-11">
                                                <div class="form-group">
                                                    <label class="col-lg-3">{{Lang::get('site.Phone number')}}</label>
                                                    <input type="text" class="form-control"  name="phone" placeholder="Phone number">
                                                    <input type="hidden" class="form-control" value="-1"  name="days" placeholder="Phone number">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-11">
                                                <div class="form-group">
                                                    <label class="col-lg-3">{{Lang::get('site.Password')}}</label>
                                                    <input type="password" class="form-control" name="password" placeholder="Password">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
