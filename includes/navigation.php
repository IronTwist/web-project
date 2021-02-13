

<nav class="navbar navbar-expand-md navbar-light">
<p class="navLogo">MyPlace</p>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#myNav" aria-controls="myNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="myNav">
        <ul class="navbar-nav mr-auto ">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>

            <?php if(!isset($_SESSION["logat"]) || $_SESSION["logat"] == false){ ?>
                <li class="nav-item">
                    <a class="nav-link" href="register.php">Register</a>
                </li>
            <?php } ?>
            <?php if(isset($_SESSION["logat"]) && $_SESSION["logat"] == true){ ?>
                <li class="nav-item">
                    <a class="nav-link" href="index.php">MyPlace</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="photos.php">Photos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="my_posts">Friends</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="profile.php">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            <?php } ?>
        </ul>
        <form target="search.php" method="get">
            <input class="form-control" name="search" type="text" placeholder="Search" aria-label="Search">
        </form>
    </div>
</nav>