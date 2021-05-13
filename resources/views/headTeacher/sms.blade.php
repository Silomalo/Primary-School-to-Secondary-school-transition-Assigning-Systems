@extends('headTeacher.layout')

@section('hdpart')
<div class="regbody">
    <div class="container">
<h3>My Messages</h3>
<div style="overflow-x:auto;">
    <table class="table caption-top">
      <caption>SMS</caption>
      <thead>
        <tr>
            <th scope="col">Date__Sent</th>
          <th scope="col">Sender</th>
          <th scope="col">Primary</th>
          <th scope="col">Text</th>
        </tr>
      </thead>
      <tbody>
      @foreach($sms as $stor)
        <tr>
            <th scope="row" >{{$stor->created_at}}</th>
          <th scope="row" >{{$stor->sender}}</th>
          <td>{{$stor->primarySchoolcode}}</td>
          <td style="color:blue;">{{$stor->messageBody}}</td>
        <td>
        <a href="{{ url('/MyReply/'.$stor->id) }}" class="btn btn-sm btn-info">ReplySMS</a>
        </td>
        <td>
        <a href="{{ url('/Destroysms/'.$stor->id) }} " class="btn btn-sm btn-danger">Delete</a>
        </td>
          
          
        </tr>
        @endforeach
      </tbody>
    </table>
    </div>
</div>
</div>
@endsection
