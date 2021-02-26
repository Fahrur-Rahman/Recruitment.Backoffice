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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/css/tempusdominus-bootstrap-4.min.css" integrity="sha256-XPTBwC3SBoWHSmKasAk01c08M6sIA5gF5+sRxqak2Qs=" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment-with-locales.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/js/tempusdominus-bootstrap-4.min.js" integrity="sha256-z0oKYg6xiLq3yJGsp/LsY9XykbweQlHl42jHv2XTBz4=" crossorigin="anonymous"></script>
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
    <form action="/postcandidatelist" method="POST">
    @csrf
      <div class="form-group">
        <label class="col-form-label"><b><h5>New Candidate</h5></b></label><hr>
      </div>
      <div class="form-group">
        <label class="col-form-label">NIK</label>
        <input name="nik" type="text" id="nik" value="{{ old('nik') }}" class="form-control">
      </div>
      <div class="form-group">
        <label class="col-form-label">Full Name</label>
        <input name="fullname" id="name" type="text" value="{{ old('fullname') }}" class="form-control">
      </div>
      <div class="form-group">
        <label class="col-form-label">Email</label>
        <input name="email" type="text" value="{{ old('email') }}" class="form-control">
      </div>
      <div class="form-group">
        <label class="col-form-label">Phone Number</label>
        <input name="phonenumber" type="text" id="phone" value="{{ old('phonenumber') }}" class="form-control">
      </div>
      <div class="form-group">
        <label class="col-form-label">Position</label>
        <select class="form-control" name="position" id="newcandidateposition" value="{{ old('position') }}">
          <option selected="selected" value="0">Choose...</option>
          @foreach($posisi as $pos)
          <option value="{{$pos->positionname}}" >{{$pos->positionname}}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group">
        <label class="col-form-label">Schedule Date</label>
        <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
          <input type="text" class="form-control datetimepicker-input" value="{{ old('scheduledate') }}" name="scheduledate" data-target="#datetimepicker1"/>
            <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
        </div>
      </div>
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="/schedule" type="button" class="btn btn-primary" style="margin-left:2px">Cancel</a>
    </form>
  </div>
</div>
<script>
$('#datetimepicker1').datetimepicker({defaultDate: scheduledate,
    format: 'YYYY-MM-DD HH:mm:ss'
});
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
        $("#name").keypress(function (e) {
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
            