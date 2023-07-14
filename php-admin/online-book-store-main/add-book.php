<?php  
session_start();

# If the admin is logged in
if (isset($_SESSION['user_id']) &&
    isset($_SESSION['user_email'])) {

	# Database Connection File
	include "db_conn.php";

    # Category helper function
	include "php/func-category.php";
    $categories = get_all_categories($conn);

    # author helper function
	include "php/func-author.php";
    $authors = get_all_author($conn);

    if (isset($_GET['title'])) {
    	$title = $_GET['title'];
    }else $title = '';

    if (isset($_GET['desc'])) {
    	$desc = $_GET['desc'];
    }else $desc = '';

    if (isset($_GET['category_id'])) {
    	$category_id = $_GET['category_id'];
    }else $category_id = 0;

    if (isset($_GET['author_id'])) {
    	$author_id = $_GET['author_id'];
    }else $author_id = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Add Book</title>

    <!-- bootstrap 5 CDN-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <!-- bootstrap 5 Js bundle CDN-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

</head>
<body>
	<div class="container">
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
		  <div class="container-fluid">
		    <a class="navbar-brand" href="admin.php">Admin</a>
		    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		      <span class="navbar-toggler-icon"></span>
		    </button>
		    <div class="collapse navbar-collapse" 
		         id="navbarSupportedContent">
		      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
		        <li class="nav-item">
		          <a class="nav-link" 
		             aria-current="page" 
		             href="index.php">Store</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link active" 
		             href="add-book.php">Add Book</a>
		        </li>
		        
		        <li class="nav-item">
		          <a class="nav-link" 
		             href="logout.php">Logout</a>
		        </li>
		      </ul>
		    </div>
		  </div>
		</nav>
     <form action="php/add-book.php"
           method="post"
           enctype="multipart/form-data" 
           class="shadow p-4 rounded mt-5"
           style="width: 90%; max-width: 50rem;">

     	<h1 class="text-center pb-5 display-4 fs-3">
     		Add New Book
     	</h1>
     	<?php if (isset($_GET['error'])) { ?>
          <div class="alert alert-danger" role="alert">
			  <?=htmlspecialchars($_GET['error']); ?>
		  </div>
		<?php } ?>
		<?php if (isset($_GET['success'])) { ?>
          <div class="alert alert-success" role="alert">
			  <?=htmlspecialchars($_GET['success']); ?>
		  </div>
		<?php } ?>
     	<div class="mb-3">
		    <label class="form-label">
		           Book Title
		           </label>
		    <input type="text" 
		           class="form-control"
		           value="<?=$title?>" 
		           name="book_title">
		</div>

		<div class="mb-3">
		    <label class="form-label">
		           Book Description
		           </label>
		    <input type="text" 
		           class="form-control" 
		           value="<?=$desc?>"
		           name="book_description">
		</div>

		<div class="mb-3">
		    <label class="form-label">
		           Book Author
		           </label>
		    <select name="book_author"
		            class="form-control">
		    	    <option value="0">
		    	    	Select author
		    	    </option>
		    	    <?php 
                    if ($authors == 0) {
                    	# Do nothing!
                    }else{
		    	    foreach ($authors as $author) { 
		    	    	if ($author_id == $author['id']) { ?>
		    	    	<option 
		    	    	  selected
		    	    	  value="<?=$author['id']?>">
		    	    	  <?=$author['name']?>
		    	        </option>
		    	        <?php }else{ ?>
						<option 
							value="<?=$author['id']?>">
							<?=$author['name']?>
						</option>
		    	   <?php }} } ?>
		    </select>
		</div>

		<div class="mb-3">
		    <label class="form-label">
		           Book Category
		           </label>
		    <select name="book_category"
		            class="form-control">
		    	    <option value="0">
		    	    	Select category
		    	    </option>
		    	    <?php 
                    if ($categories == 0) {
                    	# Do nothing!
                    }else{
		    	    foreach ($categories as $category) { 
		    	    	if ($category_id == $category['id']) { ?>
		    	    	<option 
		    	    	  selected
		    	    	  value="<?=$category['id']?>">
		    	    	  <?=$category['name']?>
		    	        </option>
		    	        <?php }else{ ?>
						<option 
							value="<?=$category['id']?>">
							<?=$category['name']?>
						</option>
		    	   <?php }} } ?>
		    </select>
		</div>

		<div class="mb-3">
		    <label class="form-label">
		           Book Cover
		           </label>
		    <input type="file" 
		           class="form-control" 
		           name="book_cover">
		</div>

		<div class="mb-3">
		    <label class="form-label">
		           File
		           </label>
		    <input type="file" 
		           class="form-control" 
		           name="file">
		</div>

	    <button type="submit" 
	            class="btn btn-primary">
	            Add Book</button>
     </form>




    <form method="post" enctype="multipart/form-data">
		    <label class="form-label">
		           File
		           </label>
		    <input type="file" 
		           class="form-control" 
		           name="csvFile" accept=".csv"/>
        <!-- <input type="submit" value="Upload CSV"> -->
        <button type="submit" 
	            class="btn btn-primary">
	            Upload CSV</button>
    </form>

<table class="table table-striped table-bordered b_table"><thead>



<tr><th>Id</th><th>ISBN</th><th>Title of Book</th><th>Author</th><th>Year</th><th>Publication</th><th>Time</th><th>Link   </th><th>Status</th></tr>



<!-- <tr id="w0-filters" class="filters"><td>&nbsp;</td><td><input type="text" class="form-control" name="BookDetailsSearch[isbn]"></td><td><input type="text" class="form-control" name="BookDetailsSearch[title_of_book]"></td><td><input type="text" class="form-control" name="BookDetailsSearch[author]"></td><td><input type="text" class="form-control" name="BookDetailsSearch[year]"></td><td><input type="text" class="form-control" name="BookDetailsSearch[publication]"></td><td>&nbsp;</td></tr>
 -->

</thead>
<tbody>



<?php

// MySQL database credentials
$servername = "localhost";
$username = "root";
$password = "";
$database = "online_book_store_db";



// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Function to update an existing record
function updateRecord($id, $status) 
{
    global $conn;
    $sql = "UPDATE book_details SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $id);
    $stmt->execute();
    $stmt->close();
}


$url =  $_SERVER['REQUEST_URI'];


$res = parse_url($url);

if(isset($res['query'])){
   parse_str($res['query'], $params);

   if(isset($params['id']) && isset($params['status'])){
       // echo 'id = '.$params['id'];
       // echo 'status = '.$params['status'];
        updateRecord($params['id'], $params['status']);
   }

}

// Function to insert a new record
function insertRecord($column1, $column2, $column3, $column4, $column5, $column6, $column7, $column8) {
    global $conn;

    $sql = "INSERT INTO book_details (isbn, title_of_book, author, year, publication, link, time, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $column1, $column2, $column3, $column4, $column5, $column6, $column7, $column8);
    $stmt->execute();
    $stmt->close();
}


function getRecordByUniqueIdentifier($conn, $id) {
    $sql = "SELECT * FROM your_table WHERE isbn = ? LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $record = $result->fetch_assoc();
    $stmt->close();

    return $record;
}


function getAllRecords() {
    global $conn;
    $sql = "SELECT * FROM book_details";
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

if ($result->num_rows > 0) {
  // output data of each row
  while($data = $result->fetch_assoc()) {
    
    // echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";


    echo "<tr data-key='2'><td>".$data['id']."</td><td>".$data['isbn']."</td><td>".$data['title_of_book']."</td><td>".$data['author']."</td><td>".$data['year']."</td><td>".$data['publication']."</td><td>".$data['time']."</td><td><a class='btn btn-info b_btn' href='".$data['link']." title='Go' target='_blank'>Click</a></td><td><a style=\"color:".($data['status'] == 0 ? '#ff2fad' : '#64a500')."\" href='?id=".$data['id']."&status=".($data['status'] == 0 ? 1 : 0)."'>".($data['status'] == 0 ? 'Inactive' : 'Active')."</a></td></tr>";



  }
} else {
  echo "0 results";
}



// Close the database connection
$conn->close();

?>

</tbody>
</table>


</div>
</body>
</html>

