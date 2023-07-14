<?php 
require 'includes/snippet.php';
require 'includes/db-inc.php';
include "includes/header.php"; 

	if (isset($_POST['submit'])) {
		$id = trim($_POST['del_btn']);
		$sql = "DELETE from books where bookId = '$id'";
		$query = mysqli_query($conn, $sql);

		if ($query) {
			echo "<script>alert('book Deleted!')</script>";
		}
	}

?>


<div class="container">
    <?php include "includes/nav.php"; ?>
	<!-- navbar ends -->
	<!-- info alert -->
	<div class="alert alert-warning col-lg-7 col-md-12 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-0 col-sm-offset-1 col-xs-offset-0" style="margin-top:70px">

		<span class="glyphicon glyphicon-book"></span>
	    <strong>Book</strong> Table
	</div>


	</div>
	<div class="container col-lg-11 ">
		<div class="panel panel-default">
		  <!-- Default panel contents -->
		  <div class="panel-heading">
		  	<div class="row">
		  	  <a href="addbook.php"><button class="btn btn-success col-lg-3 col-md-4 col-sm-11 col-xs-11 button" style="margin-left: 15px;margin-bottom: 5px"><span class="glyphicon glyphicon-plus-sign"></span> Add Book</button></a>
			  
			</div>
		  </div>
		  <table class="table table-bordered">
		          <thead>
		               <tr>
		               	  <th>#</th> 
		                  <th>ISBN</th>
		                  <th>BookTitle</th>
		                  <th>Author</th>
		                  <th>Year</th>
		                  <th>Publication</th>		             
		                  <th>Link</th>
		                  <th>Time</th>
		                  <th>Status</th>
		                </tr>    
		          </thead>    
		          <?php 

		          $sql = "SELECT * FROM books";
		          $query = mysqli_query($conn, $sql);
		          $counter = 1;
		          while ( $row = mysqli_fetch_assoc($query)) {        	
		           ?>s
		          <tbody> 
		            <tr> 
		             <td><?php echo $counter++; ?></td>
		             <td><?php echo $row['ISBN']; ?></td>
		             <td><?php echo $row['BookTitle']; ?></td>
		             <td><?php echo $row['Author']; ?></td>
		             <td><?php echo $row['Year']; ?></td>
		             <td><?php echo $row['Publication']; ?></td>
		             <td><?php echo $row['Link']; ?></td>
		             <td><?php echo $row['Time']; ?></td>
		             <td><?php echo $row['Status']; ?></td>
		             
		             <td>
		             	<form action="viewbooks.php" method="post">
		             		<input type="hidden" value="<?php echo $row['bookId']; ?>" name="del_btn">
		             		<button name="submit" class="btn btn-warning">DELETE</button>
		             	</form> 
		         	</td>
		            </tr> 
		           
		         </tbody> 
		         <?php } ?>
		   </table>		 
	  </div>
	</div>
</body>
</html>