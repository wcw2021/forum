<?php
class Topic{
	//Init DB Variable
	private $db; 
	
	/*
	 *	Constructor
	 */
	public function __construct(){
		$this->db = new Database;
	}
	 
	/*
	 *	Get All Topics
	 */
    public function getAllTopics(){
        $this->db->query("SELECT topics.*, users.username, users.avatar, categories.name FROM topics
                        INNER JOIN users
                        ON topics.user_id = users.id
                        INNER JOIN categories
                        ON topics.category_id = categories.id
                        ORDER BY create_date DESC
                        ");
        //Assign Result Set
        $results = $this->db->resultset();
		
		return $results;
	}

    /*
	 * Get All Topics with Pagination
	 */
	public function getAllTopicsWithPagination($page_offset_topics=0, $topics_per_page=3){
		$this->db->query("SELECT topics.*, categories.name, users.username, users.avatar FROM topics
						INNER JOIN categories
						ON topics.category_id = categories.id
						INNER JOIN users
						ON topics.user_id=users.id
                        ORDER BY create_date DESC
                        LIMIT $page_offset_topics, $topics_per_page		
		");
	
		//Assign Result Set
		$results = $this->db->resultset();
		
		return $results;
	}
	  
	/*
	 * Get Topics By Category
	 */
	public function getByCategory($category_id){
		$this->db->query("SELECT topics.*, categories.name, users.username, users.avatar FROM topics
						INNER JOIN categories
						ON topics.category_id = categories.id
						INNER JOIN users
						ON topics.user_id=users.id
						WHERE topics.category_id = :category_id	
                        ORDER BY create_date DESC		
		");
		$this->db->bind(':category_id', $category_id);
	
		//Assign Result Set
		$results = $this->db->resultset();
		
		return $results;
	}

    /*
	 * Get Topics By Category With Pagination
	 */
	public function getByCategoryWithPagination($category_id, $page_offset_topics=0, $topics_per_page=3){
		$this->db->query("SELECT topics.*, categories.name, users.username, users.avatar FROM topics
						INNER JOIN categories
						ON topics.category_id = categories.id
						INNER JOIN users
						ON topics.user_id=users.id
						WHERE topics.category_id = :category_id	
                        ORDER BY create_date DESC
                        LIMIT $page_offset_topics, $topics_per_page			
		");
		$this->db->bind(':category_id', $category_id);
	
		//Assign Result Set
		$results = $this->db->resultset();
		
		return $results;
	}
	
	/*
	 * Get Topics By Username
	 */
	public function getByUser($user_id){
		$this->db->query("SELECT topics.*, categories.name, users.username, users.avatar FROM topics
						INNER JOIN categories
						ON topics.category_id = categories.id
						INNER JOIN users
						ON topics.user_id=users.id
						WHERE topics.user_id = :user_id
                        ORDER BY create_date DESC
		");
		$this->db->bind(':user_id', $user_id);
	
		//Assign Result Set
		$results = $this->db->resultset();
	
		return $results;
	}

    /*
	 * Get Topics By Username With Pagination
	 */
	public function getByUserWithPagination($user_id, $page_offset_topics=0, $topics_per_page=3){
		$this->db->query("SELECT topics.*, categories.name, users.username, users.avatar FROM topics
						INNER JOIN categories
						ON topics.category_id = categories.id
						INNER JOIN users
						ON topics.user_id=users.id
						WHERE topics.user_id = :user_id
                        ORDER BY create_date DESC
                        LIMIT $page_offset_topics, $topics_per_page	
		");
		$this->db->bind(':user_id', $user_id);
	
		//Assign Result Set
		$results = $this->db->resultset();
	
		return $results;
	}

    /*
	 * Get Topics By Search filter
	 */
	public function getBySearch($search){

        $pattern = '%' . $search . '%';

		$this->db->query("SELECT topics.*, categories.name, users.username, users.avatar FROM topics
                        INNER JOIN categories
                        ON topics.category_id = categories.id
                        INNER JOIN users
                        ON topics.user_id=users.id
                        WHERE topics.title LIKE :pattern OR topics.body LIKE :pattern
                        ORDER BY create_date DESC 
        ");
        $this->db->bind(':pattern', $pattern);
		
		//Assign Result Set
		$results = $this->db->resultset();

		return $results;
	}

    /*
	 * Get Topics By Search filter With Pagination
	 */
	public function getBySearchWithPagination($search, $page_offset_topics=0, $topics_per_page=3){

        $pattern = '%' . $search . '%';

		$this->db->query("SELECT topics.*, categories.name, users.username, users.avatar FROM topics
                        INNER JOIN categories
                        ON topics.category_id = categories.id
                        INNER JOIN users
                        ON topics.user_id=users.id
                        WHERE topics.title LIKE :pattern OR topics.body LIKE :pattern
                        ORDER BY create_date DESC 
                        LIMIT $page_offset_topics, $topics_per_page	
		");
		$this->db->bind(':pattern', $pattern);
		
		//Assign Result Set
		$results = $this->db->resultset();

		return $results;
	}
	  
	/*
	 * Get Total # of Topics
	 */
	public function getTotalTopics(){
		$this->db->query('SELECT * FROM topics');
		$rows = $this->db->resultset();
		return $this->db->rowCount();
	}

    /*
	 * Get Total # of Topics By Category filter
	 */
	public function getTotalTopicsByCategory($category_id){
		$this->db->query("SELECT * FROM topics
						WHERE topics.category_id = :category_id			
		");
		$this->db->bind(':category_id', $category_id);
	
		//Assign Result Set
		$rows = $this->db->resultset();

		return $this->db->rowCount();
	}

    /*
	 * Get Total # of Topics By Username filter
	 */
	public function getTotalTopicsByUser($user_id){
		$this->db->query("SELECT * FROM topics
						WHERE topics.user_id = :user_id
		");
		$this->db->bind(':user_id', $user_id);
	
		//Assign Result Set
		$rows = $this->db->resultset();

		return $this->db->rowCount();
	}
	
    /*
	 * Get Total # of Topics By Search filter
	 */
	public function getTotalTopicsBySearch($search){

        $pattern = '%' . $search . '%';

		$this->db->query("SELECT * FROM topics
                        WHERE topics.title LIKE :pattern OR topics.body LIKE :pattern
		");
		$this->db->bind(':pattern', $pattern);
		
		//Assign Result Set
		$rows = $this->db->resultset();

		return $this->db->rowCount();
	}

	/*
	 * Get Total # of Categories
	 */
	public function getTotalCategories(){
		$this->db->query('SELECT * FROM categories');
		$rows = $this->db->resultset();
		return $this->db->rowCount();
	}
	
	/*
	 * Get Total # of Replies
	 */
	public function getTotalReplies(){
		$this->db->query('SELECT * FROM replies');
		$rows = $this->db->resultset();
		return $this->db->rowCount();
	}
	
	/*
	 * Get Category By ID
	 */
	public function getCategory($category_id){
		$this->db->query("SELECT * FROM categories WHERE id = :category_id
		");
		$this->db->bind(':category_id', $category_id);
	
		//Assign Row
		$row = $this->db->single();
	
		return $row;
	}

	/*
	 * Get Topic By ID
	 */
	public function getTopic($id){
		$this->db->query("SELECT topics.*, users.username, users.name, users.avatar FROM topics
						INNER JOIN users
						ON topics.user_id = users.id
						WHERE topics.id = :id			
		");
		$this->db->bind(':id', $id);
		
		//Assign Row
		$row = $this->db->single();
		
		return $row;
	}
	
	/*
	 * Get Topic Replies By topic ID
	 */
	public function getReplies($topic_id){
		$this->db->query("SELECT replies.body, replies.last_activity as reply_date, replies.topic_id, replies.user_id,users.* FROM replies
						INNER JOIN users
						ON replies.user_id = users.id
						WHERE replies.topic_id = :topic_id 
						ORDER BY create_date ASC	
		");
		$this->db->bind(':topic_id', $topic_id);
	
		//Assign Result Set
		$results = $this->db->resultset();
	
		return $results;
	}
	
	/*
	 * Create Topic
	 */
	public function create($data){
		//Insert Query
		$this->db->query("INSERT INTO topics (category_id, user_id, title, body, last_activity)
											VALUES (:category_id, :user_id, :title, :body, :last_activity)");
		//Bind Values
		$this->db->bind(':category_id', $data['category_id']);
		$this->db->bind(':user_id', $data['user_id']);
		$this->db->bind(':title', $data['title']);
		$this->db->bind(':body', $data['body']);
		$this->db->bind(':last_activity', $data['last_activity']);
		//Execute
		if($this->db->execute()){
			return true;
		} else {
			return false;
		}
	}
	
	/*
	 * Add Reply
	 */
	public function reply($data){
		//Insert Query
		$this->db->query("INSERT INTO replies (topic_id, user_id, body, last_activity)
											VALUES (:topic_id, :user_id, :body, :last_activity)");
		//Bind Values
		$this->db->bind(':topic_id', $data['topic_id']);
		$this->db->bind(':user_id', $data['user_id']);
		$this->db->bind(':body', $data['body']);
        $this->db->bind(':last_activity', $data['last_activity']);

		//Execute
		if($this->db->execute()){
			return true;
		} else {
			return false;
		}
	}

	/*
	 * Delete Topic
	 */
    public function delete($id){
        //Insert Query
        $this->db->query("DELETE FROM topics WHERE id = :id");
        //Bind Values
        $this->db->bind(':id', $id);

        //Execute
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

	/*
	 * Update Topic
	 */
    public function update($data){
        //Insert Query
        $this->db->query("UPDATE topics
            SET
            category_id = :category_id,
            title = :title,
            body = :body,
            last_activity = :last_activity
            WHERE id = :id");
        // Bind Data
		$this->db->bind(':category_id', $data['category_id']);
		$this->db->bind(':title', $data['title']);
		$this->db->bind(':body', $data['body']);
		$this->db->bind(':last_activity', $data['last_activity']);
		$this->db->bind(':id', $data['topic_id']);
        //Execute
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }
	
	
}




