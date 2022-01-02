                    
                    </div> <!-- end of card -->
                </div> <!-- end of main col -->                
            </div> <!-- end of col-md-8 -->

            <div class="col-md-4">
                <div class="sidebar">
					<div class="card card-body border-0 mb-3">						
                        <?php if(isLoggedIn()) : ?>
                            <h3>Welcome! <?php echo (!empty(getUserInfo())) ? getUserInfo()['username'] : ''; ?></h3>
                            <form class="mt-2" method="post" action="logout.php">
                                <input name="do_logout" type="submit" class="btn btn-info" value="Logout" />
                            </form>
                        <?php else : ?>
                            <h3>Login Form</h3>
                            <form class="mt-2" method="post" action="login.php">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input name="username" type="text" class="form-control" placeholder="Enter Username">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input name="password" type="password" class="form-control" placeholder="Enter Password">
                                </div>
                                <button name="do_login" type="submit" class="btn btn-info" value="Login">Login</button>
                                <a class="btn btn-secondary" href="register.php"> Create Account</a>
                            </form>
                        <?php endif; ?>
					</div>

                    <div class="card p-3 my-3 border-0 advertise">
                        <div class="text-center">
                            <h1 id="advertise-text">Annoying AD</h1>
                        </div>
                    </div>

                    <div class="card card-body border-0 mb-4">
                        <h3>Categories</h3>
                        <div class="list-group my-2">
                            <a href="topics.php" class="list-group-item <?php echo is_active(null); ?>">All Topics <span class="badge badge-pill badge-secondary float-right"><?php echo topicCount(); ?></span></a> 
                            <?php foreach(getCategories() as $category) : ?>
                                <a href="topics.php?category=<?php echo urlFormat($category->id); ?>" class="list-group-item <?php echo is_active($category->id); ?>">
                                    <?php echo htmlspecialchars($category->name); ?>
                                    <span class="badge badge-pill badge-secondary float-right"><?php echo topicCountByCategory($category->id); ?></span>
                                </a> 
                            <?php endforeach; ?>
                        </div>
                    </div> <!-- end of card --> 
				</div> <!-- end of sidebar -->
			</div> <!-- end of col-md-4 -->
        </div> <!--end of row -->
    </div> <!-- end of container -->



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
    <script src="templates/js/advertise.js"></script>
    <script src="//cdn.ckeditor.com/4.17.1/basic/ckeditor.js"></script>
    <script>
            CKEDITOR.replace( 'body' );
    </script>
</body>

</html>





