<?php
/*
 * this the template page i will uwe it in all pages
 * ==============================
 * ===category page
 * ==============================
 */

ob_start();
session_start();
$pagetitle = 'categoryes';
if (isset($_SESSION['userName'])) {
    include 'init.php';
    $do = isset($_GET['do']) ? $_GET['do'] : 'Manage';

    if ($do == 'Manage') {

        $sort = 'ASC';
        $sortArray = array('ASC','DESC');
        if (isset($_GET['sort']) && in_array($_GET['sort'], $sortArray)){
            $sort = $_GET['sort'];
        }
        $stmt2 = $con->prepare("SELECT * FROM categories ORDER BY ordering $sort");
        $stmt2->execute();
        $Categorys = $stmt2->fetchAll();
        if (!empty($Categorys)) {
            ?>
            <h1 class="text-center">Manage Category</h1>
            <div class="container">
                <div class="border-left" style="">
                    Ordering:
                    <a class="<?php if ($sort == 'ASC') {
                        echo 'btn btn-danger';
                    } ?>" href="categories.php?sort=ASC">ASC</a>
                    <a class="<?php if ($sort == 'DESC') {
                        echo 'btn btn-danger';
                    } ?>" href="categories.php?sort=DESC">DESC</a>
                </div>
                <table class="text-center table-bordered container ">
                    <thead class="btn-dark">
                    <tr>
                        <th>name</th>
                        <th>description</th>
                        <th>visibility</th>
                        <th>allowComment</th>
                        <th>allowAds</th>
                        <th>Control</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($Categorys as $Category) {
                        echo '<tr>';
                        echo '<td><h3>' . $Category['name'] . '</h3></td>';
                        echo '<td><p>';
                        if ($Category['description'] == '') {
                            echo 'there is no description';
                        } else {
                            echo $Category['description'];
                        }
                        echo '</p></td>';
                        echo '<td>';
                        if ($Category['visibility'] == 1) {
                            echo '<p class="btn btn-warning">Hidden</p>';
                        } else {
                            echo '';
                        }
                        echo '</td>';
                        echo '<td>';
                        if ($Category['allowComment'] == 1) {
                            echo '<p class="btn btn-warning">Commenting disabled</p>';
                        } else {
                            echo 'you can Comment';
                        }
                        echo '</td>';
                        echo '<td>';
                        if ($Category['allowAds'] == 1) {
                            echo '<p class="btn btn-warning">ads disabled</p>';
                        } else {
                            echo 'you can\'t add ads';
                        }
                        echo '</td>';
                        echo '<td>' .
                            '<a href="categories.php?do=edit&catId=' . $Category['id'] . '" class="btn btn-success confirm">' . '<i class="fa fa-edit"></i>' . 'Edit' . '</a>' .
                            '<a href="categories.php?do=Delete&catId=' . $Category['id'] . '" class="btn btn-danger confirm activate">' . '<i class="fa fa-trash"></i>' . 'Delete' . '</a>';
                        echo '</td>';
                        echo '</tr>';
                        echo 'sort';
                    }

                    ?>
                    </tbody>
                </table>
                <a href="categories.php?do=add" class="btn btn-primary" style="margin-top: 15px"><i
                            class="fa fa-plus"></i>New Category</a>
            </div>
            <?php
        }else{
            echo '<div class="container">';
            echo '<div class="alert-info" style="margin-top: 150px; font-size: 50px; text-align: center;">there is no Categorys yet</div>';
            echo'<a href="categories.php?do=add" class="btn btn-primary" style="margin-top: 15px"><i class="fa fa-plus"></i>New Category</a>';
            echo '</div>';
        }
            ?>
        <?php
    }elseif ($do == 'add'){
        ?>

        <!--start add new member-->
        <h1 class="text-center">Add Category</h1>
        <div class="container">
            <form class="form-horizontal" action="?do=insert" method="post">

                <!-- start name filed -->
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Category name</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="username" name="name"
                               placeholder="Category Name" required="required">
                    </div>
                </div>
                <!-- end name filed -->

                <!-- start Description filed -->
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="description" id="description"
                               placeholder="write your Description">
                    </div>
                </div>
                <!-- end Description filed -->

                <!-- start ordering filed -->
                <div class="form-group row ">
                    <label  class="col-sm-2 col-form-label">ordering</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control"  name="ordering" placeholder="you order">
                    </div>
                </div>
                <!-- end ordering filed -->

                <!-- start ordering filed -->
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">visible</label>
                    <div class="col-lg-1">
                        <div>
                            <input id="vis-yes" type="radio" class="" name="visibility" value="0" checked/>
                            <label for="vis-yes">Yes</label>
                        </div>
                        <div>
                            <input id="vis-no" type="radio" class="" name="visibility" value="1" />
                            <label for="vis-no">No</label>
                        </div>
                    </div>
                </div>
                <!-- start ordering filed -->

                <!-- start commenting filed -->
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Allow commenting</label>
                    <div class="col-lg-1">
                        <div>
                            <input id="com-yes" type="radio" class="" name="commenting" value="0" checked/>
                            <label for="com-yes">Yes</label>
                        </div>
                        <div>
                            <input id="com-no" type="radio" class="" name="commenting" value="1" />
                            <label for="com-no">No</label>
                        </div>
                    </div>
                </div>
                <!-- start commenting filed -->

                <!-- start ads filed -->
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Allow Ads</label>
                    <div class="col-lg-1">
                        <div>
                            <input id="ads-yes" type="radio" class="" name="Ads" value="0" checked/>
                            <label for="com-yes">Yes</label>
                        </div>
                        <div>
                            <input id="ads-no" type="radio" class="" name="Ads" value="1" />
                            <label for="ads-no">No</label>
                        </div>
                    </div>
                </div>
                <!-- start ads filed -->

                <!-- start ordering filed -->
                <div class="form-group row">
                    <div class="col-md-6">
                        <input type="submit" value="save" class="btn btn-primary"/>
                    </div>
                </div>
                <!-- end username filed -->
            </form>
        </div>
        <?php
    }elseif ($do == 'insert'){


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            echo '<h1 class="text-center">Insert Category</h1>';
            echo '<div class="container">';
            $name           = $_POST['name'];
            $description    = $_POST['description'];
            $order          = $_POST['ordering'];
            $visibility     = $_POST['visibility'];
            $commenting     = $_POST['commenting'];
            $Ads            = $_POST['Ads'];

                //check if the categories name exist in database or not
                $check = checkItems("name" , "categories" ,$name);
                if ($check == 1){
                    $theMessage = '<div class="alert alert-danger container">' . 'sorry this user exist' . '</div>' ;
                    redirectToHome ($theMessage,'back');
                }else {
                    // the next step will add new data in the database

                    $stmt = $con->prepare("INSERT INTO categories(name, description, ordering, visibility,allowComment,allowAds) VALUES(:zname, :zdescription , :zordering, :zvisibility,:zallowComment,:zallowAds)");
                    $stmt->execute([
                        'zname' => $name,
                        'zdescription' => $description,
                        'zordering' => $order,
                        'zvisibility' => $visibility,
                        'zallowComment' => $commenting,
                        'zallowAds' => $Ads
                    ]);
                    $theMessage = '<div class="container alert alert-success">' . $stmt->rowCount() . 'created</div>';
                    redirectToHome ($theMessage,'back');
                }

        }else{
            $theMessage = '<div class="alert alert-danger container">' . 'you cant brows this page directely' . '</div>';
            redirectToHome ($theMessage,'back');
        }
        echo '</div>';




    }elseif ($do == 'edit'){


        $catId = isset($_GET['catId']) && is_numeric($_GET['catId']) ? intval($_GET['catId']) : 0; // to check if this user id number or no and get the integer val of it

        $stmt = $con->prepare("SELECT * FROM categories WHERE id=?");    // hear we select all the data form the database depend on id
        $stmt->execute(array($catId)); // to execute the query
        $cat = $stmt->fetch();  // to bring the data form the database
        $count = $stmt->rowCount(); // to check if this row exist or not

        if ($count > 0) { // hear we say it the row exist and greater than 0 sho the form

            ?>
            <h1 class="text-center">Edit Category</h1>
        <div class="container">
            <form class="form-horizontal" action="?do=update" method="post">
            <input type="hidden" name="$catId" value="<?php echo $catId ?>"/>

                <!-- start name filed -->
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Category name</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="username" name="name"
                               placeholder="Category Name"  required="required" value="<?php echo $cat['name'];?>">
                    </div>
                </div>
                <!-- end name filed -->

                <!-- start Description filed -->
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" name="description" id="description"
                               placeholder="write your Description" value="<?php echo $cat['description'];?>">
                    </div>
                </div>
                <!-- end Description filed -->

                <!-- start ordering filed -->
                <div class="form-group row ">
                    <label  class="col-sm-2 col-form-label">ordering</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control"  name="ordering" placeholder="you order" value="<?php echo $cat['ordering'];?>">
                    </div>
                </div>
                <!-- end ordering filed -->

                <!-- start ordering filed -->
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">visible</label>
                    <div class="col-lg-1">
                        <div>
                            <input id="vis-yes" type="radio" class="" name="visibility" value="0" <?php if ($cat['visibility'] == 0 ){echo 'checked';} ?>/>
                            <label for="vis-yes">Yes</label>
                        </div>
                        <div>
                            <input id="vis-no" type="radio" class="" name="visibility" value="1" /<?php if ($cat['visibility'] == 1 ){echo 'checked';} ?>>
                            <label for="vis-no">No</label>
                        </div>
                    </div>
                </div>
                <!-- start ordering filed -->

                <!-- start commenting filed -->
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Allow commenting</label>
                    <div class="col-lg-1">
                        <div>
                            <input id="com-yes" type="radio" class="" name="allowComment" value="0" <?php if ($cat['allowComment'] == 0 ){echo 'checked';} ?>/>
                            <label for="com-yes">Yes</label>
                        </div>
                        <div>
                            <input id="com-no" type="radio" class="" name="allowComment" value="1" <?php if ($cat['allowComment'] == 1 ){echo 'checked';} ?> />
                            <label for="com-no">No</label>
                        </div>
                    </div>
                </div>
                <!-- start commenting filed -->

                <!-- start ads filed -->
                <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Allow Ads</label>
                    <div class="col-lg-1">
                        <div>
                            <input id="ads-yes" type="radio" class="" name="allowAds" value="0" <?php if ($cat['allowAds'] == 0 ){echo 'checked';} ?>/>
                            <label for="com-yes">Yes</label>
                        </div>
                        <div>
                            <input id="ads-no" type="radio" class="" name="allowAds" value="1" <?php if ($cat['allowAds'] == 1 ){echo 'checked';} ?>/>
                            <label for="ads-no">No</label>
                        </div>
                    </div>
                </div>
                <!-- start ads filed -->

                <!-- start ordering filed -->
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

    }elseif ($do == 'update')   {
        echo '<h1 class="text-center">Update Categories</h1>';
        echo '<div class="container">';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['$catId'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            $ordering = $_POST['ordering'];

            $visibility = $_POST['visibility'];
            $commenting = $_POST['allowComment'];
            $Ads = $_POST['allowAds'];

            // start the validate

            if (empty($user)) {
                $formErrors[] = '<div class="alert alert-danger">user name can\'t be empty</div>';
            }

            if (empty($formErrors)) {    // this if to make sure that there is no errors an update all the data in data base

                // the next statment will put the data in the database
                $stmt = $con->prepare("UPDATE categories SET name = ?, description = ?, ordering =?, visibility = ?, allowComment = ?, allowAds = ? WHERE id = ? ");
                $stmt->execute(array($name, $description, $ordering, $visibility, $commenting, $Ads, $id));
                $theMessage = '<div class="container alert alert-success">' . $stmt->rowCount() . 'have been updated</div>';
                redirectToHome($theMessage, $_SERVER['HTTP_REFERER' ] = 'categories.php');

            }


        }
        echo '</div>';

    }elseif ($do == 'Delete'){
        $catId = isset($_GET['catId']) && is_numeric($_GET['catId']) ? intval($_GET['catId']) : 0; // to check if this user id number or no and get the integer val of it

        $check = checkItems('id', 'categories', $catId);// hear we select all the data form the database depend on id

        if ($check > 0) { // hear we say it the row exist and greater than 0 sho the form
            $stmt = $con->prepare("DELETE FROM categories WHERE id = :zid");
            $stmt->bindParam(':zid',$catId);
            $stmt->execute();
            $theMessage = '<div class="container alert alert-success" style="margin-top: 50px">have been deleted</div>';
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
ob_end_flush();