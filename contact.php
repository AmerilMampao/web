<?php
// Step 1: Establish a Database Connection
$dsn = 'mysql:host=localhost;dbname=web';
$username = 'root';
$password = '';

try {
    $con = new PDO($dsn, $username, $password);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Step 2: Prepare Your Data
    $contact_us_name = $_POST['name'] ?? null;
    $contact_us_email = $_POST['email'] ?? null;
    $contact_us_phone = $_POST['phone'] ?? null;
    $contact_us_message = $_POST['message'] ?? null;
    
    // Ensure that all data is provided
    if ($contact_us_name && $contact_us_email && $contact_us_phone && $contact_us_message) {
        // Step 3: Create and Execute the Prepared Statement
        $sql = "INSERT INTO contact_us (contact_us_name, contact_us_email, contact_us_phone, contact_us_message) VALUES (:name, :email, :phone, :message)";
        $stmt = $con->prepare($sql);
        
        $stmt->bindParam(':name', $contact_us_name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $contact_us_email, PDO::PARAM_STR);
        $stmt->bindParam(':phone', $contact_us_phone, PDO::PARAM_STR);
        $stmt->bindParam(':message', $contact_us_message, PDO::PARAM_STR);
        
        $stmt->execute();
        
        // Redirect to dashboard.php after successful insertion
        header("Location: dashboard.php");
        exit();
    } else {
        echo "All fields are required!";
    }
    
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// Close the connection
$con = null;
