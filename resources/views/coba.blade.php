
<link rel="stylesheet" href="https://getbootstrap.com/docs/4.5/dist/css/bootstrap.min.css">
<!-- <link rel="stylesheet" href="{{ URL::asset('https://getbootstrap.com/docs/4.5/dist/css/bootstrap.min.css')}}"> -->

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form methode="POST" action="/editchedule">
                @csrf
                    <input name="id" id="id" type="hidden">
                    <div class="form-group">
                        <label for="namenewcandidate" class="col-form-label">Full Name</label>
                        <input name="fullname" id="fullname" type="text" class="form-control">
                    </div>
                      <div class="form-group ml-auto">
                      <div class="ml-auto" style="text-align:right;">
                            <i class="ion ion-android-time" id="reschedule" style="font-size:30px;" data-toggle="modal" data-target="#formreschedule"></i>
                        </div>
                      </div>
                </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="add(document.getElementById('fullname').value)">Save changes</button>
      </div>
    </div>
  </div>
</div>
<script src="{{ URL::asset('js/app.js') }} "></script> 
<script>
function add(fullname) {
    var data = fullname;
    console.log(data);
  }
</script>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>