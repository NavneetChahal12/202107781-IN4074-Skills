<?php
// Check existence of id parameter before processing further
if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    // Include config file
    require_once "config.php";

    // Prepare a select statement
    $sql = "SELECT * FROM art_museum WHERE id = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);

        // Set parameters
        $param_id = trim($_GET["id"]);

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) == 1) {
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                // Retrieve individual field value
                $artwork_title = $row["artwork_title"];
                $artist_name = $row["artist_name"];
                $date_of_creation = $row["date_of_creation"];
                $materials = $row["materials"];
            } else {
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    // Close statement
    mysqli_stmt_close($stmt);

    // Close connection
    mysqli_close($link);
} else {
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View Record</title>
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
  background-color: #c18dc6;
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
  padding: 8px 50px;
}

li a:hover:not(.active) {
  background-color:#b480ce;
}

.active {
  background-color:#b480ce;
}
        h1 {
              font-weight: bold;
              font-family: georgia;
              text-shadow: 1px 1px black;
              color:#9300a0c3;
              font-size: 38px;
                }
            p{
                font-weight: bold; 
                font-family: serif;
                font-size: 18px; 
                color: black;
            }
            .btn-primary {
    background-color: #9300a0c3; 
    color: #ffffff; 
    border: none;
    padding: 10px 20px;
    font-size: 20px;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease;
}
.btn-primary:hover {
    background-color: #9300a0c3; 
}
 
        img {
	display: block;
	margin: auto;
	width: 30%;
  border: 3px solid black;
}   
    </style>
      <img src="Images/museum.jpeg" alt="museum",</img>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3">View Record</h1>
                    <div class="form-group">
                        <label>Artwork Title</label>
                        <p><b><?php echo $row["artwork_title"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Artist Name</label>
                        <p><b><?php echo $row["artist_name"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Date of creation</label>
                        <p><b><?php echo $row["date_of_creation"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Materials</label>
                        <p><b><?php echo $row["materials"]; ?></b></p>
                    </div>
                    <p><a href="demo.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
 <!-- Footer Section -->
 <footer>
     <p>&copy; 2023 Historical Art Museum. All Rights Reserved by Navneet Kaur 202107781.</p>
</html>