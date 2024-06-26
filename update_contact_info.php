<?php
require_once('classes/database.php');
session_start();

$con = new database();

// Initialize variables to store contact information
$title = $phone = $email = $address = $linkedin = $github = $facebook = $instagram = '';

// Check if ID is set in POST data
if (isset($_POST["id"])) {
    $id = $_POST["id"];
    $data = $con->viewcontactInfo($id); // Fetch existing contact info
    if (!$data) {
        header('location:dashboard.php?status=success'); // Redirect if contact info not found
        exit();
    }
} else {
    header('location:dashboard.php'); // Redirect if ID is not set
    exit();
}

// Process form submission
if (isset($_POST['update'])) {
    // Fetch form data
    $id = $_POST['id']; // Retrieve the id from the form
    $title = $_POST['title'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $linkedin = $_POST['linkedin'];
    $github = $_POST['github'];
    $facebook = $_POST['facebook'];
    $instagram = $_POST['instagram'];

    // Update contact information
    if ($con->updatecontactInfo($id,$title, $phone, $email, $address, $linkedin, $github, $facebook, $instagram)) {
        // Redirect with success status
        header('location:dashboard.php?status=success');
        exit();
    } else {
        $error = "Error occurred while updating contact information. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Contact Info</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>

<div class="container mt-5">
    <h3 class="text-center mb-4">Update Contact Info</h3>
    <form method="POST">
        <!-- Contact Information -->
        <div class="card mb-4">
            <div class="card-header bg-info text-white">Contact Information</div>
            <div class="card-body">
                <div class="form-group row">
                    <label for="title" class="col-sm-3 col-form-label">Title:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($data['title']); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="phone" class="col-sm-3 col-form-label">Phone:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($data['phone']); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-3 col-form-label">Email:</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($data['email']); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="address" class="col-sm-3 col-form-label">Address:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="address" name="address" value="<?php echo htmlspecialchars($data['address']); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="linkedin" class="col-sm-3 col-form-label">LinkedIn:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="linkedin" name="linkedin" value="<?php echo htmlspecialchars($data['linkedin']); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="github" class="col-sm-3 col-form-label">GitHub:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="github" name="github" value="<?php echo htmlspecialchars($data['github']); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="facebook" class="col-sm-3 col-form-label">Facebook:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="facebook" name="facebook" value="<?php echo htmlspecialchars($data['facebook']); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="instagram" class="col-sm-3 col-form-label">instagram:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="instagram" name="instagram" value="<?php echo htmlspecialchars($data['instagram']); ?>">
                    </div>
                </div>
            </div>
        </div>

        <!-- Hidden ID Field -->
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <!-- Submit Button -->
        <div class="row justify-content-center">
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary btn-block" name="update">Update</button>
            </div>
            <div class="col-md-3">
                <a href="dashboard.php" class="btn btn-danger btn-block">Cancel</a>
            </div>
        </div>
    </form>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const params = new URLSearchParams(window.location.search);
  const status = params.get('status');
 
  if (status) {
    let title, text, icon;
    switch (status) {
      case 'success':
        title = 'Success!';
        text = 'Record is successfully updated.';
        icon = 'success';
        break;
      case 'error':
        title = 'Error!';
        text = 'Something went wrong.';
        icon = 'error';
        break;
      default:
        return;
    }
    Swal.fire({
      title: title,
      text: text,
      icon: icon
    }).then(() => {
      // Remove the status parameter from the URL
      const newUrl = window.location.origin + window.location.pathname;
      window.history.replaceState(null, null, newUrl);
    });
  }
});
</script>
</body>
</html>
