<?php 
    include "../../../conn.php";
    session_start();
    $id=$_SESSION['id'];
    if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['del-goal'])){
        $result=sql_query("DELETE FROM `goals` WHERE `id` = ".intval($_POST['del-goal'])."");
    }
    if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['complete-goal'])){
        $result=sql_query("UPDATE `goals` SET `status` = '1' WHERE `id` = ".$_POST['complete-goal']."");
    }
    if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['restore-goal'])){
        $result=sql_query("UPDATE `goals` SET `trash` = '0' WHERE `id` = ".$_POST['restore-goal']."");
    }
    if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['date-change'])){
        $result=sql_query("UPDATE `goals` SET `created` = '".$_POST['date-change']."' WHERE `id` = ".$_SESSION['goal-id']."");
    }
    if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['end-change'])){
        $result=sql_query("UPDATE `goals` SET `end` = '".$_POST['end-change']."' WHERE `id` = ".$_SESSION['goal-id']."");
    }
    if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['disc-change'])){
        $result=sql_query("UPDATE `goals` SET `disc` = '".$_POST['disc-change']."' WHERE `id` = ".$_SESSION['goal-id']."");
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

    <title>SB Admin 2 - Tables</title>

    <!-- Custom fonts for this template -->
    <link href="/Personal-Productivity-Planner/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet"
        type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/Personal-Productivity-Planner/admin/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="/Personal-Productivity-Planner/admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.js"
        integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous">
        </script>
    <script>
        $(function () {
            $("#sidebar").load("/Personal-Productivity-Planner/admin/sidebar.php");
            $("#nav").load("/Personal-Productivity-Planner/admin/nav.php");
            $("#footer").load("/Personal-Productivity-Planner/admin/footer.html");
        });
    </script>
    <style>
        .goals-nav {
            margin-top: 10px
        }

        .goals-list {
            margin: 10px 0
        }

        .goals-list .goals-item {
            padding: 5px;
            margin: 5px 0;
            border-radius: 0;
            background: #ffffff
        }
        .goals-list.only-active .goals-item.complete {
            display: none
        }

        .goals-list.only-active .goals-item:not(.complete) {
            display: block
        }

        .goals-list.only-complete .goals-item:not(.complete) {
            display: none
        }

        .goals-list.only-complete .goals-item.complete {
            display: block
        }

        .goals-list .goals-item.complete span {
            text-decoration: line-through
        }

        .remove-goals-item {
            color: #ccc;
            visibility: hidden
        }

        .remove-goals-item:hover {
            color: #5f5f5f
        }

        .goals-item:hover .remove-goals-item {
            visibility: visible
        }

        div.checker {
            width: 18px;
            height: 18px
        }

        div.checker input,
        div.checker span {
            width: 18px;
            height: 18px
        }

        div.checker span {
            display: -moz-inline-box;
            display: inline-block;
            zoom: 1;
            text-align: center;
            background-position: 0 -260px;
        }

        div.checker,
        div.checker input,
        div.checker span {
            width: 19px;
            height: 19px;
        }

        div.checker,
        div.radio,
        div.uploader {
            position: relative;
        }

        div.button,
        div.button *,
        div.checker,
        div.checker *,
        div.radio,
        div.radio *,
        div.selector,
        div.selector *,
        div.uploader,
        div.uploader * {
            margin: 0;
            padding: 0;
        }

        div.button,
        div.checker,
        div.radio,
        div.selector,
        div.uploader {
            display: -moz-inline-box;
            display: inline-block;
            zoom: 1;
            vertical-align: middle;
        }
    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar"></div>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <div id="nav"></div>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid" style="padding-left:0;padding-right:0;">
                    <div class="row align-items-start">
                        <div class="col" style="padding-right:0;">
                            <div class="card mb-4" style="border: 0px;border-right: 1px solid #e3e6f0;border-radius: 0;">
                                <div class="card-body">
                                    <h4>Trash goal</h4>
                                    <?php 
                                    $result=sql_query("SELECT * FROM `goals` WHERE `fk_user`='$id' and `trash`= 1");
                                    if (mysqli_num_rows($result) >0) {
                                    while($row = mysqli_fetch_assoc($result)){
                                        $date=strtotime($row["created"]);
                                        $today=strtotime("now");
                                        $tomorrow=strtotime("tomorrow");
                                        $yesterday=strtotime("yesterday");
                                        echo '
                                        <form action="trash-goals.php" method="POST">
                                        <div class="goals-list" style="border-bottom: 1px solid #ccc;">
                                        <div class="goals-item">
                                            <div class="checker"><span class=""><input type="checkbox" onChange="this.form.submit()" name="complete-goal" value="'.$row['id'].'"></span></div>
                                            <button type="submit" class="btn btn-link" name="open-goal" value="'.$row['id'].'"<span>'.$row["name"].'</span></button>
                                            <span class="time float-right">';
                                            if(strval(date('d-M-y', $today))==strval(date('d-M-y', $date))){echo "Today";}
                                            else if(strval(date('d-M-y', $tomorrow))==strval(date('d-M-y', $date))){echo "Tomorrow";}
                                            else if(strval(date('d-M-y', $yesterday))==strval(date('d-M-y', $date))){echo "Yesterday";}
                                            echo'<button type="submit" name="del-goal" value="'.$row['id'].'" class="close ml-3" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <button type="submit" name="restore-goal" value="'.$row['id'].'" class="close ml-3" aria-label="Close"><span aria-hidden="true">↻</span></button>
                                            </span>
                                                      <div class="ml-4 small">'.$row["disc"].'</div>
                                        </div>
                                    </div>
                                    </form>';
                                        }
                                    }
                                    
                                    ?>
                                </div>
                            </div>
                        </div>
                            <div class="col" style="padding-left:0;">
                                <div class="card mb-4" style="border: 0px;border-radius: 0;">
                                    <div class="card-body">
                                    <?php
                                    if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['open-goal'])){
                                        $_SESSION['goal-id']=intval($_POST['open-goal']);
                                        $result=sql_query("SELECT * FROM `goals` WHERE `id` = ".$_SESSION['goal-id']."");
                                        if (mysqli_num_rows($result) >0) {
                                            while($row = mysqli_fetch_assoc($result)){
                                                $startdate=strtotime($row["created"]);
                                                $strstartdate=strval(date('Y-m-d', $startdate));
                                                $enddate=strtotime($row["end"]);
                                                $strenddate=strval(date('Y-m-d', $enddate));
                                                // die($strtime);
                                                echo '<form action="goals.php" method="POST">
                                                        <div class="p-2 bg-white notes">
                                                        <div class="d-flex flex-row align-items-center notes-title">
                                                        <span class=""><input type="checkbox" style="width: 19px;height: 19px;"></span>
                                                        <span><h4>&nbsp;'.$row['name'].'</h4></span>
                                                        <span class="float-right">
                                                        <span class="dropdown no-arrow">
                                                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                                                <a class="dropdown-item" href="#">Re-schedule</a>
                                                                <a class="dropdown-item" href="#">Won\'t Do</a>
                                                                <a class="dropdown-item" href="#">Trash</a>
                                                                <div class="dropdown-divider"></div>
                                                                <a class="dropdown-item" href="#">Something else here</a>
                                                            </div>
                                                        </span>
                                            </div>
                                            Start Date&nbsp;&nbsp;<input onChange="this.form.submit()" style="border:none;" name="date-change" type="date" value="'.$strstartdate.'" min="'.$strstartdate.'" ">
                                            <span class="float-right">
                                            End Date&nbsp;&nbsp;<input onChange="this.form.submit()" style="border:none;" name="end-change" type="date" value="'.$strenddate.'" min="'.$strenddate.'" ">
                                            </span>
                                        </div>
                                        <div class="p-2 bg-white">
                                        <label for="exampleFormControlTextarea1">Description</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" style="border:none;" rows="10" onChange="this.form.submit()" name="disc-change">'.$row['disc'].'</textarea>
                                        
                                        </div> 
                                    </div>
                                    </form>';
                                }
                            }
                        }
                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; Your Website 2020</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="/Personal-Productivity-Planner/admin/#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="/Personal-Productivity-Planner/admin/login.html">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="/Personal-Productivity-Planner/admin/vendor/jquery/jquery.min.js"></script>
        <script src="/Personal-Productivity-Planner/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="/Personal-Productivity-Planner/admin/vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="/Personal-Productivity-Planner/admin/js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <script src="/Personal-Productivity-Planner/admin/vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="/Personal-Productivity-Planner/admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="/Personal-Productivity-Planner/admin/js/demo/datatables-demo.js"></script>

</body>

</html>