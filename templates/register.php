<?php include('includes/header.php'); ?>


    <form enctype="multipart/form-data" method="post" action="register.php">
        <div class="form-group">
            <label>Name*</label>
            <input type="text" class="form-control" name="name" value="<?php echo $data['name']; ?>"
            placeholder="Enter Your Name">
        </div>
        <div class="form-group">
            <label>Email Address*</label>
            <input type="email" class="form-control" name="email" value="<?php echo $data['email']; ?>"
            placeholder="Enter Your Email Address">
        </div>
        <div class="form-group">
            <label>Choose Username*</label>
            <input type="text" class="form-control" name="username" value="<?php echo $data['username']; ?>" 
            placeholder="Create A Username">
        </div>
        <div class="form-group">
            <label>Password*</label>
            <input type="password" class="form-control" name="password" placeholder="Enter A Password">
        </div>
        <div class="form-group">
            <label>Confirm Password*</label>
            <input type="password" class="form-control" name="password2" placeholder="Enter Password Again">
        </div>
        <div class="form-group">
            <label>Upload Avatar <small>(Optional;  Accept File format: 'image/gif', 'image/png', 'image/jpeg' with Maximum Size: 1MB)</small></label>
            <input type="file" accept="image/*" class="form-control-file" name="avatar">
        </div>
        <div class="form-group">
            <label>About Me <small>(Optional)</small></label>
            <textarea id="about" rows="6" cols="80" class="form-control" name="about" placeholder="Tell us about yourself"><?php echo $data['about']; ?></textarea>
        </div>
        <input name="register" type="submit" class="btn btn-secondary" value="Register" />
    </form>


<?php include('includes/footer.php'); ?>

 
