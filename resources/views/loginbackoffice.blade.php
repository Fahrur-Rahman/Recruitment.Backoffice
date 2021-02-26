
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('Asset/css/bootstrap.css') }} ">
	</head>
	<body>
        <div class="container">
            <div class="row justify-content-center align-items-center" style="height:100vh">
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="/postbackoffice">
                            @csrf
                                <dic class="form-group">
                                    <img src="Asset/image/adidatafoto.jpg" width="300px" height="80px">
                                </dic>
                                <div class="form-group">
                                    <label>Username</label>
                                    <br>
                                    <input name="name" type="name" id="inputName" class="form-control" placeholder="Username" required autofocus>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <br>
                                    <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required>
                                </div>
                                <button class="btn btn-green-light-brand btn-block">SIGN IN</button>
                                <!-- <a class="btn btn-primary" href="/backoffice" role="button">Login</a> -->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="{{ URL::asset('Asset/js/jquery.js') }} "></script> 
    <script src="{{ URL::asset('Asset/js/popper.js') }} "></script> 
    <script src="{{ URL::asset('Asset/js/bootstrap.js') }} "></script> 
</html>