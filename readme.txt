<!-- footer section starts -->
<section class="footer" id="footer">
    <div class="box-container">
        <div class="box">
            <h3> My Portfolio</h3>
            <p>Thank you for visiting my personal portfolio website.</p>
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
        <div class="box">
            <h3>Contact Info</h3>
            <p><i class="fas fa-phone"></i> +63 XXX-XXX-XXXX</p>
            <p><i class="fas fa-envelope"></i> amerilmampao@gmail.com</p>
            <p><i class="fas fa-map-marked-alt"></i> Tanauan City, Batangas, Philippines, 4232</p>
            <div class="share">
                <a href="https://www.linkedin.com/in/ameril-mu-menin-mampao-04740a314/" target="_blank" aria-label="LinkedIn"><i class="fab fa-linkedin"></i></a>
                <a href="https://github.com/AmerilMampao" target="_blank" aria-label="GitHub"><i class="fab fa-github"></i></a>
                <a href="https://www.facebook.com/profile.php?id=100083115511418" target="_blank" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
                <a href="mailto:amerilmampao@gmail.com" target="_blank" aria-label="Mail"><i class="fas fa-envelope"></i></a>
            </div>
        </div>
    </div>
</section>
<!-- footer section ends -->

----Create Contact_Info Table
CREATE TABLE contact_info (
    contact_info_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    email VARCHAR(100) NOT NULL,
    address VARCHAR(255) NOT NULL,
    linkedin VARCHAR(255) NOT NULL,
    github VARCHAR(255) NOT NULL,
    facebook VARCHAR(255) NOT NULL,
    instagram VARCHAR(255) NOT NULL
)
--- Populate contact_info
INSERT INTO contact_info(
    title,
    phone,
    email,
    address,
    linkedin,
    github,
    facebook,
    instagram
)
VALUES(
    'My Portfolio',
    '+63 XXX-XXX-XXXX',
    'amerilmampao@gmail.com',
    'Tanauan City, Batangas, Philippines, 4232',
    'https://www.linkedin.com/in/ameril-mu-menin-mampao-04740a314/',
    'https://github.com/AmerilMampao',
    'https://www.facebook.com/profile.php?id=100083115511418',
    'https://www.instagram.com/ame.mampao/'
);
------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
-- Create contact_us table
CREATE TABLE contact_us (
    contact_us_d INT AUTO_INCREMENT PRIMARY KEY,
    contact_us_name VARCHAR(100) NOT NULL,
    contact_us_email VARCHAR(100) NOT NULL,
    contact_us_phone VARCHAR(20) NOT NULL,
    contact_us_message TEXT NOT NULL,
    contact_us_created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
-- Populate contact_us table
INSERT INTO contact_us (contact_us_name, contact_us_email, contact_us_phone, contact_us_message) VALUES (:name, :email, :phone, :message);


/ checking whats wrong during queries/
 var_dump($_POST['id']);
------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
   <!-- project start-->
    <section class="projects" id="projects">
        <div class="container">
            <h1 class="sub-title">My <span>Projects</span></h1>
            <div class="project-list">
                <div class="project">
                    <img src="uploads/Home Section.jpg" alt="Project 1">
                    <h2>Project Title 1</h2>
                    <p>Brief description of the project. Highlight key features or technologies used.</p>
                    <a href="https://amerilmampao.github.io/html-css-js-portforlio/" target="_blank"class="read">view</a>
                </div>
                <div class="project">
                    <img src="uploads/about me section.jpg" alt="Project 2">
                    <h2>Project Title 2</h2>
                    <p>Brief description of the project. Highlight key features or technologies used.</p>
                    <a href="https://amerilmampao.github.io/html-css-js-portforlio/" target="_blank"class="read">view</a>
                </div>
                <div class="project">
                    <img src="uploads/footer section.jpg" alt="Project 3">
                    <h2>Project Title 3</h2>
                    <p>Brief description of the project. Highlight key features or technologies used.</p>
                    <a href="https://amerilmampao.github.io/html-css-js-portforlio/" target="_blank"class="read">view</a>
                </div>
            </div>
        </div>
    </section>
    <!-- experience start-->
    <section class="experience" id="experience">
        <div class="container">
            <h1 class="sub-title">My <span>Experience</span></h1>
            <div class="experience-list">
                <div class="experience-item">
                    <h2>Job Title 1</h2>
                    <h4>Company Name</h4>
                    <p>Describe your responsibilities and achievements in this role.</p>
                    <!-- Add more details as needed -->
                </div>
                <div class="experience-item">
                    <h2>Job Title 2</h2>
                    <h4>Company Name</h4>
                    <p>Describe your responsibilities and achievements in this role.</p>
                    <!-- Add more details as needed -->
                </div>
                <!-- Add more experience items as necessary -->
            </div>
        </div>
    </section>

    <!-- education section starts -->
    <section class="education" id="education">
        <h1 class="sub-title">My <span>Education</span></h1>
        <div class="education-container">
            <div class="education-item">
                <img src="uploads/nu-lipa-hero.jpg" alt="University Image">
                <div class="education-details">
                    <h3>Bachelor of Science in Computer Science (BSCS-MLA)</h3>
                    <p>National University Lipa</p>
                    <h4>2022-2026 | Pursuing</h4>
                </div>
            </div>
            <div class="education-item">
                <img src="uploads/DMMCIHS.jpg" alt="College Image">
                <div class="education-details">
                    <h3>Diploma in Science, Technology, Engineering, and Mathematics | STEM</h3>
                    <p>DMMC Institute of Health Sciences | DMCCIHS</p>
                    <h4>2018-2019 | Completed</h4>
                </div>
            </div>
        </div>
    </section>
    <!-- education section ends -->

-- Create education table
CREATE TABLE education (
    education_id INT AUTO_INCREMENT PRIMARY KEY,
    education_image VARCHAR(255),
    education_degree VARCHAR(255) NOT NULL,
    education_institution VARCHAR(255) NOT NULL,
    education_location VARCHAR(255),
    education_duration VARCHAR(50),
    STATUS ENUM('Pursuing', 'Completed') 
);
    -- Populate education table
    INSERT INTO education(
    education_image,
    education_degree,
    education_institution,
    education_location,
    education_duration,
STATUS
)
VALUES(
    'uploads/nu-lipa-hero.jpg',
    'Bachelor of Science in Computer Science (BSCS-MLA)',
    'National University Lipa',
    'Lipa',
    '2022-2026',
    'Pursuing'
),(
    'uploads/DMMCIHS.jpg',
    'Diploma in Science, Technology, Engineering, and Mathematics | STEM',
    'DMMC Institute of Health Sciences | DMCCIHS',
    'Tanauan',
    '2018-2019',
    'Completed'
);
------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    <!-- project start-->
    <section class="projects" id="projects">
        <div class="container">
            <h1 class="sub-title">My <span>Projects</span></h1>
            <div class="project-list">
                <div class="project">
                    <img src="uploads/Home Section.jpg" alt="Project 1">
                    <h2>Project Title 1</h2>
                    <p>Brief description of the project. Highlight key features or technologies used.</p>
                    <a href="https://amerilmampao.github.io/html-css-js-portforlio/" target="_blank"class="read">view</a>
                </div>
                <div class="project">
                    <img src="uploads/about me section.jpg" alt="Project 2">
                    <h2>Project Title 2</h2>
                    <p>Brief description of the project. Highlight key features or technologies used.</p>
                    <a href="https://amerilmampao.github.io/html-css-js-portforlio/" target="_blank"class="read">view</a>
                </div>
                <div class="project">
                    <img src="uploads/footer section.jpg" alt="Project 3">
                    <h2>Project Title 3</h2>
                    <p>Brief description of the project. Highlight key features or technologies used.</p>
                    <a href="https://amerilmampao.github.io/html-css-js-portforlio/" target="_blank"class="read">view</a>
                </div>
            </div>
        </div>
    </section>

-- Create Project Table
CREATE TABLE projects (
    projects_id INT AUTO_INCREMENT PRIMARY KEY,
    projects_title VARCHAR(255) NOT NULL,
    projects_description TEXT,
    projects_image_url VARCHAR(255),
    projects_url VARCHAR(255)
);
-- Populate Project Table
INSERT INTO projects(
    projects_title,
    projects_description,
    projects_image_url,
    projects_url
)
VALUES(
    'Project Title 1',
    'Brief description of the project. Highlight key features or technologies used.',
    'uploads/Home Section.jpg',
    'https://amerilmampao.github.io/html-css-js-portforlio/'
),(
    'Project Title 2',
    'Brief description of the project. Highlight key features or technologies used.',
    'uploads/about me section.jpg',
    'https://amerilmampao.github.io/html-css-js-portforlio/'
),(
    'Project Title 3',
    'Brief description of the project. Highlight key features or technologies used.',
    'uploads/footer section.jpg',
    'https://amerilmampao.github.io/html-css-js-portforlio/'
);
------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
<!-- skills start-->
    <section>
        <div class="services" id="skills">
            <div class="container">
                <h1 class="sub-title">My <span>Skills</span></h1>
                <div class="skills-list">
                  <div>
                    <i class='bx bx-code' style='color:#b75ff3'  ></i>
                        <h2>UI/UX Design</h2>
                        <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus, commodi officia quaerat beatae repellat velit libero exercitationem ipsam accusamus perferendis adipisci quisquam accusantium nostrum laborum at, nihil soluta porro ad!
                        Totam officia distinctio quia illum. Culpa voluptate inventore quam soluta mollitia iure doloribus suscipit sed, ratione eum, incidunt sequi vitae neque fugit, perspiciatis esse impedit excepturi error tempora libero perferendis!
                        </p>
                        <a href="#" class="read">Learn more</a>
                </div>
                <div>
                    <i class='bx bx-crop' style='color:#b75ff3'  ></i>
                        <h2>UI/UX Design</h2>
                        <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus, commodi officia quaerat beatae repellat velit libero exercitationem ipsam accusamus perferendis adipisci quisquam accusantium nostrum laborum at, nihil soluta porro ad!
                        Totam officia distinctio quia illum. Culpa voluptate inventore quam soluta mollitia iure doloribus suscipit sed, ratione eum, incidunt sequi vitae neque fugit, perspiciatis esse impedit excepturi error tempora libero perferendis!
                        </p>
                        <a href="#" class="read">Learn more</a>
                </div>
                <div>
                    <i class='bx bxl-apple' style='color:#b75ff3' ></i>
                        <h2>UI/UX Design</h2>
                        <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus, commodi officia quaerat beatae repellat velit libero exercitationem ipsam accusamus perferendis adipisci quisquam accusantium nostrum laborum at, nihil soluta porro ad!
                        Totam officia distinctio quia illum. Culpa voluptate inventore quam soluta mollitia iure doloribus suscipit sed, ratione eum, incidunt sequi vitae neque fugit, perspiciatis esse impedit excepturi error tempora libero perferendis!
                        </p>
                        <a href="#" class="read">Learn more</a>
                </div>
            </div>
        </div>
    </div>
    </section>
--Create Skills table
CREATE TABLE skills(
    skills_id INT AUTO_INCREMENT PRIMARY KEY,
    skills_icon_class VARCHAR(255) NOT NULL,
    skills_title VARCHAR(255) NOT NULL,
    skills_description TEXT NOT NULL,
    skills_learn_more_link VARCHAR(255) NOT NULL
);
--Populate Skills Table
INSERT
INTO skills(
    skills_icon_class,
    skills_title,
    skills_description,
    skills_learn_more_link
)
VALUES(
    'bx bx-code',
    'UI/UX Design',
    'Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus, commodi officia quaerat beatae repellat velit libero exercitationem ipsam accusamus perferendis adipisci quisquam accusantium nostrum laborum at, nihil soluta porro ad! Totam officia distinctio quia illum. Culpa voluptate inventore quam soluta mollitia iure doloribus suscipit sed, ratione eum, incidunt sequi vitae neque fugit, perspiciatis esse impedit excepturi error tempora libero perferendis!',
    'https://dribbble.com/tags/ui-ux-design'
),(
    'bx bx-crop',
    'UI/UX Design',
    'Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus, commodi officia quaerat beatae repellat velit libero exercitationem ipsam accusamus perferendis adipisci quisquam accusantium nostrum laborum at, nihil soluta porro ad! Totam officia distinctio quia illum. Culpa voluptate inventore quam soluta mollitia iure doloribus suscipit sed, ratione eum, incidunt sequi vitae neque fugit, perspiciatis esse impedit excepturi error tempora libero perferendis!',
    'https://dribbble.com/tags/ui-ux-design'
),(
    'bx bxl-apple',
    'UI/UX Design',
    'Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus, commodi officia quaerat beatae repellat velit libero exercitationem ipsam accusamus perferendis adipisci quisquam accusantium nostrum laborum at, nihil soluta porro ad! Totam officia distinctio quia illum. Culpa voluptate inventore quam soluta mollitia iure doloribus suscipit sed, ratione eum, incidunt sequi vitae neque fugit, perspiciatis esse impedit excepturi error tempora libero perferendis!',
    'https://dribbble.com/tags/ui-ux-design'
);
------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
   <!-- about start-->
    <section class="about" id="about">
        <div class="about-img">
            <img src="uploads/profile pic.jpg" alt="">
        </div>
        <div class="about-text">
            <h2>About <span>Me</span></h2>
            <h4>A student</h4>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. 
               Reiciendis, quo dolore commodi in exercitationem quasi aliquid autem ullam ipsam soluta maiores cupiditate culpa explicabo 
               recusandae perspiciatis ad esse? Doloribus, cumque.
            </p>
            <a href="https://drive.google.com/file/d/1oUF3I13YgRFClYQT2JnAQfH65xTgNvax/view" target="_blank" class="btn-box">Resume</a>
        </div>
    </section>

--Create About Table
CREATE TABLE about (
    about_id INT(11) PRIMARY KEY AUTO_INCREMENT,
    about_title VARCHAR(255) NOT NULL,
    about_subtitle VARCHAR(255) NOT NULL,
    about_description TEXT NOT NULL,
    resume_link VARCHAR(255) NOT NULL
    home_id INT,
FOREIGN KEY (home_id) REFERENCES contact_info(home_id)
);
--Populate About Table
INSERT INTO about(
    about_title,
    about_subtitle,
    about_description,
    resume_link,
    home_id
)
VALUES(
    'About Me',
    'A student',
    'Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis, quo dolore commodi in exercitationem quasi aliquid autem ullam ipsam soluta maiores cupiditate culpa explicabo recusandae perspiciatis ad esse? Doloribus, cumque.',
    'https://drive.google.com/file/d/1oUF3I13YgRFClYQT2JnAQfH65xTgNvax/view','1'
);

------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    <!-- home start -->
    <section class="home" id="home">
        <div id="particles-js"></div>

        <div class="home-content">
            <h3>Welcome, It's Me</h3>
            <h1>Ameril Mampao</h1>
            <h3>And I'm into <span class="text"></span></h3>
            <p><br>Willing to learn how to create websites, Frontend design, 
                and much more...</p></br>
                <!-- Placeholder <img> tag for profile picture -->
                <img src="uploads/profile pic.jpg" alt="Profile Picture">
        <div class="home-sci">
            <a href="https://www.facebook.com/profile.php?id=100083115511418"target="_blank"><i class='bx bxl-facebook'></i></a>
            <a href="https://www.instagram.com/ame.mampao/"target="_blank"><i class='bx bxl-instagram' ></i></a>
            <a href="https://www.linkedin.com/in/ameril-mu-menin-mampao-04740a314/"target="_blank"><i class='bx bxl-linkedin-square' ></i></a>
            <a href="https://github.com/AmerilMampao"target="_blank"><i class='bx bxl-github'></i></a>
        </div>
        <a href="" class="btn-box">More About Me</a>

       </div>
    </section>
   <!-- home end-->
   <!-- about start-->

- Create Home Table
CREATE TABLE home (
    home_id INT(11) PRIMARY KEY AUTO_INCREMENT,
    home_profile_image VARCHAR(255) NOT NULL,
    home_welcome_message VARCHAR(255) NOT NULL,
    home_title VARCHAR(255) NOT NULL,
    home_description VARCHAR(255) NOT NULL,
    typing_texts JSON NOT NULL,
    contact_info_id INT,
    FOREIGN KEY (contact_info_id) REFERENCES contact_info(contact_info_id)
);
--Populate Home Table
INSERT INTO home(
    home_profile_image,
    home_welcome_message,
    home_title,
    home_description,
    typing_texts,
    contact_info_id
)
VALUES(
    'uploads/profile_pic.jpg',
    'Welcome to my website!',
    'Ameril Mampao',
    'I am passionate about creating websites and frontend design.',
    '["Web Development", "Frontend Design", "User Experience"]',
    1
);
------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
-- Create the users table
CREATE TABLE users (
    user_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    user_firstname VARCHAR(255) NOT NULL,
    user_lastname VARCHAR(255) NOT NULL,
    user_birthday DATE NOT NULL,
    user_sex VARCHAR(255) NOT NULL,
    user_email VARCHAR(255) NOT NULL,
    user_name VARCHAR(255),
    user_pass VARCHAR(255),
    user_profile_picture VARCHAR(255) NOT NULL
);

-- Create the user_address table
CREATE TABLE user_address (
    address_id INT(11) AUTO_INCREMENT PRIMARY KEY,
    user_id INT(11),
    street VARCHAR(255) NOT NULL,
    barangay VARCHAR(255) NOT NULL,
    city VARCHAR(255),
    province VARCHAR(255),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);