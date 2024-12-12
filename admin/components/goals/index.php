<?php 
    include "../../../conn.php";
    session_start();
    $id=$_SESSION['id'];
    if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['add-goal'])){
        $imgContent='';
        if(!empty($_FILES["img"])) { 
            // Get file info 
            $fileName = basename($_FILES["img"]["name"]); 
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
            // Allow certain file formats 
            $allowTypes = array('jpg','png','jpeg','gif'); 
            if(in_array($fileType, $allowTypes)){ 
                $image = $_FILES['img']['tmp_name']; 
                $imgContent = addslashes(file_get_contents($image));
            }
        }
        // die("INSERT INTO `goals` (`name`,`disc`,`created`,`end`,`img`, `fk_user`) VALUES ('".$_POST['name']."','".$_POST['disc']."','".$_POST['created']."','".$_POST['end']."','$imgContent', '$id')");
        $result=sql_query("INSERT INTO `goals` (`name`,`disc`,`created`,`end`,`img`, `fk_user`) VALUES ('".$_POST['name']."','".$_POST['disc']."','".$_POST['created']."','".$_POST['end']."','$imgContent', '$id')");
    }
    if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['del-task'])){
        $result=sql_query("UPDATE `todo` SET `trash` = '1' WHERE `id` = ".$_POST['del-task']."");
    }
    if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['complete-task'])){
        $result=sql_query("UPDATE `todo` SET `status` = '1' WHERE `id` = ".$_POST['complete-task']."");
    }
    if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['update-task'])){
        $result=sql_query("UPDATE `todo` SET `name`='".$_POST['name']."',`disc`='".$_POST['disc']."',`created`='".$_POST['created']."',`time`='".$_POST['time']."',`tag`='".$_POST['tag']."' WHERE `id` = ".$_POST['update-task']."");
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Goals</h6>
                        </div>
                        <div class="card-body">
                            <form class="row" action="index.php" method="POST" enctype="multipart/form-data">
                                <div class="col-xl-6 col-md-6 ">
                                    <label for="exampleFormControlTextarea1">Goals Name</label>
                                    <input type="text" name="name" class="mr-2 form-control add-task"
                                        placeholder="What do you need to do today?" required>
                                    <div class="my-3 mb-2"><span><label for="exampleFormControlTextarea1">Start
                                                Date</label>
                                            <input name="created" type="date" required></span>
                                        <span class="float-right"><label for="exampleFormControlTextarea1">End
                                                Date</label>
                                            <input name="end" type="date" required></span>
                                    </div>
                                    <label for="exampleFormControlTextarea1" required>Goals Description</label>
                                    <textarea class="form-control mb-3" name="disc" rows="3"></textarea>
                                    <button type="submit" name="add-goal"
                                        class="add btn btn-primary btn-block font-weight-bold todo-list-add-btn">Add New
                                        Goals</button>
                                </div>
                                <div class="col-xl-6 col-md-6">
                                    <img src="/Personal-Productivity-Planner/admin/img/img.jpg"
                                        class="img-thumbnail rounded-start mb-3" style="width:25%" alt="..."><br>
                                    <label for="exampleFormControlTextarea1">Select Imgage</label>
                                    <div class="form-group mb-3">
                                        <input type="file" name="img" class="form-control" id="inputGroupFile01">
                                    </div>
                                </div>
                        </div>
                        </form>
                    </div>
                    <!-- DataTales Example -->
                    <div class="row">
                        <?php
                    $result=sql_query("SELECT * FROM goals WHERE `fk_user`='$id' and `status`='0' and `id`!=0");
                    if (mysqli_num_rows($result) >0){
                    while($row = mysqli_fetch_assoc($result)){
                        $rs=sql_query("SELECT * FROM `todo` WHERE `fk_goal` = ".$row['id']." AND `fk_user`='".$id."'");
                        $compltT=0;
                        $totalT=0;                        
                        if(mysqli_num_rows($rs)>=0){
                            while($task=mysqli_fetch_assoc($rs)){
                                if($task['status']==1 && $task['trash']!=1){
                                    $compltT++;
                                }
                                if($task['trash']!=1) $totalT++;
                            }
                        }
                    echo '<div class="col-md-4">
                            <form action="goals.php" method="POST">
                            <button class="btn btn-block text-left" type="submit" name="gid" value="'.$row['id'].'">
                            <div class="card shadow mb-3">
                            <div class="row">
                                <div class="col-md-5">';
                                if($row["img"])echo '<img src="data:image/png;base64,'.base64_encode($row["img"]).'" class="img-thumbnail rounded-start" style="width: 250px;height:250px;" alt="...">';
                                else echo '<img src="/Personal-Productivity-Planner/admin/img/img.jpg" class="img-thumbnail rounded-start" style="width: 250px;height:250px;" alt="...">';
                                echo '</div>
                                <div class="col-md-6">
                                <div class="card-body">
                                    <h5 class="card-title">'.$row['name'].'</h5>
                                    <p class="card-text small">'.$row['disc'].'</p>
                                    <h6 class="font-weight-bold small mt-4">Pending Goals <span
                                                    class="float-right">';
                                                    if($totalT!=0) echo floor(($compltT/$totalT)*100);else echo "100";
                                                    echo '%</span></h6>
                                            <div class="progress" style="height: 10px;">
                                                <div class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" style="width:';
                                                if($totalT!=0) echo floor(($compltT/$totalT)*100);else echo "100";
                                                echo '%;"
                                                    aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                </div>
                                </div>
                            </div>
                            </div>
                            </button>
                            </form>
                        </div>';}
                        for($i=1;$i<=(6-mysqli_num_rows($result));$i++){
                        echo '<div class="col-md-4 opacity-25">
                            <div class="card shadow mb-3">
                            <div class="row">
                                <div class="col-md-5">
                                <img src="/Personal-Productivity-Planner/admin/img/img.jpg" class="img-thumbnail rounded-start" style="width: 250px;height:250px;" alt="...">
                                </div>
                                <div class="col-md-6">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                    <h6 class="font-weight-bold small mt-4">Pending Goals <span
                                                    class="float-right">60%</span></h6>
                                            <div class="progress" style="height: 10px;">
                                                <div class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" style="width: 60%;"
                                                    aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>';}}
                        else{
                            for($i=1;$i<=6;$i++){
                                echo '<div class="col-md-4 opacity-25">
                                    <div class="card shadow mb-3">
                                    <div class="row">
                                        <div class="col-md-5">
                                        <img src="/Personal-Productivity-Planner/admin/img/img.jpg" class="img-thumbnail rounded-start" style="width: 250px;height:250px;" alt="...">
                                        </div>
                                        <div class="col-md-6">
                                        <div class="card-body">
                                            <h5 class="card-title">Card title</h5>
                                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                            <h6 class="font-weight-bold small mt-4">Pending Goals <span
                                                            class="float-right">60%</span></h6>
                                                    <div class="progress" style="height: 10px;">
                                                        <div class="progress-bar progress-bar-striped bg-success progress-bar-animated" role="progressbar" style="width: 60%;"
                                                            aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>';}
                        }
                        ?>
                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <!-- <div id="footer"></div>  -->
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
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