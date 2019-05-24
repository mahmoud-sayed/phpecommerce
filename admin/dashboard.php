<?php
    ob_start();
    session_start();
    if (isset($_SESSION['userName'])) {
        include 'init.php';
        // start dashboard page

        $numUsers = 5;
        $theLatestUsers = getLatest('*','users','userId', $numUsers);

        $latestItems = 5;
        $theLatestItems = getLatest('*','items' ,'itemId' ,$latestItems );

        $latestComments = 5;
        $thelatestComments = getLatest('*','comments' ,'commentId' ,$latestComments );
        ?>

        <div class="container home-stats text-center">
            <h1>Dashboard</h1>
            <div class="row">
                <div class="col-md-3">
                    <div class="status users-style"><a href="members.php"> Total Members<span><?php echo countItems('userId','users') ?></span></a></div>
                </div>
                <div class="col-md-3">
                    <div class="status Members-style"><a href="members.php?do=Manage&page=pending">pending Members<span><?php echo checkItems('regstatus', 'users', 0)?></span></a></div>
                </div>
                <div class="col-md-3">
                    <div class="status Items-style"><a href="items.php?do=manage">total Items<span><?php echo countItems('itemId', 'items')?></span></a></div>
                </div>
                <div class="col-md-3">
                    <div class="status comments-style"><a href="comment.php?do=M    anage">total comments<span><?php echo countItems('commentId', 'comments')?></span></a></div>
                </div>
            </div>
        </div>
        <div class="container latest">
            <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-users"></i>Latest <?php echo $numUsers ?> registerd users
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="latest-user" style="list-style: none; padding-left: 8px;">
                                <?php
                                if (!empty($theLatestUsers)){
                                foreach ($theLatestUsers as $user){
                                    echo '<li class="list-group-item" style="list-style: none;">' . $user['userName'] . '<a href="members.php?do=edit&userId=' .$user['userId']. '"><i class="fa fa-edit" style="margin-left: 5px; color: rgb(171, 184, 64)"></i></a></li>';
                                    if ($user['regstatus'] == 0){
                                        echo '<div style="position: relative; float: right;"><a href="members.php?do=activate&userId=' . $user['userId'] . '" class="btn btn-primary activate activate"  >'.'<i class="fa fa-check"></i>' . 'Activate' . '</a></div>';
                                    }
                                }
                                }else{
                                    echo 'there is no record to show';
                                }
                                ?>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-tag"></i>Latest item <?php echo $latestItems;   ?>
                        </div>
                        <ul class="list-group list-group-flush">
                            <?php
                            if (!empty($theLatestItems)) {
                                foreach ($theLatestItems as $item) {
                                    echo '<li class="list-group-item" style="list-style: none;">' . $item['name'] . '<a href="items.php?do=edit&itemId=' . $item['itemId'] . '"><i class="fa fa-edit" style="margin-left: 5px; color: rgb(171, 184, 64)"></i></a></li>';
                                    if ($item['approve'] == 0) {
                                        echo '<div style="position: relative; float: right;"><a href="items.php?do=approve&itemId=' . $item['itemId'] . '" class="btn btn-primary activate activate"  >' . '<i class="fa fa-check"></i>' . 'Activate' . '</a></div>';
                                    }
                                }
                            }else{
                                echo 'there is no recorde to show';
                            }
                            ?>
                        </ul>
                    </div>
                </div>

            </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-comment"></i>Latest <?php echo $numUsers ?> comments
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="latest-user" style="list-style: none; padding-left: 8px;">
                            <?php

                            $stmt = $con->prepare("SELECT comments.*,users.userName AS userName
                                        FROM  comments
                                        INNER JOIN 
                                        users 
                                        ON 
                                        users.userId = comments.userId
                                        ORDER BY 
                                        commentId DESC 
                                        LIMIT $latestComments");
                            $stmt->execute();
                            $comments = $stmt->fetchAll();
                            if (!empty($comments)){
                            foreach ($comments as $comment){
                                echo '<li class="list-group-item" style="list-style: none;">'  . $comment['userName'] . ' <br>' . $comment['comment'] . '<a href="items.php?do=edit&itemId=' .$comment['commentId']. '"><i class="fa fa-edit" style="margin-left: 5px; color: rgb(171, 184, 64)"></i></a></li>';
                                if ($comment['status'] == 0){
                                    echo '<div style="position: relative; float: right;"><a href="items.php?do=approve&itemId=' . $comment['itemId'] . '" class="btn btn-primary activate activate"  >'.'<i class="fa fa-check"></i>' . 'Activate' . '</a></div>';
                                }
                            }
                            }else{
                                echo 'there is no record to show';
                            }
                            ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <?php
        // end dashboard page
        include $tpl . 'footer.php';
    }else{
        header('location: index.php');
        exit();
    }
    ob_end_flush();

    ?>