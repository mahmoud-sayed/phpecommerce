

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
          <a class="navbar-brand" href="dashboard.php"><?php echo lang('shop_name') ?></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#app-nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="app-nav">
            <ul class="navbar-nav mr-auto">
              <li><a class="nav-link" href="categories.php"><?php echo lang('shop_Categories')?></a></li>
              <li><a class="nav-link" href="items.php"><?php echo lang('items')?></a></li>
              <li><a class="nav-link" href="members.php"><?php echo lang('members')?></a></li>
              <li><a class="nav-link" href="#"><?php echo lang('statistics')?></a></li>
              <li><a class="nav-link" href="comment.php"><?php echo lang('comments')?></a></li>
              <li><a class="nav-link" href="#"><?php echo lang('logs')?></a></li>
                <div class="col-lg-12">
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <?php echo lang('admin_name')?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="../index.php"><?php echo lang('index')?></a>
                      <a class="dropdown-item" href="members.php?do=edit&userId=<?php echo $_SESSION['id'] ?>"><?php echo lang('Edit')?></a>
                      <a class="dropdown-item" href="#"><?php echo lang('Settings')?></a>
                      <a class="dropdown-item" href="Logout.php"><?php echo lang('Logout')?></a>
                    </div>
                  </li>
                </div>
            </ul>
          </div>
    </div>
</nav>