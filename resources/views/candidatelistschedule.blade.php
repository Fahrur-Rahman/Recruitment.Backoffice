<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('Asset/css/bootstrap.css') }} ">
        <link rel="stylesheet" href="{{ URL::asset('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css')}}">
        <link rel="stylesheet" href="{{ URL::asset('https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css')}}">
        <!-- <script src="{{ URL::asset('https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous') }}"></script> -->
		<!-- <script src="{{ URL::asset('https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous') }}"></script>
		<script src="{{ URL::asset('https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous') }}"></script>
        <link rel="stylesheet" href="{{ URL::asset('https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/css/tempusdominus-bootstrap-4.min.css" integrity="sha256-XPTBwC3SBoWHSmKasAk01c08M6sIA5gF5+sRxqak2Qs=" crossorigin="anonymous') }}" /> -->
        <script src="{{ URL::asset('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment-with-locales.min.js') }}"></script>
        <!-- <script src="{{ URL::asset('https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/js/tempusdominus-bootstrap-4.min.js" integrity="sha256-z0oKYg6xiLq3yJGsp/LsY9XykbweQlHl42jHv2XTBz4=" crossorigin="anonymous') }}"></script> -->
        <script src="{{ URL::asset('js/app.js') }} "></script>
    </head>
<body>
    @extends('dashboard/header')

    @section('home')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <div class='container'>
            <h1 class="m-0 text-dark">Candidate List</h1>
            </div>
          </div>
          <div class="ml-auto">
        <form action="/caricandidateschedule" method="GET">
        <div class="row">
                <div >
                <input class="form-control" type="text" name="cari" placeholder="Search" value="{{ old('cari') }}">
                </div>
                <div  style="padding-left: 5px; padding-bottom: 15px;">
                <button type="sumbit" class="form-control btn btn-primary">Search</button>
                </div>
                </div>                
        </form>
        </div><!-- /.row -->
        </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- <button type="button" class="btn btn-danger btn-sm" style="border-radius:2em;" data-toggle="modal" data-target="#exampleModals" data-whatever="9">Interview by Client</button> -->
    <div class="card col-10 offset-1">
              <div class="card-body table-responsive p-0">
                <table class="table">
                  <thead>
                  <tr>
                    <th>Candidate Name</th>
                    <th>Last Interview</th>
                    <th>Total Interview</th>
                    <th>Last Status</th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($candidatelistschedule as $candidate)
                  <tr>
                    <td>{{$candidate->fullname}}</td>
                    <td>{{$candidate->ctualinterviewtime}}</td>
                    <td>{{$candidate->jml}}</td>
                    <td>{{$candidate->status}}</td>
                    <td>
                    <a href="/history/{{$candidate->interviewid}}" class="btn btn-success btn-sm active" style="border-radius:2em;" role="button" aria-pressed="true">History</a>
                    @if($candidate->status == 'Propose')
                        <a href="/forminterviewclient/{{$candidate->interviewid}}" type="button" class="btn btn-danger btn-sm" style="border-radius:2em;">Interview by Client</a>
                        @else

                        @endif
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              </br>
              {{$candidatelistschedule->links()}}
            </div>
<script src="{{ URL::asset('js/app.js') }} "></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script> 
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
@endsection
</body>

</html>