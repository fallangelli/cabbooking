<div class="container-fluid">
    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </a>
    <a class="brand" href="#">ETI Administration</a>
    <div class="btn-group pull-right">
        <a class="btn" href="edit_profile.php"><i class="icon-user"></i> <?php echo $_SESSION['admin_username']; ?></a>
        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
            <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
            <li><a href="edit_profile.php">Profile</a></li>
            <li class="divider"></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    <div class="nav-collapse">
        <ul class="nav">
            <li><a href="index.php">Home</a></li>
            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Users <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="new-user.html">New User</a></li>
                    <li class="divider"></li>
                    <li><a href="users.html">Manage Users</a></li>
                </ul>
            </li>
            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Roles <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="new-role.html">New Role</a></li>
                    <li class="divider"></li>
                    <li><a href="roles.html">Manage Roles</a></li>
                </ul>
            </li>
            <!--<li><a href="stats.html">Stats</a></li>-->
        </ul>
    </div>
</div>