<?php
require_once('classes/database.php');
$con = new database();
session_start();

// Check if user is logged in and has admin privileges
if (!isset($_SESSION['username']) || $_SESSION['account_type'] != 0) {
    header('location: login.php');
    exit();
}

// Initialize $id to avoid undefined variable warning
$id = isset($_POST['id']) ? $_POST['id'] : null;

// Check if delete button is clicked
if (isset($_POST['delete'])) {
    // Retrieve $id from form submission
    $id = $_POST['id'];
    
    // Call delete method and handle success or failure
    if ($con->delete($id)) {
        header('location: dashboard.php?status=success');
        exit();
    } else {
        echo "Something went wrong.";
    }
}

// Fetch data to display (assuming this is for displaying user information)


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome!</title>
  <link rel="stylesheet" href="./bootstrap-5.3.3-dist/css/bootstrap.css">
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- For Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <!-- boxicons -->
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="./includes/style.css">
  <!-- sweet alert -->
  <link rel="stylesheet" href="package/dist/sweetalert2.css">

</head>
<body>
    <?php include('includes/navbar.php') ?>
<div class="container user-info rounded shadow p-3 my-2">
<h2 class="text-center mb-2">User Table</h2>
  <div class="table-responsive text-center">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>#</th>
          <th>Picture</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Birthday</th>
          <th>Sex</th>
          <th>Username</th>
          <th>Address</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
      <?php
        $counter = 1;
        $data = $con->view();
        foreach($data as $row) { ?>
        <tr>
          <td><?php echo $counter++ ?></td>
          <td>
            <?php if (!empty($row['user_profile_picture'])): ?>
            <img src="<?php echo htmlspecialchars($row['user_profile_picture']); ?>" alt="Profile Picture" style="width: 50px; height: 50px; border-radius: 50%;">
            <?php else: ?>
            <img src="path/to/default/profile/pic.jpg" alt="Default Profile Picture" style="width: 50px; height: 50px; border-radius: 50%;">
            <?php endif; ?>
        </td>
          <td><?php echo $row['user_firstname']?></td>
          <td><?php echo $row['user_lastname']; ?></td>
          <td><?php echo $row['user_birthday']; ?></td>
          <td><?php echo $row['user_sex']; ?></td>
          <td><?php echo $row['user_name']; ?></td>
          <td><?php echo $row['address']; ?></td>
          <td>

            <form action="update_user.php" role="group" method="POST" class=" d-inline">
          <input type="hidden" name="id" value= "<?php echo $row['user_id']; ?>">  
        <button type="submit" name="delete" class="btn btn-primary btn-sm" value="delete"onclick="return confirm('Are you sure you want to edit this user?')">
            <i class="fas fa-edit"></i>
            </button>
            </form>
            
        <!-- Delete button -->
        <form method="POST" class=" d-inline">
        <input type="hidden" name="id" value= "<?php echo $row['user_id']; ?>">  
        <button type="submit" name="delete" class="btn btn-danger btn-sm" value="delete" onclick="return confirm('Are you sure you want to delete this user?')">
            <i class="fas fa-trash-alt"></i>
            </button>
        </form>
          </td>
        </tr>
        <?php } ?>
        <!-- Add more rows for additional needs -->
      </tbody>
    </table>
  </div>
