@extends('dashboard.layout.master')
@section('content')
    <style>
        .removes_buttons {
            margin-top: 37px;
            height: 30px;
        }

        .remove_button {
            margin-top: 37px;
            width: 60px;
            height: 30px;

        }
    </style>

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
                    <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">{{Lang::get('site.Add New Export bill')}}</h4>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb m-0 p-0">
                                <li class="breadcrumb-item"><a href="{{route('dashhome')}}"
                                                               class="text-muted">{{Lang::get('site.Home')}}</a></li>
                                <li class="breadcrumb-item text-muted active"
                                    aria-current="page">{{Lang::get('site.Add New')}}</li>
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
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            @include('dashboard.layout.messages')
            <form method="post" action="{{route('storeexport')}}">
                @csrf
                <div class="field_wrapper">
                    <a href="javascript:void(0);"
                       class="add_button  btn btn-success mb-4"> add new
                    </a>



                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>description</label>
                                <input type="text" name="description[]" value="{{ old('description[]') }}"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>quantity</label>
                                <input type="text" name="quantity[]" value="{{ old('quantity[]') }}"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>customer</label>
                                <div class="input-group">
                                    <select name="customer_id[]" class="custom-select" id="inputGroupSelect04">
                                        <option selected>customer</option>
                                        @foreach($customer as $value)
                                            <option
                                                value="{{$value->id}}">{{$value->name}}</option>

                                        @endforeach
                                    </select>
                                    <div class="input-group-append">
                                        <a href="{{route('addcustomer')}}" style="color: white" class="btn btn-success" type="button">Add New
                                        </a>
                                    </div>
                                </div>
                                {{--<label>supplier</label>
                                <input type="text" name="supplier[]" value="{{ old('job[]') }}"  class="form-control" >--}}
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>category</label>
                                <div class="input-group">
                                    <select name="category_id[]" class="custom-select" id="inputGroupSelect04">
                                        <option selected>category</option>
                                        @foreach($categories as $value)
                                            <option
                                                value="{{$value->id}}">{{$value->name}}</option>

                                        @endforeach
                                    </select>
                                    <div class="input-group-append">
                                        <a href="{{route('addcategory')}}" style="color: white" class="btn btn-success" type="button">Add New
                                        </a>
                                    </div>
                                </div>
                                {{--<label>category</label>
                                <input type="text" name="category[]" value="{{ old('phone_number[]') }}"  class="form-control" >--}}
                            </div>
                        </div>

                        <a href='' class='removes_buttons btn btn-danger btn-sm '>delete</a>

                    </div>


                </div>
                <div class="form-actions" >
                    <div class="text-right">
                        <button type="submit" class="btn btn-info">{{Lang::get('site.Submit')}}</button>
                        <button type="reset" class="btn btn-dark">{{Lang::get('site.Reset')}}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script type="text/javascript">
            $(document).ready(function () {
                var maxField = 50; //Input fields increment limitation
                var addButton = $('.add_button'); //Add button selector
                var wrapper = $('.field_wrapper'); //Input field wrapper

                var fieldHTML = "<hr><div class='row'>" +
                    "<div class='col-md-2'><div class='form-group'><label>description</label><input  type='text' name='description[]'  class='form-control '></div></div>" +
                    "<div class='col-md-2'><div class='form-group'><label>quantity</label><input type='text' name='quantity[]'  class='form-control' ></div></div>" +
                    "<div class='col-md-3'><div class='form-group'><label>customer</label><select name='customer_id[]' class=\"custom-select\" id=\"inputGroupSelect04\">\n" +
                    "                                    <option selected>customer</option>\n" +
                    "                                    @foreach($customer as $value)\n" +
                    "                                        <option \n" +
                    "                                                value=\"{{$value->id}}\">{{$value->name}}</option>\n" +
                    "\n" +
                    "                                    @endforeach\n" +
                    "                                </select></div></div>" +
                    "<div class='col-md-3'><div class='form-group'><label>category</label><select name='category_id[]' class=\"custom-select\" id=\"inputGroupSelect04\">\n" +
                    "                                    <option selected>category</option>\n" +
                    "                                        @foreach($categories as $value)\n" +
                    "                                            <option \n" +
                    "                                                    value=\"{{$value->id}}\">{{$value->name}}</option>\n" +
                    "\n" +
                    "                                        @endforeach\n" +
                    "                                </select></div></div>" +
                    "<a  href='javascript:void(0);' class='remove_button  btn btn-danger btn-sm' >delete</a></div></div>";

                var x = 1; //Initial field counter is 1

                //Once add button is clicked
                $(addButton).click(function () {
                    //Check maximum number of input fields
                    if (x < maxField) {
                        x++; //Increment field counter
                        $(wrapper).append(fieldHTML).fadeIn(300); //Add field html

                    }


                });

                //Once remove button is clicked
                $(wrapper).on('click', '.remove_button', function (e) {
                    e.preventDefault();
                    $(this).parent('div').remove(); //Remove field html
                    x--; //Decrement field counter
                });


            });


        </script>
    @endpush

@endsection
