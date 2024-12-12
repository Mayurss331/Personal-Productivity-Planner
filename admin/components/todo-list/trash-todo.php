<?php 
    include "../../../conn.php";
    session_start();
    $id=$_SESSION['id'];
    if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['del-task'])){
        $result=sql_query("DELETE FROM `todo` WHERE `id` = ".intval($_POST['del-task'])."");
    }
    if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['complete-task'])){
        $result=sql_query("UPDATE `todo` SET `status` = '1' WHERE `id` = ".$_POST['complete-task']."");
    }
    if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['restore-task'])){
        $result=sql_query("UPDATE `todo` SET `trash` = '0' WHERE `id` = ".$_POST['restore-task']."");
    }
    if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['date-change'])){
        $result=sql_query("UPDATE `todo` SET `created` = '".$_POST['date-change']."' WHERE `id` = ".$_SESSION['task-id']."");
    }
    if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['time-change'])){
        $result=sql_query("UPDATE `todo` SET `time` = '".$_POST['time-change']."' WHERE `id` = ".$_SESSION['task-id']."");
    }
    if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['disc-change'])){
        $result=sql_query("UPDATE `todo` SET `disc` = '".$_POST['disc-change']."' WHERE `id` = ".$_SESSION['task-id']."");
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
    <style>
        .todo-nav {
            margin-top: 10px
        }

        .todo-list {
            margin: 10px 0
        }

        .todo-list .todo-item {
            padding: 5px;
            margin: 5px 0;
            border-radius: 0;
            background: #ffffff
        }
        .todo-list.only-active .todo-item.complete {
            display: none
        }

        .todo-list.only-active .todo-item:not(.complete) {
            display: block
        }

        .todo-list.only-complete .todo-item:not(.complete) {
            display: none
        }

        .todo-list.only-complete .todo-item.complete {
            display: block
        }

        .todo-list .todo-item.complete span {
            text-decoration: line-through
        }

        .remove-todo-item {
            color: #ccc;
            visibility: hidden
        }

        .remove-todo-item:hover {
            color: #5f5f5f
        }

        .todo-item:hover .remove-todo-item {
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
        #wrapper #content-wrapper{
            height:100vh;
        }
        footer{
            display:block;
            position: fixed;
            left: 50%;
            bottom:0;
        }
    </style>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <!-- <div id="sidebar"></div> -->
        <?php include "../../sidebar.php"?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <!-- <div id="nav"></div> -->
                <?php include "../../nav.php"?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid" style="padding-left:0;padding-right:0;">
                    <div class="row align-items-start">
                        <div class="col" style="padding-right:0;">
                            <div class="card mb-4" style="border: 0px;border-right: 1px solid #e3e6f0;border-radius: 0;">
                                <div class="card-body">
                                    <h4>Trash Task</h4>
                                    <?php 
                                    $result=sql_query("SELECT * FROM `todo` WHERE `fk_user`='$id' and `trash`= 1 ORDER BY `created` ASC");
                                    if (mysqli_num_rows($result) >0) {
                                    while($row = mysqli_fetch_assoc($result)){
                                        $date=strtotime($row["created"]);
                                        $today=strtotime("now");
                                        $tomorrow=strtotime("tomorrow");
                                        $yesterday=strtotime("yesterday");
                                        echo '
                                        <form action="trash-todo.php" method="POST">
                                        <div class="todo-list" style="border-bottom: 1px solid #ccc;">
                                        <div class="todo-item">
                                            <div class="checker"><span class=""></span></div>
                                            <div type="submit" class="btn btn-link" name="open-task" value="'.$row['id'].'"<span>'.$row["name"].'</span></div>
                                            <span class="time float-right">';
                                            if(strval(date('d-M-y', $today))==strval(date('d-M-y', $date))){echo "Today";}
                                            else if(strval(date('d-M-y', $tomorrow))==strval(date('d-M-y', $date))){echo "Tomorrow";}
                                            else if(strval(date('d-M-y', $yesterday))==strval(date('d-M-y', $date))){echo "Yesterday";}
                                            echo'<button type="submit" name="del-task" value="'.$row['id'].'" class="close ml-3" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    <button type="submit" name="restore-task" value="'.$row['id'].'" class="close ml-3" aria-label="Close"><span aria-hidden="true">↻</span></button>
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
                                    if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['open-task'])){
                                        $_SESSION['task-id']=intval($_POST['open-task']);
                                        $result=sql_query("SELECT * FROM `todo` WHERE `id` = ".$_SESSION['task-id']."");
                                        if (mysqli_num_rows($result) >0) {
                                            while($row = mysqli_fetch_assoc($result)){
                                                $date=strtotime($row["created"]);
                                                $strdate=strval(date('Y-m-d', $date));
                                                $time=strtotime($row["time"]);
                                                $strtime=strval(date('H:i', $time));
                                                // die($strtime);
                                                echo '<form action="todo.php" method="POST">
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
                                            <input onChange="this.form.submit()" style="border:none;" name="date-change" type="date" value="'.$strdate.'" min="'.$strdate.'" ">
                                            <span class="info ml-1"'.$row['type'].'</span>
                                            <span class="float-right">
                                            <input type="time" onChange="this.form.submit()" style="border:none;" name="time-change" type="date" value="'.$strtime.'" min=9:00 max=12:00 step=900>
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
                <!-- <div id="footer"></div>       -->
                <?php include "../../footer.html"?>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="/Personal-Productivity-Planner/admin/#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

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