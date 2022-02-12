
<?php include('includes/header.php'); ?>

    <ul id="topics">
        <?php if($topics) : ?>
            <?php foreach($topics as $topic) : ?>
                <li class="topic">
                    <div class="row">
                        <div class="col-md-2" id="image-sec">
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
                                    <span class="badge badge-pill badge-secondary float-right" id="reply-num">
                                        <?php echo replyCount($topic->id); ?> Replies 
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            <?php endforeach ; ?>
    </ul>

        <nav class="ml-auto">
            <ul class="pagination">
                <?php
                // if (isset($_GET['page'])) { //get page from URL if its there
                //     $page = preg_replace('#[^0-9]#', '', $_GET['page']); //filter everything but numbers

                // } else {
                //     $page = 1;
                // }

                // if ($page == 1 || $page == '') {
                //     $page_offset_posts = 0;
                // }else{
                //     $page_offset_posts = ($page * 3) -3;
                // }

                if ($currentPage != 1) {
                    $prevPage = $currentPage - 1;
                    echo "<li class='page-item'><a class='page-link' href='index.php?page={$prevPage}'>&laquo;</a></li>";
                }

                $totalPage = ceil($totalTopics/$topicsPerPage);
                for($i=1; $i <= $totalPage; $i++){
                    if($i == $currentPage){
                        echo "<li class='page-item active'><a class='page-link' href='index.php?page={$i}'>{$i}</a></li>";
                    }else{
                        echo "<li class='page-item'><a class='page-link' href='index.php?page={$i}'>{$i}</a></li>";
                    }
                }

                if ($currentPage != $totalPage && $currentPage < $totalPage) {
                    $nextPage = $currentPage + 1;
                    echo "<li class='page-item'><a class='page-link' href='index.php?page={$nextPage}'>&raquo;</a></li>";
                }
                ?>
                
            </ul>
        </nav>

        <?php else : ?>
            <p>No Topics To Display</p>
        <?php endif; ?>

    <div class="mt-4">
        <h3>Forum Statistics</h3>
        <ul>
            <li>Total Number of Users: <strong><?php echo htmlspecialchars($totalUsers); ?></strong></li>
            <li>Total Number of Topics: <strong><?php echo htmlspecialchars($totalTopics); ?></strong></li>
            <li>Total Number of Categories: <strong><?php echo htmlspecialchars($totalCategories); ?></strong></li>
        </ul>
    </div>

<?php include('includes/footer.php'); ?>





