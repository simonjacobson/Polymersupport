<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Read the json Post contents
$data = json_decode(file_get_contents('php://input'), true);

// Make sure there is data

if ($data =="")  {
	$errorNull= "No data received";

} else {

// Convert json object to php associative array

// Parse the contact details
    $practiceName = $data['pr_name'];
    $cohort = $data['pr_cohort'];

// Validate fields by removing extra white spaces & escaping harmful characters
$practiceName = trim($practiceName);
$cohort = trim($cohort);

// Create MySQL login variables
$servername = "localhost";
$username = "webapp";
$password = "as43vE54";
$dbname = "contactsdb";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Insert into mysql table
    $sql = "INSERT INTO contactsdb.amp_practice (AMP_Practice_Name, AMP_Practice_Cohort)
    VALUES('$practiceName', '$cohort')";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
 // Close connection
mysqli_close($conn);
}
?>