</div>
    <!-- Contact Info Table -->
    <div class="container contact-info rounded shadow p-3 my-2">
        <h2 class="text-center mb-2">Contact Info Table</h2>
        <div class="table-responsive text-center">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>LinkedIn</th>
                        <th>GitHub</th>
                        <th>Facebook</th>
                        <th>Mail</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $counter = 1;
                    $data = $con->letmeviewcontactinfo(); // Replace with your method to fetch contact info
                    foreach ($data as $row) { ?>
                        <tr>
                            <td><?php echo $counter++; ?></td>
                            <td><?php echo htmlspecialchars($row['title']); ?></td>
                            <td><?php echo htmlspecialchars($row['phone']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['address']); ?></td>
                            <td><?php echo htmlspecialchars($row['linkedin']); ?></td>
                            <td><?php echo htmlspecialchars($row['github']); ?></td>
                            <td><?php echo htmlspecialchars($row['facebook']); ?></td>
                            <td><?php echo htmlspecialchars($row['instagram']); ?></td>
                            <td>
                                <form action="update_contact_info.php" method="POST" class="d-inline">
                                    <input type="hidden" name="id" value="<?php echo $row['contact_info_id']; ?>">
                                    <button type="submit" name="edit_contact" class="btn btn-primary btn-sm" onclick="return confirm('Are you sure you want to edit this contact info?')">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
      <!-- Contact Us Table -->
<div class="container contact-info rounded shadow p-3 my-2">
    <h2 class="text-center mb-2">Contact Us Table</h2>
    <div class="table-responsive text-center">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Message</th>
                    <th>Received At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $counter = 1;
              $data = $con-> fetchContactUsData();
                foreach ($data as $row) { ?>
                    <tr>
                        <td><?php echo $counter++; ?></td>
                        <td><?php echo htmlspecialchars($row['contact_us_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['contact_us_email']); ?></td>
                        <td><?php echo htmlspecialchars($row['contact_us_phone']); ?></td>
                        <td><?php echo htmlspecialchars($row['contact_us_message']); ?></td>
                        <td><?php echo htmlspecialchars($row['contact_us_created_at']); ?></td>
                        <td>
                          <!-- Delete button -->
                            <form method="POST" class=" d-inline">
                                <input type="hidden" name="id" value="<?php echo $row['contact_us_d']; ?>">
                                <button type="submit" name="delete" class="btn btn-danger btn-sm" value="delete" onclick="return confirm('Are you sure you want to delete this message?')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
     <!-- Education Table -->             
<div class="container user-info rounded shadow p-3 my-2">
    <h2 class="text-center mb-2">Education Table</h2>
    <div class="table-responsive text-center">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Picture</th>
                    <th>Degree</th>
                    <th>Institution</th>
                    <th>Location</th>
                    <th>Duration</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $counter = 1;
                $data = $con-> fetchEducationData();
                    foreach ($data as $row) {  ?>
                        <tr>
                            <td><?php echo $counter++ ?></td>
                            <td>
                                <img src="<?php echo htmlspecialchars($row['education_image']); ?>" alt="<?php echo htmlspecialchars($educatrowion['education_institution']); ?> Image" style="width: 50px; height: 50px; border-radius: 50%;">
                            </td>
                            <td><?php echo htmlspecialchars($row['education_degree']); ?></td>
                            <td><?php echo htmlspecialchars($row['education_institution']); ?></td>
                            <td><?php echo htmlspecialchars($row['education_location']); ?></td>
                            <td><?php echo htmlspecialchars($row['education_duration']); ?></td>
                            <td><?php echo ucfirst($row['STATUS']); ?></td>
                            <td>
                                <form action="update_education.php" method="POST" class="d-inline">
                                    <input type="hidden" name="id" value="<?php echo $row['education_id']; ?>">
                                    <button type="submit" name="edit" class="btn btn-primary btn-sm" onclick="return confirm('Are you sure you want to edit this education?')">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </form>

                                <form method="POST" class="d-inline">
                                    <input type="hidden" name="id" value="<?php echo $row['education_id']; ?>">
                                    <button type="submit" name="delete" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this education?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>

                            </td>
                        </tr>
                        <?php } ?>
                 </tbody>
             </table>
       </div>
</div>
<!-- Education Table ends --> 

<!-- Project Table starts -->
<div class="container user-info rounded shadow p-3 my-2">
    <h2 class="text-center mb-2">Projects Table</h2>
    <div class="table-responsive text-center">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>URL</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $counter = 1;
                $projects = $con->fetchProjectsData();
                foreach ($projects as $project) {  ?>
                <tr>
                    <td><?php echo $counter++; ?></td>
                    <td><?php echo htmlspecialchars($project['projects_title']); ?></td>
                    <td><?php echo htmlspecialchars($project['projects_description']); ?></td>
                    <td>
                        <img src="<?php echo htmlspecialchars($project['projects_image_url']); ?>" alt="<?php echo htmlspecialchars($project['projects_title']); ?>" style="width: 50px; height: 50px; border-radius: 50%;">
                    </td>
                    <td>
                        <a href="<?php echo htmlspecialchars($project['projects_url']); ?>" target="_blank"><?php echo htmlspecialchars($project['projects_url']); ?></a>
                    </td>
                    <td>
                        <form action="update_projects.php" method="POST" class="d-inline">
                            <input type="hidden" name="id" value="<?php echo $project['projects_id']; ?>">
                            <button type="submit" name="edit" class="btn btn-primary btn-sm" onclick="return confirm('Are you sure you want to edit this project?')">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                        </form>
                        <form method="POST" class="d-inline">
                            <input type="hidden" name="id" value="<?php echo $project['projects_id']; ?>">
                            <button type="submit" name="delete" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this project?')">
                                <i class="fas fa-trash-alt"></i> Delete
                            </button>
                        </form>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<!-- Project Table ends -->

<!-- Skills Table -->
<div class="container user-info rounded shadow p-3 my-2">
    <h2 class="text-center mb-2">Skills Table</h2>
    <div class="table-responsive text-center">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Boxicons</th>
                    <th>Description</th>
                    <th>Links</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $counter = 1;
                $data = $con->fetchSkillsData();
                foreach ($data as $row) { ?>
                    <tr>
                        <td><?php echo $counter++; ?></td>
                        <td><?php echo htmlspecialchars($row['skills_title']); ?></td>
                        <td><i class="<?php echo htmlspecialchars($row['skills_icon_class']); ?>"></i></td>
                        <td><?php echo htmlspecialchars($row['skills_description']); ?></td>
                        <td><a href="<?php echo htmlspecialchars($row['skills_learn_more_link']); ?>" target="_blank">Learn more</a></td>
                        <td>
                            <form action="update_skills.php" method="POST" class="d-inline">
                                <input type="hidden" name="id" value="<?php echo $row['skills_id']; ?>">
                                <button type="submit" name="edit" class="btn btn-primary btn-sm" onclick="return confirm('Are you sure you want to edit this skill?')">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </form>

                            <form method="POST" class="d-inline">
                                <input type="hidden" name="id" value="<?php echo $row['skills_id']; ?>">
                                <button type="submit" name="delete" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this skill?')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<!-- Skills Table ends -->

<!-- SkillsTable ends --> 
<!-- Home Table -->
<div class="container user-info rounded shadow p-3 my-2">
    <h2 class="text-center mb-2">Home Table</h2>
    <div class="table-responsive text-center">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Welcome Message</th>
                    <th>Description</th>
                    <th>Typing Texts</th>
                    <th>Profile Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $counter = 1;
                $data = $con->fetchHomeData(); // Assuming a method fetchAllHomeData() in your database class
                foreach ($data as $row) { ?>
                    <tr>
                        <td><?php echo $counter++; ?></td>
                        <td><?php echo htmlspecialchars($row['home_title']); ?></td>
                        <td><?php echo htmlspecialchars($row['home_welcome_message']); ?></td>
                        <td><?php echo htmlspecialchars($row['home_description']); ?></td>
                        <td><?php echo htmlspecialchars($row['typing_texts']); ?></td>
                        <td><img src="<?php echo htmlspecialchars($row['home_profile_image']); ?>" alt="Profile Image" style="max-width: 100px;"></td>
                        <td>
                            <form action="update_home_table.php" method="POST" class="d-inline">
                                <input type="hidden" name="id" value="<?php echo $row['home_id']; ?>">
                                <button type="submit" name="edit" class="btn btn-primary btn-sm" onclick="return confirm('Are you sure you want to edit this home information?')">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </form>

                            <form method="POST" class="d-inline">
                                <input type="hidden" name="id" value="<?php echo $row['home_id']; ?>">
                                <button type="submit" name="delete" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this home information?')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<!-- Home Table ends -->

<!-- About Table -->
<div class="container user-info rounded shadow p-3 my-2">
    <h2 class="text-center mb-2">About Table</h2>
    <div class="table-responsive text-center">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Subtitle</th>
                    <th>Description</th>
                    <th>Resume Link</th>
                    <th>Profile Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $rows = $con->fetchAboutData();
                if ($rows) {
                    $counter = 1;
                    foreach ($rows as $row) {
                        ?>
                        <tr>
                            <td><?php echo $counter++; ?></td>
                            <td><?php echo htmlspecialchars($row['about_title']); ?></td>
                            <td><?php echo htmlspecialchars($row['about_subtitle']); ?></td>
                            <td><?php echo htmlspecialchars($row['about_description']); ?></td>
                            <td><a href="<?php echo htmlspecialchars($row['resume_link']); ?>" target="_blank">Resume Link</a></td>
                            <td>
                                <?php if (isset($row['home_profile_image']) && !empty($row['home_profile_image'])) { ?>
                                    <img src="<?php echo htmlspecialchars($row['home_profile_image']); ?>" alt="Profile Image" style="max-width: 100px;">
                                <?php } else { ?>
                                    No Image Available
                                <?php } ?>
                            </td>
                            <td>
                                <form action="update_about.php" method="POST" class="d-inline">
                                    <input type="hidden" name="id" value="<?php echo $row['about_id']; ?>">
                                    <button type="submit" name="edit" class="btn btn-primary btn-sm" onclick="return confirm('Are you sure you want to edit this about information?')">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                </form>

                                <form method="POST" class="d-inline">
                                    <input type="hidden" name="id" value="<?php echo $row['about_id']; ?>">
                                    <button type="submit" name="delete" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this about information?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='7'>Error fetching about data.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<!-- About Table ends -->



<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="./bootstrap-5.3.3-dist/js/bootstrap.js"></script>
<!-- Bootsrap JS na nagpapagana ng danger alert natin -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>



<script src="package/dist/sweetalert2.js"></script>

<!-- Pop Up Messages after a succesful transaction starts here --> <script>

document.addEventListener('DOMContentLoaded', function() {
  const params = new URLSearchParams(window.location.search);
  const status = params.get('status');
  if (status) {
    let title, text, icon;
    switch (status) {
      case 'success':
        title = 'Success!';
        text = 'You updated successfully.';
        icon = 'success';
        break;
        case 'login':
        title = 'Login!';
        text = 'You login successfully.';
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
</script> <!-- Pop Up Messages after a succesful transaction ends here -->
</body>
</html>