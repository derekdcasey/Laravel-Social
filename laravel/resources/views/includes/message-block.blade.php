@if(count($errors) > 0)
<div class="row"> <div class="col"><ul>
@foreach($errors->all() as $error)
    <li class="text-danger">{{$error}}</li>
@endforeach
</ul></div></div>
@endif
@if(Session::has('message'))
<div class="row"> <div class="col"><ul>
   {{ Session::get('message') }}
    </ul></div></div>
    @endif
