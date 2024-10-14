<?php $base_url = "/todo/"; ?>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">

        <div class="navbar-header">

            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand" href="?controller=task&method=index">Todo</a>
        </div>


        <div class="collapse navbar-collapse" id="myNavbar">

            <ul class="nav navbar-nav">
                <li class="active"><a href="?controller=task&method=index">Home</a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Tasks <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="?controller=task&method=create">Add Task</a></li>
                        <li><a href="<?php echo $base_url; ?>app/views/home.php">Show Tasks</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Categories <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="?controller=categories&method=showCategories">Show Categories</a></li>
                        <li><a href="<?php echo $base_url; ?>app/views/categories/addCategory.php">Add Category</a></li>
                    </ul>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li><a href="login/register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                <li><a href="login/login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
            </ul>
        </div>
    </div>
</nav>

