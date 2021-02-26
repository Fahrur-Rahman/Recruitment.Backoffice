<body>
@extends('dashboard/header')
@section('home')
<form method="POST" action="/linked/{{$candidatelist->candidatelistid}}">
@csrf
<div class="content" style="padding : 12px; padding-top:30px;">
<div class="row">
    <div class="col-lg-4">
        <div class="card">
              <div class="card-body">
              <h2><strong>Candidate List</strong></h2><br>
              <div>
                  <i class="far fa-calendar-alt fa-lg"></i><strong> {{$schedule->scheduledate}}</strong><br/>
              </div>
                <div style="padding-top: 25px;">
                  <p class="d-flex flex-column">
                    <span class="text-bold text-lg">NIK</span>
                    <span>{{$candidatelist->niknumber}}</span>
                  </p>
                  <p class="d-flex flex-column">
                    <span class="text-bold text-lg">Email</span>
                    <span>{{$candidatelist->email}}</span>
                  </p>
                  <p class="d-flex flex-column">
                    <span class="text-bold text-lg">Full Name</span>
                    <span>{{$candidatelist->fullname}}</span>
                  </p>
                  <p class="d-flex flex-column">
                    <span class="text-bold text-lg">Mobile Phone</span>
                    <span>{{$candidatelist->mobilephone}}</span>
                  </p>
                </div>
                </div>                    
        </div>
        <!-- /.card -->
    </div>
            <!-- /.col-md-8 -->
<div class="col-lg-8">
        <div class="card">
          <div class="card-body">
              <h2><strong>Candidate Form</strong></h2><br>
              <div>
              <select class="form-control" id='candidate' name='candidate'>
                <option selected="selected">Choose...</option>
              @foreach($candidate as $candi)
                <option value="{{$candi->candidateid}}" >{{$candi->nik}} - {{$candi->fullname}}</option>
              @endforeach
              </select>
              </div>
              <div style="padding-top: 25px;">
                  <h4 style="text-align:center;"><strong>No Detail Information yet...</strong></h4>
              </div>
              <div style="padding-top: 25px;">
                <div class="col-12">
                  <div class="row">
                  <div class="col-4">
                  <p class="d-flex flex-column">
                    <span class="text-bold text-lg">NIK</span>
                    <span id="nikcandidate"></span>
                  </p>
                  <p class="d-flex flex-column">
                    <span class="text-bold text-lg">Email</span>
                    <span id="emailcandidate"></span>
                  </p>
                  <p class="d-flex flex-column">
                    <span class="text-bold text-lg">Full Name</span>
                    <span id="namecandidate"></span>
                  </p>
                  <p class="d-flex flex-column">
                    <span class="text-bold text-lg">Mobile Phone</span>
                    <span id="phonecandidate"></span>
                  </p>
                  </div>
                </div>
                </div>
                </div>             
            </div>
            
          </div>
        </div>
            <!-- /.card -->
</div>
<div class="col-8 offset-4">
<button class="btn btn-primary" type="sumbit">Linked</button>
</div>
</form>
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ URL::asset('js/app.js') }} "></script>
<script>      	  
 jQuery(document).ready(function ()
    {
            jQuery('select[name="candidate"]').on('change',function(){
               var candidate = jQuery(this).val();
               if(candidate)
               {
                  jQuery.ajax({
                     url : '/getcandidatelist/' +candidate,
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     {  
                        var nik = data.nik;
                        var fullname = data.fullname;
                        var email = data.email;
                        var phone = data.phonenumber;

                        document.getElementById("nikcandidate").innerHTML = nik;
                        document.getElementById("emailcandidate").innerHTML = email;
                        document.getElementById("namecandidate").innerHTML = fullname;
                        document.getElementById("phonecandidate").innerHTML = phone;
                     }
                  });
               }
               else
               {
                  $('select[name="state"]').empty();
               }
            });
    });
    </script>
@endsection
</body>