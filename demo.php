<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
  background-color: #da3535;
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
  background-color:#b03030;
}

.active {
  background-color:#b03030;
}
        h2 {
              font-weight: bold;
              font-family: georgia;
              text-shadow: 1px 1px black;
              color:#cf0d0d;
              font-size: 38px;
                }
            p{
                font-weight: bold; 
                font-family: serif;
                font-size: 18px; 
                color: black;
            }
            .btn {
    background-color: #cf0d0d; 
    color: #ffffff; 
    border: none;
    padding: 10px 20px;
    font-size: 20px;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease;
}
.btn:hover {
    background-color: #e34a4a; 
}
 
        img {
	display: block;
	margin: auto;
	width: 30%;
  border: 3px solid black;
}   
    </style>
  

    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>

<body>
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
  <img src="Images/masterpieces.jpeg" alt="museum",</img>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Art Museum Details</h2>
                        <a href="create.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New Details</a>
                    </div>
                    <?php
                    // Include config file
                    require_once "config.php";

                    // Attempt select query execution
                    $sql = "SELECT * FROM art_museum";
                    if ($result = mysqli_query($link, $sql)) {
                        if (mysqli_num_rows($result) > 0) {
                            echo '<table class="table table-bordered table-striped">';
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>id</th>";
                            echo "<th>artwork_title</th>";
                            echo "<th>artist_name</th>";
                            echo "<th>date_of_creation</th>";
                            echo "<th>materials</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['artwork_title'] . "</td>";
                                echo "<td>" . $row['artist_name'] . "</td>";
                                echo "<td>" . $row['date_of_creation'] . "</td>";
                                echo "<td>" . $row['materials'] . "</td>";
                                echo "<td>";
                                echo '<a href="read.php?id=' . $row['id'] . '" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                echo '<a href="update.php?id=' . $row['id'] . '" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                echo '<a href="delete.php?id=' . $row['id'] . '" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                echo "</td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else {
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else {
                        echo "Oops! Something went wrong. Please try again later.";
                    }

                    // Close connection
                    mysqli_close($link);
                    ?>
                </div>
            </div>
        </div>
    </div>
     <!-- Footer Section -->
  <footer>
     <p>&copy; 2023 Historical Art Museum. All Rights Reserved by Navneet Kaur 202107781.</p>
</body>

</html>