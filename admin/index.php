<?php
    session_start();
    include 'init.php';
    include  $tpl.'header.php';
    include 'includes/languages/english.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $username = $_POST['user'];
        $password = $_POST['pass'];
        $hashedpass = sha1($password);
        echo $hashedpass;


        // check if the user exist or not

        $stmt = $con->prepare("SELECT userName, password FROM users WHERE userName=? AND password=? AND groupId=1");
        $stmt->execute(array($username , $hashedpass));
        $count = $stmt->rowCount();
        echo $count;

        // if count > 0 this mean the  database contain record about this user name
        if($count >0){
            echo 'welcome' . $username;
        }
    }
?>
    <form class="login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <h4 class="text-center"> Admin Login</h4>
        <input class="form-control" type="text" name="user" placeholder="Username" autocomplete="off">
        <input class="form-control" type="password" name="pass" placeholder="password" autocomplete="new_password">
        <input class="btn btn-primary btn-block" type="submit" value="login">
    </form>





<?php
    include $tpl. 'footer.php';
?>
