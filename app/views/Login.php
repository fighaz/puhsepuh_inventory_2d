<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="@sweetalert2/theme-bootstrap-4/bootstrap-4.css">
    <script src="sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
</head>

<body>
<div class="container d-flex align-items-center justify-content-center vh-100">
        <form id="login-form" class="w-25" action="<?= BASEURL; ?>/Auth/login" method="post">
            <div class="d-flex justify-content-center mb-3">
                <img src="assets/jti-logo.png" alt="logo" class="img-fluid">
            </div>
            <div class="form-group">
                <input type="username" name="username" class="form-control border border-primary shadow-sm border-3" id="username-input"
                    aria-describedby="usernameHelp" placeholder="Username" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control border border-primary shadow-sm border-3" id="password-input"
                    placeholder="Password" required>
            </div>
            <div class="d-flex justify-content-end forgot-password">
                <!--<a href="#" class="text-primary"><small>Lupa Password?</small></a>-->
            </div>
            <button type="submit" class="text-white btn btn-primary btn-lg shadow-sm mt-3">Masuk</button>
        </form>
    </div>
    <script>
        <?php session_start() ?>
        if (<?=$_SESSION['login_success'] == false?>) {
            Swal.fire({
                title: 'Login Gagal',
                text: 'Silahkan coba lagi',
                icon: 'danger',
                timer: 2000,
                timerProgressBar: true,
            });
            <?php $_SESSION['login_success'] = true?>
        }
    </script>
    <style>
        #login-form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .forgot-password {
            margin: -10px 5px;
        }

        .forgot-password>a {
            text-decoration: none;
        }
        
        img {
            width: 35%;
            height: 35%;
        }
    </style>
</body>

</html>
