<?php
// Process delete operation after confirmation
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    // Include config file
    require_once "config.php";

    // Prepare a delete statement
    $sql = "DELETE FROM art_museum WHERE id = ?"; 

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);

        // Set parameters
        $param_id = trim($_POST["id"]);

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Records deleted successfully. Redirect to landing page
            header("location: index.php");
            exit();
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    // Close statement
    mysqli_stmt_close($stmt);

    // Close connection
    mysqli_close($link);
} else {
    // Check existence of id parameter
    if (empty(trim($_GET["id"]))) {
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en"> 

<head>
    <meta charset="UTF-8">
    <title>Delete Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
     <!-- Navigation Section -->
  <nav>
    <ul>
      <li><a href="index.php">Index Page</a></li>
      <li><a href="demo.php">Demonstration</a></li>
      <li><a href="resources.html">Resources</a></li>
      <li><a href="me.html">About me</a></li>
      <li><a href="create.php">Add Record</a></li>
      <li><a href="index.html">Home</a></li>
      <li><a href="about.html">About Museum</a></li>
      <li><a href="collections.html">Collections</a></li>
      <li><a href="exhibitions.html">Exhibitions</a></li>
      <li><a href="contact.html">Contact Us</a></li>
    </ul>
  </nav>
  <style>
        .wrapper {
            width: 600px;
            margin: 0 auto;
        }
        ul {
	list-style-type: circle;
  margin: 10px;
  padding: 14px;
  overflow: hidden;
  background-color: #e5c4ab;
  font-size: 30px;
  font-weight: bold;
  border-style: solid;
  border-color: black;
}

li {
  float: left;
}

li a {
  display: block;
  color: black;
  text-align: center;
  padding: 10px 50px;
}

li a:hover:not(.active) {
  background-color:#daae8d;
}

.active {
  background-color:#daae8d;
}
        h2 {
              font-weight: bold;
              font-family: georgia;
              text-shadow: 1px 1px black;
              color:#ad7c57ea;
              font-size: 38px;
                }
            p{
                font-weight: bold; 
                font-family: serif;
                font-size: 18px; 
                color: black;
            }
            .btn-danger {
    background-color: #ad7c57ea; 
    color: #ffffff; 
    border: none;
    padding: 10px 20px;
    font-size: 20px;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease;
}
.btn-danger:hover {
    background-color: #e34a4a; 
}
.btn-secondary {
    background-color: #ad7c57ea; 
    color: #ffffff; 
    border: none;
    padding: 10px 20px;
    font-size: 20px;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease;
}
.btn-secondary:hover {
    background-color: #e34a4a; 
}
        img {
	display: block;
	margin: auto;
	width: 30%;
  border: 3px solid black;
}   
    </style>
      <img src="Images/past.jpeg" alt="museum",</img>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5 mb-3">Delete Record</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>" />
                            <p>Are you sure you want to delete this Art Museum record?</p>
                            <p>
                                <input type="submit" value="Yes" class="btn btn-danger">
                                <a href="demo.php" class="btn btn-secondary">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
 <!-- Footer Section -->
 <footer>
     <p>&copy; 2023 Historical Art Museum. All Rights Reserved by Navneet Kaur 202107781.</p>
</html>