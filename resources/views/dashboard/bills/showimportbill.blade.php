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
                    <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">{{Lang::get('site.Import Bills')}}</h4>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb m-0 p-0">
                                <li class="breadcrumb-item"><a href="{{route('dashhome')}}"
                                                               class="text-muted">{{Lang::get('site.Home')}}</a></li>
                                <li class="breadcrumb-item text-muted active"
                                    aria-current="page">{{Lang::get('site.Bill info')}}</li>
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
                            <h4 class="card-title">{{Lang::get('site.Bill Information')}}</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{Lang::get('site.id')}}</th>
                                    <th scope="col">{{Lang::get('site.Bill Number')}}</th>
                                    <th scope="col">{{Lang::get('site.Description')}}</th>
                                    <th scope="col">{{Lang::get('site.quantity')}}</th>
                                    <th scope="col">{{Lang::get('site.total price')}}</th>
                                    <th scope="col">{{Lang::get('site.Delivered')}}</th>
                                    <th scope="col">{{Lang::get('site.Added By')}}</th>
                                    <th scope="col">{{Lang::get('site.created at')}}</th>
                                    {{--<th scope="col">{{Lang::get('site.Edit')}}</th>--}}
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $count = 0;
                                @endphp
                                @foreach($import->unique('bill_number') as $value)
                                    @php
                                        $count ++
                                    @endphp
                                    <tr>
                                        <th scope="row">{{$count}}</th>
                                        <td>
                                            <a href="{{route('ibillinfo', ['id' => $value->bill_number])}}">{{$value->bill_number}}</a>
                                        </td>
                                        <td>{{$value->description}}</td>
                                        <td>{{\App\EmportBill::where('bill_number', $value->bill_number)->sum('quantity')}}</td>
                                        <td>@php $bill = \App\EmportBill::where('bill_number', $value->bill_number)->get();
                                                $total = 0;
                                                foreach ($bill as $bvalue){
                                                    $total = $total + $bvalue->quantity * (\App\Category::findOrFail($bvalue->category_id)->buying_price);
                                                }

                                            @endphp {{$total}}</td>
                                        @if($value->processing == 0)
                                            <td>{{Lang::get('site.Not Yet')}}</td>
                                        @elseif($value->processing == 2)
                                            <td>Rejected</td>
                                        @else
                                            <td>{{Lang::get('site.Yes')}}</td>
                                        @endif
                                        <td>{{\App\User::findOrFail($value->user_id)->name}}</td>
                                        <td>{{$value->created_at}}</td>
                                        {{--<td><a href="{{route('editcategory', ['id' => $value->id])}}">
                                                <button type="button" class="btn btn-success"><i
                                                        class=" fas fa-pencil-alt"></i>
                                                    {{Lang::get('site.Edit')}}</button>
                                            </a>
                                            <a href="{{route('deletecategory', ['id' => $value->id])}}">
                                                <button type="button" class="btn btn-danger"><i
                                                        class="fas fa-trash-alt"></i>
                                                    {{Lang::get('site.Delete')}}</button>
                                            </a>
                                        </td>--}}
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{$import->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
