
    <div id="header" class="header navbar-default">
       
        <div class="navbar-header">
            <a href="admin" class="navbar-brand"><span class="navbar-logo"></span> <b>Groupe</b> Codeurs</a>
            <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        
        <ul class="navbar-nav navbar-right">
            <li class="navbar-form">
                <form action="" method="POST" name="search">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Rechercher..." />
                        <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
                    </div>
                </form>
            </li>
            <li class="dropdown">
                <a href="#" data-toggle="dropdown" class="dropdown-toggle f-s-14">
                    <i class="fa fa-bell"></i>
                    <span class="label">5</span>
                </a>
                <div class="dropdown-menu media-list dropdown-menu-right">
                    <div class="dropdown-header">NOTIFICATIONS (5)</div>
                    <a href="javascript:;" class="dropdown-item media">
                        <div class="media-left">
                            <i class="fa fa-bug media-object bg-silver-darker"></i>
                        </div>
                        <div class="media-body">
                            <h6 class="media-heading">Server Error Reports <i class="fa fa-exclamation-circle text-danger"></i></h6>
                            <div class="text-muted f-s-10">3 minutes ago</div>
                        </div>
                    </a>
                    <a href="javascript:;" class="dropdown-item media">
                        <div class="media-left">
                            <img src="public/template/templateAdmin/assets/img/user/user-1.jpg" class="media-object" alt="" />
                            <i class="fab fa-facebook-messenger text-blue media-object-icon"></i>
                        </div>
                        <div class="media-body">
                            <h6 class="media-heading">John Smith</h6>
                            <p>Quisque pulvinar tellus sit amet sem scelerisque tincidunt.</p>
                            <div class="text-muted f-s-10">25 minutes ago</div>
                        </div>
                    </a>
                    <a href="javascript:;" class="dropdown-item media">
                        <div class="media-left">
                            <img src="public/template/templateAdmin/assets/img/user/user-2.jpg" class="media-object" alt="" />
                            <i class="fab fa-facebook-messenger text-blue media-object-icon"></i>
                        </div>
                        <div class="media-body">
                            <h6 class="media-heading">Olivia</h6>
                            <p>Quisque pulvinar tellus sit amet sem scelerisque tincidunt.</p>
                            <div class="text-muted f-s-10">35 minutes ago</div>
                        </div>
                    </a>
                    <a href="javascript:;" class="dropdown-item media">
                        <div class="media-left">
                            <i class="fa fa-plus media-object bg-silver-darker"></i>
                        </div>
                        <div class="media-body">
                            <h6 class="media-heading"> New User Registered</h6>
                            <div class="text-muted f-s-10">1 hour ago</div>
                        </div>
                    </a>
                    <a href="javascript:;" class="dropdown-item media">
                        <div class="media-left">
                            <i class="fa fa-envelope media-object bg-silver-darker"></i>
                            <i class="fab fa-google text-warning media-object-icon f-s-14"></i>
                        </div>
                        <div class="media-body">
                            <h6 class="media-heading"> New Email From John</h6>
                            <div class="text-muted f-s-10">2 hour ago</div>
                        </div>
                    </a>
                    <div class="dropdown-footer text-center">
                        <a href="javascript:;">View more</a>
                    </div>
                </div>
            </li>
            <li class="dropdown navbar-user">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="public/images/users/<?= $photo ?>" alt="Photo profil" />
                    <span class="d-none d-md-inline"><?= $email ?></span> <b class="caret"></b>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a href="javascript:;" class="dropdown-item">Edit Profile</a>
                    <a href="javascript:;" class="dropdown-item"><span class="badge badge-danger pull-right">2</span> Inbox</a>
                    <a href="javascript:;" class="dropdown-item">Calendar</a>
                    <a href="javascript:;" class="dropdown-item">Setting</a>
                    <div class="dropdown-divider"></div>
                    <a href="logout" class="dropdown-item">Se déconnecter</a>
                </div>
            </li>
        </ul>
    </div>