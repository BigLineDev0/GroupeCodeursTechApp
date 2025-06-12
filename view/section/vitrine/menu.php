<div id="header" class="header navbar navbar-transparent navbar-fixed-top navbar-expand-lg">
     
        <div class="container">
            <a href="home" class="navbar-brand">
                <span class="brand-logo"></span>
                <span class="brand-text">
                    <span class="text-primary">Groupe</span> Codeurs
                </span>
            </a>
     
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#header-navbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
          
            <div class="collapse navbar-collapse" id="header-navbar">
                <ul class="nav navbar-nav navbar-right">
                    <li class="nav-item">
                        <a class="nav-link active" href="home" data-click="scroll-to-target" data-scroll-target="#home">ACCUEIL</a> 
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about" data-click="scroll-to-target">A PROPOS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#team" data-click="scroll-to-target">EQUIPES</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#service" data-click="scroll-to-target">SERVICES</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#work" data-click="scroll-to-target">REALISATIONS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#client" data-click="scroll-to-target">CLIENT</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#pricing" data-click="scroll-to-target">PRIX</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact" data-click="scroll-to-target">CONTACT</a>
                    </li>
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