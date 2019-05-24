<?php
/*
 * manage member page
 * you can == edit || delete comments from hear
 */

session_start();
$pagetitle = 'comments';
if (isset($_SESSION['userName'])) {
    include 'init.php';
    $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';
    if ($do == 'Manage') {

        $stmt = $con->prepare("SELECT comments.*,items.name AS itemName,users.userName AS userName
                                        FROM  comments
                                        INNER JOIN 
                                        items
                                        ON 
                                        items.itemId = comments.itemId
                                        INNER JOIN 
                                        users 
                                        ON 
                                        users.userId = comments.userId");
        $stmt->execute();
        $rows = $stmt->fetchAll();
        if (!empty($rows)){
        ?>

        <h1 class="text-center">Manage Comments</h1>
        <div class="container">
            <table class="text-center table-bordered container ">
                <thead class="btn-dark">
                <tr>
                    <th>#ID</th>
                    <th>comment</th>
                    <th>Item Name</th>
                    <th>User Name</th>
                    <th>Added Data</th>
                    <th>control</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($rows as $row){
                    echo '<tr>';
                        echo '<td>' . $row['commentId'] . '</td>';
                        echo '<td>' . $row['comment'] . '</td>';
                        echo '<td>' . $row['itemName'] . '</td>';
                        echo '<td>' . $row['userName'] . '</td>';
                        echo '<td>' . $row['commentDate'] . '</td>';

                        echo '<td>' .
                            '<a href="comment.php?do=edit&commentId=' .$row['commentId'] . '" class="btn btn-success ">' .'<i class="fa fa-edit"></i>'. 'Edit' . '</a>' .
                            '<a href="comment.php?do=Delete&commentId=' .$row['commentId'] . '" class="btn btn-danger confirm activate">'.'<i class="fa fa-trash"></i>' . 'Delete' . '</a>';
                        if ($row['status'] == 0){
                            echo ''. '<a href="comment.php?do=activate&commentId=' .$row['commentId'] . '" class="btn btn-primary activate activate">'.'<i class="fa fa-check"></i>' . 'approve' . '</a>';
                        }
                        echo '</td>';

                    echo '</tr>';
                }

                ?>
                </tbody>
            </table>
        </div>
        <?php }else{
            echo '<div class="container">';
                echo '<div class="alert-info" style="margin-top: 150px; font-size: 50px; text-align: center;">there is no comments yet</div>';
            echo '</div>';
        }?>

        <?php
    } elseif ($do == 'edit') { //for edit the user that coming with the is

        $commentId = isset($_GET['commentId']) && is_numeric($_GET['commentId']) ? intval($_GET['commentId']) : 0; // to check if this user id number or no and get the integer val of it

        $stmt = $con->prepare("SELECT * FROM comments WHERE commentId=?");    // hear we select all the data form the database depend on id
        $stmt->execute(array($commentId)); // to execute the query
        $row = $stmt->fetch();  // to bring the data form the database
        $count = $stmt->rowCount(); // to check if this row exist or not

        if ($count > 0) { // hear we say it the row exist and greater than 0 sho the form

            ?>
            <h1 class="text-center">Edit comment</h1>
            <div class="container">
                <form class="form-horizontal" action="?do=update" method="post">
                    <input type="hidden" name="commentId" value="<?php echo $commentId ?>"/>
                    <!-- start comment filed-->
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Comment</label>
                        <div class="col-md-6">
                            <textarea class="form-control" id="username" name="comment"
                                       placeholder="Your Comment" required="required"><?php echo $row['comment'];?></textarea>

                        </div>
                    </div>
                    <!-- end comment filed-->
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
        echo '<h1 class="text-center">Comment</h1>';
        echo '<div class="container">';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['commentId'];
            $comment = $_POST['comment'];

                // the next statment will put the data in the database
                $stmt = $con->prepare("UPDATE comments SET comment = ? WHERE commentId = ? ");
                $stmt->execute(array($comment,      $id));
//        print_r([$id,$user,$email,$pass,$name]);
                $theMessage = '<div class="container alert alert-success">' . $stmt->rowCount() . 'have been updated</div>';
                redirectToHome($theMessage,'back');

        }
        echo '</div>';
    }elseif ($do == 'Delete'){

        echo'<h1 class="text-center">Delete Comment</h1>';
        $commentId = isset($_GET['commentId']) && is_numeric($_GET['commentId']) ? intval($_GET['commentId']) : 0; // to check if this user id number or no and get the integer val of it

        $check = checkItems('commentId', 'comments', $commentId);// hear we select all the data form the database depend on id

        if ($check > 0) { // hear we say it the row exist and greater than 0 sho the form
            $stmt = $con->prepare("DELETE FROM comments WHERE commentId = :zid");
            $stmt->bindParam(':zid',$commentId);
            $stmt->execute();
            $theMessage = '<div class="container alert alert-success" style="margin-top: 50px">have been deleted</div>';
            redirectToHome($theMessage,'back');

        }else {
            $theMessage = '<div class="container alert alert-danger" style="margin-top: 50px">this Id is not exist </div>';
            redirectToHome($theMessage);
        }
    }elseif ($do == 'activate'){
        echo '<h1 class="text-center">Activate Member</h1>';
        $commentId = isset($_GET['commentId']) && is_numeric($_GET['commentId']) ? intval($_GET['commentId']) : 0; // to check if this user id number or no and get the integer val of it

        $check = checkItems('commentId', 'comments', $commentId);// hear we select all the data form the database depend on id

        if ($check > 0) { // hear we say it the row exist and greater than 0 sho the form
            $stmt = $con->prepare("UPDATE comments SET status = 1 WHERE commentId = ?");
            $stmt->execute([$commentId]);
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
