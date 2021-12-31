<?php require('core/init.php'); ?>

<?php
// Create Topic Object
$topic = new Topic;

// Create User Object
$user = new User;

// Create Validator Object
$validate = new Validator;

// Get Template
$template = new Template('templates/register.php');


// Init data
$data =[
    'name' => '',
    'email' => '',
    'username' => '',
    'about' => ''
];


if(isset($_POST['register'])){

    // Invalie file upload
    if (empty($_FILES)) {    
        redirectWithMessage('register.php', 'Invalid File upload!', 'error');
    }

    // Sanitize POST data
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

	// Reset Init Data Array
	$data['name'] = trim($_POST['name']);
	$data['email'] = trim($_POST['email']);
	$data['username'] = trim($_POST['username']);
	$data['password'] = trim($_POST['password']);
	$data['password2'] = trim($_POST['password2']);
	$data['about'] = $_POST['about'];
	$data['last_activity'] = date("Y-m-d H:i:s");

	// Required Fields
	$field_array = array('name','email','username','password','password2');

	if($validate->isRequired($field_array)){
		if($validate->isValidEmail($data['email'])){
            if(!$user->findUserByEmail($data['email'])){
                if(!$user->findUserByUsername($data['username'])){
                    if($validate->passwordsMatch($data['password'],$data['password2'])){
                        
                        // Hash Password
                        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                        
                        // Upload Avatar Image
                        if ($_FILES['avatar']['name']) {
                            
                            $uploadFile = $user->uploadAvatar();
                            if($uploadFile){
                                $data['avatar'] = $uploadFile;
                                //Register User
                                if($user->register($data)){
                                    redirectWithMessage('index.php', 'You are registered and can now log in', 'success');
                                } else {
                                    flash('register_message', 'Something went wrong with registration', 'alert alert-danger');
                                    $template->data = $data;
                                }
                            }else{
                                flash('register_message', 'Something went wrong with file upload', 'alert alert-danger');
                                $template->data = $data;
                            }
                        }else{
                            $data['avatar'] = 'noimage.png';
                            //Register User
                            if($user->register($data)){
                                redirectWithMessage('index.php', 'You are registered and can now log in', 'success');
                            } else {
                                flash('register_message', 'Something went wrong with registration', 'alert alert-danger');
                                $template->data = $data;
                            }
                        }
                    } else {
                        flash('register_message', 'Your passwords did not match', 'alert alert-danger');
                        $template->data = $data;
                    }
                } else {
                    flash('register_message', 'Username is already taken', 'alert alert-danger');
                    $template->data = $data;
                }    
            } else {
                flash('register_message', 'Email is already taken', 'alert alert-danger');
                $template->data = $data;
            }
		} else {
            flash('register_message', 'Please use a valid email address', 'alert alert-danger');
            $template->data = $data;
		}
	} else {
        flash('register_message', 'Please fill in all required fields', 'alert alert-danger');
        $template->data = $data;
	}
}


// Assign Vars
$template->title = 'Create An Account';
$template->data = $data;


// Display template
echo $template;






