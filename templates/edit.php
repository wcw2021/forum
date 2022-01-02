
<?php include('includes/header.php'); ?>
<?php if($topic) : ?>	
    <form method="post" action="edit.php?id=<?php echo urlencode($topic->id); ?>">
        <div class="form-group">
            <label>Topic Title*</label>
            <input type="text" class="form-control" name="title" value="<?php echo htmlspecialchars($topic->title); ?>">
        </div>
        <div class="form-group">
            <label>Category*</label>
            <select class="form-control" name="category">
                <?php foreach(getCategories() as $category) : ?>
                    <?php 
                        if( urlencode($category->id) == urlencode($topic->category_id) ){
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
            <textarea id="body" rows="10" cols="80" class="form-control" name="body"><?php echo htmlspecialchars($topic->body); ?></textarea>
            <!-- <script>CKEDITOR.replace('body');</script> -->
        </div>
        <button name="do_edit" type="submit" class="btn btn-secondary" value="Edit">Submit</button>
    </form>
<?php else : ?>
    <p>No Topic To Display</p>
<?php endif; ?>
                            

<?php include('includes/footer.php'); ?>	




