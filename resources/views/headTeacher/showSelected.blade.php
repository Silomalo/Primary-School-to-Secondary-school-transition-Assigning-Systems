@extends('headTeacher.layout')

@section('hdpart')
<div class="regbody">
    <div class="container">
<h3>My Assigned Students</h3>
<div style="overflow-x:auto;">
    <table class="table caption-top">
      <caption>Selected</caption>
      <thead>
        <tr>
          <th scope="col">Name</th>
          <th scope="col">Secondary School</th>
          <th scope="col">Marks</th>
        </tr>
      </thead>
      <tbody>
        @foreach($placed as $placed)
        <tr>   
            <th scope="row" >{{$placed->index}}</th>
            <th scope="row" >{{$placed->secondarySchoolid}}</th>
            <th scope="row" >{{$placed->scores}}</th>
        </tr>
        @endforeach
      </tbody>
    </table>
    </div>
</div>
</div>
@endsection