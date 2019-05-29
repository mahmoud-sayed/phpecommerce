<?php
session_start();
$pageTitle = 'login';
if (isset($_SESSION['User']) && $_SESSION['User'] === true) {
    header('location: index.php');
}
include 'init.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    $hashedpass = sha1($pass);


    // check if the user exist or not

    $stmt = $con->prepare("SELECT userName, password 
                                    FROM 
                                          users
                                    WHERE 
                                          userName=? 
                                      AND 
                                      password=? 
                                      ");
    $stmt->execute([$user, $hashedpass]);
    $count = $stmt->rowCount();

    // if count > 0 this mean the  database contain reco    rd about this user name
    if ($count > 0) {
        $_SESSION['User'] = $user;  // hear we name the register session
        header('location: index.php');      // hear we say if all statment completed pleas redirect me to the location
        exit();
    }
} ?>
    <div class="container login-page">
        <h1 class="text-center" style="margin-top: 20px">
            <span class="selected" data-class="login">Login</span> | <span data-class="singUp">SingUp</span>
        </h1>
    </div>
    <!-- start login form-->
    <form class="login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <h4 class="text-center">Login</h4>
        <input class="form-control" type="text" name="user" placeholder="Username" autocomplete="off">
        <input class="form-control" type="password" name="pass" placeholder="password" autocomplete="new_password">
        <input class="btn btn-primary btn-block" type="submit" value="login">
    </form>
    <!-- end login form-->

    <!-- start register form-->
    <form class="login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <h4 class="text-center">register</h4>
        <input class="form-control" type="text" name="user" placeholder="Username" autocomplete="off">
        <input class="form-control" type="password" name="pass" placeholder="password" autocomplete="new_password">
        <input class="form-control" type="password" name="pass2" placeholder="password again"
               autocomplete="new_password">
        <input class="form-control" type="email" name="email" placeholder="email">
        <input class="btn btn-primary btn-block" type="submit" value="SignUp">
    </form>
    <!-- end  register form-->
<?php
include $tpl . 'footer.php';