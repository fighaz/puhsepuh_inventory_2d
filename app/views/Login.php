<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
        <link href="css/bootstrap.css" rel="stylesheet">
    </head>
    <body>
        <div class="container mt-5 w-25">
            <form id="login-form" class="">
                <div class="d-flex justify-content-center">
                    <img src="assets/jti-logo.png" alt="logo" class="img-fluid w-25 h-25">
                </div>
                <div class="form-group">
                  <input type="username" class="form-control border border-primary" id="username-input" aria-describedby="usernameHelp" placeholder="Username/Email">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control border border-primary" id="password-input" placeholder="Password">
                </div>
                <div class="d-flex justify-content-end forgot-password">
                    <a href="#" class="text-primary"><small>Lupa Password?</small></a>
                </div>
                <button type="submit" class="text-white btn btn-primary">Masuk</button>
            </form>
        </div>
        <script>
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

            .forgot-password > a {
                text-decoration: none;
            }
        </style>
    </body>
</html>
