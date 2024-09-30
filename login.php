<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyApp | Login</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fontawesome/css/all.css">
</head>
<body class="bg-dark">
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-lg-5">
                <div class="card o-hidden border-1 my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg">
                                <div class="p-5">
                                    <div class="text-center mb-4">
                                        <h4>Welcome to Apotik App</h4>
                                    </div>
                                    <form action="config.php" method="POST">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                                            <input type="text" class="form-control" placeholder="nama" aria-label="nama" aria-describedby="basic-addon1" name="nama">
                                        </div>
                                        
                                        <div class="input-group mb-3">
                                            <input type="submit" class="btn btn-primary form-control" name="login" value="Login">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
<!-- Harusya ini sisi user -->