<!DOCTYPE html>
<html lang="en">
    <?php session_start()?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mentari | E-Learning Elementary</title>

    <!-- CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-secondary" style="height:100vh">
    <div class="h-100 d-flex justify-content-center align-items-center">
        <div class="col-7 col-lg-3">
            <div class="card shadow">
                <div class="card-body">

                    <h1 class="card-title text-center text-info mt-2 fs-1 fw-bold">Mentari</h1>
                    <h2 class="card-title text-center text-success mb-4 fs-1"><i class="fa fa-bed" aria-hidden="true"></i>Masukan nama</h2>

                    <form action="startProses.php" method="post" class="col-10 mx-auto">
                        <div class="form-group mt-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input required type="text" name="nama" class="form-control" id="nama" placeholder="Ex:Farrel Laksana Soetarjo">
                        </div>
                        <div class="form-group mt-4 mb-3">
                            <input type="submit" name="aksi" value="register" class="form-control btn btn-primary">
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</body>

</html>
<!-- Harusnya ini sisi admin -->