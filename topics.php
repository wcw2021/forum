<?php require('core/init.php'); ?>

<?php
//Create Topic Object
$topic = new Topic;

//Create User Object
$user = new User;

//Get category From URL
$category_id = (isset($_GET['category'])) ? (int) $_GET['category'] : null;

//Get user From URL
$user_id = (isset($_GET['user'])) ? (int) $_GET['user'] : null;

//Get Template
$template = new Template('templates/topics.php');

//Check For Category Filter
if(isset($category_id)){
	$template->topics = $topic->getByCategory($category_id);
    if( $topic->getCategory($category_id) ){
	    $template->title = 'Topics in "'.$topic->getCategory($category_id)->name.'"';
    }
}

//Check For User Filter
if(isset($user_id)){
	$template->topics = $topic->getByUser($user_id);
    if( $user->getUser($user_id) ){
	    $template->title = 'Topics by "'.$user->getUser($user_id)->username.'"';
    }
}

//Check For Category & User not set Filter
if(!isset($category_id) && !isset($user_id)){
	$template->topics = $topic->getAllTopics();
}

//Assign Vars
$template->totalTopics = $topic->getTotalTopics();
$template->totalCategories = $topic->getTotalCategories();
$template->totalUsers = $user->getTotalUsers();

//Display template
echo $template;




