<?php
require_once('classes/database.php');
session_start();

$con = new database();

// Initialize variables
$id = $education_image = $education_degree = $education_institution = $education_location = $education_duration = $status = '';

// Check if ID is set in POST data
if (isset($_POST["id"])) {
    $id = $_POST["id"];
    $data = $con->viewEducationInfo($id); // Fetch existing education info
    if ($data) {
        // Assign fetched data to variables
        $education_image = isset($data[0]['education_image']) ? $data[0]['education_image'] : '';
        $education_degree = isset($data[0]['education_degree']) ? $data[0]['education_degree'] : '';
        $education_institution = isset($data[0]['education_institution']) ? $data[0]['education_institution'] : '';
        $education_location = isset($data[0]['education_location']) ? $data[0]['education_location'] : '';
        $education_duration = isset($data[0]['education_duration']) ? $data[0]['education_duration'] : '';
        $status = isset($data[0]['status']) ? $data[0]['status'] : '';
    } else {
        header('location:dashboard.php?status=error'); // Redirect with error status if education info not found
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
    $education_image = $_POST['education_image'];
    $education_degree = $_POST['education_degree'];
    $education_institution = $_POST['education_institution'];
    $education_location = $_POST['education_location'];
    $education_duration = $_POST['education_duration'];
    $status = $_POST['status'];

    // Update education information
    if ($con->updateEducationInfo($id, $education_image, $education_degree, $education_institution, $education_location, $education_duration, $status)) {
        // Redirect with success status
        header('location:dashboard.php?status=success');
        exit();
    } else {
        $error = "Error occurred while updating education information. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Education Info</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>

<div class="container mt-5">
    <h3 class="text-center mb-4">Update Education Info</h3>
    <form method="POST">
        <!-- Education Information -->
        <div class="card mb-4">
            <div class="card-header bg-info text-white">Education Information</div>
            <div class="card-body">
                <div class="form-group row">
                    <label for="education_image" class="col-sm-3 col-form-label">Education Image:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="education_image" name="education_image" value="<?php echo htmlspecialchars($education_image); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="education_degree" class="col-sm-3 col-form-label">Education Degree:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="education_degree" name="education_degree" value="<?php echo htmlspecialchars($education_degree); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="education_institution" class="col-sm-3 col-form-label">Education Institution:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="education_institution" name="education_institution" value="<?php echo htmlspecialchars($education_institution); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="education_location" class="col-sm-3 col-form-label">Education Location:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="education_location" name="education_location" value="<?php echo htmlspecialchars($education_location); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="education_duration" class="col-sm-3 col-form-label">Education Duration:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="education_duration" name="education_duration" value="<?php echo htmlspecialchars($education_duration); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="status" class="col-sm-3 col-form-label">Status:</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="status" name="status">
                            <option value="Pursuing" <?php if ($status === 'Pursuing') echo 'selected'; ?>>Pursuing</option>
                            <option value="Completed" <?php if ($status === 'Completed') echo 'selected'; ?>>Completed</option>
                        </select>
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
</body>
</html>
