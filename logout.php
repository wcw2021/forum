<?php include('core/init.php'); ?>

<?php
if(isset($_POST['do_logout'])){

    if( !isset($_POST['logout_token']) || $_POST['logout_token'] !== $_SESSION['logout_token'] ){
        // var_dump($_POST, $_SESSION); exit;
        redirectWithMessage('index.php','Please re-submit the form','error');
    }

	//Create User Object
	$user = new User;
	
	if($user->logout()){
		redirectWithMessage('index.php','You are now logged out','success');
	} 
} else {
	redirect('index.php');
}


