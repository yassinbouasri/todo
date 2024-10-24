<?php $base_url = "/todo/"; ?>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">

        <div class="navbar-header">

            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand" href="/">Todo</a>
        </div>


        <div class="collapse navbar-collapse" id="myNavbar">

            <ul class="nav navbar-nav">
                <li class="active"><a href="/">Home</a></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Tasks <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/task/create">Add Task</a></li>
                        <li><a href="/">Show Tasks</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Categories <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/category/show">Show Categories</a></li>
                        <li><a href="/category/create">Add Category</a></li>
                    </ul>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"> <span class="glyphicon glyphicon-user"></span>  Account<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/changePassword">Settings</a></li>
                        <li><a href="/logout">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

