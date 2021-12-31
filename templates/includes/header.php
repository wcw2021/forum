<?php
    //Check if title is set, if not assign it
    if(empty($title)){
    	$title = SITE_TITLE;
    }

    $activepage = basename($_SERVER['PHP_SELF'], ".php");
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
    integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <!-- custom css -->
    <link rel="stylesheet" href="templates/css/style.css">

    <title>Forum</title>
</head>

    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">FORUM</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
        
            <div class="collapse navbar-collapse" id="navbarColor01">            
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link <?= ($activepage == 'index') ? 'active' : ''; ?>" href="index.php">Home</a>
                    </li>
                    <?php if(!isLoggedIn()) : ?>
                        <li class="nav-item">
                            <a class="nav-link <?= ($activepage == 'register') ? 'active' : ''; ?>" href="register.php">Create An Account</a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link <?= ($activepage == 'create') ? 'active' : ''; ?>" href="create.php">Create Topic</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <?php displayMessage(); ?>
        <?php flash('register_message'); ?>
        <?php flash('topic_message'); ?>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="main-col">
					<div class="card card-body border-0 mb-4">
                        <div class="d-flex justify-content-between align-items-baseline">
                            <h1 class="h3 mb-0"><?php echo htmlspecialchars($title); ?></h1>
                            <h6 class="text-muted mb-0">A simple PHP forum engine</h6>
                        </div>
                        
						<hr class="mt-2">
           
                        <!-- <?php //displayMessage(); ?> -->



