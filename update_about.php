<?php
require_once('classes/database.php');
session_start();

$con = new database();

// Initialize variables to store about information
$about_title = '';
$about_subtitle = '';
$about_description = '';
$resume_link = '';
$home_profile_image = '';
$error = '';

// Check if ID is set in POST data
if (isset($_POST["id"])) {
    $id = $_POST["id"];
    $data = $con->viewAboutInfo($id); // Fetch existing about info
    if ($data) {
        // Assign fetched data to variables
        $about_title = isset($data[0]['about_title']) ? $data[0]['about_title'] : '';
        $about_subtitle = isset($data[0]['about_subtitle']) ? $data[0]['about_subtitle'] : '';
        $about_description = isset($data[0]['about_description']) ? $data[0]['about_description'] : '';
        $resume_link = isset($data[0]['resume_link']) ? $data[0]['resume_link'] : '';
        $home_profile_image = isset($data[0]['home_profile_image']) ? $data[0]['home_profile_image'] : '';
    } else {
        header('location:dashboard.php?status=error'); // Redirect with error status if about info not found
        exit();
    }
} else {
    // Optionally, you can handle the case when ID is not set (e.g., redirect or display a message)
    header('location:dashboard.php');
    exit();
}

// Process form submission
if (isset($_POST['update'])) {
    // Fetch form data
    $id = $_POST['id']; // Retrieve the id from the form
    $about_title = $_POST['about_title'];
    $about_subtitle = $_POST['about_subtitle'];
    $about_description = $_POST['about_description'];
    $resume_link = $_POST['resume_link'];

    // Update about information
    if ($con->updateAboutInfo($id, $about_title, $about_subtitle, $about_description, $resume_link)) {
        // Redirect with success status
        header('location:dashboard.php?status=success');
        exit();
    } else {
        $error = "Error occurred while updating about information. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update About Info</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

<div class="container mt-5">
    <h3 class="text-center mb-4">Update About Info</h3>
    <form method="POST">
        <!-- About Information -->
        <div class="card mb-4">
            <div class="card-header bg-info text-white">About Information</div>
            <div class="card-body">
                <div class="form-group row">
                    <label for="about_title" class="col-sm-3 col-form-label">About Title:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="about_title" name="about_title" value="<?php echo htmlspecialchars($about_title); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="about_subtitle" class="col-sm-3 col-form-label">About Subtitle:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="about_subtitle" name="about_subtitle" value="<?php echo htmlspecialchars($about_subtitle); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="about_description" class="col-sm-3 col-form-label">About Description:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="about_description" name="about_description" value="<?php echo htmlspecialchars($about_description); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="resume_link" class="col-sm-3 col-form-label">Resume Link:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="resume_link" name="resume_link" value="<?php echo htmlspecialchars($resume_link); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="home_profile_image" class="col-sm-3 col-form-label">Profile Image URL:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="home_profile_image" name="home_profile_image" value="<?php echo htmlspecialchars($home_profile_image); ?>" readonly>
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

        <!-- Display Error Message if Exists -->
        <?php if (!empty($error)) : ?>
            <div class="alert alert-danger mt-3" role="alert">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
    </form>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- SweetAlert2 Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

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
