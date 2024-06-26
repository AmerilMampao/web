<?php
require_once('classes/database.php');
session_start();
$con = new database ();
$footerData = $con->fetchFooterData();
$fetchEducationData = $con->fetchEducationData();
$fetchProjectsData = $con->fetchProjectsData();
$fetchSkillsData = $con->fetchSkillsData();
$fetchHomeData = $con->fetchHomeData(); 
$fetchAboutData = $con->fetchAboutData();

$socialMediaLinks = '<div class="home-sci">';
if (!empty($footerData['linkedin'])) {
    $socialMediaLinks .= '<a href="' . htmlspecialchars($footerData['linkedin']) . '" target="_blank"><i class="bx bxl-linkedin-square"></i></a>';
}
if (!empty($footerData['github'])) {
    $socialMediaLinks .= '<a href="' . htmlspecialchars($footerData['github']) . '" target="_blank"><i class="bx bxl-github"></i></a>';
}
if (!empty($footerData['facebook'])) {
    $socialMediaLinks .= '<a href="' . htmlspecialchars($footerData['facebook']) . '" target="_blank"><i class="bx bxl-facebook"></i></a>';
}
if (!empty($footerData['instagram'])) {
    $socialMediaLinks .= '<a href="' . htmlspecialchars($footerData['instagram']) . '" target="_blank"><i class="bx bxl-instagram"></i></a>';
}
$socialMediaLinks .= '</div>';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio</title>
    <link rel="stylesheet" href="css/style.css">
    <!-- boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- navbar -->
    <header class="header">
        <a href="#" class="logo">Portfolio</a>
        <nav class="navbar">
            <a href="#home" style="--i:1" class="active">Home</a>
            <a href="#about" style="--i:2">About</a>
            <a href="#skills" style="--i:3">Skills</a>
            <a href="#projects" style="--i:4">Projects</a>
            <a href="#experience" style="--i:4">Experience</a>
            <a href="#education" style="--i:4">Education</a>
            <a href="#contact" style="--i:5">Contact</a>
        </nav>
        <!-- navbar -->
    </header>
<!-- home start -->
<section class="home" id="home">
    <div id="particles-js"></div>

    <div class="home-content">
        <?php
        if ($fetchHomeData) {
            foreach ($fetchHomeData as $row) {
                // Extracting and sanitizing data
                $home_profile_image = htmlspecialchars($row['home_profile_image']);
                $home_welcome_message = htmlspecialchars($row['home_welcome_message']);
                $home_title = htmlspecialchars($row['home_title']);
                $home_description = htmlspecialchars($row['home_description']);
                $typing_texts = json_decode($row['typing_texts'], true);

                // Displaying the fetched data
                ?>
                <h3><?php echo $home_welcome_message; ?></h3>
                <h1><?php echo $home_title; ?></h1>
                <h3>And I'm into <span class="text"><?php echo implode(', ', $typing_texts); ?></span></h3>
                <p><br><?php echo $home_description; ?></p></br>
                <img src="<?php echo $home_profile_image; ?>" alt="Profile Picture">

                <!-- Injecting dynamic social media links (assuming $socialMediaLinks is defined elsewhere) -->
                <?php echo $socialMediaLinks; ?>

                <a href="#about" class="btn-box">More About Me<i class="fas fa-arrow-circle-down"></i></a>
                <?php
            }
        } else {
            echo "Failed to fetch home data.";
        }
        ?>
    </div>
</section>
<!-- home end -->

   <!-- about start-->
   <section class="about" id="about">
    <?php
    // Assuming $fetchAboutData is fetched from fetchAboutData() function
    if ($fetchAboutData) {
        foreach ($fetchAboutData as $row) {
            // Extracting data for each 'about' entry
            $about_subtitle = htmlspecialchars($row['about_subtitle']);
            $about_description = htmlspecialchars($row['about_description']);
            $resume_link = htmlspecialchars($row['resume_link']);
    ?>
    <div class="about-img">
        <!-- Assuming $home_profile_image is fetched from the home table and associated via home_id -->
        <img src="<?php echo htmlspecialchars($home_profile_image); ?>" alt="Profile Picture">
    </div>
    <div class="about-text">
        <h2>About <span>Me</span></h2>
        <h4><?php echo $about_subtitle; ?></h4>
        <p><?php echo $about_description; ?></p>
        <a href="<?php echo $resume_link; ?>" target="_blank" class="btn-box">Resume</a>
    </div>
    <?php
        }
    } else {
        echo "No about data available.";
    }
    ?>
</section>
    
<!-- skills start-->
<section>
    <div class="services" id="skills">
        <div class="container">
            <h1 class="sub-title">My <span>Skills</span></h1>
            <div class="skills-list">
                <?php 
                $skills = $fetchSkillsData;
                foreach ($skills as $skill): ?>
                    <div>
                        <i class='<?php echo htmlspecialchars($skill['skills_icon_class']); ?>' style='color:#b75ff3'></i>
                        <h2><?php echo htmlspecialchars($skill['skills_title']); ?></h2>
                        <p><?php echo htmlspecialchars($skill['skills_description']); ?></p>
                        <a href="<?php echo htmlspecialchars($skill['skills_learn_more_link']); ?>" class="read">Learn more</a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- project start-->
