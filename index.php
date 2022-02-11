<?php require('core/init.php'); ?>

<?php
//Create Topic Object
$topic = new Topic;

//Create User Object
$user = new User;

//Get paginator(page) From URL
$page = (isset($_GET['page'])) ? (int) $_GET['page'] : (int) 1;

if ($page == 1 || $page < 1) {
    $topics_per_page = 4;
    $page_offset_topics = 0;
    $page = 1;
}else{
    $topics_per_page = 4;
    $page_offset_topics = ($page * $topics_per_page) -$topics_per_page;
}

//Get Template
$template = new Template('templates/frontpage.php');


$template->totalTopics = $topic->getTotalTopics();
$template->topicsPerPage = $topics_per_page;
$template->currentPage = $page;

$template->topics = $topic->getAllTopicsWithPagination($page_offset_topics, $topics_per_page);

//Assign Vars
// $template->topics = $topic->getAllTopics();
// $template->totalTopics = $topic->getTotalTopics();
$template->totalCategories = $topic->getTotalCategories();
$template->totalUsers = $user->getTotalUsers();

//Display template
echo $template;





