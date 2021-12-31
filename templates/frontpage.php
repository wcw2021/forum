
<?php include('includes/header.php'); ?>

    <ul id="topics">
        <?php if($topics) : ?>
            <?php foreach($topics as $topic) : ?>
                <li class="topic">
                    <div class="row">
                        <div class="col-md-2">
                            <img class="avatar img-fluid" width="80" src="images/avatars/<?php echo htmlspecialchars($topic->avatar); ?>" />
                        </div>
                        <div class="col-md-10">
                            <div class="topic-content">
                                <h3>
                                    <a href="topic.php?id=<?php echo urlFormat($topic->id); ?>"><?php echo htmlspecialchars($topic->title); ?></a>
                                </h3>
                                <div class="topic-info">
                                    <a href="topics.php?category=<?php echo urlFormat($topic->category_id); ?>">
                                        <?php echo htmlspecialchars($topic->name); ?>
                                    </a> >>
                                    <a href="topics.php?user=<?php echo urlFormat($topic->user_id); ?>">
                                        <?php echo htmlspecialchars($topic->username); ?>
                                    </a> >>
                                    <?php echo formatDate($topic->create_date); ?>
                                    <span class="badge badge-pill badge-secondary float-right">
                                        <?php echo replyCount($topic->id); ?> Replies 
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            <?php endforeach ; ?>
    </ul>
        <?php else : ?>
            <p>No Topics To Display</p>
        <?php endif; ?>


    <h3>Forum Statistics</h3>
    <ul>
        <li>Total Number of Users: <strong><?php echo htmlspecialchars($totalUsers); ?></strong></li>
        <li>Total Number of Topics: <strong><?php echo htmlspecialchars($totalTopics); ?></strong></li>
        <li>Total Number of Categories: <strong><?php echo htmlspecialchars($totalCategories); ?></strong></li>
    </ul>

<?php include('includes/footer.php'); ?>





