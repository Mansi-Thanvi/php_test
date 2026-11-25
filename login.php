<?php
    include 'db.php';

    if($_SERVER['REQUEST_METHOD']==='POST'){
        $uemail = $_POST['uemail'];
        $pass = $_POST['pass'];

        if(empty($uemail) || empty($pass)){
            echo "<script>alert('Please fill all the details.')</script>";
        }
        elseif (!filter_var($uemail, FILTER_VALIDATE_EMAIL)) {
            echo "<script>alert('Email must be in correct format')</script>";
        }
        else{            
            $sql = $conn -> prepare('select password_hash, full_name from users where email = ?');
            $sql -> bind_param('s', $uemail);
            $sql -> execute();
            $sql -> bind_result($pass_hash, $uname);
            $sql -> fetch();

            if(password_verify($pass, $pass_hash)){
                $_SESSION['uname'] = $uname;
                header('Location:dashboard.php');
            }
            else{
                echo "<script>alert('User not found. Check your password or email.')</script>";
            }
        }
    }
?>
<!doctype html>
<html lang="en" data-bs-theme="light">
    <head>
        <title>Register</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- Bootstrap CSS v5.3.8 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
            crossorigin="anonymous"
        />
    </head>

    <body>
        <header>
            <!-- place navbar here -->
        </header>
        <main>
            <div
                class="container my-5 py-4 col-5 border rounded shadow"
            >
                <h1 class="text-center">Log-in</h1>
            <form class="py-2" action="" method="post">
                
                <div class="mb-3">
                    <label for="" class="form-label">Enter Your Email</label>
                    <input
                        type="email"
                        class="form-control"
                        name="uemail"
                        id=""
                        aria-describedby="emailHelpId"
                        placeholder="abc@mail.com"
                    />
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Password</label>
                    <input
                        type="password"
                        class="form-control"
                        name="pass"
                        id=""
                        placeholder=""
                    />
                </div>
                <center><button
                    type="submit"
                    class="btn btn-primary"
                >
                    Log-in
                </button></center>
                
                
            </form>
            <p>New user? <a href="register.php">Register here</a></p>
            </div>
            
        </main>
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Bundle (includes Popper) -->
        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
