<?php 
    $id=$_SESSION['id'];
?>

<script src="/Personal-Productivity-Planner/admin/js/sb-admin-2.min.js"></script>

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center my-1" href="/Personal-Productivity-Planner/admin/index.php">
            <?php 
                $result=sql_query("SELECT * FROM `web_info`");
                if (mysqli_num_rows($result) >0) {
                while($row = mysqli_fetch_assoc($result)){
                    echo'<img src="data:image/png;base64,'.base64_encode($row["img"]).'" alt="..." width="35px">';
                    }
                }?>
        <div class="sidebar-brand-text mx-3 mt-1">Planner<sup></sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?php if($_SERVER['PHP_SELF']=="/Personal-Productivity-Planner/admin/index.php"){echo "active";}?>">
        <a class="nav-link" href="/Personal-Productivity-Planner/admin/index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item <?php if($_SERVER['PHP_SELF']=="/Personal-Productivity-Planner/admin/components/todo-list/todo.php"||$_SERVER['PHP_SELF']=="/Personal-Productivity-Planner/admin/components/todo-list/todo-tags.php?tag=Personal"||$_SERVER['PHP_SELF']=="/Personal-Productivity-Planner/admin/components/todo-list/todo-tags.php?tag=Private"||$_SERVER['PHP_SELF']=="/Personal-Productivity-Planner/admin/components/todo-list/todo-tags.php?tag=Work"||$_SERVER['PHP_SELF']=="/Personal-Productivity-Planner/admin/components/todo-list/todo-tags.php?tag=Other"||$_SERVER['PHP_SELF']=="/Personal-Productivity-Planner/admin/components/todo-list/complete-todo.php"||$_SERVER['PHP_SELF']=="/Personal-Productivity-Planner/admin/components/todo-list/trash-todo.php"){echo "active";}?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Todo List</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="/Personal-Productivity-Planner/admin/components/todo-list/todo.php">Inbox</a>
            </div>
        </div>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Tags</h6>
                    <a class="collapse-item" href="/Personal-Productivity-Planner/admin/components/todo-list/todo-tags.php?tag=Personal">Personal</a>
                    <a class="collapse-item" href="/Personal-Productivity-Planner/admin/components/todo-list/todo-tags.php?tag=Work">Work</a>
                    <a class="collapse-item" href="/Personal-Productivity-Planner/admin/components/todo-list/todo-tags.php?tag=Regular">Regular</a>
                    <a class="collapse-item" href="/Personal-Productivity-Planner/admin/components/todo-list/todo-tags.php?tag=Other">Other</a>
            </div>
        </div>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="/Personal-Productivity-Planner/admin/components/todo-list/complete-todo.php">Completed</a>
                <a class="collapse-item" href="/Personal-Productivity-Planner/admin/components/todo-list/trash-todo.php">Trash</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item <?php if($_SERVER['PHP_SELF']=="/Personal-Productivity-Planner/admin/components/goals/index.php"||$_SERVER['PHP_SELF']=="/Personal-Productivity-Planner/admin/components/goals/complete-goals.php"||$_SERVER['PHP_SELF']=="/Personal-Productivity-Planner/admin/components/goals/complete-sub.php"||$_SERVER['PHP_SELF']=="/Personal-Productivity-Planner/admin/components/goals/goals.php"){echo "active";}?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Goals List</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="/Personal-Productivity-Planner/admin/components/goals/index.php">Goals</a>
                <a class="collapse-item" href="/Personal-Productivity-Planner/admin/components/goals/complete-goals.php">Completed</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Addons
    </div>

    <!-- Nav Item - Charts -->
    <li class="nav-item <?php if($_SERVER['PHP_SELF']=="/Personal-Productivity-Planner/admin/components/matrix/matrix.php"){echo "active";}?>">
        <a class="nav-link" href="/Personal-Productivity-Planner/admin/components/matrix/matrix.php">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Eisenhower Matris</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item <?php if($_SERVER['PHP_SELF']=="/Personal-Productivity-Planner/admin/components/pomodoro/index.html"){echo "active";}?>">
        <a class="nav-link" href="/Personal-Productivity-Planner/admin/components/pomodoro/index.html">
            <i class="fas fa-fw fa-table"></i>
            <span>Pomodoro</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->
    <!-- <div class="sidebar-card d-none d-lg-flex">
        <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
    </div> -->

</ul>