<section class="projects" id="projects">
    <div class="container">
        <h1 class="sub-title">My <span>Projects</span></h1>
        <div class="project-list">
            <?php 
            $projects = $fetchProjectsData;
            foreach ($projects as $project): ?>
                <div class="project">
                    <img src="<?php echo htmlspecialchars($project['projects_image_url']); ?>" alt="<?php echo htmlspecialchars($project['projects_title']); ?>">
                    <h2><?php echo htmlspecialchars($project['projects_title']); ?></h2>
                    <p><?php echo htmlspecialchars($project['projects_description']); ?></p>
                    <a href="<?php echo htmlspecialchars($project['projects_url']); ?>" target="_blank" class="read">View</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>



<!-- education section starts -->
<section class="education" id="education">
    <h1 class="sub-title">My <span>Education</span></h1>
    <div class="education-container">
        <?php
        $educations = $con->fetchEducationData();
        if ($educations !== false) {
            foreach ($educations as $education) {
                ?>
                <div class="education-item">
                    <img src="<?php echo $education['education_image']; ?>" alt="<?php echo $education['education_institution']; ?> Image">
                    <div class="education-details">
                        <h3><?php echo $education['education_degree']; ?></h3>
                        <p><?php echo $education['education_institution']; ?></p>
                        <h4><?php echo $education['education_duration']; ?> | <?php echo ucfirst($education['STATUS']); ?></h4>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "Failed to fetch education data.";
        }
        ?>
    </div>
</section>
<!-- education section ends -->
<!-- contact Us section starts -->
<section class="contact" id="contact">
    <h2 class="heading"> Contact <span>Us</span></h2>
  
    <div class="container">
        <div class="content ">
            <div class="image-box">
                <img draggable="false" src="uploads/contactme.jpg" alt="">
            </div>
            <form id="contact-form" action="contact.php" method="post">
                <div class="form-group">
                    <div class="field">
                        <input type="text" name="name" placeholder="Name" required>
                    </div>
                    <div class="field">
                        <input type="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="field">
                        <input type="tel" name="phone" placeholder="Phone" required>
                    </div>
                    <div class="message">
                        <textarea placeholder="Write the Message" name="message" required></textarea>
                    </div>
                </div>
                <div class="button-area">
                    <button type="submit" name="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- contact Us section ends -->

<!-- footer section starts -->
<section class="footer" id="footer">
    <div class="box-container">
        <div class="box">
            <?php
            // Check if data is fetched successfully
            if ($footerData) {
                echo '<h3>' . htmlspecialchars($footerData['title']) . '</h3>';
                echo '<p>Thank you for visiting my personal portfolio website.</p>';
            }
            ?>
        </div>
        <div class="box">
            <h3>To the Top</h3>
            <a href="#home"><i class="fas fa-chevron-circle-right"></i> Home</a>
            <a href="#about"><i class="fas fa-chevron-circle-right"></i> About</a>
            <a href="#skills"><i class="fas fa-chevron-circle-right"></i> Skills</a>
            <a href="#education"><i class="fas fa-chevron-circle-right"></i> Education</a>
            <a href="#projects"><i class="fas fa-chevron-circle-right"></i> Project</a>
            <a href="#experience"><i class="fas fa-chevron-circle-right"></i> Experience</a>
        </div>
        <div class="contact-info-container">
            <div class="box">
            <h3>Contact Info</h3>
            <?php
            // Display contact information if fetched successfully
            if ($footerData) {
                echo '<p><i class="fas fa-phone"></i> ' . htmlspecialchars($footerData['phone']) . '</p>';
                echo '<p><i class="fas fa-envelope"></i> ' . htmlspecialchars($footerData['email']) . '</p>';
                echo '<p><i class="fas fa-map-marked-alt"></i> ' . htmlspecialchars($footerData['address']) . '</p>';
                echo '<div class="share">';
                echo '<a href="' . htmlspecialchars($footerData['linkedin']) . '" target="_blank" aria-label="LinkedIn"><i class="fab fa-linkedin"></i></a>';
                echo '<a href="' . htmlspecialchars($footerData['github']) . '" target="_blank" aria-label="GitHub"><i class="fab fa-github"></i></a>';
                echo '<a href="' . htmlspecialchars($footerData['facebook']) . '" target="_blank" aria-label="Facebook"><i class="fab fa-facebook"></i></a>';
                echo '<a href="' . htmlspecialchars($footerData['instagram']) . '" target="_blank" aria-label="instagram"><i class="fa-brands fa-instagram"></i></a>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</section>
<!-- footer section ends -->

 <!-- scroll to top button -->
 <button id="scrollToTopBtn" title="Go to top"><i class="fas fa-arrow-up"></i></button>
    <!-- Include particles.js and configuration script -->
    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
    <!-- Custom JS for particle config -->
    <script src="js/particle-configure.js"></script>
    <script src="js/particle.min.js"></script>
    <!-- Script of Typed.js initialization -->
    <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>
    <!-- Custom JS for Typed.js initialization -->
    <script src="js/typed-init.js"></script>
    <!-- Custom JS for scroll-to-top button -->
    <script src="js/scrolltop.js"></script>
    <!-- Custom JS for smooth-scroll button -->
    <script src="js/smooth-scroll.js"></script>
</body>
</html>
