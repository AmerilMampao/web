<?php
require_once('classes/database.php');
session_start();

$con = new database();

// Initialize variables to store skills information
$skills_icon_class = '';
$skills_title = '';
$skills_description = '';
$skills_learn_more_link = '';
$error = '';

// Check if ID is set in POST data
if (isset($_POST["id"])) {
    $id = $_POST["id"];
    $data = $con->viewSkillInfo($id); // Fetch existing skills info
    if ($data) {
        // Assign fetched data to variables
        $skills_icon_class = isset($data['skills_icon_class']) ? $data['skills_icon_class'] : '';
        $skills_title = isset($data['skills_title']) ? $data['skills_title'] : '';
        $skills_description = isset($data['skills_description']) ? $data['skills_description'] : '';
        $skills_learn_more_link = isset($data['skills_learn_more_link']) ? $data['skills_learn_more_link'] : '';
    } else {
        header('location:dashboard.php?status=error'); // Redirect with error status if skills info not found
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
    $skills_icon_class = $_POST['skills_icon_class'];
    $skills_title = $_POST['skills_title'];
    $skills_description = $_POST['skills_description'];
    $skills_learn_more_link = $_POST['skills_learn_more_link'];

    // Update skills information
    if ($con->updateSkillInfo($id, $skills_icon_class, $skills_title, $skills_description, $skills_learn_more_link)) {
        // Redirect with success status
        header('location:dashboard.php?status=success');
        exit();
    } else {
        $error = "Error occurred while updating skills information. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Skills Info</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

<div class="container mt-5">
    <h3 class="text-center mb-4">Update Skills Info</h3>
    <form method="POST">
        <!-- Skills Information -->
        <div class="card mb-4">
            <div class="card-header bg-info text-white">Skills Information</div>
            <div class="card-body">
                <div class="form-group row">
                    <label for="skills_title" class="col-sm-3 col-form-label">Skills Title:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="skills_title" name="skills_title" value="<?php echo htmlspecialchars($skills_title); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="skills_icon_class" class="col-sm-3 col-form-label">Boxicons:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="skills_icon_class" name="skills_icon_class" value="<?php echo htmlspecialchars($skills_icon_class); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="skills_description" class="col-sm-3 col-form-label">Skills Description:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="skills_description" name="skills_description" value="<?php echo htmlspecialchars($skills_description); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="skills_learn_more_link" class="col-sm-3 col-form-label">Learn More Link:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="skills_learn_more_link" name="skills_learn_more_link" value="<?php echo htmlspecialchars($skills_learn_more_link); ?>">
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
