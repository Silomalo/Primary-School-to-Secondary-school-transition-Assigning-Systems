@extends('admin.layout')

@section('admin')
<div class="regbody">
    <div class="container">
<h3>Assigned Students</h3>
<form method="GET" action="/adminSearchAllocated">
  @csrf
  <div class="col-md-12">
    @if(session()->has('success'))
    <div class="alert alert-success">{{session('success')}}</div>
    @elseif(session()->has('error'))
    <div class="alert alert-danger">{{session('error')}}</div>
   @endif
  </div>
<div class="mb-3">
  <label for="search" class="form-label">Filter By Index: </label>
  <input type="text" name="index" class="form-control" id="scode" placeholder="Enter student Index ">
  </div>
  
  <button type="submit" name="ok" class="btn btn-primary">Filter By Index</button>
</form>
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
        @foreach($allo as $placed)
        <tr>   
            <th scope="row" >{{$placed->index}}</th>
            <th scope="row" >{{$placed->secondarySchoolid}}</th>
            <th scope="row" >{{$placed->scores}}</th>
            <th scope="row" > 
              <a href="{{ url('/adminDestroyAllocated/'.$placed->id) }} " class="btn btn-outline-danger">Delete</a>
            </th>
        </tr>
        @endforeach
      </tbody>
    </table>
    </div>
</div>
</div>
@endsection