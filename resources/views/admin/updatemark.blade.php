@extends('admin.layoutIN')

@section('admin')
<div class="regbody">
    <div class="container">
<h3>Update primary School Details  </h3>
@foreach($scores as $score)
<form method="POST" class="row g-3"  action="{{route('updateMarkDetails')}}">
    @csrf
    <div class="col-md-4">
        <label for="name" class="form-label">Index-Code:</label>
        <input type="text" class="form-control" name="id"  value="{{$score->id}}" hidden >
        <input type="text" class="form-control" name="index" placeholder="Enter  school code " value="{{$score->indexStaffNo}}"  >
      </div>
    <div class="col-md-4">
        <label for="name" class="form-label">Student Total scores:</label>
        <input type="number" class="form-control" name="mark" placeholder="Enter student Mark   " value="{{$score->minMark}}">
    </div>

        <div class="col-md-12">
            <button type="submit" class="btn btn-success">Update Mark</button>
            <a href="/adminshowMarks"  class="btn btn-danger" style="float:right"> Back to Marks </a>
        </div>
    </div>
</form>
@endforeach
</div>
</div>
@endsection
