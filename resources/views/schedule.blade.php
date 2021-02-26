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
    <!-- Content Wrapper. Contains page content -->
	<div class="content">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <div class='container'>
            <h1 class="m-0 text-dark">Schedule</h1>
            </div>
          </div>
          @can('isRecruiter')
          <div class="ml-auto">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newcandidate">New Candiate</button>
          </div>
          @endcan
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
        
        <form action="/carischedule" method="GET">
        <div class="col-3 offset-9 row">
                <div class= "col-8">
                <input class="form-control" type="text" name="cari" placeholder="Search" value="{{ old('cari') }}">
                </div>
                <div class= "col-4" style="padding-left: 5px; padding-bottom: 15px;">
                <button type="sumbit" class="form-control btn btn-primary">Search</button>
                </div>
                </div>
        </form>
        
    <div class="card col-10 offset-1">
              <div class="card-body table-responsive p-0">
                <table class="table">
                  <thead>
                  <tr>
                    <th>Nik</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Position</th>
                    <th>Schedule Date</th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($table as $tablecandidate)
                  <tr>
                    <td>{{$tablecandidate->niknumber}}</td>
                    <td>{{$tablecandidate->fullname}}</td>
                    <td>{{$tablecandidate->email}}</td>
                    <td>{{$tablecandidate->positionname}}</td>
                    <td>{{$tablecandidate->scheduledate}}</td>
                    <td>
                    @can('isRecruiter')
                    <a href="/editnewcandidateschedule/{{$tablecandidate->scheduleid}}" type="button" class="btn btn-warning btn-sm" style="border-radius:2em;">
                   Edit
                    </a>
                    @endcan
                    @can('isInterviewer')
                        <a href="/link/{{$tablecandidate->scheduleid}}" class="btn btn-success btn-sm active" style="border-radius:2em;" role="button" aria-pressed="true">Interview</a>
                        <a href="/notattend/{{$tablecandidate->scheduleid}}" type="button" class="btn btn-danger btn-sm" style="border-radius:2em;">Not-Attend</a>
                        @endcan
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              </br>
              {{$table->links()}}
            </div>
            <!-- /.card -->
          </div>
<!-- New Candidate -->
<div class="modal fade" id="newcandidate" tabindex="-1" role="dialog" aria-labelledby="newcandidateLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
            <div class="row">
                <div class="col">
                    <h5 class="modal-title" id="newcandidateLabel" style="text-align:center;">New Candidate</h5>
                </div>
                <div class="ml-auto">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <br/>
            <div style="text-align:center;">
                <a href="yesnewcandidate" type="button" class="btn btn-primary" style="margin-right:2px text-color:white;">Yes</a>
                <a href="nonewcandidate" type="button" class="btn btn-primary" style="margin-left:2px text-color:white;">No</a>
            <div>
      </div>
    </div>
  </div>
</div>
      </div>
	  </div>
<!-- New Candidate Form -->
<div class="modal fade" id="formnewcandidate" tabindex="-1" role="dialog" aria-labelledby="formnewcandidateLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-body">
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
            <form action="/postcandidatelist" method="POST">
            @csrf
              <div class="form-group">
                <label class="col-form-label">NIK</label>
                <input name="nik" type="text" class="form-control">
              </div>
              <div class="form-group">
                <label class="col-form-label">Full Name</label>
                <input name="fullname" type="text" class="form-control">
              </div>
              <div class="form-group">
                <label class="col-form-label">Email</label>
                <input name="email" type="text" class="form-control">
              </div>
              <div class="form-group">
                <label class="col-form-label">Phone Number</label>
                <input name="phonenumber" type="text" class="form-control">
              </div>
              <div class="form-group">
                <label class="col-form-label">Position</label>
                <!-- <input name="position" type="text" class="form-control"> -->
                <select class="form-control" name="position" id="newcandidateposition">
                          <option selected="selected">Choose...</option>
                        @foreach($posisi as $pos)
                          <option value="{{$pos->positionname}}" >{{$pos->positionname}}</option>
                        @endforeach
                        </select>
              </div>
              <div class="form-group">
                <label class="col-form-label">Schedule Date</label>
                <input name="scheduledate" class="form-control" type="datetime-local" id="example-datetime-local-input">
              </div>
                  <button type="submit" class="btn btn-primary">Save</button>
              </form>
            </div>
            </div>
      </div>
    </div>
  </div>
