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

//Get search filter From URL
$search = (isset($_GET['search'])) ? $_GET['search'] : '';
$search = htmlspecialchars($search);

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
$template = new Template('templates/topics.php');

//Check For Category Filter
    // if(isset($category_id)){
    //     $template->topics = $topic->getByCategory($category_id);
    //     if( $topic->getCategory($category_id) ){
    //         $template->title = 'Topics in "'.$topic->getCategory($category_id)->name.'"';
    //     }
    // }
if(isset($category_id)){
    $template->totalTopics = $topic->getTotalTopicsByCategory($category_id);
    $template->topicsPerPage = $topics_per_page;
    $template->currentPage = $page;
    $template->category_id = $category_id;

    $template->topics = $topic->getByCategoryWithPagination($category_id, $page_offset_topics, $topics_per_page);
    
    if( $topic->getCategory($category_id) ){
        $template->title = 'Topics in "'.$topic->getCategory($category_id)->name.'"';
    }
}

//Check For User Filter
if(isset($user_id)){
    $template->totalTopics = $topic->getTotalTopicsByUser($user_id);
    $template->topicsPerPage = $topics_per_page;
    $template->currentPage = $page;
    $template->user_id = $user_id;

    $template->topics = $topic->getByUserWithPagination($user_id,$page_offset_topics, $topics_per_page);

    if( $user->getUser($user_id) ){
	    $template->title = 'Topics by "'.$user->getUser($user_id)->username.'"';
    }
}

//Check For Search Filter
if(!empty($search)){
    $template->totalTopics = $topic->getTotalTopicsBySearch($search);
    $template->topicsPerPage = $topics_per_page;
    $template->currentPage = $page;
    $template->search = $search;

    $template->topics = $topic->getBySearchWithPagination($search,$page_offset_topics, $topics_per_page);
    $template->title = "Search for: $search";
}

//Check For Category & User & Search not set Filter
if(!isset($category_id) && !isset($user_id) && empty($search)){
    $template->totalTopics = $topic->getTotalTopics();
    $template->topicsPerPage = $topics_per_page;
    $template->currentPage = $page;
    $template->topics = $topic->getAllTopicsWithPagination($page_offset_topics, $topics_per_page);
}

//Assign Vars
$template->totalCategories = $topic->getTotalCategories();
$template->totalUsers = $user->getTotalUsers();

//Display template
echo $template;




