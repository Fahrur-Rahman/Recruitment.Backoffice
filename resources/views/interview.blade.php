<body>
@extends('dashboard/header')

@section('home')

<div class="content" style="padding : 12px; padding-top:30px;">
<div class="row">

    <div class="col-md-4">
        <div class="card">
              <div class="card-body" style="text-align:center;">
              <h3><strong>{{$candidateinformation->fullname}}</strong></h3><br>
              <h5>{{$schedulecandidateinterview->scheduledate}}</h5><br>
              <div>
                <a class="btn btn-primary" href="/details/{{$canid->candidateid}}">Candidate Information</a>
              </div>
              </div>                    
        </div>
        <!-- /.card -->
    </div>
    <div class="card">
            <div class="card-body">
            @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
    </div>
    <form method="POST" action="/interviewcreate">
    @csrf
    <div class="col-md-8" style="text-align:center;">
                    <div class="card" style="width:28rem; padding:10px; text-align: left;">
                    <div class="form-group">
                    <div style="text-align:center; align-content:center;">
                    <div id="statusinterview" class="btn-group btn-group-lg" role="group"> 
                      <button type="button" value="1" name="option" id="1" class="btn btn-secondary">Purpose</button>
                      <button type="button" value="2" name="option" id="2" class="btn btn-secondary">Accept</button>
                      <button type="button" value="3" name="option" id="3" class="btn btn-secondary">Reject</button>
                    </div></div>
                <input name="sdate" value="{{$schedulecandidateinterview->scheduledate}}" type="hidden">
              <input name="scid"value="{{$schedulecandidateinterview->scheduleid}}" type="hidden">
              <input name="statusidint" id="statusidint" type="hidden">
                    <div class="form-group">
                        <label for="reschedulereason" class="col-form-label">Interview Testimony</label>
                        <textarea class="form-control" name="testimony" id="reason" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="reschedulereason" class="col-form-label">Personal Candidate Testimony</label>
                        <textarea class="form-control" name="personal" id="reason" rows="3"></textarea>
                    </div>
                    <div class="form-group" style="display: none;" id="myDIV">
                        <label for="reschedulereason" class="col-form-label">Reject Note</label>
                        <textarea class="form-control" name="rejectnote" id="reason" rows="3"></textarea>
                    </div>
                <div>
                <button type="sumbit" class="btn btn-primary" style="margin-top:10px">Save</button>
                </div>
                </div>
              
            </div>
        </div>
        <!-- /.card -->
    </div>
    </form>
</div>
</div>
@if (!empty($history))
<div class="row">
    <div class="col-4" style="border:1px solid rgba(0,0,0,.1)">
    @foreach($candidatelistschedule as $int)
        <div style="border-style: hidden; padding-top: 2px; padding-bottom: 5px;" class="checkhistory" data-id="{{$int->scheduleid}}">
            {{$int->name}}</br>
            {{$int->ctualinterviewtime}}</br>
            {{$int->status}}</br>
            <hr>
        </div>
    @endforeach
    </div>
    <div class="col-8" style="border:1px solid rgba(0,0,0,.1)">
        <div class="row">
            <div class="col-8">
                <div>
                    <span class="text-bold text-md" id="user">Interviewer</span>
                </div>
                <div>
                    <span>PT. Adidata Informatika</span>
                </div>
            </div>
            <div class="col-4 ml-auto">
                <span class="text-bold text-md" id="status">Not Attend</span><br>
                <span id="interviewcompany" style="display: none;">Not Attend</span>
                <span class="text-bold text-sm" id="ctualinterviewtime">12 July 2018 10:00</span>
            </div>
        </div>
        <!-- Not Attend -->
        <div class="col" id="ifnotattend" style="display: none;">
        <div style="padding-top: 35px; padding-left:5px;">
                <span>Not Attend Reason</span>              
            </div>
            <br>
            <div class="col-12" style="padding-top: 20px;">
                <span id="notattend"></span>   
            <hr>
            </div>
        </div>
        <!-- interview -->
        <div class="col" id="ifinterview" style="display: none;">
            <div style="padding-top: 35px; padding-left:5px;">
                <span>Interview Testimony</span>              
            </div>
            <br>
            <div class="col-12" style="padding-top: 20px;">
                <span id="interviewnote"></span>   
            <hr>
            </div>
            <div style="padding-top: 35px; padding-left:5px;">
                <span>Candidate Personal Testimony</span>              
            </div>
            <br>
            <div class="col-12" style="padding-top: 20px;">
                <span id="pesonalcandidatestestimony"></span>   
            <hr>
            </div>
            <!-- Rejected -->
            <div class="col" id="ifreject" style="display: none;">
            <div style="padding-top: 35px; padding-left:5px;">
                    <span>Rejected Reason</span>              
                </div>
                <br>
                <div class="col-12" style="padding-top: 20px;">
                <span id="reject"></span>   
            <hr>
            </div>
            </div>
            <!-- Candidate Info -->      
            <div style="padding-top: 35px; padding-left:5px;">
                <span>Candidate Info</span>              
            </div>
            <br>
            <div class="col-12" style="padding-top: 20px;">
                <ul style="list-style-type:none;">
                    <li>
                        <div class="row">
                            <div class="col-4">
                                <span>Candidate Name :</span><br>
                                <span>{{$candidatelist->fullname}}</span>
                            </div>
                            <div class="col-4">
                                <span>NIK :</span><br>
                                <span>{{$candidatelist->niknumber}}</span>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="row" style="padding-top: 7px;">
                            <div class="col-4">
                                <span>Email :</span><br>
                                <span>{{$candidatelist->email}}</span>
                            </div>
                            <div class="col-4">
                                <span>Phone :</span><br>
                                <span>{{$candidatelist->mobilephone}}</span>
                            </div>
                        </div>
                    </li>
                </ul>    
                <hr>
            </div>
    </div>
