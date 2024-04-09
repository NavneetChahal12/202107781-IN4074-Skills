<?php
// Include config file
require_once "config.php"; 

// Define variables and initialize with empty values
$artwork_title = $artist_name = $date_of_creation = $materials = "";
$artwork_title_err = $artist_name_err = $date_of_creation_err = $materials_err = "";

// Processing form data when form is submitted
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    // Get hidden input value
    $id = $_POST["id"];

     // Validate Artwork Title
     $input_artwork_title = trim($_POST["artwork_title"]);
     if (empty($input_artwork_title)) {
         $artwork_title_err = "Please enter the Artwork Title.";
     } else {
         $artwork_title = $input_artwork_title;
     }

    // Validate Artist name
    $input_artist_name = trim($_POST["artist_name"]);
    if (empty($input_artist_name)) {
        $artist_name_err = "Please enter a Artist name.";
    } elseif (!filter_var($input_artist_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $artist_name_err = "Please enter a valid Artist name.";
    } else {
        $artist_name = $input_artist_name;
    }

    // Validate date_of_creation
    $input_date_of_creation = trim($_POST["date_of_creation"]);
    if (empty($input_date_of_creation)) {
        $date_of_creation_err = "Please enter an date_of_creation.";
    } else {
        $date_of_creation = $input_date_of_creation;
    }

    // Validate materials
    $input_materials = trim($_POST["materials"]);
    if (empty($input_materials)) {
        $materials_err = "Please enter the materials amount.";
    } else {
        $materials = $input_materials;
    }

    // Check input errors before inserting in database
    if (empty($artwork_title_err) && empty($artist_name_err) && empty($date_of_creation_err) && empty($materials_err)) {
        // Prepare an update statement
$sql = "UPDATE art_museum SET artwork_title=?, artist_name=?, date_of_creation=?, materials=? WHERE id=?";

if ($stmt = mysqli_prepare($link, $sql)) {
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "ssssi", $param_artwork_title, $param_artist_name, $param_date_of_creation, $param_materials, $param_id);

    // Set parameters
    $param_artwork_title = $artwork_title;
    $param_artist_name = $artist_name;
    $param_date_of_creation = $date_of_creation;
    $param_materials = $materials;
    $param_id = $id;

    // Attempt to execute the prepared statement
    if (mysqli_stmt_execute($stmt)) {
        // Records updated successfully. Redirect to landing page
        header("location: index.php");
        exit();
    } else {
        echo "Oops! Something went wrong. Please try again later.";
    }
}

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
} else {
    // Check existence of id parameter before processing further
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        // Get URL parameter
        $id =  trim($_GET["id"]);

        // Prepare a select statement
        $sql = "SELECT * FROM art_museum WHERE id = ?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);

            // Set parameters
            $param_id = $id;

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
                    // URL doesn't contain valid id. Redirect to error page
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
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
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
  background-color: #6a7777;
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
  background-color:#bccece;
}

.active {
  background-color:#bccece;
}
        h2 {
              font-weight: bold;
              font-family: georgia;
              text-shadow: 1px 1px black;
              color:#405353;
              font-size: 38px;
                }
            p{
                font-weight: bold; 
                font-family: serif;
                font-size: 18px; 
                color: black;
            }
            .btn-primary {
    background-color: #405353; 
    color: #ffffff; 
    border: none;
    padding: 10px 20px;
    font-size: 20px;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease;
}
.btn-primary:hover {
    background-color: #6a7777; 
}

        img {
	display: block;
	margin: auto;
	width: 30%;
  border: 3px solid black;
}   
    </style>
      <img src="Images/legacy.jpeg" alt="museum",</img>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Update Record</h2>
                    <p>Please edit the input values and submit to update the employee record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                    <div class="form-group">
                            <label>Artwork Title</label>
                            <input type="text" name="artwork_title" class="form-control <?php echo (!empty($artwork_title_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $artwork_title; ?>">
                            <span class="invalid-feedback"><?php echo $artwork_title_err; ?></span>
                        </div>   
                    <div class="form-group">
                            <label>Artist Name</label>
                            <input type="text" name="artist_name" class="form-control <?php echo (!empty($artist_name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $artist_name; ?>">
                            <span class="invalid-feedback"><?php echo $artist_name_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>date_of_creation</label>
                            <input type="text" name="date_of_creation" class="form-control <?php echo (!empty($date_of_creation_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $date_of_creation; ?>">
                            <span class="invalid-feedback"><?php echo $date_of_creation_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>materials</label>
                            <input type="text" name="materials" class="form-control <?php echo (!empty($materials_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $materials; ?>">
                            <span class="invalid-feedback"><?php echo $materials_err; ?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="demo.php" class="btn btn-secondary ml-2">Cancel</a>
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