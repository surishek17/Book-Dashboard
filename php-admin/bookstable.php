<?php 
   require 'includes/snippet.php';
   require 'includes/db-inc.php';
   include "includes/header.php";    
   $id=(int) $_GET['id'];
   if($id>0){
   
   	$id = sanitize(trim($id));
   
   	$sql_del = "DELETE from books where BookID = ".$id; 
   	$error = false;
   	$result = mysqli_query($conn,$sql_del);
   			if ($result)
   			{
   			$error = true; //delete successful
   			}			
      
    }
   ?>
   
<div class="container">
   <?php include "includes/nav.php"; ?>
   <!-- navbar ends -->
   <!-- info alert -->
   <div class="alert alert-warning col-lg-7 col-md-12 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-0 col-sm-offset-1 col-xs-offset-0" style="margin-top:70px">
      <span class="glyphicon glyphicon-book"></span>
      <strong>Books</strong> Table
   </div>
</div>
<div class="container">
   <div class="panel panel-default">
      <!-- Default panel contents -->
      <div class="panel-heading">
         <?php if(isset($error)===true) { ?>
         <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Book Deleted Successfully!</strong>
         </div>
         <?php } ?>
        
         <div class="row">
            <a href="addbook.php"><button class="btn btn-success col-lg-3 col-md-4 col-sm-11 col-xs-11 button" style="margin-left: 15px;margin-bottom: 5px"><span class="glyphicon glyphicon-plus-sign"></span> Add Book</button></a>
         </div>
      </div>
      <table class="table table-bordered">
         <thead>
            <tr>
               <th>BookId</th>
               <th>ISBN</th>
               <th>BookTitle</th>
               <th>Author</th>
               <th>Year</th>
               <th>Publication</th>
               <th>Link</th>
               <th>Time</th>
               <th>Status</th>
               <th>Actions</th>
            </tr>
         </thead>
         <?php 
            $sql = "SELECT * from books";
            
            $query = mysqli_query($conn, $sql); 
            $counter = 1;
            while ($row = mysqli_fetch_array($query)) { ?>
         <tbody>
            <td><?php echo $row['BookID']; ?></td>
            <td><?php echo $row['ISBN']; ?></td>
            <td><?php echo $row['BookTitle']; ?></td>
            <td><?php echo $row['Author']; ?></td>
            <td><?php echo $row['Year']; ?></td>
            <td><?php echo $row['Publication']; ?></td>
            <td><?php echo $row['Link']; ?></td>
            <td><?php echo $row['Time']; ?></td>
            <td><?php echo $row['Status']; ?></td>
            <td><a href="bookstable.php?id=<?php echo $row['BookID']; ?>">Delete</a> </td>
         <!-- <td><a href="bookstable.php?id=<?php echo $row['BookID']; ?>">Edit</a> </td>  -->
            <form method='post' action='bookstable.php'>
               <input type='hidden' value="<?php echo $row['BookID']; ?>" name='Id'> 
               <!-- <td><button name='del' type='submit' value='Delete' class='btn btn-warning'>DELETE</button></td> -->
            </form>
         </tbody>
         <?php 	}
            ?>
      </table>
   </div>
</div>
<script type="text/javascript">
   function Delete() {
               return confirm('Would you like to delete the book?');
           }
</script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>	
</body>
</html>