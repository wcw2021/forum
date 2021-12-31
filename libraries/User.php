<?php 
class User{
	//Init DB Variable
	private $db;
	
	/*
	 *	Constructor
	 */
	public function __construct(){
		$this->db = new Database;
	}

    /*
	 * Register User
	 */
	public function register($data){
        //Insert Query
        $this->db->query('INSERT INTO users (name, email, avatar, username, password, about, last_activity) 
                                        VALUES (:name, :email, :avatar, :username, :password, :about, :last_activity)');
        //Bind Values
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':avatar', $data['avatar']);
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':about', $data['about']);
        $this->db->bind(':last_activity', $data['last_activity']);
        //Execute
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }

    }

    /*
	 * Upload User Avatar
	 */
	public function uploadAvatar(){

        // Restrict the file type
        $mime_types = ['image/gif', 'image/png', 'image/jpeg'];

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime_type = finfo_file($finfo, $_FILES['avatar']['tmp_name']);

        if ( ! in_array($mime_type, $mime_types)) {
            flash('register_message', 'Invalid File Type!', 'alert alert-danger');
            return false;
        }

        // Restrict the file size
        if ($_FILES['avatar']['size'] > 1000000) {
            flash('register_message', 'Max file size is 1MB!', 'alert alert-danger');
            return false;
        }

        // Get info of uploaded file
        $pathinfo = pathinfo($_FILES["avatar"]["name"]);

        $base = $pathinfo['filename'];

        // Replace any characters that aren't letters, numbers, underscores or hyphens with underscore
        $base = preg_replace('/[^a-zA-Z0-9_-]/', '_', $base);

        // Restrict the filename to 200 characters
        $base = mb_substr($base, 0, 200);

        $filename = $base . "." . $pathinfo['extension'];

        $destination = "images/avatars/$filename";

        // Add a numeric suffix to the filename to avoid overwriting existing files
        $i = 1;

        while (file_exists($destination)) {
            $filename = $base . "-$i." . $pathinfo['extension'];
            $destination = "images/avatars/$filename";

            $i++;
        }

        if (move_uploaded_file($_FILES['avatar']['tmp_name'], $destination)) {
            return $filename;
        } else {
            return false;
        }

	}

 
	/*
	 * User Login
	 */
	public function login($username, $password){

        $this->db->query('SELECT * FROM users WHERE name = :user');
        $this->db->bind(':user', $username);

        $row = $this->db->single();

        if($row){    
            $hashed_password = $row->password;
            if(password_verify($password, $hashed_password)){
                session_regenerate_id();
                $this->setUserData($row);
                return $row;
            } else {
                return false;
            }
        }else {
            return false;
        }
	}
	
	/*
	 * Set User Data
	 */
	private function setUserData($row){
		$_SESSION['user_id'] = $row->id;
		$_SESSION['username'] = $row->username;
		$_SESSION['name'] = $row->name;
	}
	
	/*
	 * User Logout
	 */
	public function logout(){
		unset($_SESSION['user_id']);
		unset($_SESSION['username']);
		unset($_SESSION['name']);
        session_destroy();
		return true;
	}
	
    
    /*
	 *  Find user by email to see if email already taken or not
	 */
    public function findUserByEmail($email){
      $this->db->query('SELECT * FROM users WHERE email = :email');
      // Bind value
      $this->db->bind(':email', $email);

      $row = $this->db->single();

      // Check row
      if($this->db->rowCount() > 0){
        return true;
      } else {
        return false;
      }
    }


    /*
	 *  Find user by username to see if username already taken or not
	 */
    public function findUserByUsername($username){
      $this->db->query('SELECT * FROM users WHERE username = :username');
      // Bind value
      $this->db->bind(':username', $username);

      $row = $this->db->single();

      // Check row
      if($this->db->rowCount() > 0){
        return true;
      } else {
        return false;
      }
    }


	/*
	 * Get Total # Of Users
	 */
	public function getTotalUsers(){
		$this->db->query('SELECT * FROM users');
		$rows = $this->db->resultset();
		return $this->db->rowCount();
	}

	/*
	 * Get User By ID
	 */
	public function getUser($user_id){
		$this->db->query("SELECT * FROM users WHERE id = :user_id
		");
		$this->db->bind(':user_id', $user_id);
	
		//Assign Row
		$row = $this->db->single();
	
		return $row;
	}


}





