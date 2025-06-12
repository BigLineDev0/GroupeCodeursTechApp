<!DOCTYPE html>
<html lang="fr">
<!-- ================== Section loader ================== -->
<?php require_once("../../../view/section/login/head.php") ?>

<body class="pace-top">
    <!-- ================== Section loader ================== -->
    <?php require_once("../../../view/section/login/loader.php") ?>

    <?php 
        session_start();
        if (!$_SESSION['code']) {
            header("Location: reinitEmail?error=1&message=" . urldecode('lien corrompu !') . "&title=" . urldecode('Accès interdit !'));
            exit;
        }

    ?>
    <div id="page-container" class="fade">
        <div class="login login-v1">

            <div class="login-container">

                <!-- Entete -->
                <div class="login-header">
                    <div class="brand">
                        <span class="logo"></span> <b>Réinitialisation</b>
                        <small>Réinitialisation du mot de passe</small>
                    </div>
                    <div class="icon">
                        <i class="fa fa-lock"></i>
                    </div>
                </div>

                <!-- Form -->
                <div class="login-body">

                    <div class="login-content">
                        <form action="userMainController" method="POST" id="ReinitForm" class="margin-bottom-0">

                           <!-- New Password -->
                            <div class="form-group m-b-20">
                                <input type="password" id="new_password_reinit" name="new_password" class="form-control form-control-lg inverse-mode" placeholder="Nouveau Mot de passe" required />
                                <p class="error-message small"></p>
                            </div>

                            <!-- Confirm Password -->
                            <div class="form-group m-b-20">
                                <input type="password" id="confirm_password_reinit" name="confirm_password" class="form-control form-control-lg inverse-mode" placeholder="Mot de passe de confirmation" required />
                                <p class="error-message small"></p>
                            </div>

                            
                            <!-- Confirmer -->
                            <div class="login-buttons">
                                <button type="submit" id="btnSubmitReinit" name="frmReinit" class="btn btn-success btn-block btn-lg">Réinitialiser</button>
                            </div>

                        </form>
                    </div>

                </div>

            </div>

        </div>

        <!-- ================== Section config ================== -->
        <?php require_once("../../../view/section/login/config.php") ?>

        <!-- ================== Section Scroll top btn ================== -->
        <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>

    </div>

    <!-- ================== SECTION SCRIPT JS ================== -->
    <?php require_once("../../../view/section/login/scripts.php") ?>

    <!-- ================== Message Erreur/Success =============== -->
    <?php require_once("../../../view/section/admin/msgErreurSuccess.php") ?>
</body>

</html>