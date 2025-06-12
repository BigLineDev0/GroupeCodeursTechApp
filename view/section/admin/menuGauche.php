<div id="sidebar" class="sidebar">
    <div data-scrollbar="true" data-height="100%">
        <ul class="nav">
            <li class="nav-profile">
                <a href="javascript:;" data-toggle="nav-profile">
                    <div class="cover with-shadow"></div>
                    <div class="image">
                        <img src="public/images/users/<?= $photo ?>" alt="Photo profil" />
                    </div>
                    <div class="info">
                        <b class="caret pull-right"></b><?= $nom ?>
                        <small><?= $email ?></small>
                    </div>
                </a>
            </li>
            <li>
                <ul class="nav nav-profile">
                    <li><a href="logout"><i class="fa fa-sign-out-alt"></i> Se décconecter</a></li>
                </ul>
            </li>
        </ul>
        <ul class="nav">
            
            <!-- Dashboard -->
            <li class="has-sub active">
                <a href="admin">
                    <i class="fa fa-th-large"></i>
                    <span>Tableau de bord</span>
                </a>
            </li>

            <!-- Profil -->
            <li class="has-sub">
                <a href="#">
                    <i class="fa fa-user-circle"></i>
                    <span>Profil</span>
                </a>
            </li>

            <!-- ServiceRéa -->
            <li class="has-sub">
                <a href="listeServiceRea">
                    <i class="fa fa-cogs"></i>
                    <span>Service / Réalisation</span>
                </a>
            </li>

            <!-- Newsletter -->
            <li class="has-sub">
                <a href="listeNewsletter">
                    <i class="fa fa-envelope"></i>
                    <span>Newsletter</span>
                </a>
            </li>

            <!-- Contact -->
            <li class="has-sub">
                <a href="listeContact">
                    <i class="fa fa-tty"></i>
                    <span>Contact</span>
                </a>
            </li>

            <!-- Utilisateur -->
            <li class="has-sub">
                <a href="listeUser">
                    <i class="fa fa-user"></i>
                    <span>Utilisateur</span>
                </a>
            </li>

             <!-- Déconnexion -->
             <li class="has-sub">
                <a href="logout">
                    <i class="fa fa-sign-out-alt"></i>
                    <span>Déconnexion</span>
                </a>
            </li>

            <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
        </ul>
    </div>
</div>
<div class="sidebar-bg"></div>