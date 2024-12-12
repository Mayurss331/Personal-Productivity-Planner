<?php 
    include "../../../conn.php";
    session_start();
    $id=$_SESSION['id'];
    if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['restore'])){
        $tid=$_POST['restore'];
        $result=sql_query("UPDATE `todo` SET `status`='0' WHERE `id`='".$tid."'");
    }
    if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['del-task'])){
        $result=sql_query("UPDATE `todo` SET `trash` = '1' WHERE `id` = ".$_POST['del-task']."");
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
                <div class="container-fluid">
                <!-- Page Heading -->

                            
                <div class="card shadow mb-4 mt-4">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Completed Tasks</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Description</th>
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th>Status</th>
                                                <th>Tag</th>
                                                <th>Modity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $result=sql_query("SELECT * FROM `todo` WHERE `fk_user`='$id' and `trash`= 0 and `status`=1 ORDER BY `created` ASC");
                                            if (mysqli_num_rows($result) >0) {
                                            while($row = mysqli_fetch_assoc($result)){
                                                $tid=$row['id'];
                                                $date=strtotime($row["created"]);
                                                $strdate=strval(date('d-M-y', $date));
                                                $today=strtotime("now");
                                                $tomorrow=strtotime("tomorrow");
                                                $yesterday=strtotime("yesterday");
                                                $time=strtotime($row["time"]);
                                                $strtime=strval(date('H:i a', $time));
                                                echo '
                                                    <tr>
                                                    <td>'.$row['name'].'</td>
                                                    <td>'.$row['disc'].'</td>
                                                    <td>';
                                                    if(strval(date('d-M-y', $today))==strval(date('d-M-y', $date))){echo "Today";}
                                                    else if(strval(date('d-M-y', $tomorrow))==strval(date('d-M-y', $date))){echo "Tomorrow";}
                                                    else if(strval(date('d-M-y', $yesterday))==strval(date('d-M-y', $date))){echo "Yesterday";}else{echo $strdate;}
                                                echo'</td>
                                                    <td>'.$strtime.'</td>
                                                    <td>';
                                                    if($row['status']==1){echo '<span class="badge badge-pill badge-success mb-2 ">Completed</span>';}else if($row['status']==0 and date('d-M-y', $today)>date('d-M-y', $date)){echo '<span class="badge badge-pill badge-danger mb-2 ">Due</span>';}else{echo '<span class="badge badge-pill badge-warning mb-2 ">Pending</span>';}
                                                echo'</td>
                                                    <td>'.$row['tag'].'</td>
                                                    <td><form action="complete-todo.php" method="POST"><span><button type="submit" name="restore" value="'.$tid.'" class="btn btn-sm btn-primary">Restore</button><button type="submit" name="del-task" value="'.$row['id'].'" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button></span></form></td>

                                                </tr>';
                                                    }
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <!-- <div id="footer"></div> -->
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