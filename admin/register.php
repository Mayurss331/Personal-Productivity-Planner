<?php
include "../conn.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Register</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <script src="Checker.js" type=text/javascript></script>
    <style>
    .card{
        margin-top:15vh;
    }
    </style>
</head>

<body class="bg-gradient-primary">
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg ">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                    <?php
                        $signup=0;
                        if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['register'])){
                            $email=$_POST['email'];
                            $pass=$_POST['pass'];
                            $cpass=$_POST['cpass'];
                            $fname=$_POST['fname'];
                            $lname=$_POST['lname'];
                            $err="";
                            if(!(strlen($fname)>1&& strlen($lname)>1)){$err="Enter Proper Name & Last Name!";}
                            if($pass!=$cpass){$err="Both Password Should match";}
                            if(!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z\d]).{8,}$/', $pass)){$err="Password must contain 8 letters!";}
                            if(filter_var($email, FILTER_VALIDATE_EMAIL)&& preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z\d]).{8,}$/', $pass) && strlen($fname)>1&& strlen($lname)>1)
                            {
                                $pass=password_hash($_POST['pass'],PASSWORD_DEFAULT);
                                if(mysqli_num_rows($result=sql_query("SELECT * FROM `users` WHERE 'email'='$email'")) ==0){
                                    // die();
                                    $result=sql_query("INSERT INTO `users` (`email`, `password`, `fname`, `lname`) VALUES ('$email', '$pass', '$fname', '$lname')");
                                    header("Location: login.php?id=1");
                                }else $signup=1;
                            }
                            else{
                                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>'.$err.'</strong> 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>';
                            }
                        }

                        // if($signup){
                        // echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        // <strong>Failed !! </strong> User is Already Available
                        // <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        //     <span aria-hidden="true">&times;</span>
                        // </button>
                        // </div>';
                        // }
                        
                        
                    ?>
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form method="POST" action="register.php" class="users">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="exampleFirstName"
                                            name="fname" placeholder="First Name">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="exampleLastName"
                                            name="lname"placeholder="Last Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" id="exampleInputEmail"
                                        name="email"placeholder="Email Address" required>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                            name="pass"id="exampleInputPassword" title="Must Have!
one capital letter
one small letter 
one special character 
one number" placeholder="Password" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            name="cpass"id="exampleRepeatPassword" placeholder="Repeat Password"required>
                                    </div>
                                </div>
                                <input type="submit" name="register" value="Register Account" onclick="validateForm()"class="btn btn-primary btn-user btn-block">                   
                                <hr>
                                
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.php">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="login.php">Already have an account? Login!</a>
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