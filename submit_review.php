<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = ""; // Adjust if your MySQL server has a password
$dbname = "review_system";

// Connect to MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user input
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $review = $conn->real_escape_string($_POST['review']);

    // Validate input
    if (!empty($name) && !empty($email) && !empty($review)) {
        // Insert data into database
        $sql = "INSERT INTO reviews (name, email, review) VALUES ('$name', '$email', '$review')";
        
        if ($conn->query($sql) === TRUE) {
            echo "Review submitted successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "All fields are required.";
    }
}

$conn->close();
?>
