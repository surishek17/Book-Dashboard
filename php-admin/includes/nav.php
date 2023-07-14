<?php 
if(!session_id()) session_start();
if (!(isset($_SESSION['auth']) && $_SESSION['auth'] == true)) {
	header("Location: admin.php");
	exit();
}

if (isset($_SESSION['admin'])) {
     $admin = $_SESSION['admin'];
}

?>



<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example">
                <span class="sr-only">:</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div><img src="https://www.du.ac.in/uploads/du/images/logo-du-1.png"></div>
            <!-- <div><a class="navbar-brand" id="setting" href="admin.php">E-Books</a></div> -->
        </div>

        <div class="collapse navbar-collapse" id="bs-example">
            <ul class="nav navbar-nav">
                <?php if(isset($admin)) { ?>  
                <li><a href="admin.php">Home</a></li>
                <li><a href="bookstable.php">Books</a></li>
                <!-- <li><a href="users.php">Admins</a></li> -->
                <!-- <li><a href="viewstudents.php">Students</a></li> -->
                <!-- <li><a href="borrowedbooks.php">Issued books</a></li> -->
                <?php } ?>
               
            <ul class="nav navbar-nav navbar-right">
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>