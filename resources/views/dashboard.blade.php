<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Viga" rel="stylesheet">

    <title>My Portal</title>
    <link rel="stylesheet" href="collapse.css">
    <!--j-qerry for dropdown -->
    <script src='jquery-3.2.1.min.js' type='text/javascript'></script>
    <script src='select2/dist/js/select2.min.js' type='text/javascript'></script>
    <link href='select2/dist/css/select2.min.css' rel='stylesheet' type='text/css'>
  </head>
  <body>
   

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light">
      <div class="container">
        <a class="navbar-brand" href="#">My Portal</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav ml-auto">
            <a class="nav-item nav-link active" href="/dashboard">Home <span class="sr-only">(current)</span></a>
            <a class="nav-item nav-link" href="/user/profile">Profile </a>
            <a class="nav-item nav-link" href="quit254">LogOut </a>

          </div>
        </div>
      </div>
    </nav>
   

    <div class="jumbotron jumbotron-fluid">
      <div class="container">
        <h1 class="display-4">Always aim <span>HIGHER</span> <br>the <span>Sky</span> is the Limit</h1>
        <a href="#" class="btn btn-info btn-lg tombol">Truelly Kenyan</a>
      </div>
    </div>
  


    <!-- container -->
    <div class="container">

      <!-- info panel -->
      <div class="row justify-content-center">
        <div class="col-10 info-panel">
          <div class="row" >
            @foreach($placed as $placed)
            <div class="col-sm">
              <img src="img/employee.png" alt="Employee" class="img-fluid float-left">
              <h4>H.School</h4>
              <p>{{$placed->secondaryName}}</p>
            </div>
            <div class="col-lg">
              <img src="img/county.png" alt="HiRes" class="img-fluid float-left">
              <h4>County</h4>
                <p>{{$placed->county}}</p>
            </div>
            <div class="col-lg">
              <img src="img/level.png" alt="Security" class="img-fluid float-left">
              <h4>Type</h4>
              <p>{{$placed->role}}</p>
            </div>
            @endforeach
          </div>
        </div>
      </div>
     


      <!-- Workingspace -->
      <div class="row workingspace">
        <div class="col-lg-4">
          <img src="img/workingspace.svg" alt="Working Space" class="img-fluid">
        </div>
        <div class="col-lg-8">
          <h2><span>Messaging!</span></span></h2>
          <div class="col-md-12">
            @if(session()->has('success'))
            <div class="alert alert-success">{{session('success')}}</div>
            @elseif(session()->has('error'))
            <div class="alert alert-danger">{{session('error')}}</div>
           @endif
          </div>
          <p>Send message to KUCCPS or Your head teacher.</p>
          <form method="POST" class="row g-3"  action="{{ route('studentSendsms') }}">
            @csrf
            <br>
            <div class="col-md-4">
             
          <select class="form-control" name="target" required>
            <option value="2">HeadTeacher</option>
            <option value="3">KUCCPS</option>
          </select></div>
          <div class="col-md-8">
            <select id='pid' name="pid" class="form-control" readonly>
              @foreach($pID as $pid)       
              <option value="{{$pid->schoolCode}}">{{$pid->primaryName}}</option>  
               @endforeach
          </select>
          </div>
          <br><br>
          <div class="col-md-12">
            <textarea  class="form-control" name="txt" placeholder="Type in your message " required >
            </textarea>
          </div>
          <br><br>
          <div class="col-md-12">
          <input type="submit" class="btn btn-success" value="Send SMS" >
          </div>
          </form>
{{-- start of message display --}}
          <br>
          <button class="collapsible" style="height: 60px">Read Your Messages !</button>
          <div class="content">
            <div style="overflow-x:auto;">
              <table class="table caption-top">
                <caption>SMS</caption>
                <thead>
                  <tr>
                      <th scope="col">Date__Sent</th>
                    <th scope="col">Sender</th>
                    <th scope="col">Primary</th>
                    <th scope="col">Text</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($sms as $stor)
                  <tr>
                      <th scope="row" >{{$stor->created_at}}</th>
                    <th scope="row" >{{$stor->sender}}</th>
                    <td>{{$stor->primarySchoolcode}}</td>
                    <td style="color:blue;">{{$stor->messageBody}}</td>
                  
                  <td>
                  <a href="{{ url('/studentDestroysms/'.$stor->id) }} " class="btn btn-sm btn-danger">Delete</a>
                  </td>
                    
                    
                  </tr>
                  @endforeach
                </tbody>
              </table>
              </div>
          </div>

{{-- end of messages display --}}
        </div>
      </div>
      <div class="selectSchool">
        <h3>List of schools will be here </h3>
      </div>

      <button class="collapsible">Choose Your Dream School!</button>
      <div class="content">