</div>
<!-- Not Attend -->
<div class="modal fade" id="formnotattend" tabindex="-1" role="dialog" aria-labelledby="formnotattendLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
            <div class="card">
            <div class="card-body">
                <form method="POST" action="/rejected"> 
                    @csrf
                    <div class="form-group">
                        <label for="formnotattendreason" class="col-form-label">Not Attend Reason</label>
                        <textarea class="form-control" name="notattendreason" id="message-text" rows="3"></textarea>
                    </div>
                    <input name="noattsi" id="noattsi" type="hidden">
                    <input name="sdate" id="sdate" type="hidden">
                    <div class="form-group">
                        <div class="ml-auto" style="text-align:center">
                            <button type="sumbit" class="btn btn-primary" style="margin-right:2px">Save</button>
                            <button type="button" class="btn btn-primary" style="margin-left:2px" data-target="#formnotattend" data-dismiss="modal" aria-label="Close">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
            </div>
      </div>
    </div>
  </div>
</div>
<!-- Edit Candidate Form -->
<div class="modal fade" id="editformnewcandidate" tabindex="-1" role="dialog" aria-labelledby="editformnewcandidateLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
            <div class="card">
            <div class="card-body">
            <form action="/editschedule" method="POST">
                @csrf
                    <div class="form-group">
                        <label for="niknewcandidate" class="col-form-label">NIK</label>
                        <input name="nik" id="nik" type="text" class="form-control">
                    </div>
                    <input name="sci" id="sci" type="hidden">
                    <input name="ci" id="ci" type="hidden">
                    <input name="pi" id="pi" type="hidden">
                    <div class="form-group">
                        <label for="namenewcandidate" class="col-form-label">Full Name</label>
                        <input name="fullname" id="fullname" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="emailnewcandidate" class="col-form-label">Email</label>
                        <input name="email" id="email" type="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="phonenumbernewcandidate" class="col-form-label">Phone Number</label>
                        <input name="phone" id="phone" type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="positionnewcandidate" class="col-form-label">Position</label>
                        <!-- <input name="position" id="position" type="text" class="form-control"> -->
                        <select class="form-control" name="position" id="position" >
                          <option selected="selected">Choose...</option>
                        @foreach($posisi as $pos)
                          <option value="{{$pos->positionname}}" >{{$pos->positionname}}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="row">  
                      <div class="form-group">
                        <label for="schedulenewcandidate" class="col-form-label">Schedule Date</label><br>
                        <label for="datenewcandidate" id="date" class="col-form-label">Date</label>
                      </div>
                      <div class="form-group ml-auto">
                        <div class="ml-auto" style="text-align:right;">
                            <i class="ion ion-android-time" id="reschedulemodal" style="font-size:30px;" data-toggle="modal" data-target="#formreschedule"></i>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                        <div class="ml-auto" style="text-align:center">
                            <button type="submit" class="btn btn-primary" style="margin-right:2px">Save</button>
                            <button type="button" class="btn btn-primary" style="margin-left:2px" data-target="#editformnewcandidate" data-dismiss="modal" aria-label="Close">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
            </div>
      </div>
    </div>
  </div>
</div>
<!-- No New Candidate -->
<div class="modal fade" id="nonewcandidate" tabindex="-1" role="dialog" aria-labelledby="nonewcandidateLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
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
                <form method="POST" action="/notnew"> 
                    @csrf
                    <div class="form-group">
                        <label class="col-form-label">Candidate List</label>
                        <select class="form-control" id='notnewcandidatelist' name='notnewcandidatelist'>
                          <option selected="selected">Choose...</option>
                        @foreach($modalcandidatelist as $list)
                          <option value="{{$list->candidatelistid}}" >{{$list->niknumber}} - {{$list->fullname}}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Position Name</label>
                        <select class="form-control" name="notnewcandidateposition" id="notnewcandidateposition">
                          <option selected="selected">Choose...</option>
                        @foreach($posisi as $pos)
                          <option value="{{$pos->positionname}}" >{{$pos->positionname}}</option>
                        @endforeach
                        </select>
                        <!-- <input name="notnewcandidateposition" id="notnewcandidateposition" type="text" class="form-control"> -->
                    </div>
                    <input name="notcandidatelistid" id="notcandidatelistid" type="hidden">
                    <div class="form-group">
                      <label class="col-form-label">Schedule Date</label>
                      <input name="notscheduledate" class="form-control" type="datetime-local" id="notscheduledate">
                    </div>
                    <div class="form-group">
                        <div class="ml-auto" style="text-align:center">
                            <button type="sumbit" class="btn btn-primary" style="margin-right:2px">Save</button>
                            <button type="button" class="btn btn-primary" style="margin-left:2px" data-target="#nonewcandidate" data-dismiss="modal" aria-label="Close">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
            </div>
      </div>
    </div>
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
                    <input type="text" name="rescheduledate" class="form-control datetimepicker-input" id="datepicker1" data-target="#datetimepicker1"/>
                    <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
                    </div>
                    <input name="resi" id="resi" type="hidden">
                    <input name="reci" id="reci" type="hidden">
                    <input name="repi" id="repi" type="hidden">
                    <input name="renik" id="renik" type="hidden">
                    <input name="rename" id="rename" type="hidden">
                    <input name="reposition" id="reposition" type="hidden">
                    <input name="reemail" id="reemail" type="hidden">
                    <input name="rephone" id="rephone" type="hidden">
                    <div class="form-group">
                        <label for="reschedulereason" class="col-form-label">Reschedule Reason</label>
                        <textarea class="form-control" name="reschedulereason" id="reason" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <div class="ml-auto" style="text-align:center">
                            <button type="sumbit" class="btn btn-primary" style="margin-right:2px">Save</button>
                            <button type="button" class="btn btn-primary" style="margin-left:2px" data-target="#formreschedule" data-dismiss="modal" aria-label="Close">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
            </div>
      </div>

    </div>
  </div>
