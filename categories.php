<?php
include 'init.php';
?>
<div class="container">
    <h1 class="text-center"><?php echo str_replace('-', ' ', $_GET['pageName']); ?></h1>
    <div class="container">
        <div class="row">
            <?php
            $pagId = $_GET['pageId'];
            foreach (getItem($pagId) as $item) {
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

<?php
include $tpl . 'footer.php';
?>
