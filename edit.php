<?php require('core/init.php'); ?>
 
<?php

// Check if login or not
if(!isLoggedIn()){
    redirect('index.php');
}

// Create Topic Object
$topic = new Topic;

// Get ID From URL
$topic_id = (isset($_GET['id'])) ? $_GET['id'] : null;

// Check for owner
if($topic->getTopic($topic_id)->user_id != $_SESSION['user_id']){
    redirect('index.php');
}

// Get Template
$template = new Template('templates/edit.php');


if(isset($_POST['do_edit'])){

    if( !isset($_POST['edit_topic_token']) || $_POST['edit_topic_token'] !== $_SESSION['edit_topic_token']){
        // var_dump($_POST, $_SESSION); exit;
        redirectWithMessage('index.php','Please re-submit the form','error');
    }
    
	// Create Validator Object
	$validate = new Validator;

    // Sanitize POST data
    // $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    //Create Data Array
	$data = array();
	$data['topic_id'] = $topic_id;
	$data['title'] = $_POST['title'];
	$data['body'] = $_POST['body'];
	$data['category_id'] = $_POST['category'];
	$data['last_activity'] = date("Y-m-d H:i:s");
	
	// Required Fields
	$field_array = array('title', 'body', 'category');
	
	if($validate->isRequired($field_array)){
		//Register User
		if($topic->update($data)){
			redirectWithMessage("topic.php?id=$topic_id", 'Your topic has been updated', 'success');
		} else {
			// redirectWithMessage('topic.php?id='.$topic_id, 'Something went wrong with your post', 'error');
            flash('topic_message', 'Something went wrong with update post', 'alert alert-danger');
		}
	} else {
        flash('topic_message', 'Please fill in all required fields', 'alert alert-danger');
	}
}



// Assign Vars
$template->topic = $topic->getTopic($topic_id);
$template->title = 'Edit Topic';


// Display template
echo $template;



