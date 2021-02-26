<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('Asset/css/bootstrap.css') }} ">
        <link rel="stylesheet" href="{{ URL::asset('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css')}}">
        <link rel="stylesheet" href="{{ URL::asset('https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css')}}">
        <script src="{{ URL::asset('https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous') }}"></script>
		<script src="{{ URL::asset('https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous') }}"></script>
		<script src="{{ URL::asset('https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous') }}"></script>
        <link rel="stylesheet" href="{{ URL::asset('https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/css/tempusdominus-bootstrap-4.min.css" integrity="sha256-XPTBwC3SBoWHSmKasAk01c08M6sIA5gF5+sRxqak2Qs=" crossorigin="anonymous')}}" />
        <script src="{{ URL::asset('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js')}}"></script>
        <script type="text/javascript" src="{{ URL::asset('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment-with-locales.min.js')}}"></script>
        <script src="{{ URL::asset('https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/js/tempusdominus-bootstrap-4.min.js')}}" integrity="sha256-z0oKYg6xiLq3yJGsp/LsY9XykbweQlHl42jHv2XTBz4=" crossorigin="anonymous')}}"></script>
        <script src="{{ URL::asset('js/app.js') }} "></script>
	</head>
<body style="padding:35px;">
<div class="card col-4 mx-auto">
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
        <form action="/editschedule" method="POST">
        @csrf
            <div class="form-group">
                <label for="niknewcandidate" class="col-form-label">NIK</label>
                <input name="nik" value="{{ old('nik') }}" id="nik" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label for="namenewcandidate" class="col-form-label">Full Name</label>
                <input name="fullname" value="{{ old('fullname') }}" id="fullname" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label for="emailnewcandidate" class="col-form-label">Email</label>
                <input name="email" value="{{ old('email') }}" id="email" type="email" class="form-control">
            </div>
            <div class="form-group">
                <label for="phonenumbernewcandidate" class="col-form-label">Phone Number</label>
                <input name="phone" value="{{ old('phone') }}" id="phone" type="text" class="form-control">
            </div>
            <div class="form-group">
                <label for="positionnewcandidate" class="col-form-label">Position</label>
                <select class="form-control" value="{{ old('position') }}" name="position" id="position" >
                    <option selected="selected">Choose...</option>
                    @foreach($posisi as $pos)
                    <option value="{{$pos->positionid}}" >{{$pos->positionname}}</option>
                    @endforeach
                </select>
            </div>
            <div class="row">  
                <div class="form-group">
                    <label for="schedulenewcandidate" class="col-form-label">Schedule Date</label><br>
                    <label for="datenewcandidate" id="date" class="col-form-label">Date</label>
                </div>
                <input name="tanggalre" id="tanggalre" type="hidden">
                <div class="form-group ml-auto">
                    <div class="ml-auto" style="text-align:right;">
                        <i class="ion ion-android-time" id="reschedulemodal" style="font-size:30px;" data-toggle="modal" data-tanggalre="{{$schedule->scheduledate}}" data-cli="{{$candidatelist->candidatelistid}}" data-si="{{$schedule->scheduleid}}" data-target="#formreschedule"></i>
                    </div>
                </div>
            </div>
            <input name="si" id="si" type="hidden">
            <input name="cli" id="cli" type="hidden">
            <input name="coba" value="test" type="hidden">
            <div class="form-group">
                <div class="ml-auto" style="text-align:center">
                    <button type="submit" class="btn btn-primary" style="margin-right:2px">Save</button>
                    <a href="{{ url()->previous() }}" type="button" class="btn btn-primary" style="margin-left:2px">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- New Candidate Form Reschedule -->
<div class="modal fade" id="formreschedule" tabindex="-1" role="dialog" aria-labelledby="formrescheduleLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <div class="card">
          <div class="card-body">
            <form action="/editreschedule" method="POST">
                @csrf
                    <div class="form-group">
                        <label for="reschedulenewcandidate" class="col-form-label">Reschedule Date</label>
                        <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                        <input type="text" name="rescheduledate" class="form-control datetimepicker-input" id="datetimepicker1" data-target="#datetimepicker1"/>
                        <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
                    </div>
                    <input name="resi" id="resi" type="hidden">
                    <input name="recli" id="recli" type="hidden">
                    <input name="test" value="recli" type="hidden">
                    <div class="form-group">
                        <label for="reschedulereason" class="col-form-label">Reschedule Reason</label>
                        <textarea class="form-control" name="reschedulereason" id="reason" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <div class="ml-auto" style="text-align:center">
                            <button type="sumbit" class="btn btn-primary" style="margin-right:2px">Save</button>
                            <button data-dismiss="modal" type="button" class="btn btn-primary" style="margin-left:2px">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
            </div>
      </div>

    </div>
  </div>
