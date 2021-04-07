<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }

        img {
            width: 100px;
            height: 100px;
            margin-top: 60px;
            margin-left: 60px;
        }
        #h5{
            margin-left: 47px;
        }
    </style>
</head>
<body>
<h2 class="text-center">Category ( {{$category->name}} )</h2>
<h2 class="text-center">Quantity ( {{$quantity}} )</h2>
<div class="table-responsive">
    <table class="table table-bordered">
        <thead class="thead-light">
        <tr>
            <th scope="col">{{Lang::get('site.id')}}</th>
            <th scope="col">{{Lang::get('site.Bill Number')}}</th>
            <th scope="col">{{Lang::get('site.operation')}}</th>
            <th scope="col">{{Lang::get('site.Description')}}</th>
            <th scope="col">{{Lang::get('site.quantity')}}</th>
            <th scope="col">{{Lang::get('site.Added By')}}</th>
            <th scope="col">{{Lang::get('site.created at')}}</th>
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
                    <td><h5>{{Lang::get('site.Export')}} <i class="fas fa-level-up-alt"></i>
                        </h5> @endif</td>
                    <td>{{$value->description}}</td>
                    <td>{{$value->quantity}}</td>
                    <td>{{\App\User::findOrFail($value->user_id)->name}}</td>
                    <td>{{$value->created_at}}</td>

            </tr>
        @endforeach
        </tbody>
    </table>
    <br>

</div>
<div class="row">
    <div class="col-md-11">
        <div class="row">
            <h5 id="h5">company signature</h5>
            <img src="{{$signature->signature}}">
        </div>
    </div>
</div>
</body>
</html>

