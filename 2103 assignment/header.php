<?php 
require_once 'Dbconnect.php';
session_start();

?>
<header> 
    <!-- Navigation -->
   
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Infant Watch</a>
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">
            <li>
                <a href="#"><i class="fa fa-user"></i>Welcome <?php echo $_SESSION['username']; ?></a>
            </li>
            <li>
                <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
            </li>
          
        </ul>
        
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                
                <li>
                    <a href="charts.php"><i class="fa fa-fw fa-bar-chart-o"></i> Charts</a>
                </li>
                <li>
                    <a href="View.php"><i class="fa fa-fw fa-table"></i> View Data </a>
                </li>
                <li>
                    <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Logs <i class="fa fa-fw fa-caret-down"></i></a>
                    <ul id="demo" class="collapse">
                        <?php 
                        if($_SESSION['userType']==='Admin'){?>
                        <li>
                            <a href="AdminLog.php">Admin</a>
                        </li>
                        <?php } ?>
                        <li>
                            <a href="AssistantLog.php">Assistant Admin</a>
                        </li>
                    </ul>
                </li><?php
                if($_SESSION['userType']==='Admin'){?>
                <li>
                    <a href="ApproveLogs.php"><i class="fa fa-fw fa-file"></i> Approving Logs</a>
                </li><?php }?>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>
</header>