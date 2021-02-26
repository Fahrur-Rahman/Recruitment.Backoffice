@extends('dashboard/header')

@section('home')
<div class="content">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <div class='container'>
            <h1 class="m-0 text-dark">Candidate</h1>
            </div>
          </div>
            <form action="/cari" method="GET" class="ml-auto">
            <div class="row">
                <div >
                <input class="form-control" type="text" name="cari" placeholder="Search" value="{{ old('cari') }}">
                </div>
                <div  style="padding-left: 5px; padding-bottom: 15px;">
                <button type="sumbit" class="btn btn-primary">Search</button>
                </div>
                </div>                                              
	        </form>
        </div>
        </div>
    </div>
</div>
    <!-- Table -->
    <div class="card col-10 offset-1">
        <div class="card-body table-responsive p-0">
        <table class="table">
            <thead style="text-align: center;">
                <tr>
                <th scope="col">Nama</th>
                <th scope="col">No.KTP</th>
                <th scope="col">Posisi yang di lamar</th>
                <th scope="col">Tanggal Melamar</th>
                <th scope="col"></th>
                </tr>
            </thead>
            <tbody style="text-align: center;">
            @foreach($candidateform as $form)
                <tr>
                <th scope="row">{{$form->fullname}}</th>
                <td>{{$form->nik}}</td>
                <td>{{$form->position}}</td>
                <td>{{$form->applydate}}</td>
                <td><a href="/details/{{$form->candidateid}}" class="badge badge-primary">Details</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        </div>
        </br>
              {{$candidateform->links()}}
    </div>
@endsection