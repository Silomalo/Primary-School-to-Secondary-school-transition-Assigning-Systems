@extends('headTeacher.layout')

@section('hdpart')
<div class="container">
    <div class="col-md-12">
        @if(session()->has('success'))
        <div class="alert alert-success">{{session('success')}}</div>
        @elseif(session()->has('error'))
        <div class="alert alert-danger">{{session('error')}}</div>
       @endif
      </div>
      <div class="Container2">
        <h1 style="font-family: gabriolla;text-decoration:underline ">WELCOME TO HEAD-TEACHER DASHBOARD </h1>
        <div id="cards" class="cards_container">

            <div id="card_two" class="infected cards">
                <h6>My Students  <i class="fas fa-virus"></i></h4>
                <h6>{{$totalStudents}} <i class="fas fa-virus"></i></h4>
            </div>
            <div id="card_three" class="tested cards">
                <h6>My School <i class="fas fa-vial"></i></h4>
                <h6>{{$name}} <i class="fas fa-vial"></i></h4>   
            </div>
            <div id="card_four" class="recovered cards">
                <h6>Allocated <i class="fa "></i></h4>
                <h6>{{$totalChoosen}}  <i class="fas "></i></h4>
            </div>

        </div>
       
            <h3 style="font-family: gabriolla">The WORLD can be controlled by a button Press</h3>




    </div>









    


</div>
@endsection