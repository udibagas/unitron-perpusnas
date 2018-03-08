<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SMADING PERPUSNAS  </title>

    <!-- Bootstrap core CSS -->

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="css/custom.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/maps/jquery-jvectormap-2.0.1.css" />
    <link href="css/icheck/flat/green.css" rel="stylesheet" />
    <link href="css/floatexamples.css" rel="stylesheet" type="text/css" />

    <script src="js/jquery.min.js"></script>
    <script src="js/nprogress.js"></script>
    <script>
        NProgress.start();
    </script>

    <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>


<body class="nav-md">

    <div class="container body">


        <div class="main_container">

            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">

                    <div class="navbar nav_title" style="border: 0;">
                        <a href="home.php" class="site_title"><i class="fa fa-tachometer"></i> <span>SMADING PERPUSNAS 2016</span></a>
                    </div>
                    <div class="clearfix"></div>

                    <!-- menu prile quick info -->
                    <div class="profile">
                        <div class="profile_pic">
                            <img src="images/user.png" alt="..." class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Welcome,</span>
                            <h2>Admin</h2>
                        </div>
                    </div>
                    <!-- /menu prile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                        <div class="menu_section">
                            <h3>General</h3>
                            <ul class="nav side-menu">
                                <li><a href="home.php"><i class="fa fa-tachometer"></i> Ikhtisar </a>
                                </li>
                                 <li><a href="home.php"><i class="fa fa-comment"></i> Notifikasi </a>
                                </li>
                                <li><a><i class="fa fa-binoculars"></i> Pemantauan <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="#"><i class="fa fa-retweet"></i>Lingkungan</a>
                                        </li>
                                        <li><a href="#"><i class="fa fa-plug"></i>Kelistrikan</a>
                                        </li>
                                    </ul>
                                </li>

                                <li><a><i class="fa fa-tasks"></i> Rekaman <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="#"><i class="fa fa-bell"></i>Alarm</a>
                                        </li>
                                        <li><a href="#"><i class="fa fa-bolt"></i>Efiensi Listrik</a>
                                        </li>
                                        <li><a href="#"><i class="fa fa-exclamation-triangle"></i>Pemantauan Sensor</a>
                                        </li>
                                    </ul>
                                </li>


                              <li><a href="#"><i class="fa fa-tags"></i> Inventory </a>
                                </li>
                              <li><a href="#"><i class="fa fa-users"></i> Buku Tamu </a>
                                </li>

                             <li><a><i class="fa fa-sliders"></i> Pengaturan <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="#"><i class="fa fa-sort"></i>Min Max Sensor</a>
                                        </li>
                                        <li><a href="#"><i class="fa fa-volume-up"></i>Notifikasi Alarm</a>
                                        </li>
                                    </ul>
                                </li>

                            <li><a href="#"><i class="fa fa-sun-o"></i> Shutdown </a>
                                </li>

                        </div>

                    </div>
                    <!-- /sidebar menu -->

                    <!-- /menu footer buttons -->
                    <div class="sidebar-footer hidden-small">
                       <h5 align="center">Copyright 2015 SMADING PERPUSNAS v2</h5>
                    </div>
                    <!-- /menu footer buttons -->
                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">

                <div class="nav_menu">
                    <nav class="" role="navigation">
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>

                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <img src="images/user.png" alt="">Admin
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                    <li><a href="javascript:;">  Profil</a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <span class="badge bg-red pull-right">50%</span>
                                            <span>Pengaturan Akun</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">Bantuan</a>
                                    </li>
                                    <li><a href="login.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                    </li>
                                </ul>
                            </li>

                            <li role="presentation" class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-envelope-o"></i>
                                    <span class="badge bg-green">6</span>
                                </a>
                                <ul id="menu1" class="dropdown-menu list-unstyled msg_list animated fadeInDown" role="menu">
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="images/user.png" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>Alarm</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                        Alarm Di ruang Server A
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="images/user.png" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>Alarm</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                       Alarm Di ruang Server B
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="images/user.png" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>Alarm</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                         Alarm Di ruang Server C
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="images/user.png" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>Alarm</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                         Alarm Di ruang Server D
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="text-center">
                                            <a>
                                                <strong><a href="inbox.php">See All Alerts</strong>
                                                <i class="fa fa-angle-right"></i>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                    </nav>
                </div>

            </div>

            <!-- top navigation -->
            <div class="top_nav">

                <div class="nav_menu">
                    <nav class="" role="navigation">
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>

                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <img src="images/img.jpg" alt="">John Doe
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                    <li><a href="javascript:;">  Profile</a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                            <span class="badge bg-red pull-right">50%</span>
                                            <span>Settings</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">Help</a>
                                    </li>
                                    <li><a href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                    </li>
                                </ul>
                            </li>

                            <li role="presentation" class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-envelope-o"></i>
                                    <span class="badge bg-green">6</span>
                                </a>
                                <ul id="menu1" class="dropdown-menu list-unstyled msg_list animated fadeInDown" role="menu">
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="images/img.jpg" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where... 
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="images/img.jpg" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where... 
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="images/img.jpg" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where... 
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="images/img.jpg" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where... 
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="text-center">
                                            <a>
                                                <strong>See All Alerts</strong>
                                                <i class="fa fa-angle-right"></i>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                    </nav>
                </div>

            </div>
            <!-- /top navigation -->

            <!-- page content -->
           

                <div class="">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>Projects <small>Listing design</small></h3>
                        </div>

                        <div class="title_right">
                            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search for...">
                                    <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h2>Projects</h2>
                                    <ul class="nav navbar-right panel_toolbox">
                                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="#">Settings 1</a>
                                                </li>
                                                <li><a href="#">Settings 2</a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                                        </li>
                                    </ul>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-body">

                                    <p>Simple table with project listing with progress and editing options</p>

                                    <!-- start project list -->
                                    <table class="table table-striped projects">
                                        <thead>
                                            <tr>
                                                <th style="width: 1%">#</th>
                                                <th style="width: 20%">Project Name</th>
                                                <th>Team Members</th>
                                                <th>Project Progress</th>
                                                <th>Status</th>
                                                <th style="width: 20%">#Edit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>#</td>
                                                <td>
                                                    <a>Pesamakini Backend UI</a>
                                                    <br />
                                                    <small>Created 01.01.2015</small>
                                                </td>
                                                <td>
                                                    <ul class="list-inline">
                                                        <li>
                                                            <img src="http://localhost/personal/njoroge/assets3/img.jpg" class="avatar" alt="Avatar">
                                                        </li>
                                                        <li>
                                                            <img src="http://localhost/personal/njoroge/assets3/img.jpg" class="avatar" alt="Avatar">
                                                        </li>
                                                        <li>
                                                            <img src="http://localhost/personal/njoroge/assets3/img.jpg" class="avatar" alt="Avatar">
                                                        </li>
                                                        <li>
                                                            <img src="http://localhost/personal/njoroge/assets3/img.jpg" class="avatar" alt="Avatar">
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td class="project_progress">
                                                    <div class="progress progress_sm">
                                                        <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="57"></div>
                                                    </div>
                                                    <small>57% Complete</small>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-success btn-xs">Success</button>
                                                </td>
                                                <td>
                                                    <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
                                                    <a href="#" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                                    <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>#</td>
                                                <td>
                                                    <a>Pesamakini Backend UI</a>
                                                    <br />
                                                    <small>Created 01.01.2015</small>
                                                </td>
                                                <td>
                                                    <ul class="list-inline">
                                                        <li>
                                                            <img src="http://localhost/personal/njoroge/assets3/img.jpg" class="avatar" alt="Avatar">
                                                        </li>
                                                        <li>
                                                            <img src="http://localhost/personal/njoroge/assets3/img.jpg" class="avatar" alt="Avatar">
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td class="project_progress">
                                                    <div class="progress progress_sm">
                                                        <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="47"></div>
                                                    </div>
                                                    <small>47% Complete</small>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-success btn-xs">Success</button>
                                                </td>
                                                <td>
                                                    <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
                                                    <a href="#" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                                    <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>#</td>
                                                <td>
                                                    <a>Pesamakini Backend UI</a>
                                                    <br />
                                                    <small>Created 01.01.2015</small>
                                                </td>
                                                <td>
                                                    <ul class="list-inline">
                                                        <li>
                                                            <img src="http://localhost/personal/njoroge/assets3/img.jpg" class="avatar" alt="Avatar">
                                                        </li>
                                                        <li>
                                                            <img src="http://localhost/personal/njoroge/assets3/img.jpg" class="avatar" alt="Avatar">
                                                        </li>
                                                        <li>
                                                            <img src="http://localhost/personal/njoroge/assets3/img.jpg" class="avatar" alt="Avatar">
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td class="project_progress">
                                                    <div class="progress progress_sm">
                                                        <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="77"></div>
                                                    </div>
                                                    <small>77% Complete</small>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-success btn-xs">Success</button>
                                                </td>
                                                <td>
                                                    <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
                                                    <a href="#" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                                    <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>#</td>
                                                <td>
                                                    <a>Pesamakini Backend UI</a>
                                                    <br />
                                                    <small>Created 01.01.2015</small>
                                                </td>
                                                <td>
                                                    <ul class="list-inline">
                                                        <li>
                                                            <img src="http://localhost/personal/njoroge/assets3/img.jpg" class="avatar" alt="Avatar">
                                                        </li>
                                                        <li>
                                                            <img src="http://localhost/personal/njoroge/assets3/img.jpg" class="avatar" alt="Avatar">
                                                        </li>
                                                        <li>
                                                            <img src="http://localhost/personal/njoroge/assets3/img.jpg" class="avatar" alt="Avatar">
                                                        </li>
                                                        <li>
                                                            <img src="http://localhost/personal/njoroge/assets3/img.jpg" class="avatar" alt="Avatar">
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td class="project_progress">
                                                    <div class="progress progress_sm">
                                                        <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="60"></div>
                                                    </div>
                                                    <small>60% Complete</small>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-success btn-xs">Success</button>
                                                </td>
                                                <td>
                                                    <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
                                                    <a href="#" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                                    <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>#</td>
                                                <td>
                                                    <a>Pesamakini Backend UI</a>
                                                    <br />
                                                    <small>Created 01.01.2015</small>
                                                </td>
                                                <td>
                                                    <ul class="list-inline">
                                                        <li>
                                                            <img src="http://localhost/personal/njoroge/assets3/img.jpg" class="avatar" alt="Avatar">
                                                        </li>
                                                        <li>
                                                            <img src="http://localhost/personal/njoroge/assets3/img.jpg" class="avatar" alt="Avatar">
                                                        </li>
                                                        <li>
                                                            <img src="http://localhost/personal/njoroge/assets3/img.jpg" class="avatar" alt="Avatar">
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td class="project_progress">
                                                    <div class="progress progress_sm">
                                                        <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="12"></div>
                                                    </div>
                                                    <small>12% Complete</small>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-success btn-xs">Success</button>
                                                </td>
                                                <td>
                                                    <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
                                                    <a href="#" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                                    <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>#</td>
                                                <td>
                                                    <a>Pesamakini Backend UI</a>
                                                    <br />
                                                    <small>Created 01.01.2015</small>
                                                </td>
                                                <td>
                                                    <ul class="list-inline">
                                                        <li>
                                                            <img src="http://localhost/personal/njoroge/assets3/img.jpg" class="avatar" alt="Avatar">
                                                        </li>
                                                        <li>
                                                            <img src="http://localhost/personal/njoroge/assets3/img.jpg" class="avatar" alt="Avatar">
                                                        </li>
                                                        <li>
                                                            <img src="http://localhost/personal/njoroge/assets3/img.jpg" class="avatar" alt="Avatar">
                                                        </li>
                                                        <li>
                                                            <img src="http://localhost/personal/njoroge/assets3/img.jpg" class="avatar" alt="Avatar">
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td class="project_progress">
                                                    <div class="progress progress_sm">
                                                        <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="35"></div>
                                                    </div>
                                                    <small>35% Complete</small>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-success btn-xs">Success</button>
                                                </td>
                                                <td>
                                                    <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
                                                    <a href="#" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                                    <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>#</td>
                                                <td>
                                                    <a>Pesamakini Backend UI</a>
                                                    <br />
                                                    <small>Created 01.01.2015</small>
                                                </td>
                                                <td>
                                                    <ul class="list-inline">
                                                        <li>
                                                            <img src="http://localhost/personal/njoroge/assets3/img.jpg" class="avatar" alt="Avatar">
                                                        </li>
                                                        <li>
                                                            <img src="http://localhost/personal/njoroge/assets3/img.jpg" class="avatar" alt="Avatar">
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td class="project_progress">
                                                    <div class="progress progress_sm">
                                                        <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="87"></div>
                                                    </div>
                                                    <small>87% Complete</small>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-success btn-xs">Success</button>
                                                </td>
                                                <td>
                                                    <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
                                                    <a href="#" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                                    <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>#</td>
                                                <td>
                                                    <a>Pesamakini Backend UI</a>
                                                    <br />
                                                    <small>Created 01.01.2015</small>
                                                </td>
                                                <td>
                                                    <ul class="list-inline">
                                                        <li>
                                                            <img src="http://localhost/personal/njoroge/assets3/img.jpg" class="avatar" alt="Avatar">
                                                        </li>
                                                        <li>
                                                            <img src="http://localhost/personal/njoroge/assets3/img.jpg" class="avatar" alt="Avatar">
                                                        </li>
                                                        <li>
                                                            <img src="http://localhost/personal/njoroge/assets3/img.jpg" class="avatar" alt="Avatar">
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td class="project_progress">
                                                    <div class="progress progress_sm">
                                                        <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="77"></div>
                                                    </div>
                                                    <small>77% Complete</small>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-success btn-xs">Success</button>
                                                </td>
                                                <td>
                                                    <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
                                                    <a href="#" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                                    <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>#</td>
                                                <td>
                                                    <a>Pesamakini Backend UI</a>
                                                    <br />
                                                    <small>Created 01.01.2015</small>
                                                </td>
                                                <td>
                                                    <ul class="list-inline">
                                                        <li>
                                                            <img src="http://localhost/personal/njoroge/assets3/img.jpg" class="avatar" alt="Avatar">
                                                        </li>
                                                        <li>
                                                            <img src="http://localhost/personal/njoroge/assets3/img.jpg" class="avatar" alt="Avatar">
                                                        </li>
                                                        <li>
                                                            <img src="http://localhost/personal/njoroge/assets3/img.jpg" class="avatar" alt="Avatar">
                                                        </li>
                                                        <li>
                                                            <img src="http://localhost/personal/njoroge/assets3/img.jpg" class="avatar" alt="Avatar">
                                                        </li>
                                                    </ul>
                                                </td>
                                                <td class="project_progress">
                                                    <div class="progress progress_sm">
                                                        <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="77"></div>
                                                    </div>
                                                    <small>77% Complete</small>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-success btn-xs">Success</button>
                                                </td>
                                                <td>
                                                    <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
                                                    <a href="#" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                                    <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!-- end project list -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- footer content -->
                <footer>
                    <div class="">
                        <p class="pull-right">Gentelella Alela! a Bootstrap 3 template by <a>Kimlabs</a>. |
                            <span class="lead"> <i class="fa fa-paw"></i> Gentelella Alela!</span>
                        </p>
                    </div>
                    <div class="clearfix"></div>
                </footer>
                <!-- /footer content -->

            </div>
            <!-- /page content -->
        </div>

    </div>

    <div id="custom_notifications" class="custom-notifications dsp_none">
        <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
        </ul>
        <div class="clearfix"></div>
        <div id="notif-group" class="tabbed_notifications"></div>
    </div>

    <script src="js/bootstrap.min.js"></script>

    <!-- chart js -->
    <script src="js/chartjs/chart.min.js"></script>
    <!-- bootstrap progress js -->
    <script src="js/progressbar/bootstrap-progressbar.min.js"></script>
    <script src="js/nicescroll/jquery.nicescroll.min.js"></script>
    <!-- icheck -->
    <script src="js/icheck/icheck.min.js"></script>

    

</body>

</html>