<form method="POST" class="row g-3"  action="/selection">
          @csrf
          <br>
    <div class="col-md-12">
      <label>National Schools</label> </div>
      <div class="col-md-6">
        <select id='selUser' name="national1" style='width: 100%;'>
          <option >-- Select 1st National --</option>   
          @foreach($national as $n)       
          <option value='{{$n->schoolCode}}'>{{$n->secondaryName}}</option>  
           @endforeach
      </select> </div>
      <br><br>
      <div class="col-md-6">
        <select id='selUser' name="national2" style='width: 100%;'>
          <option>-- Select 2nd National --</option>   
          @foreach($national as $n)       
          <option value='{{$n->schoolCode}}'>{{$n->secondaryName}}</option>  
           @endforeach
      </select> </div>
      <br><br>
      <div class="col-md-6">
        <select id='selUser' name="national3" style='width: 100%;'>
          <option>-- Select 3rd National --</option>   
          @foreach($national as $n)       
          <option value='{{$n->schoolCode}}'>{{$n->secondaryName}}</option>  
           @endforeach
      </select> </div>
      <br><br>
      <div class="col-md-6">
        <select id='selUser' name="national4" style='width: 100%;'>
          <option>-- Select 4th National --</option>   
          @foreach($national as $n)       
          <option value='{{$n->schoolCode}}'>{{$n->secondaryName}}</option>  
           @endforeach
      </select> </div>
      <br><br>
     
         <!--Extra county-->
          <div class="col-md-12">
          <label>Extra County</label> </div>
          <div class="col-md-6">
            <select id='selUser' name="exCounty1" style='width: 100%;'>
              <option>-- Select 1st Extra-County --</option>   
              @foreach($exCounty as $exC)       
              <option value='{{$exC->schoolCode}}'>{{$exC->secondaryName}}</option>  
               @endforeach
          </select> </div>
          <br><br>
          <div class="col-md-6">
            <select id='selUser' name="exCounty2" style='width: 100%;'>
              <option>-- Select 2nd Extra-County --</option>   
              @foreach($exCounty as $exC)       
              <option value='{{$exC->schoolCode}}'>{{$exC->secondaryName}}</option>  
               @endforeach
          </select> </div>
          <br><br>
    <div class="col-md-12">
    <label>County Schools</label> </div>
    <div class="col-md-6">
      <select id='selUser' name="county1" style='width: 100%;'>
        <option> Select 1st County School</option>   
        @foreach($county as $c)       
        <option value='{{$c->schoolCode}}'>{{$c->secondaryName}}</option>  
         @endforeach
    </select> </div>
    <br><br>
    <div class="col-md-6">
      <select id='selUser' name="county2" style='width: 100%;'>
        <option>Select 2nd County School</option>   
        @foreach($county as $c)       
        <option value='{{$c->schoolCode}}'>{{$c->secondaryName}}</option>  
         @endforeach
    </select> </div>
    <br><br>
    <div class="col-md-12">
      <label>District Schools</label> </div>
      <div class="col-md-6">
        <select id='selUser' name="district1" style='width: 100%;'>
          <option>-- Select 1st District --</option>   
          @foreach($district as $d)       
          <option value='{{$d->schoolCode}}'>{{$d->secondaryName}}</option>  
           @endforeach
      </select> </div>
      <br><br>
      <div class="col-md-6">
        <select id='selUser' name="district2" style='width: 100%;'>
          <option>-- Select 2nd District --</option>   
          @foreach($district as $d)       
          <option value='{{$d->schoolCode}}'>{{$d->secondaryName}}</option>  
           @endforeach
      </select> </div>
      <br><br>
     
        <div class="col-md-12">
        <input type="submit" class="btn btn-success" value="Register Schools" >
        </div><br><br>
  </form>
      </div>
    
      <section class="testimonial">
        <div class="row justify-content-center">
          <div class="col-lg-8">
            <p>"Given chance and power , everybody has the ability to change the world "</p>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-lg-6 justify-content-center d-flex">
            <img src="img/img1.jpg">
            <img src="img/img2.jpg">
            <img src="img/img3.jpg">
            <img src="img/img4.jpeg">
            <img src="img/img5.jpeg">
            <img src="img/img6.jpeg">
          </div>
        </div>
        <div class="row justify-content-center info-text">
          <div class="col-lg text-center">
            <h5>KAMATI</h5>
            <p>Advanced WEB Designers</p>
          </div>
        </div>
      </section>
     


    </div>
   




    <script>
    
          
          // Initialize select2
          $("#selUser").select2();

    
      </script>
    <!--Collapse js-->
    <script>
      var coll = document.getElementsByClassName("collapsible");
      var i;
      
      for (i = 0; i < coll.length; i++) {
        coll[i].addEventListener("click", function() {
          this.classList.toggle("active");
          var content = this.nextElementSibling;
          if (content.style.maxHeight){
            content.style.maxHeight = null;
          } else {
            content.style.maxHeight = content.scrollHeight + "px";
          } 
        });
      }
      </script>
      
      <!--End of Collapse js-->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>