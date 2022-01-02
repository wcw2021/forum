
<?php include('includes/header.php'); ?>	
<?php if($topic) : ?>
    <ul id="topics" class="mb-3">
        <li id="main-topic" class="topic">
            <div class="row">
                <div class="col-md-2">
                    <div class="user-info">
                        <img class="avatar img-fluid mb-2" width="80" src="images/avatars/<?php echo htmlspecialchars($topic->avatar); ?>" />
                        <ul>
                            <li><strong><?php echo htmlspecialchars($topic->username); ?></strong></li>
                            <li><?php echo userTopicCount($topic->user_id); ?> Topics</li>
                            <li><a href="topics.php?user=<?php echo urlFormat($topic->user_id); ?>">View Topics</a>
                        </ul>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="topic-content">
                        <small>
                           Posted on  <?php echo htmlspecialchars($topic->last_activity); ?>
                        </small>
                        <p>
                            <?php echo htmlspecialchars($topic->body); ?>
                        </p>
                        
                    </div>
                    
                    <?php if(!empty($_SESSION) && $topic->user_id == $_SESSION['user_id']) : ?>
                        <hr>
                        <a href="edit.php?id=<?php echo urlFormat($topic->id); ?>" class="btn btn-outline-info btn-sm mr-2">Edit</a>

                        <form style="display:inline;" method="post" action="topic.php">
                            <input type="hidden" name="del_id" value="<?php echo urlFormat($topic->id); ?>">
                            <input type="submit" class="btn btn-outline-danger btn-sm" value="Delete">
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </li>                                               
    
        <?php foreach($replies as $reply) : ?>
            <li class="topic">
                <div class="row">
                    <div class="col-md-2">
                        <div class="user-info">
                            <img class="avatar img-fluid mb-2" width="80"  src="images/avatars/<?php echo htmlspecialchars($reply->avatar); ?>" />
                            <ul>
                                <li><strong><?php echo htmlspecialchars($reply->username); ?></strong></li>
                                <li><?php echo userTopicCount($reply->user_id); ?> Topics</li>
                                <li><a href="topics.php?user=<?php echo urlFormat($reply->user_id); ?>">View Topics</a>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="reply-content">
                            <small>
                               Replied on  <?php echo htmlspecialchars($reply->reply_date); ?>
                            </small>
                            <p>
                                <?php echo htmlspecialchars($reply->body); ?>
                            </p>
                            
                        </div>
                        
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>

    <h3>Reply to Topic</h3>
    <?php if(isLoggedIn()) : ?>
        <form method="post" action="topic.php?id=<?php echo urlFormat($topic->id); ?>">	
            <div class="form-group">
                <textarea id="reply" rows="10" cols="80" class="form-control" name="body"></textarea>
            </div>
            <button name="do_reply" type="submit" class="btn btn-secondary" value="Reply">Submit</button>
        </form>
    <?php else : ?>
        <p>Please login to reply</p>
    <?php endif; ?>	
    
<?php else : ?>
    <p>No Topic To Display</p>
<?php endif; ?>
            

<?php include('includes/footer.php'); ?>	







