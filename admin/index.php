<?php
    session_start();
    $noNavBar = '';
    $pagetitle = 'login';
    if (isset($_SESSION['userName']) && $_SESSION['userName'] === true) {
        header('location: dashboard.php');
    }
    
    include 'init.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $username = $_POST['user'];
        $password = $_POST['pass'];
        $hashedpass = sha1($password);


        // check if the user exist or not

        $stmt = $con->prepare("SELECT userId, userName, password FROM users WHERE userName=? AND password=? AND groupId=1 LIMIT 1");
        $stmt->execute(array($username , $hashedpass));
        $row =$stmt->fetch();
        $count = $stmt->rowCount();

        // if count > 0 this mean the  database contain record about this user name
        if($count > 0){
            print_r($row);
            $_SESSION['userName'] = $username;  // hear we name the register session
            $_SESSION['id']=$row['userId'];
            header('location: dashboard.php');      // hear we say if all statments completed pleas redirect me to the location
            exit();
        }
    }
?>
    <form class="login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <h4 class="text-center"> Admin Login</h4>
        <input class="form-control" type="text" name="user" placeholder="Username" autocomplete="off">
        <input class="form-control" type="password" name="pass" placeholder="password" autocomplete="new_password">
        <input class="btn btn-primary btn-block" type="submit" value="login">
    </form>





<?php include $tpl. 'footer.php' ;?>
