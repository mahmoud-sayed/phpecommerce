<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php gitTitle(); ?></title>

    <link rel="stylesheet" href="<?php echo $css;?>bootstrap.min.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo $css;?>frontend.css"/>
</head>
<body>
<div class="uppar-bar" style="background-color: #fff">
    <div class="container text-lg-right" >
        <?php

        if (isset($_SESSION['User'])) {
        echo 'welcome' . $sessionUser;
        echo '<a href="profile.php">My Profile</a>';
        echo ' - <a href="login.php">Logout</a>';
        $userStatus = checkeUerStatus($sessionUser);
            if ($userStatus == 1){
                // hear is the user is not active
                echo 'user is not active';
            }
        }else{
        ?>
        <a href="login.php">login/Signup</a>
        <?php } ?>
    </div>
</div>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php"><?php echo lang('Main_Page') ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#app-nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="app-nav">
            <ul class="navbar-nav mr-auto justify-content-center">
                <?php
                    foreach (getCat() as $cat){
                        echo '<li class="nav-item">
                                    <a class="nav-link" href="categories.php?pageId=' . $cat['id'] . '&pageName=' . str_replace(' ','-' , $cat['name']) . '">' . $cat['name'] . '</a>
                              </li>';
                    }
                ?>

           <?php /*
<!--                <li><a class="nav-link" href="categories.php">--><?php //echo lang('shop_Categories')?><!--</a></li>-->
<!--                <li><a class="nav-link" href="items.php">--><?php //echo lang('items')?><!--</a></li>-->
<!--                <li><a class="nav-link" href="members.php">--><?php //echo lang('members')?><!--</a></li>-->
<!--                <li><a class="nav-link" href="comment.php">--><?php //echo lang('comments')?><!--</a></li>-->
<!--                <div class="col-lg-12">-->
<!--                    <li class="nav-item dropdown">-->
<!--                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
<!--                            --><?php //echo lang('admin_name')?>
<!--                        </a>-->
<!--                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">-->
<!--                            <a class="dropdown-item" href="members.php?do=edit&userId=--><?php //echo $_SESSION['id'] ?><!--">--><?php //echo lang('Edit')?><!--</a>-->
<!--                            <a class="dropdown-item" href="#">--><?php //echo lang('Settings')?><!--</a>-->
<!--                            <a class="dropdown-item" href="Logout.php">--><?php //echo lang('Logout')?><!--</a>-->
<!--                        </div>-->
<!--                    </li>-->
<!--                </div>-->
                */?>
            </ul>
        </div>
    </div>
</nav>

