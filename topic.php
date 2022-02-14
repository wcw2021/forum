<?php require('core/init.php'); ?>

<?php
//Create Topic Object
$topic = new Topic;

//Get ID From URL
$topic_id = (isset($_GET['id'])) ? (int) $_GET['id'] : null;

//Process Reply
if(isset($_POST['do_reply'])){

    if( !isset($_POST['reply_topic_token']) || $_POST['reply_topic_token'] !== $_SESSION['reply_topic_token']){
        // var_dump($_POST, $_SESSION); exit;
        redirectWithMessage('topic.php','Please re-submit the form','error');
    }

    // Sanitize POST data
    // $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

	//Create Data Array
	$data = array();
	$data['topic_id'] = $topic_id;
	$data['body'] = $_POST['body'];
	$data['user_id'] = getUserInfo()['user_id'];
    $data['last_activity'] = date("Y-m-d H:i:s");

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

if(isset($_POST['del_id'])){

    if( !isset($_POST['delete_topic_token']) || $_POST['delete_topic_token'] !== $_SESSION['delete_topic_token']){
        // var_dump($_POST, $_SESSION); exit;
        redirectWithMessage('topic.php','Please re-submit the form','error');
    }

	$del_id = $_POST['del_id'];
	if($topic->delete($del_id)){
		redirectWithMessage('index.php', 'Topic Deleted', 'success');
	} else {
		redirectWithMessage('index.php', 'Topic Not Deleted', 'error');
	}
}

//Get Template
$template = new Template('templates/topic.php');

//Assign Vars
$template->topic = $topic->getTopic($topic_id);
$template->replies = $topic->getReplies($topic_id);

if( $topic->getTopic($topic_id) ){
	$template->title = $topic->getTopic($topic_id)->title;
	$template->subtitle = "<small>Original Post: " . $topic->getTopic($topic_id)->create_date . "</small>";
}

//Display template
echo $template;




