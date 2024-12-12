<?php
include "../conn.php";
session_start();
if(isset($_SESSION['id'])){
    header("Location: /Personal-Productivity-Planner/admin/index.php");
}
$signup=0;
$account=0;
if(isset($_GET['id'])) $account=1;
if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['login'])){
    $email=$_POST['email'];
    $pass=$_POST['pass'];
    $result=sql_query("SELECT * FROM `users` WHERE `email`='$email'");
    if(mysqli_num_rows($result) >0) { 
        while($row = mysqli_fetch_assoc($result)) { 
          if($row['email']==$email && password_verify($pass,$row['password'])){ 
            $_SESSION['id']=$row['id'];
            $_SESSION['email']=$email;
            $_SESSION['fname']=$row['fname'];
            $_SESSION['lname']=$row['lname'];
            header("Location: index.php"); 
          }else $signup=1;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link href="/Personal-Productivity-Planner/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/Personal-Productivity-Planner/admin/css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        .container{
            padding-top:10vh;
        }
        </style>

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                            <?php
                                if($account){
                                echo '<div class="alert alert-success alert-dismissible fade show" style="position:absolute;" role="alert">
                                <strong>Successfully !! </strong> Account is Created.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                                }if($signup){
                                    echo '<div class="alert alert-danger alert-dismissible fade show" style="position:absolute;" role="alert">
                                    <strong>Failed !! </strong> User is Already Available
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
                                }
                                if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['reset'])){
                                    echo '<div class="alert alert-success alert-dismissible fade show" style="position:absolute;" role="alert">
                                    <strong>Successfully !! </strong> Password sent to your registered Email    .
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>';
                                    }
                                ?>
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form action="login.php" method="POST" class="user">
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="pass" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <input type="submit" name="login" value="Login" class="btn btn-primary btn-user btn-block">
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="/Personal-Productivity-Planner/admin/forgot-password.php">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="/Personal-Productivity-Planner/admin/register.php">Create an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    
</body>

</html>