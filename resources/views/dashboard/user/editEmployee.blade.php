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
                    <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">{{Lang::get('site.Edit employee Info')}}</h4>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb m-0 p-0">
                                <li class="breadcrumb-item"><a href="{{route('dashhome')}}"
                                                               class="text-muted">{{Lang::get('site.Home')}}</a></li>
                                <li class="breadcrumb-item text-muted active"
                                    aria-current="page">{{Lang::get('site.Edit employee Info')}}</li>
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
                            @foreach($employee as $value)
                            <form action="{{route('updateemployee',['id' => $value->id])}}" method="post">
                                @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-11">
                                                <div class="form-group">
                                                    <label class="col-lg-1">{{Lang::get('site.Name')}}</label>
                                                    <input type="text" value="{{$value->name}}" name="name"
                                                           class="form-control" placeholder="Name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-11">
                                                <div class="form-group">
                                                    <label class="col-lg-3">{{Lang::get('site.Email')}}</label>
                                                    <input class="form-control" value="{{$value->email}}" name="email"
                                                           placeholder="email" rows="3">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-11">
                                                <div class="form-group">
                                                    <label class="col-lg-3">{{Lang::get('site.Phone number')}}</label>
                                                    <input type="text" class="form-control" value="{{$value->phone}}"
                                                           name="phone" placeholder="Phone number">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-11">
                                                <label class="col-lg-3">{{Lang::get('site.level')}}</label>
                                                <div class="input-group">
                                                    <select name="level" class="custom-select" id="inputGroupSelect04">
                                                        @if($value->level == 2)
                                                            <option value="2">{{Lang::get('site.Store Manager')}}</option>
                                                            @elseif($value->level == 3)
                                                            <option value="3">{{Lang::get('site.Selling Manager')}}</option>
                                                            @else
                                                            <option value="4">{{Lang::get('site.Buying Manager')}}</option>
                                                        @endif
                                                        <option value="2">{{Lang::get('site.Store Manager')}}</option>
                                                        <option value="3">{{Lang::get('site.Selling Manager')}}</option>
                                                        <option value="4">{{Lang::get('site.Buying Manager')}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div><br>
                                    <div class="form-actions">
                                        <div class="text-right">
                                            <button type="submit"
                                                    class="btn btn-info">{{Lang::get('site.Submit')}}</button>
                                            <button type="reset"
                                                    class="btn btn-dark">{{Lang::get('site.Reset')}}</button>
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
