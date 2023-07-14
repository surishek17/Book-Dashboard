<?php 
   require 'includes/snippet.php';
   require 'includes/db-inc.php';
   include "includes/header.php";
   
   if(isset($_POST['submit'])){
   
       $label = sanitize(trim($_POST['label']));
       $BookTitle = sanitize(trim($_POST['BookTitle']));
       $Author = sanitize(trim($_POST['Author']));
       $Year = sanitize(trim($_POST['Year']));
       $Publication = sanitize(trim($_POST['Publication']));
       $Link = sanitize(trim($_POST['Link']));
       $Time = sanitize(trim($_POST['Time']));
       $Status = sanitize(trim($_POST['Status']));
   
       $sql = "INSERT INTO books(ISBN, BookTitle, Author, Year, Publication, Link, Time, Status)
                    values ('$label','$BookTitle','$Author','$Year', '$Publication','$Link','$Time','$Status')";
   
       $query = mysqli_query($conn, $sql);
   
       if($query){
           echo "<script>alert('New Book has been added ');
                    location.href ='bookstable.php';
                    </script>";
       }
       else {
           echo "<script>alert('Book not added!');
                    </script>"; 
       }
   }
   
  
  
   
   
   ?>
<div class="container">
<?php include "includes/nav.php"; ?>
<div class="container  col-lg-9 col-md-11 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-1 col-sm-offset-0 col-xs-offset-0  " style="margin-top: 20px">
   <div class="jumbotron login2 col-lg-10 col-md-11 col-sm-12 col-xs-12">
      <p class="page-header" style="text-align: center">ADD BOOK</p>
      <div class="container">
         <form class="form-horizontal" role="form" enctype="multipart/form-data" action="addbook.php" method="post">
            <div class="form-group">
               <label for="ISBN" class="col-sm-2 control-label">ISBN</label>
               <div class="col-sm-10">
                  <input type="text" class="form-control" name="label" placeholder="Enter ISBN" id="password" required>
               </div>
            </div>
            <div class="form-group">
               <label for="BookTitle" class="col-sm-2 control-label">Book Title</label>
               <div class="col-sm-10">
                  <input type="text" class="form-control" name="title" placeholder="Enter Title" id="password" required>
               </div>
            </div>
            <div class="form-group">
               <label for="Author" class="col-sm-2 control-label">Author</label>
               <div class="col-sm-10">
                  <input type="text" class="form-control" name="author" placeholder="Enter Author" id="password" required>
               </div>
            </div>
            <div class="form-group">
               <label for="Year" class="col-sm-2 control-label">Year</label>
               <div class="col-sm-10">
                  <input type="text" class="form-control" name="label" placeholder="Enter Year" id="password" required>
               </div>
            </div>
            <div class="form-group">
               <label for="Publication" class="col-sm-2 control-label">Publication</label>
               <div class="col-sm-10">
                  <input type="text" class="form-control" name="publisher" placeholder="Enter Publication" id="password" required>
               </div>
            </div>
            <div class="form-group">
               <label for="Link" class="col-sm-2 control-label">Link</label>
               <div class="col-sm-10">
                  <input type="text" class="form-control" name="category" placeholder="Enter Link" id="password" required>
               </div>
            </div>
            <div class="form-group">
               <label for="Time" class="col-sm-2 control-label">Time</label>
               <div class="col-sm-10">
                  <input type="text" class="form-control" name="call" placeholder="Enter Time" id="password" required>
               </div>
            </div>
            <div class="form-group">
               <label for="Status" class="col-sm-2 control-label">Status</label>
               <div class="col-sm-10">
                  <input type="text" class="form-control" name="call" placeholder="Enter Status" id="password" required>
               </div>
            </div>
            <div class="form-group">
               <div class="col-sm-offset-2 col-sm-10">
                  <button  name="submit" class="btn btn-info col-lg-12" data-toggle="modal" data-target="#info">
                  ADD BOOK
                  </button>
               </div>
            </div>
         </form>
         <form method="post" enctype="multipart/form-data">
		        <label class="form-label">File</label>
		        <input type="file" class="form-control" name="csvFile" accept=".csv"/>
                 <!-- <input type="submit" value="Upload CSV"> -->
               <button type="submit" class="btn btn-primary">Upload CSV</button>
         </form>
      </div>
   </div>
<?php
// Function to insert a new record
function insertRecord($column1, $column2, $column3, $column4, $column5, $column6, $column7, $column8) {
   global $conn;

   $sql = "INSERT INTO books (ISBN, BookTitle, Author, Year, Publication, Link, Time, Status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
   $stmt = $conn->prepare($sql);
   $stmt->bind_param("ssssssss", $column1, $column2, $column3, $column4, $column5, $column6, $column7, $column8);
   $stmt->execute();
   $stmt->close();
}


function getRecordByUniqueIdentifier($conn, $id) {
   $sql = "SELECT * FROM your_table WHERE ISBN = ? LIMIT 1";
   $stmt = $conn->prepare($sql);
   $stmt->bind_param( $id);
   $stmt->execute();
   $result = $stmt->get_result();
   $record = $result->fetch_assoc();
   $stmt->close();

   return $record;
}


function getAllRecords() {
   global $conn;
   $sql = "SELECT * FROM books";
   $stmt = $conn->prepare($sql);
   $stmt->execute();
   $result = $stmt->get_result();
   // $record = $result->fetch_assoc();
   $stmt->close();
   return $result;
}


   if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['csvFile'])) {
      $file = $_FILES['csvFile']['tmp_name'];
      
      if(isset($file) && $file != ""){
  
      $handle = fopen($file, "r");
  
      if ($handle !== FALSE) {
         
         fgetcsv($handle, 1000, ",");
  
          while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
  
               insertRecord($data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6], $data[7]); 
          }
  
          fclose($handle);
      } else {
          echo "Error opening the CSV file.";
      }
      }
  }
  $result = getAllRecords();


?>
</div>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/bootstrap.js"></script>
</body>
</html>

