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
                            <h4 class="card-title">{{Lang::get('site.Bill Number')}} {{$id}}</h4>
                        </div>
                        <div class="table-responsive">
                            <table id="countit" class="table">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{Lang::get('site.id')}}</th>
                                    <th scope="col">{{Lang::get('site.Category Name')}}</th>
                                    <th scope="col">{{Lang::get('site.Category Number')}}</th>
                                    <th scope="col">{{Lang::get('site.price')}}</th>
                                    <th scope="col">{{Lang::get('site.quantity')}}</th>
                                    <th scope="col">{{Lang::get('site.total price')}}</th>
                                    <th scope="col">{{Lang::get('site.Delivered')}}</th>
                                    <th scope="col">{{Lang::get('site.Added By')}}</th>
                                    <th scope="col">{{Lang::get('site.Description')}}</th>
                                    <th scope="col">{{Lang::get('site.created at')}}</th>
                                    {{--<th scope="col">{{Lang::get('site.Edit')}}</th>--}}
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $count = 0;
                                @endphp
                                @foreach($import as $value)
                                    @php
                                        $count ++
                                    @endphp
                                    <tr>
                                        <th scope="row">{{$count}}</th>
                                        <td>{{\App\Category::findOrFail($value->category_id)->name}}</td>
                                        <td>{{$value->category_id}}</td>
                                        <td>{{\App\Category::findOrFail($value->category_id)->buying_price}}</td>
                                        <td>{{$value->quantity}}</td>
                                        <td class="count-me">{{\App\Category::findOrFail($value->category_id)->buying_price * $value->quantity}}</td>
                                        @if($value->processing == 0)
                                            <td>{{Lang::get('site.Not Yet')}}</td>
                                        @elseif($value->processing == 2)
                                            <td>Rejected</td>
                                        @else
                                            <td>{{Lang::get('site.Yes')}}</td>
                                        @endif
                                        <td>{{\App\User::findOrFail($value->user_id)->name}}</td>
                                        <td>{{$value->description}}</td>
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
    <script language="javascript" type="text/javascript">
        var tds = document.getElementById('countit').getElementsByTagName('td');
        var sum = 0;
        for (var i = 0; i < tds.length; i++) {
            if (tds[i].className == 'count-me') {
                sum += isNaN(tds[i].innerHTML) ? 0 : parseInt(tds[i].innerHTML);
            }
        }
        document.getElementById('countit').innerHTML += '<tr><td>total</td><td>' + sum + '</td></tr>';
    </script>
@endsection
