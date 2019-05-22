<?php
/*
 * this the template page i will uwe it in all pages
 * ==============================
 * ===template page
 * ==============================
 */

ob_start();
session_start();
$pagetitle = '';
if (isset($_SESSION['userName'])) {
    include 'init.php';
    $do = isset($_GET['do']) ? $_GET['do'] : 'manage';
    if ($do == 'manage') {
        $query = '';
        if (isset($_GET['page']) && $_GET['page'] == 'pending'){
            $query = 'AND approve = 0';

        }
        $stmt = $con->prepare("SELECT 
                                              items.*, 
                                              categories.name AS catName,
                                              users.userName
                                        FROM 
                                              items
                                        INNER JOIN
                                              categories
                                        ON 
                                              categories.id = items.catId
                                        INNER JOIN 
                                              users
                                        ON 
                                              users.userId = items.memberId");
        $stmt->execute();
        $items = $stmt->fetchAll();

        ?>

        <h1 class="text-center">Manage Item</h1>
        <div class="container">
            <table class="text-center table-bordered container ">
                <thead class="btn-dark">
                <tr>
                    <th>#ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Adding data</th>
                    <th>category</th>
                    <th>username</th>
                    <th>Control</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($items as $item) {
                    echo '<tr>';
                    echo '<td>' . $item['itemId'] . '</td>';
                    echo '<td>' . $item['name'] . '</td>';
                    echo '<td>' . $item['description'] . '</td>';
                    echo '<td>' . $item['price'] . '</td>';
                    echo '<td>' . $item['addDate'] . '</td>';
                    echo '<td>' . $item['catName'] . '</td>';
                    echo '<td>' . $item['userName'] . '</td>';
                    echo '<td>' .
                        '<a href="items.php?do=edit&itemId=' . $item['itemId'] . '" class="btn btn-success ">' . '<i class="fa fa-edit"></i>' . 'Edit' . '</a>' .
                        '<a href="items.php?do=Delete&itemId=' . $item['itemId'] . '" class="btn btn-danger confirm activate">' . '<i class="fa fa-trash"></i>' . 'Delete' . '</a>';
                        if ($item['approve'] == 0){
                            echo ''. '<a href="items.php?do=approve&itemId=' .$item['itemId'] . '" class="btn btn-primary activate activate">'.'<i class="fa fa-check"></i>' . 'approve' . '</a>';
                        }
                    echo '</td>';
                    echo '</tr>';
                }

                ?>
                </tbody>
            </table>
            <a href="items.php?do=add" class="btn btn-primary" style="margin-top: 15px"><i class="fa fa-plus"></i>New
                item</a>
        </div>


        <?php
    } elseif ($do == 'add') {

        ?>
        <!--start add new member-->
        <h1 class="text-center">Add Item</h1>
        <div class="container">
            <form class="form-horizontal" action="?do=insert" method="post">

                <!-- start item name filed -->
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">item name</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="name" name="name"
                               placeholder="item name" required="required">
                    </div>
                </div>
                <!--end item name field -->

                <!-- start item description filed -->
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">item description</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="username" name="description"
                               placeholder="item description" required="required">
                    </div>
                </div>
                <!--end item description field -->

                <!-- start item price filed -->
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">item price</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="username" name="price"
                               placeholder="item price" required="required">
                    </div>
                </div>
                <!--end item price field -->

                <!-- start item country made filed -->
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">item country</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="username" name="countryMade"
                               placeholder="item made in" required="required">
                    </div>
                </div>
                <!--end item country made field -->

                <!-- start item status filed -->
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">item status</label>
                    <div class="col-md-6">
                        <select class="form-control" name="status" id="" required="required">
                            <option value="0">...</option>
                            <option value="1">New</option>
                            <option value="2">Like New</option>
                            <option value="3">Used</option>
                            <option value="4">Very old</option>
                        </select>
                    </div>
                </div>
                <!--end item status field -->

                <!-- start get users to chose the status filed -->
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">user name</label>
                    <div class="col-md-6">
                        <select class="form-control" name="users" id="" required="required">
                            <option value="0">...</option>
                            <?php
                            $stmt = $con->prepare("SELECT * FROM users");
                            $stmt->execute();
                            $users = $stmt->fetchAll();
                            foreach ($users as $user) {
                                echo '<option value="' . $user['userId'] . '">' . $user['userName'] . '</option>';
                            }

                            ?>
                        </select>
                    </div>
                </div>
                <!--end get users to chose the status filed -->

                <!-- start get category to chose the status filed -->
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">category name</label>
                    <div class="col-md-6">
                        <select class="form-control" name="categories" id="" required="required">
                            <option value="0">...</option>
                            <?php
                            $stmt = $con->prepare("SELECT * FROM categories");
                            $stmt->execute();
                            $categories = $stmt->fetchAll();
                            foreach ($categories as $categorie) {
                                echo '<option value="' . $categorie['id'] . '">' . $categorie['name'] . '</option>';
                            }

                            ?>
                        </select>
                    </div>
                </div>
                <!--end get category to chose the status filed -->


                <div class="form-group row">
                    <div class="col-md-6">
                        <input type="submit" value="save" class="btn btn-primary"/>
                    </div>
                </div>
                <!-- end username filed -->
            </form>

        </div>
        <?php
    } elseif ($do == 'insert') {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            echo '<h1 class="text-center">insert Item</h1>';
            echo '<div class="container">';
            $name        = $_POST['name'];
            $description = $_POST['description'];
            $price       = $_POST['price'];
            $countryMade = $_POST['countryMade'];
            $status      = $_POST['status'];
            $member      = $_POST['users'];
            $cat         = $_POST['categories'];


            // start the validate
            $formErrors = array();
            if (empty($name)) {
                $theMessage = $formErrors[] = '<div class="alert alert-danger">name can\'t be <strong> empty</strong></div>';
                redirectToHome($theMessage, 'back');
            }
            if (empty($description)) {
                $theMessage = $formErrors[] = '<div class="alert alert-danger">description can\'t be empty</div>';
                redirectToHome($theMessage, 'back');
            }
            if (empty($price)) {
                $theMessage = $formErrors[] = '<div class="alert alert-danger">price can\'t be empty</div>';
                redirectToHome($theMessage, 'back');
            }
            if (empty($countryMade)) {
                $theMessage = $formErrors[] = '<div class="alert alert-danger">country can\'t be empty</div>';
                redirectToHome($theMessage, 'back');
            }
            if ($status === 0) {
                $theMessage = $formErrors[] = '<div class="alert alert-danger">status can\'t be empty</div>';
                redirectToHome($theMessage, 'back');
            }
            if ($member === 0) {
                $theMessage = $formErrors[] = '<div class="alert alert-danger">user can\'t be empty</div>';
                redirectToHome($theMessage, 'back');
            }
            if ($cat === 0) {
                $theMessage = $formErrors[] = '<div class="alert alert-danger">category can\'t be empty</div>';
                redirectToHome($theMessage, 'back');
            }
            foreach ($formErrors as $error) {
                echo $error . '<br/>';
            }
            //end the validate

            if (empty($formErrors)) {    // this if to make sure that there is no errors an update all the data in data base

                // the next step will add new data in the database
                $stmt = $con->prepare("INSERT INTO items(name, description, price, addDate, countryMade, status, memberId, catId)
                                                              VALUES(:zname, :zdescription , :zprice , now(), :zcountryMade, :zstatus, :zmember, :zcat)");
                $stmt->execute([
                    'zname' => $name,
                    'zdescription' => $description,
                    'zprice' => $price,
                    'zcountryMade' => $countryMade,
                    'zstatus' => $status,
                    'zmember' => $member,
                    'zcat' => $cat
                ]);
                $theMessage = '<div class="container alert alert-success">' . $stmt->rowCount() . 'created</div>';
                redirectToHome($theMessage);
            }

        } else {
            $theMessage = '<div class="alert alert-danger container">' . 'you cant brows this page directely' . '</div>';
            redirectToHome($theMessage, 'back');
        }
        echo '</div>';


    } elseif ($do == 'edit') {

        $itemId = isset($_GET['itemId']) && is_numeric($_GET['itemId']) ? intval($_GET['itemId']) : 0; // to check if this user id number or no and get the integer val of it
        $stmt = $con->prepare("SELECT * FROM items WHERE itemId=?");    // hear we select all the data form the database depend on id
        $stmt->execute(array($itemId)); // to execute the query
        $item = $stmt->fetch();  // to bring the data form the database
        $count = $stmt->rowCount(); // to check if this row exist or not

        if ($count > 0) { // hear we say it the row exist and greater than 0 sho the form

            ?>
            <h1 class="text-center">Edit Item</h1>
            <div class="container">
                <form class="form-horizontal" action="?do=update" method="post">
                    <input type="hidden" name="itemId" value="<?php echo $itemId ?>">

                    <!-- start item name filed -->
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">item name</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $item['name']; ?>"
                                   placeholder="item name" required="required">
                        </div>
                    </div>
                    <!--end item name field -->

                    <!-- start item description filed -->
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">item description</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="username" name="description" value="<?php echo $item['description']; ?>"
                                   placeholder="item description" required="required">
                        </div>
                    </div>
                    <!--end item description field -->

                    <!-- start item price filed -->
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">item price</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="username" name="price" value="<?php echo $item['price']; ?>"
                                   placeholder="item price" required="required">
                        </div>
                    </div>
                    <!--end item price field -->

                    <!-- start item country made filed -->
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">item country</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="username" name="countryMade" value="<?php echo $item['countryMade']; ?>"
                                   placeholder="item made in" required="required">
                        </div>
                    </div>
                    <!--end item country made field -->

                    <!-- start item status filed -->
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">item status</label>
                        <div class="col-md-6">
                            <select class="form-control" name="status"  id="" required="required">
                                <option value="0">...</option>
                                <option value="1" <?php if ($item['status'] == 1){echo 'selected';}?>>New</option>
                                <option value="2" <?php if ($item['status'] == 2){echo 'selected';}?>>Like New</option>
                                <option value="3" <?php if ($item['status'] == 3){echo 'selected';}?>>Used</option>
                                <option value="4" <?php if ($item['status'] == 4){echo 'selected';}?>>Very old</option>
                            </select>
                        </div>
                    </div>
                    <!--end item status field -->

                    <!-- start get users to chose the status filed -->
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">user name</label>
                        <div class="col-md-6">
                            <select class="form-control" name="users"  id="" required="required">
                                <option value="0">...</option>
                                <?php
                                $stmt = $con->prepare("SELECT * FROM users");
                                $stmt->execute();
                                $users = $stmt->fetchAll();
                                foreach ($users as $user) {
                                    echo '<option value="' . $user['userId'] . ' " '; if ($item['memberId'] == $user['userId']){echo 'selected';}   echo '>'. $user['userName'] . '</option>';
                                }

                                ?>
                            </select>
                        </div>
                    </div>
                    <!--end get users to chose the status filed -->

                    <!-- start get category to chose the status filed -->
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">category name</label>
                        <div class="col-md-6">
                            <select class="form-control" name="categories" id="" required="required">
                                <option value="0">...</option>
                                <?php
                                $stmt = $con->prepare("SELECT * FROM categories");
                                $stmt->execute();
                                $categories = $stmt->fetchAll();
                                foreach ($categories as $categorie) {
                                    echo '<option value="' . $categorie['id'] . ' " '; if ($item['memberId'] == $categorie['id']){echo 'selected';}   echo '>' . $categorie['name'] . '</option>';
                                }

                                ?>
                            </select>
                        </div>
                    </div>
                    <!--end get category to chose the status filed -->


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
            redirectToHome($theMessage);
        }

    } elseif ($do == 'update') {
        echo '<h1 class="text-center">Update item</h1>';
        echo '<div class="container">';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['itemId'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $countryMade = $_POST['countryMade'];
            $status = $_POST['status'];
            $member = $_POST['users'];
            $categorie = $_POST['categories'];
            // start the validate
            $formErrors = array();
            if (empty($name)) {
                $theMessage = $formErrors[] = '<div class="alert alert-danger">name can\'t be <strong> empty</strong></div>';
                redirectToHome($theMessage, 'back');
            }
            if (empty($description)) {
                $theMessage = $formErrors[] = '<div class="alert alert-danger">description can\'t be empty</div>';
                redirectToHome($theMessage, 'back');
            }
            if (empty($price)) {
                $theMessage = $formErrors[] = '<div class="alert alert-danger">price can\'t be empty</div>';
                redirectToHome($theMessage, 'back');
            }
            if (empty($countryMade)) {
                $theMessage = $formErrors[] = '<div class="alert alert-danger">country can\'t be empty</div>';
                redirectToHome($theMessage, 'back');
            }
            if ($status === 0) {
                $theMessage = $formErrors[] = '<div class="alert alert-danger">status can\'t be empty</div>';
                redirectToHome($theMessage, 'back');
            }
            if ($member === 0) {
                $theMessage = $formErrors[] = '<div class="alert alert-danger">user can\'t be empty</div>';
                redirectToHome($theMessage, 'back');
            }
            if ($categorie === 0) {
                $theMessage = $formErrors[] = '<div class="alert alert-danger">category can\'t be empty</div>';
                redirectToHome($theMessage, 'back');
            }
            foreach ($formErrors as $error) {
                echo $error . '<br/>';
            }
            //end the validate

            if (empty($formErrors)) {    // this if to make sure that there is no errors an update all the data in data base
                // the next statment will put the data in the database
                $stmt = $con->prepare("UPDATE items SET name = ?, description = ?, price =?, countryMade = ?, status = ?, memberId = ?, catId = ? WHERE itemId = ? ");
                $stmt->execute(array($name, $description, $price, $countryMade, $status, $member, $categorie, $id));
//        print_r([$id,$user,$email,$pass,$name]);
                $theMessage = '<div class="container alert alert-success">' . $stmt->rowCount() . 'have been updated</div>';
                redirectToHome($theMessage,'back');

            }


        }
        echo '</div>';

    } elseif ($do == 'Delete') {
        $itemId = isset($_GET['itemId']) && is_numeric($_GET['itemId']) ? intval($_GET['itemId']) : 0; // to check if this user id number or no and get the integer val of it

        $check = checkItems('itemId', 'items', $itemId);// hear we select all the data form the database depend on id

        if ($check > 0) { // hear we say it the row exist and greater than 0 sho the form
            $stmt = $con->prepare("DELETE FROM items WHERE itemId = :zcat");
            $stmt->bindParam(':zcat',$itemId);
            $stmt->execute();
            $theMessage = '<div class="container alert alert-success" style="margin-top: 50px">have been deleted</div>';
            redirectToHome($theMessage,'back');

        }else {
            $theMessage = '<div class="container alert alert-danger" style="margin-top: 50px">this Id is not exist </div>';
            redirectToHome($theMessage);
        }

    } elseif ($do == 'approve') {
        echo '<h1 class="text-center">approve Member</h1>';
        $itemId = isset($_GET['itemId']) && is_numeric($_GET['itemId']) ? intval($_GET['itemId']) : 0; // to check if this user id number or no and get the integer val of it

        $check = checkItems('itemId', 'items', $itemId);// hear we select all the data form the database depend on id

        if (!empty($check)) {
            if ($check > 0) { // hear we say it the row exist and greater than 0 sho the form
                $stmt = $con->prepare("UPDATE items SET approve = 1 WHERE $itemId = ?");
                $stmt->execute([$itemId]);
                $theMessage = '<div class="container alert alert-success" style="margin-top: 50px">have been updated</div>';
                redirectToHome($theMessage,'back');

            }else {
                $theMessage = '<div class="container alert alert-danger" style="margin-top: 50px">this Id is not exist </div>';
                redirectToHome($theMessage);
            }
        }
    }
}
