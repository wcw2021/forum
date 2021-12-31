<?php require('core/init.php'); ?>

<?php
//Create Topic Object
$topic = new Topic;

//Get ID From URL
$topic_id = (isset($_GET['id'])) ? (int) $_GET['id'] : null;

//Process Reply
if(isset($_POST['do_reply'])){

    // Sanitize POST data
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

	//Create Data Array
	$data = array();
	$data['topic_id'] = $topic_id;
	$data['body'] = $_POST['body'];
	$data['user_id'] = getUserInfo()['user_id'];

	//Create Validator Object
	$validate = new Validator;
	
	//Required Fields
	$field_array = array('body');
	
	if($validate->isRequired($field_array)){
		//Register User
		if($topic->reply($data)){
			redirectWithMessage('topic.php?id='.$topic_id, 'Your reply has been posted', 'success');
		} else {
			redirectWithMessage('topic.php?id='.$topic_id, 'Something went wrong with your reply', 'error');
		}
	} else {
		redirectWithMessage('topic.php?id='.$topic_id, 'Your reply form is blank!', 'error');
	}
}

//Get Template
$template = new Template('templates/topic.php');

//Assign Vars
$template->topic = $topic->getTopic($topic_id);
$template->replies = $topic->getReplies($topic_id);

if( $topic->getTopic($topic_id) ){
	$template->title = $topic->getTopic($topic_id)->title;
}

//Display template
echo $template;




