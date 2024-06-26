<?php
require_once('classes/database.php');
session_start();

$con = new database();

// Initialize variables to store home information
$home_profile_image = '';
$home_welcome_message = '';
$home_title = '';
$home_description = '';
$typing_texts = '';
$error = '';

// Check if ID is set in POST data
if (isset($_POST["id"])) {
    $id = $_POST["id"];
    $data = $con->viewHomeInfo($id); // Fetch existing home info
    if ($data) {
        // Assign fetched data to variables
        $home_profile_image = isset($data[0]['home_profile_image']) ? $data[0]['home_profile_image'] : '';
        $home_welcome_message = isset($data[0]['home_welcome_message']) ? $data[0]['home_welcome_message'] : '';
        $home_title = isset($data[0]['home_title']) ? $data[0]['home_title'] : '';
        $home_description = isset($data[0]['home_description']) ? $data[0]['home_description'] : '';
        $typing_texts = isset($data[0]['typing_texts']) ? $data[0]['typing_texts'] : '';
    } else {
        header('location:dashboard.php?status=error'); // Redirect with error status if home info not found
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
    $home_profile_image = $_POST['home_profile_image'];
    $home_welcome_message = $_POST['home_welcome_message'];
    $home_title = $_POST['home_title'];
    $home_description = $_POST['home_description'];
    $typing_texts = $_POST['typing_texts'];

    // Update home information
    if ($con->updateHomeInfo($id, $home_profile_image, $home_welcome_message, $home_title, $home_description, $typing_texts)) {
        // Redirect with success status
        header('location:dashboard.php?status=success');
        exit();
    } else {
        $error = "Error occurred while updating home information. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Home Info</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

<div class="container mt-5">
    <h3 class="text-center mb-4">Update Home Info</h3>
    <form method="POST">
        <!-- Home Information -->
        <div class="card mb-4">
            <div class="card-header bg-info text-white">Home Information</div>
            <div class="card-body">
                <div class="form-group row">
                    <label for="home_title" class="col-sm-3 col-form-label">Home Title:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="home_title" name="home_title" value="<?php echo htmlspecialchars($home_title); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="home_profile_image" class="col-sm-3 col-form-label">Profile Image URL:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="home_profile_image" name="home_profile_image" value="<?php echo htmlspecialchars($home_profile_image); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="home_welcome_message" class="col-sm-3 col-form-label">Welcome Message:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="home_welcome_message" name="home_welcome_message" value="<?php echo htmlspecialchars($home_welcome_message); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="home_description" class="col-sm-3 col-form-label">Home Description:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="home_description" name="home_description" value="<?php echo htmlspecialchars($home_description); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="typing_texts" class="col-sm-3 col-form-label">Typing Texts:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="typing_texts" name="typing_texts" value="<?php echo htmlspecialchars($typing_texts); ?>">
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