</div>
<script>
var nik = {{$candidatelist->niknumber}};
var fullname = "{{$candidatelist->fullname}}";
var email = "{{$candidatelist->email}}";
var phone = {{$candidatelist->mobilephone}};
var cli = {{$candidatelist->candidatelistid}};
var si = {{$schedule->scheduleid}};
var tanggal = "{{$schedule->scheduledate}}";
var position = {{$positionselect->positionid}} - 1;

// Convert Date and Time
// Convert Time
var d = new Date(tanggal);
var ampm = (d.getHours() >= 12) ? "PM" : "AM";
var jam = (d.getHours() >= 12) ? d.getHours()-12 : d.getHours();

var coba =  jam+' : '+d.getMinutes()+' '+ampm;

//Convert Date
let date_ob = new Date(tanggal);
let date = ("0" + date_ob.getDate()).slice(-2);
let month = ("0" + (date_ob.getMonth() + 1)).slice(-2);
let year = date_ob.getFullYear();

// prints date & time in YYYY-MM-DD HH:MM tt format
var fixtanggal = month + "/" + date + "/" + year + " " + jam + ":" + d.getMinutes() + " " + ampm;

// On Ready page
$( document ).ready(function() {
    document.getElementById("nik").value = nik;
    document.getElementById("fullname").value = fullname;
    document.getElementById("email").value = email;
    document.getElementById("phone").value = phone;
    document.getElementById("si").value = si;
    document.getElementById("cli").value = cli;
    document.getElementById("position").selectedIndex = position;
    document.getElementById("date").innerHTML = fixtanggal;
});
document.getElementById("reschedulemodal").addEventListener("click",$('#formreschedule').on('show.bs.modal',function (event)
  {
// Convert Date and Time
// Convert Time
var button = $(event.relatedTarget)
var recipient = button.data('tanggalre')
var resi = button.data('si')
var recli = button.data('cli')

var d = new Date(recipient);
var ampm = (d.getHours() >= 12) ? "PM" : "AM";
var jam = (d.getHours() >= 12) ? d.getHours()-12 : d.getHours();
var coba =  jam+' : '+d.getMinutes()+' '+ampm;

//Convert Date
let date_ob = new Date(recipient);
let date = ("0" + date_ob.getDate()).slice(-2);
let month = ("0" + (date_ob.getMonth() + 1)).slice(-2);
let year = date_ob.getFullYear();

// prints date & time in YYYY-MM-DD HH:MM:SS format
var fixtanggaljadi = month + "/" + date + "/" + year + " " + jam + ":" + d.getMinutes() + " " + ampm;
  
    var modal = $(this)
    modal.find('.modal-body #datetimepicker1').val(fixtanggaljadi)
    modal.find('.modal-body #resi').val(resi)
    modal.find('.modal-body #recli').val(recli)
  }));
</script>
<script type="text/javascript">
    $(function () {
        $("#nik").keypress(function (e) {
            var keyCode = e.keyCode || e.which;
 
            $("#lblError").html("");
 
            //Regex for Valid Characters i.e. Numbers.
            var regex = /^[0-9]+$/;
 
            //Validate TextBox value against the Regex.
            var isValid = regex.test(String.fromCharCode(keyCode));
            if (!isValid) {
                $("#lblError").html("Only Numbers allowed.");
            }
 
            return isValid;
        });
    });
</script>
<script type="text/javascript">
    $(function () {
        $("#phone").keypress(function (e) {
            var keyCode = e.keyCode || e.which;
 
            $("#lblError").html("");
 
            //Regex for Valid Characters i.e. Numbers.
            var regex = /^[0-9]+$/;
 
            //Validate TextBox value against the Regex.
            var isValid = regex.test(String.fromCharCode(keyCode));
            if (!isValid) {
                $("#lblError").html("Only Numbers allowed.");
            }
 
            return isValid;
        });
    });
</script>
<script type="text/javascript">
    $(function () {
        $("#fullname").keypress(function (e) {
            var keyCode = e.keyCode || e.which;
 
            $("#lblError").html("");
 
            //Regex for Valid Characters i.e. Numbers.
            var regex = /^[a-zA-z ]+$/;
 
            //Validate TextBox value against the Regex.
            var isValid = regex.test(String.fromCharCode(keyCode));
            if (!isValid) {
                $("#lblError").html("Only Numbers allowed.");
            }
 
            return isValid;
        });
    });
</script>
</body>