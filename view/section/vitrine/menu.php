<div id="header" class="header navbar navbar-transparent navbar-fixed-top navbar-expand-lg">
        <!-- begin container -->
        <div class="container">
            <!-- begin navbar-brand -->
            <a href="home" class="navbar-brand">
                <span class="brand-logo"></span>
                <span class="brand-text">
                    <span class="text-primary">Color</span> Admin
                </span>
            </a>
            <!-- end navbar-brand -->
            <!-- begin navbar-toggle -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#header-navbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- end navbar-header -->
            <!-- begin navbar-collapse -->
            <div class="collapse navbar-collapse" id="header-navbar">
                <ul class="nav navbar-nav navbar-right">
                    <li class="nav-item dropdown">
                        <a class="nav-link active" href="#home" data-click="scroll-to-target" data-scroll-target="#home">ACCUEIL <b class="caret"></b></a>
                        <div class="dropdown-menu dropdown-menu-left animated fadeInDown">
                            <a class="dropdown-item" href="index.html">Page with Transparent Header</a>
                            <a class="dropdown-item" href="index_inverse_header.html">Page with Inverse Header</a>
                            <a class="dropdown-item" href="index_default_header.html">Page with White Header</a>
                            <a class="dropdown-item" href="extra_element.html">Extra Element</a>
                        </div>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#about" data-click="scroll-to-target">A PROPOS</a></li>
                    <li class="nav-item"><a class="nav-link" href="#team" data-click="scroll-to-target">EQUIPES</a></li>
                    <li class="nav-item"><a class="nav-link" href="#service" data-click="scroll-to-target">SERVICES</a></li>
                    <li class="nav-item"><a class="nav-link" href="#work" data-click="scroll-to-target">REALISATIONS</a></li>
                    <li class="nav-item"><a class="nav-link" href="#client" data-click="scroll-to-target">CLIENT</a></li>
                    <li class="nav-item"><a class="nav-link" href="#pricing" data-click="scroll-to-target">PRICING</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact" data-click="scroll-to-target">CONTACT</a></li>
                    <?php 
                        session_start();
                        if (isset($_SESSION['email'])): ?>
                            <li class="nav-item">
                                <a href="admin" class="nav-link">
                                    <span class="brand-text">
                                        <span class="text-primary text-uppercase"><?php echo $_SESSION['nom']; ?></span> 
                                    </span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="logout" class="nav-link">SE DECONNECTER</a>
                            </li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="login">CONNEXION</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>