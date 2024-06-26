<?php

class database{
  function check($username, $password) {
    // Open database connection
    $con = $this->opencon();

    // Prepare the SQL query
    $query = $con->prepare("SELECT * FROM users WHERE user_name = ?");
    $query->execute([$username]);

    // Fetch the user data as an associative array
    $user = $query->fetch(PDO::FETCH_ASSOC);

    // If a user is found, verify the password
    if ($user && password_verify($password, $user['user_pass'])) {
        return $user;
    }

    // If no user is found or password is incorrect, return false
    return false;
}
    function opencon(){
        return new PDO('mysql:host=localhost; dbname=web', 'root', '');
    }
    function signupUser($firstname, $lastname, $birthday, $sex, $email, $username, $password, $profile_picture_path){
        $con = $this->opencon();
        // Save user data along with profile picture path to the database
        $con->prepare("INSERT INTO users (user_firstname, user_lastname, user_birthday, user_sex, user_email, user_name, user_pass, user_profile_picture) VALUES (?,?,?,?,?,?,?,?)")->execute([$firstname, $lastname, $birthday, $sex, $email, $username, $password, $profile_picture_path]);
        return $con->lastInsertId();
    }

    function insertAddress($user_id, $street, $barangay, $city, $province)
    {
        $con = $this->opencon();
        return $con->prepare("INSERT INTO user_address (user_id, street, barangay, city, province) VALUES (?,?,?,?,?)")->execute([$user_id, $street, $barangay,  $city, $province]);
          
    }
    /*for dashboard user table */
    function view()
    {
        $con = $this->opencon();
        return $con->query("SELECT users.user_id, users.user_firstname, users.user_lastname, users.user_birthday, users.user_sex, 
        users.user_name, users.user_profile_picture, CONCAT(user_address.city,', ', user_address.province) AS address from users INNER JOIN user_address 
        ON users.user_id = user_address.user_id")->fetchAll();
    }
    /*for dashboard contanct info table */
    function letmeviewcontactinfo()
    {
        $con = $this->opencon();
        $query = $con->prepare("SELECT contact_info_id, title, phone, email, address, linkedin, github, facebook, instagram FROM contact_info");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function delete($id) {
    try {
    $con = $this->opencon();
    $con->beginTransaction();

    // Delete user address
    $query = $con->prepare("DELETE FROM user_address WHERE user_id = ?");
    $query->execute([$id]);

    // Delete user
    $query2 = $con->prepare("DELETE FROM users WHERE user_id = ?");
    $query2->execute([$id]);

    // Delete query for the contact_us message
    $query3 = $con->prepare("DELETE FROM contact_us WHERE contact_us_d = ?");
    $query3->execute([$id]);

    // Delete query for the education table
    $query4 = $con->prepare("DELETE FROM education WHERE education_id = ?");
    $query4->execute([$id]);

    
    // Delete query for the projects table
    $query5 = $con->prepare("DELETE FROM projects WHERE projects_id = ?");
    $query5->execute([$id]);

    // Delete query for the skills table
    $query5 = $con->prepare("DELETE FROM skills WHERE skills_id = ?");
    $query5->execute([$id]);


    $con->commit();
    return true; // Deletion successful
} catch (PDOException $e) {
    $con->rollBack();
    return false;
            }  
}
/*for update_user  */
function viewdata($id){
    try {
        $con = $this->opencon();
        $query = $con->prepare("SELECT users.user_id,users.user_firstname, users.user_lastname,users.user_birthday,users.user_sex, 
        users.user_name, users.user_profile_picture, user_address.street,user_address.barangay, user_address.city, user_address.province
        FROM users INNER JOIN user_address ON users.user_id = user_address.user_id WHERE users.user_id= ?");// ? place holder
        $query->execute([$id]);
        return $query->fetch();
    } catch (PDOException $e) {
        return [];
    }
}
/*for update contact info */
function viewcontactInfo($id){
    try{
        $con = $this->opencon();
        $query = $con->prepare("SELECT title, phone, email, address, linkedin, github, facebook, instagram FROM contact_info WHERE contact_info_id=? LIMIT 1");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_ASSOC); // Specify PDO::FETCH_ASSOC to fetch as associative array
    } catch (PDOException $e){
        return []; // Return an empty array or handle the error accordingly
    }
}
/*for update contact info */
function updatecontactInfo($id, $title, $phone, $email, $address, $linkedin, $github, $facebook, $instagram) {
    try {
        $con = $this->opencon();
        $con->beginTransaction();
        $query = $con->prepare("UPDATE contact_info SET title=?, phone=?, email=?, address=?, linkedin=?, github=?, facebook=?, instagram=? WHERE contact_info_id=?");
        $query->execute([$title, $phone, $email, $address, $linkedin, $github, $facebook, $instagram, $id]);
        $con->commit();
        return true;
    } catch (PDOException $e) {
        $con->rollback();
        return false;
    }
}
function updateUser($id, $firstname, $lastname, $birthday, $sex) {
    try {
        $con = $this->opencon();
        $con->beginTransaction();
        $query = $con->prepare("UPDATE users SET user_firstname=?, user_lastname=?, user_birthday=?,user_sex=? WHERE user_id=?");
        $query->execute([$firstname, $lastname, $birthday, $sex, $id]);
        $con->commit();
        return true;
    }  catch (PDOException $e) {
        $con->rollback();
        return false;
 } 
}
         function updateUserAddress($id,$street,$barangay,$city,$province ){
            try {
                $con = $this->opencon();
            $con->beginTransaction();
            $query = $con->prepare("UPDATE user_address SET user_address.street=?, user_address.barangay=?, user_address.city=?, user_address.province=? WHERE user_id=?");
            $query->execute([$street, $barangay, $city, $province, $id]);
            $con->commit();
            
            return true;
            } catch (PDOException $e) {
                $con->rollBack();//handle the exception
                return false;//update failed   
                  }
             }
             /*to display contact_info in footer section */
             function fetchFooterData() {
                try {
                    $con = $this->opencon();
                    $query = $con->query("SELECT title, phone, email, address, linkedin, github, facebook, instagram FROM contact_info LIMIT 1"); // Assuming contact_info is your table storing footer information
                    return $query->fetch(PDO::FETCH_ASSOC);
                } catch (PDOException $e) {
                    return false;
                }
            }
            /*to display the message from Contact US form in dashboard.php */
            function fetchContactUsData() {
                $con = $this->opencon();
                $query = $con->prepare("SELECT * FROM contact_us ORDER BY contact_us_created_at DESC");
                $query->execute();
                return $query->fetchAll(PDO::FETCH_ASSOC);
            }
            /*to fetch all education data*/
            function fetchEducationData() {
                try {
                    $con = $this->opencon();
                    $query = $con->query("SELECT * FROM education");
                    return $query->fetchAll(PDO::FETCH_ASSOC);
                } catch (PDOException $e) {
                    return false;
                }
            }
            /*for education info */
            function viewEducationInfo($id) {
                try {
                    $con = $this->opencon();
                    $query = $con->prepare("SELECT education_image, education_degree, education_institution, education_location, education_duration, status FROM education WHERE education_id=?");
                    $query->execute([$id]);
                    return $query->fetchAll(PDO::FETCH_ASSOC); // Fetch all education details as an associative array
                } catch (PDOException $e) {
                    return []; // Return an empty array or handle the error accordingly
                }
            }
            /*for update_education */
            function updateEducationInfo($id, $education_image, $education_degree, $education_institution, $education_location, $education_duration, $status) {
                try {
                    $con = $this->opencon();
                    $con->beginTransaction();
                    $query = $con->prepare("UPDATE education SET education_image=?, education_degree=?, education_institution=?, education_location=?, education_duration=?, status=? WHERE education_id=?");
                    $query->execute([$education_image, $education_degree, $education_institution, $education_location, $education_duration, $status, $id]);
                    $con->commit();
                    return true;
                } catch (PDOException $e) {
                    $con->rollback();
                    return false;
                }
            }
            function fetchProjectsData() {
                try {
                    $con = $this->opencon();
                    $query = $con->query("SELECT * FROM projects");
                    return $query->fetchAll(PDO::FETCH_ASSOC);
                } catch (PDOException $e) {
                    return false;
                }
            }
            function viewProjectsInfo($id) {
                try {
                    $con = $this->opencon();
                    $query = $con->prepare("SELECT projects_title, projects_description, projects_image_url, projects_url FROM projects WHERE projects_id=?");
                    $query->execute([$id]);
                    return $query->fetch(PDO::FETCH_ASSOC); // Fetch project details as an associative array
                } catch (PDOException $e) {
                    return false; // Return false or handle the error accordingly
                }
            }
            function updateProjectsInfo($id, $projects_title, $projects_description, $projects_image_url, $projects_url) {
                try {
                    $con = $this->opencon();
                    $con->beginTransaction();
                    $query = $con->prepare("UPDATE projects SET projects_title=?, projects_description=?, projects_image_url=?, projects_url=? WHERE projects_id=?");
                    $query->execute([$projects_title, $projects_description, $projects_image_url, $projects_url, $id]);
                    $con->commit();
                    return true;
                } catch (PDOException $e) {
                    $con->rollback();
                    return false; // Return false or handle the error accordingly
                }
            }
            function fetchSkillsData() {
                try {
                    $con = $this->opencon();
                    $query = $con->query("SELECT * FROM skills");
                    return $query->fetchAll(PDO::FETCH_ASSOC);
                } catch (PDOException $e) {
                    return false;
                }
            }
            
            function viewSkillInfo($id) {
                try {
                    $con = $this->opencon();
                    $query = $con->prepare("SELECT skills_icon_class, skills_title, skills_description, skills_learn_more_link FROM skills WHERE skills_id=?");
                    $query->execute([$id]);
                    return $query->fetch(PDO::FETCH_ASSOC); // Fetch skill details as an associative array
                } catch (PDOException $e) {
                    return false; // Return false or handle the error accordingly
                }
            }
            
            function updateSkillInfo($id, $skills_icon_class, $skills_title, $skills_description, $skills_learn_more_link) {
                try {
                    $con = $this->opencon();
                    $con->beginTransaction();
                    $query = $con->prepare("UPDATE skills SET skills_icon_class=?, skills_title=?, skills_description=?, skills_learn_more_link=? WHERE skills_id=?");
                    $query->execute([$skills_icon_class, $skills_title, $skills_description, $skills_learn_more_link, $id]);
                    $con->commit();
                    return true;
                } catch (PDOException $e) {
                    $con->rollback();
                    return false; // Return false or handle the error accordingly
                }
            }
            // fetch typing text
            public function executeQuery($query) {
                try {
                    $con = $this->opencon();
                    return $con->query($query);  // Changed from $this->con to $con
                } catch (PDOException $e) {
                    echo "Error executing query: " . $e->getMessage();
                    return false;
                }
            }
            // fetch typing text
            public function fetchArray($result) {
                try {
                    return $result->fetch(PDO::FETCH_ASSOC);
                } catch (PDOException $e) {
                    echo "Error fetching array: " . $e->getMessage();
                    return false;
                }
            }
            //to display home data
            function fetchHomeData() {
                try {
                    $con = $this->opencon();
                    $query = $con->query("SELECT home.home_id, home.home_profile_image, home.home_welcome_message, home.home_title,
                                          home.home_description, home.typing_texts, contact_info.linkedin, contact_info.github,
                                          contact_info.facebook, contact_info.instagram
                                          FROM home
                                          INNER JOIN contact_info ON home.contact_info_id = contact_info.contact_info_id");
                    return $query->fetchAll(PDO::FETCH_ASSOC);
                } catch (PDOException $e) {
                    return false;
                }
            }
            function viewHomeInfo($id) {
                try {
                    $con = $this->opencon();
                    $query = $con->prepare("SELECT home_profile_image, home_welcome_message, home_title, home_description, typing_texts FROM home WHERE home_id = ?");
                    $query->execute([$id]);
                    return $query->fetchAll(PDO::FETCH_ASSOC);
                } catch (PDOException $e) {
                    return [];
                }
            }
            
            function updateHomeInfo($id, $profile_image, $welcome_message, $home_title, $home_description, $typing_texts) {
                try {
                    $con = $this->opencon();
                    $con->beginTransaction();
                    $query = $con->prepare("UPDATE home SET home_profile_image=?, home_welcome_message=?, home_title=?, home_description=?, typing_texts=? WHERE home_id=?");
                    $query->execute([$profile_image, $welcome_message, $home_title, $home_description, $typing_texts, $id]);
                    $con->commit();
                    return true;
                } catch (PDOException $e) {
                    $con->rollback();
                    return false;
                }
            }
            
            //to display about data
            function fetchAboutData() {
                try {
                    $con = $this->opencon();
                    $query = $con->query("SELECT about.about_id, about.about_title, about.about_subtitle, about.about_description, about.resume_link, home.home_profile_image
                                          FROM about
                                          INNER JOIN home ON about.home_id = home.home_id");
                    return $query->fetchAll(PDO::FETCH_ASSOC);
                } catch (PDOException $e) {
                    return false;
                }
            }
            function viewAboutInfo($id) {
                try {
                    $con = $this->opencon();
                    $query = $con->prepare("
                        SELECT
                            about.about_id,
                            about.about_title,
                            about.about_subtitle,
                            about.about_description,
                            about.resume_link,
                            home.home_profile_image
                        FROM
                            about
                        INNER JOIN
                            home ON about.home_id = home.home_id
                        WHERE
                            about.home_id = ?
                    ");
                    $query->execute([$id]);
                    return $query->fetchAll(PDO::FETCH_ASSOC);
                } catch (PDOException $e) {
                    return [];
                }
            }
            
            function updateAboutInfo($id, $about_title, $about_subtitle, $about_description, $resume_link) {
                try {
                    $con = $this->opencon();
                    $con->beginTransaction();
                    $query = $con->prepare("
                        UPDATE about
                        SET about_title=?, about_subtitle=?, about_description=?, resume_link=?
                        WHERE about_id=?
                    ");
                    $query->execute([$about_title, $about_subtitle, $about_description, $resume_link, $id]);
                    $con->commit();
                    return true;
                } catch (PDOException $e) {
                    $con->rollback();
                    return false;
                }
            }
            
            
        }

