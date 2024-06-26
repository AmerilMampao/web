<?php
require_once('classes/database.php');
session_start();

$con = new database();

// Initialize variables to store contact information
$projects_title = $projects_description = $projects_image_url = $projects_url = '';

// Check if ID is set in POST data
if (isset($_POST["id"])) {
    $id = $_POST["id"];
    $data = $con->viewProjectsInfo($id); // Fetch existing project info
    if ($data) {
        // Assign fetched data to variables
        $projects_title = isset($data['projects_title']) ? $data['projects_title'] : '';
        $projects_description = isset($data['projects_description']) ? $data['projects_description'] : '';
        $projects_image_url = isset($data['projects_image_url']) ? $data['projects_image_url'] : '';
        $projects_url = isset($data['projects_url']) ? $data['projects_url'] : '';
    } else {
        header('location:dashboard.php?status=error'); // Redirect with error status if project info not found
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
    $projects_title = $_POST['projects_title'];
    $projects_description = $_POST['projects_description'];
    $projects_image_url = $_POST['projects_image_url'];
    $projects_url = $_POST['projects_url'];

    // Update contact information
    if ($con->updateProjectsInfo($id, $projects_title, $projects_description, $projects_image_url, $projects_url)) {
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
    <title>Update Projects Info</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>

<div class="container mt-5">
    <h3 class="text-center mb-4">Update Projects Info</h3>
    <form method="POST">
        <!-- Projects Information -->
        <div class="card mb-4">
            <div class="card-header bg-info text-white">Projects Information</div>
            <div class="card-body">
                <div class="form-group row">
                    <label for="projects_title" class="col-sm-3 col-form-label">Project Title:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="projects_title" name="projects_title" value="<?php echo htmlspecialchars($projects_title); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="projects_description" class="col-sm-3 col-form-label">Project Description:</label>
                    <div class="col-sm-9">
                        <textarea class="form-control" id="projects_description" name="projects_description"><?php echo htmlspecialchars($projects_description); ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="projects_image_url" class="col-sm-3 col-form-label">Project Image URL:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="projects_image_url" name="projects_image_url" value="<?php echo htmlspecialchars($projects_image_url); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="projects_url" class="col-sm-3 col-form-label">Project URL:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="projects_url" name="projects_url" value="<?php echo htmlspecialchars($projects_url); ?>">
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
