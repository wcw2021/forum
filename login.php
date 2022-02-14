<?php include('core/init.php'); ?>

<?php
	if(isset($_POST['do_login'])){

        if( !isset($_POST['login_token']) || $_POST['login_token'] !== $_SESSION['login_token']){
            // var_dump($_POST, $_SESSION); exit;
            redirectWithMessage('index.php','Please re-submit the form','error');
        }

        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

		$data =[
          'username' => trim($_POST['username']),
          'password' => trim($_POST['password']),
        ];
		//Create User Object
		$user = new User;
		
		if($user->login($data['username'], $data['password'])){
			redirectWithMessage('index.php','You have been logged in','success');
		} else {
			redirectWithMessage('index.php','That login is not valid','error');
		}
	} else {
		redirect('index.php');
	}


     