</div>
<script src="{{ URL::asset('js/app.js') }} "></script>
<script>
  var datanik;
  var dataname;
  var dataemail;
  var dataphone;
  var dataposition;
  var datadate;
  var datapi;
  var datasi;
  var dataci;
$('#editformnewcandidate').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var nik = button.data('nik')
  var name = button.data('name')
  var email = button.data('email')
  var phone = button.data('phone')
  var position = button.data('position')
  var date = button.data('date')
  var pi = button.data('pi')
  var si = button.data('si')
  var ci = button.data('ci')
  
  var modal = $(this)
  modal.find('.modal-body #date').text(date);
  modal.find('.modal-body #nik').val(nik);
  modal.find('.modal-body #fullname').val(name);
  modal.find('.modal-body #email').val(email);
  modal.find('.modal-body #phone').val(phone);
  modal.find('.modal-body #position').val(position);
  modal.find('.modal-body #pi').val(pi);
  modal.find('.modal-body #sci').val(si);
  modal.find('.modal-body #ci').val(ci);
  datanik = nik;
  dataname= name;
  dataemail= email;
  dataphone= phone;
  dataposition= position;
  datadate= date;
  datapi= pi;
  datasi= si;
  dataci= ci;
});
document.getElementById("reschedulemodal").addEventListener("click",$('#formreschedule').on('show.bs.modal',function ()
  {
    var renik = datanik;
    var rename = dataname;
    var reemail = dataemail;
    var rephone = dataphone;
    var reposition = dataposition;
    var redate = datadate;
    var repi = datapi;
    var resi = datasi;
    var reci = dataci;

    var modal = $(this)
    $('#datetimepicker1').datetimepicker({defaultDate: redate,
    format: 'YYYY-MM-DD HH:mm:ss'
});
  //   $(function() {
  // //  $('#datepicker1').datetimepicker({value: redate ,format: 'YYYY-MM-DD HH:mm:ss'});
  // $('#datepicker1').datetimepicker({
  //           defaultDate: redate,
  //           format: 'YYYY-MM-DD HH:mm:ss'
  //       }).datetimepicker({format: 'YYYY-MM-DD HH:mm:ss'
  //       });
  // });
  // $("#datepicker1").datetimepicker("setDateTime", redate);
// $("#datepicker1").change();
  // $('#datepicker1').datepicker({dateFormat: 'YYYY-MM-DD HH:mm:ss', showClear: true}).val(redate).change();
    modal.find('.modal-body #renik').val(renik);
    modal.find('.modal-body #rename').val(rename);
    modal.find('.modal-body #reemail').val(reemail);
    modal.find('.modal-body #rephone').val(rephone);
    modal.find('.modal-body #reposition').val(reposition);
    modal.find('.modal-body #repi').val(repi);
    modal.find('.modal-body #resi').val(resi);
    modal.find('.modal-body #reci').val(reci);
    console.log(redate);
  })
  );
  $('#formnotattend').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var si = button.data('noattsi')
  
  var modal = $(this)
  modal.find('.modal-body #noattsi').val(si);
});
</script>
<script>     	  
 jQuery(document).ready(function ()
    {
            jQuery('select[name="notnewcandidatelist"]').on('change',function(){
               var candidatelistid = jQuery(this).val();
               if(candidatelistid)
               {
                  jQuery.ajax({
                     url : '/getcandidatelistno/' +candidatelistid,
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     {  
                        var candidatelistid = data.candidatelistid;
                        console.log(candidatelistid);
                          document.getElementById("notcandidatelistid").value = candidatelistid;
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
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script> 
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

@endsection
</body>

</html>