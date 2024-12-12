<?php 
    include "../../../conn.php";
    session_start();
    $id=$_SESSION['id'];
    if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['add-task'])){
        $result=sql_query("INSERT INTO `todo` (`name`, `fk_user`) VALUES ('".$_POST['task']."', '$id')");
    }
    if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['del-task'])){
        $result=sql_query("UPDATE `todo` SET `trash` = '1' WHERE `id` = ".$_POST['del-task']."");
    }
    if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['complete-task'])){
        $result=sql_query("UPDATE `todo` SET `status` = '1' WHERE `id` = ".$_POST['complete-task']."");
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
    if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['tag-change'])){
        $result=sql_query("UPDATE `todo` SET `tag` = '".$_POST['tag-change']."' WHERE `id` = ".$_SESSION['task-id']."");
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

    <title>SB Admin 2 - Charts</title>

    <!-- Custom fonts for this template-->
    <link href="/Personal-Productivity-Planner/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/Personal-Productivity-Planner/admin/css/sb-admin-2.min.css" rel="stylesheet">
    <script
    src="https://code.jquery.com/jquery-3.3.1.js"
    integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
    crossorigin="anonymous">
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
                    <h1 class="h3 mb-2 mt-2 text-gray-800">Eisenhower Matris</h1>
                    <!-- <p class="mb-4">Chart.js is a third party plugin that is used to generate the charts in this theme.
                        The charts below have been customized - for further customization options, please visit the <a
                            target="_blank" href="https://www.chartjs.org/docs/latest/">official Chart.js
                            documentation</a>.</p> -->

                    <!-- Content Row -->
                    <div class="row">

                        <div class="col-xl-6 col-lg-7">

                            <!-- Area Chart -->
                            <div class="card shadow mb-4" style="border: 0px;border-right: 1px solid #e3e6f0;border-radius: 0;">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Urgent & Important</h6>
                                </div>
                                <div class="card-body" style="padding-top: 0px;height:325px;">
                                    <?php 
                                    $result=sql_query("SELECT * FROM `todo` WHERE `fk_user`='$id' and `status`= 0 and `trash`= 0 and `type`= 1");
                                    if (mysqli_num_rows($result) >0) {
                                    while($row = mysqli_fetch_assoc($result)){
                                        $date=strtotime($row["created"]);
                                        $today=strtotime("now");
                                        $tomorrow=strtotime("tomorrow");
                                        $yesterday=strtotime("yesterday");
                                        echo '
                                        <form action="todo.php" method="POST">
                                        <div class="todo-list" style="border-bottom: 1px solid #ccc;">
                                        <div class="todo-item">                                     
                                            <div class="checker"><span class=""><input type="checkbox" onChange="this.form.submit()" name="complete-task" value="'.$row['id'].'"></span></div>
                                            <button type="submit" class="btn btn-link" name="open-task" value="'.$row['id'].'"<span>'.$row["name"].'</span></button>';if($row['tag']){echo '<span class="badge badge-pill badge-danger mb-2 ">'.$row['tag'].'</span>';}
                                            echo'<span class="time float-right mt-2">';
                                            if(strval(date('d-M-y', $today))==strval(date('d-M-y', $date))){echo "Today";}
                                            else if(strval(date('d-M-y', $tomorrow))==strval(date('d-M-y', $date))){echo "Tomorrow";}
                                            else if(strval(date('d-M-y', $yesterday))==strval(date('d-M-y', $date))){echo "Yesterday";}
                                                    echo'<button type="submit" name="del-task" value="'.$row['id'].'" class="close ml-3" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </span>
                                            <div class="m-0 ml-3 pl-4 small">'.$row["disc"].'</div>
                                        </div>
                                    </div>
                                    </form>';
                                        }
                                    }
                                    
                                    ?>
                                </div>
                            </div>

                        </div>

                        <!-- Donut Chart -->
                        <div class="col-xl-6 col-lg-7">

                            <!-- Area Chart -->
                            <div class="card shadow mb-4" style="border: 0px;border-right: 1px solid #e3e6f0;border-radius: 0;">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Urgent & Not Important</h6>
                                </div>
                                <div class="card-body" style="padding-top: 0px;height:325px;">
                                    <?php 
                                    $result=sql_query("SELECT * FROM `todo` WHERE `fk_user`='$id' and `status`= 0 and `trash`= 0 and `type`= 2");
                                    if (mysqli_num_rows($result) >0) {
                                    while($row = mysqli_fetch_assoc($result)){
                                        $date=strtotime($row["created"]);
                                        $today=strtotime("now");
                                        $tomorrow=strtotime("tomorrow");
                                        $yesterday=strtotime("yesterday");
                                        echo '
                                        <form action="todo.php" method="POST">
                                        <div class="todo-list" style="border-bottom: 1px solid #ccc;">
                                        <div class="todo-item">                                     
                                            <div class="checker"><span class=""><input type="checkbox" onChange="this.form.submit()" name="complete-task" value="'.$row['id'].'"></span></div>
                                            <button type="submit" class="btn btn-link" name="open-task" value="'.$row['id'].'"<span>'.$row["name"].'</span></button>';if($row['tag']){echo '<span class="badge badge-pill badge-danger mb-2 ">'.$row['tag'].'</span>';}
                                            echo'<span class="time float-right mt-2">';
                                            if(strval(date('d-M-y', $today))==strval(date('d-M-y', $date))){echo "Today";}
                                            else if(strval(date('d-M-y', $tomorrow))==strval(date('d-M-y', $date))){echo "Tomorrow";}
                                            else if(strval(date('d-M-y', $yesterday))==strval(date('d-M-y', $date))){echo "Yesterday";}
                                                    echo'<button type="submit" name="del-task" value="'.$row['id'].'" class="close ml-3" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </span>
                                            <div class="m-0 ml-3 pl-4 small">'.$row["disc"].'</div>
                                        </div>
                                    </div>
                                    </form>';
                                        }
                                    }
                                    
                                    ?>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">

                        <div class="col-xl-6 col-lg-7">

                            <!-- Area Chart -->
                            <div class="card shadow mb-4" style="border: 0px;border-right: 1px solid #e3e6f0;border-radius: 0;">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Not Urgent & Important</h6>
                                </div>
                                <div class="card-body" style="padding-top: 0px;height:325px;">
                                    <?php 
                                    $result=sql_query("SELECT * FROM `todo` WHERE `fk_user`='$id' and `status`= 0 and `trash`= 0 and `type`= 3");
                                    if (mysqli_num_rows($result) >0) {
                                    while($row = mysqli_fetch_assoc($result)){
                                        $date=strtotime($row["created"]);
                                        $today=strtotime("now");
                                        $tomorrow=strtotime("tomorrow");
                                        $yesterday=strtotime("yesterday");
                                        echo '
                                        <form action="todo.php" method="POST">
                                        <div class="todo-list" style="border-bottom: 1px solid #ccc;">
                                        <div class="todo-item">                                     
                                            <div class="checker"><span class=""><input type="checkbox" onChange="this.form.submit()" name="complete-task" value="'.$row['id'].'"></span></div>
                                            <button type="submit" class="btn btn-link" name="open-task" value="'.$row['id'].'"<span>'.$row["name"].'</span></button>';if($row['tag']){echo '<span class="badge badge-pill badge-danger mb-2 ">'.$row['tag'].'</span>';}
                                            echo'<span class="time float-right mt-2">';
                                            if(strval(date('d-M-y', $today))==strval(date('d-M-y', $date))){echo "Today";}
                                            else if(strval(date('d-M-y', $tomorrow))==strval(date('d-M-y', $date))){echo "Tomorrow";}
                                            else if(strval(date('d-M-y', $yesterday))==strval(date('d-M-y', $date))){echo "Yesterday";}
                                                    echo'<button type="submit" name="del-task" value="'.$row['id'].'" class="close ml-3" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </span>
                                            <div class="m-0 ml-3 pl-4 small">'.$row["disc"].'</div>
                                        </div>
                                    </div>
                                    </form>';
                                        }
                                    }
                                    
                                    ?>
                                </div>
                            </div>

                        </div>

                        <!-- Donut Chart -->
                        <div class="col-xl-6 col-lg-7">

                            <!-- Area Chart -->
                            <div class="card shadow mb-4" style="border: 0px;border-right: 1px solid #e3e6f0;border-radius: 0;">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Not Urgent & Not Important</h6>
                                </div>
                                <div class="card-body" style="padding-top: 0px;height:325px;">
                                    <?php 
                                    $result=sql_query("SELECT * FROM `todo` WHERE `fk_user`='$id' and `status`= 0 and `trash`= 0 and `type`= 4");
                                    if (mysqli_num_rows($result) >0) {
                                    while($row = mysqli_fetch_assoc($result)){
                                        $date=strtotime($row["created"]);
                                        $today=strtotime("now");
                                        $tomorrow=strtotime("tomorrow");
                                        $yesterday=strtotime("yesterday");
                                        echo '
                                        <form action="todo.php" method="POST">
                                        <div class="todo-list" style="border-bottom: 1px solid #ccc;">
                                        <div class="todo-item">                                     
                                            <div class="checker"><span class=""><input type="checkbox" onChange="this.form.submit()" name="complete-task" value="'.$row['id'].'"></span></div>
                                            <button type="submit" class="btn btn-link" name="open-task" value="'.$row['id'].'"<span>'.$row["name"].'</span></button>';if($row['tag']){echo '<span class="badge badge-pill badge-danger mb-2 ">'.$row['tag'].'</span>';}
                                            echo'<span class="time float-right mt-2">';
                                            if(strval(date('d-M-y', $today))==strval(date('d-M-y', $date))){echo "Today";}
                                            else if(strval(date('d-M-y', $tomorrow))==strval(date('d-M-y', $date))){echo "Tomorrow";}
                                            else if(strval(date('d-M-y', $yesterday))==strval(date('d-M-y', $date))){echo "Yesterday";}
                                                    echo'<button type="submit" name="del-task" value="'.$row['id'].'" class="close ml-3" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            </span>
                                            <div class="m-0 ml-3 pl-4 small">'.$row["disc"].'</div>
                                        </div>
                                    </div>
                                    </form>';
                                        }
                                    }
                                    
                                    ?>
                                </div>
                            </div>

                        </div>
                    </div>

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
    <a class="scroll-to-top rounded" href="#page-top">
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
    <script src="/Personal-Productivity-Planner/admin/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="/Personal-Productivity-Planner/admin/js/demo/chart-area-demo.js"></script>
    <script src="/Personal-Productivity-Planner/admin/js/demo/chart-pie-demo.js"></script>
    <script src="/Personal-Productivity-Planner/admin/js/demo/chart-bar-demo.js"></script>

</body>

</html>