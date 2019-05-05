<?php 
    session_start();
    if (isset($_SESSION['userName'])) {
        include 'init.php';
        // start dashboard page
        ?>

        <div class="container home-stats text-center">
            <h1>Dashboard</h1>
            <div class="row">
                <div class="col-md-3">
                    <div class="status">Total Members<span>25</span></div>
                </div>
                <div class="col-md-3">
                    <div class="status">pending Members<span>25</span></div>
                </div>
                <div class="col-md-3">
                    <div class="status">total Items<span>25</span></div>
                </div>
                <div class="col-md-3">
                    <div class="status">total comments<span>25</span>   </div>
                </div>
            </div>
        </div>
        <div class="container latest">
            <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-users"></i>Latest registerd users
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">user1</li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-tag"></i>Latest item
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">item</li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>

        <?php
        // end dashboard page
        include $tpl . 'footer.php';
    }else{
        header('location: index.php');
        exit();
    }