@if(\Illuminate\Support\Facades\Session::has('success'))
<div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show"
     role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <strong>Success - </strong> {{\Illuminate\Support\Facades\Session::get('success')}}
</div>
@endif
@if($errors->any())
<div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show"
     role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <strong>Error - </strong> @foreach($errors->all() as $error)
                                  {{$error}} <br>
                                  @endforeach
</div>
@endif
