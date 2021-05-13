@extends('admin.layout')

@section('admin')
<div class="regbody">
    <div class="container">
<h3 style="text-align:center;text-decoration:underline"> User Data Manipulation</h3>
<div class="col-md-12">
    @if(session()->has('success'))
    <div class="alert alert-success">{{session('success')}}</div>
    @elseif(session()->has('error'))
    <div class="alert alert-danger">{{session('error')}}</div>
   @endif
  </div>

<form method="GET" action="/adminSearchUser">
    @csrf
        <div class="mb-3">
        <label for="search" class="form-label">User Email Address</label>
        <input type="text" name="userEmail" class="form-control" id="task" placeholder="Enter Searching mail address">
        </div>
        
        <button type="submit" name="ok" class="btn btn-primary">Search By Email</button>
        
    </form>

    <div class="task table-responsive" style="max-height: 500px">
    <table class="table table-sm">
    <thead class="thead-light">
    <tr>
        <th scope="col" >Full_Names</th>
        <th scope="col" >BirthCert/ID</th>
        <th scope="col" >Index/StaffNo</th>
        <th scope="col" >Role</th>
        <th scope="col" >Primary</th>
        <th scope="col" >Gender</th>
        <th scope="col" >DOB</th>
        <th scope="col" >Religion</th>
        <th scope="col" >Disabled</th>
        <th scope="col" >Email</th>
        <th scope="col" >Events</th>
    </tr>
    @foreach($userinfo as $stor)
    <tr>
    <td>{{ $stor->name}}</td>
    <td>{{ $stor->birthCertID}}</td>
    <td>{{ $stor->indexStaffNo}}</td>
    <td>{{ $stor->role}}</td>
    <td>{{ $stor->primarySchoolID}}</td>
    <td>{{ $stor->gender}}</td>
    <td>{{ $stor->dob}}</td>
    <td>{{ $stor->religion}}</td>
    <td>{{ $stor->disabled}}</td>
    <td>{{ $stor->email}}</td>
    <td>
    <a href="{{ url('/adminupdate/'.$stor->id) }}" class="btn btn-sm btn-info">Update</a>
    </td>
    <td>
    <a href="{{ url('/admindelete/'.$stor->id) }} " class="btn btn-sm btn-danger">Delete</a>
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
