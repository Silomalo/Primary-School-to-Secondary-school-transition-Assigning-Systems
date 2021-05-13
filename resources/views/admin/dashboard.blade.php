@extends('admin.layout')

@section('admin')
<div class="container">
    <div class="col-md-12">
        @if(session()->has('success'))
        <div class="alert alert-success">{{session('success')}}</div>
        @elseif(session()->has('error'))
        <div class="alert alert-danger">{{session('error')}}</div>
       @endif
      </div>
      <div class="Container2">
        <h1 style="font-family: gabriolla;text-decoration:underline ">WELCOME TO ADMIN DASHBOARD </h1>
        <div id="cards" class="cards_container">

            <div id="card_two" class="infected cards">
                <h6>STUDENTS  <i class="fas fa-virus"></i></h4>
                <h6>{{$totalStudents}}  <i class="fas fa-virus"></i></h4>
            </div>
            <div id="card_three" class="tested cards">
                <h6>H.TEACHER <i class="fas fa-vial"></i></h4>
                <h6>{{$totalHT}}  <i class="fas fa-vial"></i></h4>   
            </div>
            <div id="card_four" class="recovered cards">
                <h6>CHOOSEN <i class="fa "></i></h4>
                <h6>{{$totalChoosen}}  <i class="fas "></i></h4>
            </div>
            <div id="card_five" class="deceased cards">
                <h6>PRIMARY <i class="fas fa-skull-crossbones"></i></h4>
                <h6>{{$totalPrimaries}}  <i class="fas fa-skull-crossbones"></i></h4>
            </div>
            <div id="card_six" class="active cards">
                <h6>SECONDARY<i class="fas fa"></i></h4>
                <h6>{{$totalSecondaries}}  <i class="fas fa"></i></h4>
            </div>
            <div id="card_seven" class="unique cards">
                <h6>PLACED <i class="fas fa-fingerprint"></i></h4>
                <h6>{{$totalPlaced}}  <i class="fas fa-fingerprint"></i></h4>
            </div>


        </div>
       
            <h3 style="font-family: gabriolla">The WORLD can be controlled by a button Press</h3>
            <a href="/adminAssignStudents"  class="btn btn-info" > Assign Students</a>



    </div>









    


</div>
@endsection