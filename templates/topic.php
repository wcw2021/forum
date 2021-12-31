
<?php include('includes/header.php'); ?>	
<?php if($topic) : ?>
    <ul id="topics" class="mb-3">
        <li id="main-topic" class="topic">
            <div class="row">
                <div class="col-md-2">
                    <div class="user-info">
                        <img class="avatar img-fluid mb-2" width="80" src="images/avatars/<?php echo $topic->avatar; ?>" />
                        <ul>
                            <li><strong><?php echo $topic->username; ?></strong></li>
                            <li><?php echo userTopicCount($topic->user_id); ?> Topics</li>
                            <li><a href="topics.php?user=<?php echo $topic->user_id; ?>">View Topics</a>
                        </ul>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="topic-content">
                        <?php echo $topic->body; ?>
                    </div>
                </div>
            </div>
        </li>                                               
    
        <?php foreach($replies as $reply) : ?>
            <li class="topic">
                <div class="row">
                    <div class="col-md-2">
                        <div class="user-info">
                            <img class="avatar img-fluid mb-2" width="80"  src="images/avatars/<?php echo $reply->avatar; ?>" />
                            <ul>
                                <li><strong><?php echo $reply->username; ?></strong></li>
                                <li><?php echo userTopicCount($reply->user_id); ?> Topics</li>
                                <li><a href="topics.php?user=<?php echo $reply->user_id; ?>">View Topics</a>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="topic-content">
                            <?php echo $reply->body; ?>
                        </div>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>

    <h3>Reply to Topic</h3>
    <?php if(isLoggedIn()) : ?>
        <form method="post" action="topic.php?id=<?php echo $topic->id; ?>">	
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







