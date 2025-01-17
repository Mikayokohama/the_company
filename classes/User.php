<?php
    require_once "Database.php";

    /**
     * We will this class to place the logic of our app
     * CRUD actions
     */
    class User extends Database{

        public function store($request){
            $first_name = $request['first_name'];
            $last_name = $request['last_name'];
            $username = $request['username'];
            $password = $request['password'];

            # hash the password before inserting into the database
            $password = password_hash($password, PASSWORD_DEFAULT);

            # query string
            # backtick use in table column names ---- not a single qoute
            $sql = "INSERT INTO users(`first_name`, `last_name`, `username`, `password`) values('$first_name', '$last_name', '$username', '$password')";

            # Execute the query string
            if ($this->conn->query($sql)) {
                header('location: ../views'); //go to index or login page
                exit;
            }else {
                die("Error in creating the user: " . $this->conn->error);
            }
        }

        public function login($request){
            
            $username = $request['username'];
            $password = $request['password'];

            # query string
            $sql = "SELECT * FROM users WHERE username = '$username'";
            $result = $this->conn->query($sql);
            # $result = ['id' => 1, 'username' => 'mary', 'password' =>$42y@#109*&*^...]

            # check for the username if it exists
            if ($result->num_rows == 1) {
                #check if the password is correct
                $user = $result->fetch_assoc();
                //$user = ['id' => 1, 'username' => 'mary', 'password' =>$42y@#109*&*^...]

                if (password_verify($password, $user['password'])) {
                    #create session variables for future use
                    session_start();
                    $_SESSION['id']             = $user['id'];
                    $_SESSION['username']       = $user['username'];
                    $_SESSION['full_name']      = $user['first_name'] . " " . $user['last_name'];

                    header('location: ../views/dashboard.php'); //dashboard
                    exit;
                }else {
                    die('Password is incorrect');
                }
            }else {
                die("username not found.");
            }

        }

        public function logout(){
            session_start(); //we start the session
            session_unset(); // unset or make it inactive
            session_destroy(); // delete or removed

            header('location: ../views'); //redirect to the login page
            exit;
        }

        # Get all the lists of users from the users table
        public function getAllUsers(){
            
            $sql = "SELECT id, first_name, last_name, username, photo FROM users";
            
            if ($result = $this->conn->query($sql)) {
                return $result;
            }else {
                die("Error in retrieving all users: " . $this->conn->error);
            }
        }

        # Get details of specific user
        public function getUser($id){
            
            $sql = "SELECT * FROM users WHERE id = $id";

            if ($result = $this->conn->query($sql)) {
                return $result->fetch_assoc();
            }else {
                die('Error in retrieving the user: ' . $this->conn->error);
            }
        }

        public function update($request, $files){
            session_start();
            $id = $_SESSION['id']; //id of the current logged-in user
            $first_name = $request['first_name'];
            $last_name = $request['last_name'];
            $username = $request['username'];
            $photo = $files['photo']['name'];
            #               photo - name of the input field
            #               name - is the name of the uploaded file
            $tmp_photo = $files['photo']['tmp_name'];
            #                  photo - name of the input field
            #                 tmp_name - is the temporary PATH AND LOCATION of the uploaded file

            $sql = "UPDATE users SET first_name = '$first_name', last_name = ' $last_name', username ='$username' WHERE id = $id";

            if ($this->conn->query($sql)) {
                $_SESSION['username'] = $username;
                $_SESSION['full_name'] = "$first_name $last_name";

                # If there is an uploaded photo, save it to the db and save the file to the image folder
                if ($photo) {
                    $sql = "UPDATE users SET photo = '$photo' WHERE id = $id";
                    $destination = "../assets/images/$photo";

                    # Save the image name to the db
                    if ($this->conn->query($sql)) {
                        # save the image file to the images folder
                        if (move_uploaded_file($tmp_photo, $destination)) {
                            header('location: ../views/dashboard.php');
                            exit;
                        }else {
                            die("Error in moving the photo.");
                        }
                    }else {
                        die("Error in uploading the photo." . $this->conn->error);
                    }
                }
                header('location: ../views/dashboard.php');
                exit;
            }else {
                die("Error updating the user. " . $this->conn->error);
            }
        }

        

    }