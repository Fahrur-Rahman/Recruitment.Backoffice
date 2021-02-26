<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('Asset/css/bootstrap.css') }} ">
        <link rel="stylesheet" href="{{ URL::asset('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css')}}">
    </head>
<body>
    @extends('dashboard/header')

    @section('home')
    <div class="content" style="padding : 12px; padding-top:30px;">
    <div class="col-md-3">
        <div class="card">
              <div class="card-body" style="text-align:center;">
              <h3><strong>{{$candidatelist->fullname}}</strong></h3><br>
              <div>
                <a href="/details/{{$link->candidateid}}" class="btn btn-primary" type="submit">Candidate Information</a>
              </div>
              </div>                    
        </div>
        <!-- /.card -->
    </div>
</div>
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
        document.getElementById("ifnotattend").style.display = "none";
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
        document.getElementById("ifnotattend").style.display = "none";
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
        document.getElementById("ifnotattend").style.display = "none";
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
        document.getElementById("ifnotattend").style.display = "none";
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
@endsection
</body>

</html>