@extends('admin.layout')

@section('admin')
<div class="regbody">
    <div class="container">
<h3>Input Student Mark: </h3>
<div class="col-md-12">
    @if(session()->has('success'))
    <div class="alert alert-success">{{session('success')}}</div>
    @elseif(session()->has('error'))
    <div class="alert alert-danger">{{session('error')}}</div>
   @endif
  </div>
<form method="POST" class="row g-3"  action="{{ route('addMark') }}">
    @csrf

    <div class="col-md-6">
        <label for="indexNo" class="form-label">Enter IndexNumber:</label>
        <select id='selUser' name="indexNo"  class="form-control" :value="old('primarySchoolID')" required>
          <option >-- Select User --</option>   
          @foreach($student as $n)       
          <option value='{{$n->indexStaffNo}}'>{{$n->indexStaffNo}}</option>  
           @endforeach
      </select> 
      </div>
    <div class="col-md-6">
        <label for="mark" class="form-label">Marks Scored by Student :</label>
        <input type="number" class="form-control" name="mark" placeholder="Enter school mark "  required autofocus autocomplete="mark" >
      </div>
   
        <br><br>
        <div class="col-md-12">
            <button type="submit" class="btn btn-success">Save Mark</button>
            <a href="#"  class="btn btn-danger" style="float:right"> Re-Enter</a>
        </div>
    </div>
</form>
</div>
</div>
@endsection
