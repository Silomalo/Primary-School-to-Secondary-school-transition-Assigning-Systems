@extends('admin.layout')

@section('admin')
<div class="regbody">
    <div class="container">
<h3 style="text-align:center;text-decoration:underline"> Primary School Data Manipulation</h3>
<div class="col-md-12">
    @if(session()->has('success'))
    <div class="alert alert-success">{{session('success')}}</div>
    @elseif(session()->has('error'))
    <div class="alert alert-danger">{{session('error')}}</div>
   @endif
  </div>

<form method="GET" action="/adminSearchPrimary">
    @csrf
        <div class="mb-3">
        <label for="search" class="form-label">Filter By School Code: </label>
        <input type="text" name="schoolCode" class="form-control" id="pcode" placeholder="Enter school code ">
        </div>
        
        <button type="submit" name="ok" class="btn btn-primary">Filter By pCode</button>
        
    </form>

    <div class="task table-responsive" style="max-height: 500px">
    <table class="table table-sm">
    <thead class="thead-light">
    <tr>
        <th scope="col" >id</th>
        <th scope="col" >SchoolCode</th>
        <th scope="col" >SchoolName</th>
        <th scope="col" >County</th>
        <th scope="col" >Sub-county</th>
        <th scope="col" >capacity</th>
        <th scope="col" >Box</th>
        <th scope="col" >Email</th>
    </tr>
    @foreach($primaryinfo as $stor)
    <tr>
    <td>{{ $stor->id}}</td>
    <td>{{ $stor->schoolCode}}</td>
    <td>{{ $stor->primaryName}}</td>
    <td>{{ $stor->county}}</td>
    <td>{{ $stor->subCounty}}</td>
    <td>{{ $stor->capacity}}</td>
    <td>{{ $stor->boxNumber}}</td>
    <td>{{ $stor->email}}</td>
    <td>
    <a href="{{ url('/adminupdateprimary/'.$stor->id) }}" class="btn btn-sm btn-info">Update</a>
    </td>
    <td>
    <a href="{{ url('/admindeletePrimary/'.$stor->id) }} " class="btn btn-sm btn-danger">Delete</a>
    </td>
    <br>
    </tr>
    @endforeach

    </thead>
</table>
</div>



</div>
</div>
@endsection
