<?php
    ob_start();
    session_start();
    if (isset($_SESSION['userName'])) {
        include 'init.php';
        // start dashboard page
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
                    <div class="status Items-style">total Items<span>25</span></div>
                </div>
                <div class="col-md-3">
                    <div class="status comments-style">total comments<span>25</span>   </div>
                </div>
            </div>
        </div>
        <div class="container latest">
            <div class="row">
                <div class="col-sm-6">
                    <?php $theLatestCount = 5 ?>
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-users"></i>Latest <?php echo $theLatestCount ?> registerd users
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="latest-user" style="list-style: none; padding-left: 8px;">
                                <?php
                                $theLatest = getLatest('*','users','userId', $theLatestCount);
                                foreach ($theLatest as $user){
                                    echo '<li class="list-group-item" style="list-style: none;">' . $user['userName'] . '<a href="members.php?do=edit&userId=' .$user['userId']. '"><i class="fa fa-edit" style="margin-left: 5px; color: rgb(171, 184, 64)"></i></a></li>';
                                    if ($user['regstatus'] == 0){
                                        echo '<div style="position: relative; float: right;"><a href="members.php?do=activate&userId=' . $user['userId'] . '" class="btn btn-primary activate activate"  >'.'<i class="fa fa-check"></i>' . 'Activate' . '</a></div>';
                                    }
                                }
                                ?>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-tag"></i>Latest item
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">item</li>
                        </ul>
                    </div>
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