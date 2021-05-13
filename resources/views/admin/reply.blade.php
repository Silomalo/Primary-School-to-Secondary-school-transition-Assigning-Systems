@extends('admin.layoutIN')

@section('admin')
<div class="regbody">
    <div class="container">
<h3>Reply SMS  </h3>
@foreach($replyTo as $sms)
<form method="POST" class="row g-3"  action="{{route('adminSendReply')}}">
    @csrf
    <div class="col-md-4">
        
        <input type="text" class="form-control" name="receiver"  value="{{$sms->sender}}"hidden  >
        <input type="text" class="form-control" name="pcode"  value="{{$sms->primarySchoolcode}}"hidden  >
      </div>
      <div class="col-md-12">
        <textarea  class="form-control" name="txt" placeholder="Type in your Reply message " required  style="height:300px;">
        </textarea>
      </div>

        <div class="col-md-12">
            <button type="submit" class="btn btn-success">Reply to {{$sms->sender}}</button>
            <a href="/adminshowMessages"  class="btn btn-danger" style="float:right"> Back to Messages </a>
        </div>
    </div>
</form>
@endforeach
</div>
</div>
@endsection