</div>
@endif
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="{{ URL::asset('js/app.js') }} "></script>
<script>
jQuery(document).ready(function ()
    {
 $('.checkhistory').click(function(){

var book_id = $(this).data('id');
// console.log(book_id);
$.ajax
({ 
    url: '/checkhistory/' +book_id,
    dataType : "json",
    type: 'get',
    success: function(data)
    {   
        if (data.status == "NotAttend") {
        //  block of code to be executed if condition1 is true
        document.getElementById("interviewcompany").style.display = "none";
        document.getElementById("ifnotattend").style.display = "block";
        document.getElementById("notattend").innerHTML = data.reason;
        document.getElementById("ctualinterviewtime").innerHTML = data.ctualinterviewtime;
        } else if (data.status == "Rejected") {
        //  block of code to be executed if the condition1 is false and condition2 is true
        document.getElementById("interviewcompany").style.display = "none";
        document.getElementById("ifinterview").style.display = "block";
        document.getElementById("ifreject").style.display = "block";
        document.getElementById("ctualinterviewtime").innerHTML = data.ctualinterviewtime;
        document.getElementById("status").innerHTML = data.status;
        document.getElementById("user").innerHTML = data.name;
        document.getElementById("interviewnote").innerHTML = data.interviewnote;
        document.getElementById("pesonalcandidatestestimony").innerHTML = data.pesonalcandidatestestimony;
        document.getElementById("reject").innerHTML = data.reason;
        }else if (data.status == "InterviewByClient") {
        //  block of code to be executed if the condition1 is false and condition2 is false
        if (data.statusclientid == "3") {
        document.getElementById("interviewcompany").style.display = "block";
        document.getElementById("ifinterview").style.display = "block";
        document.getElementById("ifreject").style.display = "block";
        document.getElementById("interviewnote").innerHTML = data.interviewnote;
        document.getElementById("pesonalcandidatestestimony").innerHTML = data.pesonalcandidatestestimony;
        document.getElementById("ctualinterviewtime").innerHTML = data.ctualinterviewtime;
        document.getElementById("status").innerHTML = data.status;
        document.getElementById("user").innerHTML = data.name;
        document.getElementById("reject").innerHTML = data.reason;
        document.getElementById("interviewcompany").textContent= data.company+" - "+data.interviewername;
        }else{
        document.getElementById("interviewcompany").style.display = "block";
        document.getElementById("ifinterview").style.display = "block";
        document.getElementById("ifreject").style.display = "none";
        document.getElementById("interviewnote").innerHTML = data.interviewnote;
        document.getElementById("pesonalcandidatestestimony").innerHTML = data.pesonalcandidatestestimony;
        document.getElementById("ctualinterviewtime").innerHTML = data.ctualinterviewtime;
        document.getElementById("status").innerHTML = data.status;
        document.getElementById("user").innerHTML = data.name;
        document.getElementById("interviewcompany").textContent= data.company+" - "+data.interviewername;    
        }
        }else{
        document.getElementById("interviewcompany").style.display = "none";
        document.getElementById("ifinterview").style.display = "block";
        document.getElementById("interviewnote").innerHTML = data.interviewnote;
        document.getElementById("pesonalcandidatestestimony").innerHTML = data.pesonalcandidatestestimony;
        document.getElementById("ctualinterviewtime").innerHTML = data.ctualinterviewtime;
        document.getElementById("status").innerHTML = data.status;
        document.getElementById("user").innerHTML = data.name;
        }
    }
});
});
    });
</script>
<!-- <script>

$(document).ready(function() {
  
  // Get click event, assign button to var, and get values from that var
  $('#statusinterview button').on('click', function() {
    var thisBtn = $(this);
    
    thisBtn.addClass('active').siblings().removeClass('active');
    var btnText = thisBtn.text();
    var btnValue = thisBtn.val();
    
    document.getElementById("sci").value = btnValue;
  });
});
</script> -->
<script>
// $(document).ready(function() { 
//     document.getElementById("1").click();
//  });
$('#statusinterview button').on('click', function() {
    var thisBtn = $(this);
    
    thisBtn.addClass('active').siblings().removeClass('active');
    var btnText = thisBtn.text();
    var btnValue = thisBtn.val();
  if (this.id != 3) {
    document.getElementById("myDIV").style.display =  "none";
  } else {
    document.getElementById("myDIV").style.display = "block";
  }
  document.getElementById("statusidint").value =  btnValue;
});
</script>
@endsection
</body>
