<?php
include 'init.php';?>
    <div class="container login-page">
        <h1 class="text-center" style="margin-top: 20px">
            <span class="selected" data-class="login">Login</span> | <span data-class="singUp">SingUp</span>
        </h1>
    </div>
    <form class="login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <h4 class="text-center">Login</h4>
        <input class="form-control" type="text" name="user" placeholder="Username" autocomplete="off">
        <input class="form-control" type="password" name="pass" placeholder="password" autocomplete="new_password">
        <input class="btn btn-primary btn-block" type="submit" value="login">
    </form>

    <form class="login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <h4 class="text-center">register</h4>
        <input class="form-control" type="text" name="user" placeholder="Username" autocomplete="off">
        <input class="form-control" type="password" name="pass" placeholder="password" autocomplete="new_password">
        <input class="form-control" type="password" name="pass2" placeholder="password again" autocomplete="new_password">
        <input class="form-control" type="email" name="email" placeholder="email" >
        <input class="btn btn-primary btn-block" type="submit" value="SignUp">
    </form>

<?php
include $tpl.'footer.php';