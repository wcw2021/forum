
<?php include('includes/header.php'); ?>	
    <form method="post" action="create.php">
        <div class="form-group">
            <label>Topic Title*</label>
            <input type="text" class="form-control" name="title" value="<?php echo htmlspecialchars($data['title']); ?>" placeholder="Enter Post Title">
        </div>
        <div class="form-group">
            <label>Category*</label>
            <select class="form-control" name="category">
                <?php foreach(getCategories() as $category) : ?>
                    <?php 
                        if( urlencode($category->id) == urlencode($data['category_id']) ){
                            $selected = 'selected';
                        } else {
                            $selected = '';
                        }
                    ?>	
                    <option value="<?php echo urlencode($category->id); ?>" <?php echo $selected; ?> >
                        <?php echo htmlspecialchars($category->name); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label>Topic Body*</label>
            <textarea id="body" rows="10" cols="80" class="form-control" name="body"><?php echo htmlspecialchars($data['body']); ?></textarea>
            <!-- <script>CKEDITOR.replace('body');</script> -->
        </div>
        <button name="do_create" type="submit" class="btn btn-secondary" value="Create">Submit</button>
    </form>
                            

<?php include('includes/footer.php'); ?>	




