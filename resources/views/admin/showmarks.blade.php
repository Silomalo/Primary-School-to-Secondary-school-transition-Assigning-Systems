@extends('admin.layout')

@section('admin')
<div class="regbody">
    <div class="container">
<h3 style="text-align:center;text-decoration:underline"> Pupils Scores Manipulation</h3>
<div class="col-md-12">
    @if(session()->has('success'))
    <div class="alert alert-success">{{session('success')}}</div>
    @elseif(session()->has('error'))
    <div class="alert alert-danger">{{session('error')}}</div>
   @endif
  </div>

<form method="GET" action="/adminSearchMark">
    @csrf
        <div class="mb-3">
        <label for="search" class="form-label">Filter By indexNumber: </label>
        <input type="text" name="index" class="form-control" placeholder="Enter pupil code  ">
        </div>
        
        <button type="submit" name="ok" class="btn btn-primary">Filter By Index</button>
        
    </form>

    <div class="task table-responsive" style="max-height: 500px">
    <table class="table table-sm">
    <thead class="thead-light">
    <tr>
  
        <th scope="col" >IndexNo:</th>
        <th scope="col" >Scores</th>
    </tr>
    @foreach($scores as $stor)
    <tr>

    <td>{{ $stor->indexStaffNo}}</td>
    <td>{{ $stor->minMark}}</td>
    <td>
    <a href="{{ url('/adminupdatemark/'.$stor->id) }}" class="btn btn-sm btn-info">Update</a>
    </td>
    <td>
    <a href="{{ url('/admindeleteMark/'.$stor->id) }} " class="btn btn-sm btn-danger">Delete</a>
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
