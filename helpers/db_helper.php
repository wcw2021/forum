<?php

/*
 *	Get Categories
 */
function getCategories(){
	$db = new Database;
	$db->query('SELECT * FROM categories');
	
	//Assign Result Set
	$results = $db->resultset();

	return $results;
}


/*
 * Get # of Topics
 */
function topicCount(){
	$db = new Database;
	$db->query('SELECT * FROM topics');
	//Assign Rows
	$rows = $db->resultset();
	//Get Count
	return $db->rowCount();
}

/*
 * Get # of Topics per category
 */
function topicCountByCategory($category_id){
	$db = new Database;
	$db->query('SELECT * FROM topics WHERE category_id = :category_id');
	$db->bind(':category_id', $category_id);
	//Assign Rows
	$rows = $db->resultset();
	//Get Count
	return $db->rowCount();
}

/*
 *	Get # of replies per topic
 */
function replyCount($topic_id){
	$db = new Database;
	$db->query('SELECT * FROM replies WHERE topic_id = :topic_id');
	$db->bind(':topic_id', $topic_id);
	//Assign Rows
	$rows = $db->resultset();
	//Get Count
	return $db->rowCount();
}

/*
 *  Get # of User Topics
 */
function userTopicCount($user_id){
	$db = new Database;
	$db->query('SELECT * FROM topics 
				WHERE user_id = :user_id
				');
	$db->bind(':user_id', $user_id);
	//Assign Rows
	$rows = $db->resultset();
	//Get Count
	$topic_count = $db->rowCount();
	return $topic_count;
}

/*
 *  Get # of User Posts
 */
function userPostCount($user_id){
	$db = new Database;
	$db->query('SELECT * FROM topics 
				WHERE user_id = :user_id
				');
	$db->bind(':user_id', $user_id);
	//Assign Rows
	$rows = $db->resultset();
	//Get Count
	$topic_count = $db->rowCount();
	
	$db->query('SELECT * FROM replies
				WHERE user_id = :user_id
				');
	$db->bind(':user_id', $user_id);
	//Assign Rows
	$rows = $db->resultset();
	//Get Count
	$reply_count = $db->rowCount();
	
	return $topic_count + $reply_count;
}





