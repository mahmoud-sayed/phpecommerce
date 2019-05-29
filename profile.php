<?php
    session_start();
    $pageTitle = 'Profile';
    include 'init.php';
    if (isset($sessionUser)) {
        $getUser = $con->prepare('SElECT * FROM users WHERE userName = ?');
        $getUser->execute([$sessionUser]);
        $info = $getUser->fetch();
        ?>
        <div class="container">
            <h1 class="text-center"><?php echo $_SESSION['userName']; ?> Profile</h1>
            <div class="card" style="margin-bottom: 20px">
                <div class="card-header " style="padding: 5px  10px 5px; background-color: #0062cc; color: #fff">
                    <p style="margin: 0 0 3px">My information</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li style="list-style: none; padding-left: 8px;"> Name: <?php echo $info['userName'] ?></li>
                    <li style="list-style: none; padding-left: 8px;"> Email: <?php echo $info['email'] ?></li>
                    <li style="list-style: none; padding-left: 8px;"> Full Name: <?php echo $info['fullName'] ?></li>
                    <li style="list-style: none; padding-left: 8px;"> Register Date: <?php echo $info['date'] ?></li>
                    <li style="list-style: none; padding-left: 8px;"> Favourite Category:</li>

                </ul>
            </div>

            <div class="card" style="margin-bottom: 20px">
                <div class="card-header " style="padding: 5px  10px 5px; background-color: #0062cc; color: #fff">
                    <p style="margin: 0 0 3px">My Ads</p>
                        <div class="container">
                            <div class="row">
                                <?php
                                $pagId = $_GET['pageId'];
                                foreach (getItem('memberId  ',$pagId) as $item) {
                                    echo '<div class="col-sm-6 col-md-3">';
                                    echo '<div class="card" style="width: 18rem;">';
                                    echo '<img class="card-img-top" src="" alt="Card image cap">';
                                    echo '<div class="card-body">';
                                    echo '<h5 class="card-title">' . $item['name']  . '</h5>';
                                    echo '<p class="card-text">' . $item['description']  . '</p>';
                                    echo '<p class="card-text" style="color: #34ce57; font-size:18px; font-weight:bold; ">' . $item['price']  . '</p>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</div>';
                                }
                                ?>
                            </div>
                        </div>
                </div>
                <ul class="list-group list-group-flush">
                    <li style="list-style: none; padding-left: 8px;"> this is my asd</li>
                </ul>
            </div>

            <div class="card " style="margin-bottom: 20px">
                <div class="card-header " style="padding: 5px  10px 5px; background-color: #0062cc; color: #fff">
                    <p style="margin: 0 0 3px">Latest Comments</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li style="list-style: none; padding-left: 8px;"> this is my comments</li>
                </ul>
            </div>
        </div>


        <?php
    }else{
        header(' location: login.php');
        exit();
    }

    include $tpl .'footer.php';
?>