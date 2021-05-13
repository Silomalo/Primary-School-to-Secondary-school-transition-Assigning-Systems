@extends('admin.layout')

@section('admin')
<div class="regbody">
    <div class="container">
<h3>Add Secondary School</h3>
<div class="col-md-12">
    @if(session()->has('success'))
    <div class="alert alert-success">{{session('success')}}</div>
    @elseif(session()->has('error'))
    <div class="alert alert-danger">{{session('error')}}</div>
   @endif
  </div>
<form method="POST" class="row g-3"  action="{{ route('addSecondary') }}">
    @csrf

    <div class="col-md-4">
        <label for="pcode" class="form-label">Secondary School code:</label>
        <input type="text" class="form-control" name="scode" placeholder="code " required autofocus autocomplete="pcode" >
      </div>
    <div class="col-md-4">
        <label for="name" class="form-label"> School Name:</label>
        <input type="text" class="form-control" name="sname" placeholder="Enter school name "  required autofocus autocomplete="name" >
      </div>
      <div class="col-md-4">
        <label for="cod" class="form-label">Level: </label>
        <select name="level" class="form-control" :value="old('level')" required readonly>
            <option>Choose</option>
            <option value="004">District</option>
            <option value="003">County</option>
            <option value="002">Extra-County</option>
            <option value="001">National</option>   
        </select>
    </div>
    <div class="col-md-6">
        <label for="county" class="form-label">School County Location:</label>
        <input type="text" class="form-control" name="county" placeholder="Enter  county "  required>
    </div>
    <div class="col-md-6">
        <label for="sub-county" class="form-label">School Sub-County Location:</label>
        <input type="text" class="form-control" name="subCounty" placeholder="Enter  sub-county "  required>
    </div>
    <div class="col-md-4">
        <label for="cod" class="form-label">Type: </label>
        <select name="role" class="form-control" :value="old('role')" required readonly>
          <option value="Day-mixed">Day Mixed</option>
          <option value="Bording-mixed">Boarding Mixed</option>
          <option value="Boarding-boys">Boarding Boys</option>
          <option value="Boarding-girls">Boarding Girls</option>
          <option value="Special"> Special</option>
          <option value="Day-boys">Day Boys</option>
          <option value="Day-girls">Day Girls</option>
          
        </select>
    </div>
    <div class="col-md-4">
        <label for="capacity" class="form-label">School Capacity:</label>
        <input type="number" class="form-control" name="capacity" placeholder="Enter  capacity "  required>
    </div>
    <div class="col-md-4">
        <label for="mark" class="form-label">Enter School Intake Min-Mark:</label>
        <input type="number" class="form-control" name="mark" placeholder="Enter  mark "  required>
    </div>
    <div class="col-md-8">
        <label for="boxNumber" class="form-label">School Box Number:</label>
        <input type="text" class="form-control" name="boxNumber" placeholder="Enter  boxNumber "  required>
    </div>

    <div class="col-md-12">
        <label for="email" class="form-label">Email:</label>
        <input type="email" class="form-control" name="email" placeholder="Enter  student/staff email " :value="old('email')">
    </div>
        <br><br>
        <div class="col-md-12">
            <button type="submit" class="btn btn-success">Save School</button>
            <a href="#"  class="btn btn-danger" style="float:right"> Drop all Entry</a>
        </div>
    </div>
</form>
</div>
</div>
@endsection
