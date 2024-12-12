<?php
  include "../conn.php";
  session_start();
    if(!isset($_SESSION['email'])){
        header("Location: login.php");
        exit;
    }
    if(isset($_GET['logout'])){
        session_destroy();
        header("Location: login.php");
    }
    $id=$_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>

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
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include "sidebar.php"?>
            <!-- <div id="sidebar"></div> -->
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include "nav.php"?>
                <!-- <div id="nav"></div> -->
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid mt-4">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Tasks </div>
                                            <div  class="h5 mb-0 font-weight-bold text-gray-800">
                                            <?php
                                            $result=sql_query("SELECT * FROM `todo` WHERE `fk_user`='$id'");
                                            $totalT=mysqli_num_rows($result);
                                            echo $totalT;
                                            ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i id='totalT' value="<?php echo $totalT ?>"class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Completed Tasks</div>
                                            <div  class="h5 mb-0 font-weight-bold text-gray-800"><?php
                                            $result=sql_query("SELECT * FROM `todo` WHERE `fk_user`='$id' AND `status`='1'");
                                            $compltT=mysqli_num_rows($result);
                                            echo $compltT;
                                            ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i id='complT' value="<?php echo $compltT?>"class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Daily Progress
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php
                                                    if($totalT!=0)
                                            echo ($perc=floor(($compltT/$totalT)*100)).'%';
                                            else echo '0%'
                                            ?></div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: <?php echo $perc.'%'?>" aria-valuenow='<?php echo $perc?>' aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Pending Tasks</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php 
                                            $result=sql_query("SELECT * FROM `todo` WHERE `fk_user`='$id' AND `status`='0' AND `trash`='0'");
                                            $pending=mysqli_num_rows($result);
                                            echo $pending;
                                            ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i id='pendingT' value="<?php echo $pending?>" class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Yearly Progress</h6>
                            </div>
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Tasks Analytics</h6>
                            </div>
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="myPieChart"></canvas>
                                    </div>
                                    <div class="mt-4 text-center small">
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-success"></i> Completed
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-info"></i> Pending
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-warning"></i> Failed
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Content Row -->
                    <div class="row">
                        <!-- Area Chart -->
                            <div class="col-xl-6 col-md-6">
                                    <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Today's Pending Tasks</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th>Name</th>
                                                            <th>Description</th>
                                                            <th>Time</th>
                                                            <th>Tag</th>
                                                            <th>Modity</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php 
                                                        $today=strtotime("now");
                                                        $today=date('Y-m-d', $today);
                                                        $result=sql_query("SELECT * FROM `todo` WHERE `fk_user`='$id' and `trash`= 0 and `created`= '$today' and fk_goal=0 ORDER BY `status` ASC");
                                                        if (mysqli_num_rows($result) >0) {
                                                        while($row = mysqli_fetch_assoc($result)){
                                                            $time=strtotime($row["time"]);
                                                            $strtime=strval(date('H:i a', $time));
                                                            echo '
                                                                <tr>
                                                                <td><form action="components/todo-list/todo.php" method="POST"><div class="checker"><input type="checkbox" onChange="this.form.submit()" name="complete-task" value="'.$row['id'].'"></div></form></td>
                                                                <td>'.$row['name'].'</td>
                                                                <td>'.$row['disc'].'</td>';
                                                            echo'<td>'.$strtime.'</td>';
                                                            echo'<td>'.$row['tag'].'</td>
                                                                <td><form action="components/todo-list/todo.php" method="POST"><span><button class="btn btn-sm btn-primary" type="submit" name="edit-task" value="'.$row['id'].'">Edit</button><button type="submit" name="del-task" value="'.$row['id'].'" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button></span></form></td>

                                                            </tr>';
                                                                }
                                                            }
                                                        ?>
                                                    </tbody>
                                                </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div class="col-xl-6 col-md-6">
                                <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <?php 
                                        $goalid='';
                                        $today=Date("Y-m-d");
                                        $result=sql_query("SELECT * FROM `goals` WHERE `fk_user`='$id' and `id`!=0 ");
                                        if (mysqli_num_rows($result) >0) {
                                        if($row = mysqli_fetch_assoc($result)){
                                                if((strtotime($row['end'])-strtotime($today))>0) {
                                                    $goalid=$row['id'];
                                                    echo '<h6 class="m-0 font-weight-bold text-primary">Current Goal Sub Task : '.$row['name'].'</h6>';

                                                }
                                            }
                                        }
                                    ?>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>Name</th>
                                                        <th>Description</th>
                                                        <th>Time</th>
                                                        <th>Tag</th>
                                                        <th>Modity</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $result=sql_query("SELECT * FROM `todo` WHERE `fk_user`='$id' and `trash`= 0 and `fk_goal`= '".$goalid."' ORDER BY `status` ASC");
                                                    if (mysqli_num_rows($result) >0) {
                                                    while($row = mysqli_fetch_assoc($result)){
                                                        $time=strtotime($row["time"]);
                                                        $strtime=strval(date('H:i a', $time));
                                                        echo '
                                                            <tr>
                                                            <td><form action="components/todo-list/todo.php" method="POST"><div class="checker"><input type="checkbox" onChange="this.form.submit()" name="complete-task" value="'.$row['id'].'"></div></form></td>
                                                            <td>'.$row['name'].'</td>
                                                            <td>'.$row['disc'].'</td>';
                                                        echo'<td>'.$strtime.'</td>';
                                                        echo'<td>'.$row['tag'].'</td>
                                                            <td><form action="components/todo-list/todo.php" method="POST"><span><button class="btn btn-sm btn-primary" type="submit" name="edit-task" value="'.$row['id'].'">Edit</button><button type="submit" name="del-task" value="'.$row['id'].'" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button></span></form></td>

                                                        </tr>';
                                                            }
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                    </div>
                                </div>
                            </div>
                            </div>

                    

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
               <!-- <div id="footer"></div>           -->
               <?php include "footer.html"?>
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

</body>

</html>