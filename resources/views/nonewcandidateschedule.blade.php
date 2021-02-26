<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('Asset/css/bootstrap.css') }} ">
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
    <form method="POST" action="/notnew"> 
    @csrf
        <div class="form-group">
            <label class="col-form-label"><b><h5>New Candidate</h5></b></label><hr>
        </div>
        <div class="form-group">
            <label class="col-form-label">Candidate List</label>
            <select class="form-control" id='notnewcandidatelist' value="{{ old('notnewcandidatelist') }}" name='notnewcandidatelist'>
                <option selected="selected" value="0">Choose...</option>
                @foreach($modalcandidatelist as $list)
                <option value="{{$list->candidatelistid}}" >{{$list->niknumber}} - {{$list->fullname}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label class="col-form-label">Position Name</label>
            <select class="form-control" name="notnewcandidateposition" value="{{ old('notnewcandidateposition') }}" id="notnewcandidateposition">
                <option selected="selected" value="0">Choose...</option>  
                @foreach($posisi as $pos)
                <option value="{{$pos->positionid}}" >{{$pos->positionname}}</option>
                @endforeach                      
            </select>
        </div>
        <div class="form-group">
            <label class="col-form-label">Schedule Date</label>
            <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                <input type="text" class="form-control datetimepicker-input" value="{{ old('notscheduledate') }}" name="notscheduledate" data-target="#datetimepicker1"/>
            <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
            </div>
            </div>
        </div>
        <div class="form-group">
            <div class="ml-auto" style="text-align:center">
                <button type="sumbit" class="btn btn-primary" style="margin-right:2px">Save</button>
                <a href="/schedule" type="button" class="btn btn-primary" style="margin-left:2px">Cancel</a>
            </div>
        </div>
    </form>
  </div>
</div>
<script>
$('#datetimepicker1').datetimepicker({defaultDate: scheduledate,
    format: 'YYYY-MM-DD HH:mm:ss'
});
</script>
</body>
