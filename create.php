<?php require('core/init.php'); ?>
 
<?php

// check if login or not
if(!isLoggedIn()){
    redirect('index.php');
}

// Create Topic Object
$topic = new Topic;

// Get Template
$template = new Template('templates/create.php');

// Init data
$data =[
    'title' => '',
    'body' => '',
];


if(isset($_POST['do_create'])){
	// Create Validator Object
	$validate = new Validator;

    // Sanitize POST data
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

	// Reset Init Data Array
	$data['title'] = $_POST['title'];
	$data['body'] = $_POST['body'];
	$data['category_id'] = $_POST['category'];
	$data['user_id'] = getUserInfo()['user_id'];
	$data['last_activity'] = date("Y-m-d H:i:s");
	
	// Required Fields
	$field_array = array('title', 'body', 'category');
	
	if($validate->isRequired($field_array)){
		//Register User
		if($topic->create($data)){
			redirectWithMessage('index.php', 'Your topic has been posted', 'success');
		} else {
			// redirectWithMessage('topic.php?id='.$topic_id, 'Something went wrong with your post', 'error');
            flash('topic_message', 'Something went wrong with create post', 'alert alert-danger');
            $template->data = $data;
		}
	} else {
        flash('topic_message', 'Please fill in all required fields', 'alert alert-danger');
        $template->data = $data;
	}
}



// Assign Vars
$template->title = 'Create An Topic';
$template->data = $data;

// Display template
echo $template;



