<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">

    <title>MKOST</title>

    <style>
        body {
            overflow: hidden;
        }

        .h-full {
            height: 100vh;
        }
    </style>

</head>

<body class="bg-light">
    <div class="h-full bg-gradient-secondary d-flex align-items-center justify-content-center" style="height: 100vh;">
        <div class="col-md-4 bg-white shadow p-3">
            <div class="row">
                <div class="col-auto d-flex align-items-center">
                    <img src="./dist/img/logo.png" alt="logo" class="rounded-circle" width="55">
                </div>
                <div class="col-auto">
                    <span class="font-weight-bold h5 text-secondary">DAFTAR </span> <br>
                    <small class="text-secondary">Rasakan kenyamanan bersama MKOST!</small>
                </div>
            </div>
            <hr>
            <form action="./config.php" method="post" enctype="multipart/form-data">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                    </div>
                    <input type="text" class="form-control" name="nama" placeholder="Masukkan nama"
                        aria-label="Username" aria-describedby="basic-addon1" autofocus required>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-phone"></i></span>
                    </div>
                    <input type="tel" class="form-control" name="telp" placeholder="Masukkan No Telp"
                        aria-label="Username" aria-describedby="basic-addon1" required>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">@</span>
                    </div>
                    <input type="email" class="form-control" name="email" placeholder="Masukkan email"
                        aria-label="Username" aria-describedby="basic-addon1" required>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-key"></i></span>
                    </div>
                    <input type="password" class="form-control" name="password" placeholder="Masukkan password"
                        aria-label="Username" aria-describedby="basic-addon1" required>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-key"></i></span>
                    </div>
                    <input type="password" class="form-control" name="password2" placeholder="Konfirmasi password"
                        aria-label="Username" aria-describedby="basic-addon1" required>
                </div>
                <div class="input-group mb-3">
                    <label for="foto" class="w-100 text-secondary">Foto KTP</label>
                    <input type="file" name="foto" accept="images/*" required>
                </div>
                <hr>
                <button type="submit" name="daftar" class="btn btn-primary btn-block">Daftar</button>
            </form>
            <div class="text-center mt-3">
                <div class="text-secondary">Sudah punya akun? <a href="index.php">login</a></div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
        crossorigin="anonymous"></script>
</body>

</html>