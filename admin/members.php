<?php
/*
 * manage member page
 * you can == add || edit || delete members from hear
 */

session_start();
$pagetitle = 'members';
if (isset($_SESSION['userName'])) {
    include 'init.php';
    $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';
    if ($do == 'Manage') {
        $query = '';
        if (isset($_GET['page']) && $_GET['page'] == 'pending'){
            $query = 'AND regstatus = 0';

        }
            $stmt = $con->prepare("SELECT * FROM users WHERE groupId !=1 $query");
            $stmt->execute();
            $rows = $stmt->fetchAll();
            if (!empty($rows)){
        ?>

        <h1 class="text-center">Add Member</h1>
        <div class="container">
            <table class="text-center table-bordered container ">
                <thead class="btn-dark">
                <tr>
                    <th>#ID</th>
                    <th>User name</th>
                    <th>Email</th>
                    <th>Full name</th>
                    <th>Registerd data</th>
                    <th>control</th>
                </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($rows as $row){
                            echo '<tr>';
                            echo '<td>' . $row['userId'] . '</td>';
                            echo '<td>' . $row['userName'] . '</td>';
                            echo '<td>' . $row['email'] . '</td>';
                            echo '<td>' . $row['fullName'] . '</td>';
                            echo '<td>' . $row['date'] . '</td>';

                            echo '<td>' .
                                    '<a href="members.php?do=edit&userId=' .$row['userId'] . '" class="btn btn-success ">' .'<i class="fa fa-edit"></i>'. 'Edit' . '</a>' .
                                    '<a href="members.php?do=Delete&userId=' .$row['userId'] . '" class="btn btn-danger confirm activate">'.'<i class="fa fa-trash"></i>' . 'Delete' . '</a>';
                                    if ($row['regstatus'] == 0){
                                        echo ''. '<a href="members.php?do=activate&userId=' .$row['userId'] . '" class="btn btn-primary activate activate">'.'<i class="fa fa-check"></i>' . 'Activate' . '</a>';
                                    }
                            echo '</td>';

                            echo '</tr>';
                        }

                    ?>
                </tbody>
            </table>
            <a href="members.php?do=add" class="btn btn-primary" style="margin-top: 15px"><i class="fa fa-plus"></i>New member</a>
        </div>
                <?php
            }else{
                echo '<div class="container">';
                echo '<div class="alert-info" style="margin-top: 150px; font-size: 50px; text-align: center;">there is no comments yet</div>';
                echo'<a href="members.php?do=add" class="btn btn-primary" style="margin-top: 15px"><i class="fa fa-plus"></i>New member</a>';
                echo '</div>';
            }
        ?>

        <?php
    } elseif ($do == 'add') {
        ?>

        <!--start add new member-->
        <h1 class="text-center">Add Member</h1>
        <div class="container">
            <form class="form-horizontal" action="?do=insert" method="post">

                <!-- start username filed -->
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">User name</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="username" name="username"
                               placeholder="User name">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-md-6">
                        <input type="password" class="form-control" name="password" id="Password"
                               placeholder="password">
                    </div>
                </div>
                <div class="form-group row ">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-md-6">
                        <input type="email" class="form-control" id="inputEmail3" name="email"
                               placeholder="Email">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Full name</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="full" id="fullname3"
                               placeholder="Full name">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <input type="submit" value="save" class="btn btn-primary"/>
                    </div>
                </div>
                <!-- end username filed -->
            </form>

        </div>
    <?php } elseif ($do == 'insert') {


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            echo '<h1 class="text-center">insert Member</h1>';
            echo '<div class="container">';
            $user = $_POST['username'];
            $pass = $_POST['password'];
            $email = $_POST['email'];
            $name = $_POST['full'];

            $hashpass = sha1($_POST['password']);

            // start the validate
            $formErrors = array();
            if (strlen($user) < 3) {
                $theMessage = $formErrors[] = '<div class="alert alert-danger">user name can\'t be less than <strong> 3 characters </strong></div>';
                redirectToHome ($theMessage,'back');
            }
            if (strlen($user) > 20) {
                $theMessage = $formErrors[] = '<div class="alert alert-danger">user name can\'t be more than <strong> 20 characters </strong></div>';
                redirectToHome ($theMessage,'back');
            }
            if (empty($user)) {
                $theMessage = $formErrors[] = '<div class="alert alert-danger">user name can\'t be empty</div>';
                redirectToHome ($theMessage,'back');
            }
            if (empty($pass)) {
                $theMessage = $formErrors[] = '<div class="alert alert-danger">password can\'t be empty</div>';
                redirectToHome ($theMessage,'back');
            }
            if (empty($email)) {
                $theMessage = $formErrors[] = '<div class="alert alert-danger">email can\'t be empty</div>';
                redirectToHome ($theMessage,'back');
            }
            if (empty($name)) {
                $theMessage = $formErrors[] = '<div class="alert alert-danger">full name can\'t be empty</div>';
                redirectToHome ($theMessage,'back');
            }
            foreach ($formErrors as $error) {
                echo $error . '<br/>';
            }
            //end the validate

            if (empty($formErrors)) {    // this if to make sure that there is no errors an update all the data in data base

                //check if the user name exist in database or not
                $check = checkItems("userName" , "users" ,$user);
                if ($check == 1){
                    $theMessage = '<div class="alert alert-danger container">' . 'sorry this user exist' . '</div>' ;
                    redirectToHome ($theMessage,'back');
                }else {
                    // the next step will add new data in the database

                    $stmt = $con->prepare("INSERT INTO users(userName, password, email, fullName,regstatus, date) VALUES(:zname, :zpassword , :zemail , :zfullname, 1,now())");
                    $stmt->execute([
                        'zname' => $user,
                        'zpassword' => $hashpass,
                        'zemail' => $email,
                        'zfullname' => $name
                    ]);
                    $theMessage = '<div class="container alert alert-success">' . $stmt->rowCount() . 'created</div>';
                    redirectToHome ($theMessage,$_SERVER['HTTP_REFERER']='members.php');
                }
            }

        }else{
            $theMessage = '<div class="alert alert-danger container">' . 'you cant brows this page directely' . '</div>';
            redirectToHome ($theMessage,'back');
        }
        echo '</div>';
        ?>
        <!--end add new member-->

    <?php } elseif ($do == 'edit') { //for edit the user that coming with the is

        $userId = isset($_GET['userId']) && is_numeric($_GET['userId']) ? intval($_GET['userId']) : 0; // to check if this user id number or no and get the integer val of it

        $stmt = $con->prepare("SELECT * FROM users WHERE userId=? LIMIT 1");    // hear we select all the data form the database depend on id
        $stmt->execute(array($userId)); // to execute the query
        $row = $stmt->fetch();  // to bring the data form the database
        $count = $stmt->rowCount(); // to check if this row exist or not

        if ($count > 0) { // hear we say it the row exist and greater than 0 sho the form

            ?>
            <h1 class="text-center">Edit Member</h1>
            <div class="container">
                <form class="form-horizontal" action="?do=update" method="post">
                    <input type="hidden" name="userId" value="<?php echo $userId ?>"/>
                    <!-- start username filed -->
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">User name</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="username" name="username"
                                   value="<?php echo $row['userName']; ?>" placeholder="User name" required="required">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-md-6">
                            <input type="hidden" name="oldpassword" value="<?php echo $row['password']; ?>">
                            <input type="password" class="form-control" name="newpassword" id="Password"
                                   placeholder="leave this field blank if you don't want to change"
                                   autocomplete="newpassword">
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-md-6">
                            <input type="email" class="form-control" id="inputEmail3" name="email"
                                   value="<?php echo $row['email']; ?>" placeholder="Email" required="required">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Full name</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="full" id="fullname3"
                                   value="<?php echo $row['fullName']; ?>" placeholder="Full name" required="required">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">

                            <input type="submit" value="save" class="btn btn-primary"/>
                        </div>
                    </div>
                    <!-- end username filed -->
                </form>

            </div>


            <?php
        } else { // else if there is what i order show what i do
            $theMessage = 'there is no id';
            redirectToHome($theMessage,'back');
        }
    } elseif ($do == 'update') {  // this is the update page
        echo '<h1 class="text-center">Update Member</h1>';
        echo '<div class="container">';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['userId'];
            $user = $_POST['username'];
            $email = $_POST['email'];
            $name = $_POST['full'];

            $pass = empty($_POST['newpassword']) ? $_POST['oldpassword'] : sha1($_POST['newpassword']);// this step to check if the old pass is exist or not

            // start the validate
            $formErrors = array();
            if (strlen($user) < 3) {
                $formErrors[] = '<div class="alert alert-danger">user name can\'t be less than <strong> 3 characters </strong></div>';
            }
            if (empty($user)) {
                $formErrors[] = '<div class="alert alert-danger">user name can\'t be empty</div>';
            }
            if (empty($email)) {
                $formErrors[] = '<div class="alert alert-danger">email can\'t be empty</div>';
            }
            if (empty($name)) {
                $formErrors[] = '<div class="alert alert-danger">full name can\'t be empty</div>';
            }
            foreach ($formErrors as $error) {
                echo $error . '<br/>';
            }
            //end the validate

            if (empty($formErrors)) {    // this if to make sure that there is no errors an update all the data in data base

                    // the next statment will put the data in the database
                    $stmt = $con->prepare("UPDATE users SET userName = ?, email = ?, fullName =?, password = ? WHERE userId = ? ");
                    $stmt->execute(array($user, $email, $name, $pass, $id));
//        print_r([$id,$user,$email,$pass,$name]);
                $theMessage = '<div class="container alert alert-success">' . $stmt->rowCount() . 'have been updated</div>';
                redirectToHome($theMessage,'back');

            }


        }
        echo '</div>';
    }elseif ($do == 'Delete'){
        $userId = isset($_GET['userId']) && is_numeric($_GET['userId']) ? intval($_GET['userId']) : 0; // to check if this user id number or no and get the integer val of it

        $check = checkItems('userId', 'users', $userId);// hear we select all the data form the database depend on id

        if ($check > 0) { // hear we say it the row exist and greater than 0 sho the form
            $stmt = $con->prepare("DELETE FROM users WHERE userId = :zuser");
            $stmt->bindParam(':zuser',$userId);
            $stmt->execute();
            $theMessage = '<div class="container alert alert-success" style="margin-top: 50px">have been deleted</div>';
            redirectToHome($theMessage,'back');

        }else {
            $theMessage = '<div class="container alert alert-danger" style="margin-top: 50px">this Id is not exist </div>';
            redirectToHome($theMessage);
        }
    }elseif ($do == 'activate'){
        echo '<h1 class="text-center">Activate Member</h1>';
        $userId = isset($_GET['userId']) && is_numeric($_GET['userId']) ? intval($_GET['userId']) : 0; // to check if this user id number or no and get the integer val of it

        $check = checkItems('userId', 'users', $userId);// hear we select all the data form the database depend on id

        if ($check > 0) { // hear we say it the row exist and greater than 0 sho the form
            $stmt = $con->prepare("UPDATE users SET regstatus = 1 WHERE userId = ?");
            $stmt->execute([$userId]);
            $theMessage = '<div class="container alert alert-success" style="margin-top: 50px">have been updated</div>';
            redirectToHome($theMessage,'back');

        }else {
            $theMessage = '<div class="container alert alert-danger" style="margin-top: 50px">this Id is not exist </div>';
            redirectToHome($theMessage);
        }
    }
    include $tpl . 'footer.php';
} else {
    header('location: index.php');
    exit();
}
