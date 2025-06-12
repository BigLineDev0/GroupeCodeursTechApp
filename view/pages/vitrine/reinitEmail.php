<!DOCTYPE html>
<html lang="fr">
<!-- ================== Section loader ================== -->
<?php require_once("../../../view/section/login/head.php") ?>

<body class="pace-top">
    <!-- ================== Section loader ================== -->
    <?php require_once("../../../view/section/login/loader.php") ?>

    <!-- begin #page-container -->
    <div id="page-container" class="fade">
        <div class="login login-v1">

            <div class="login-container">

                <!-- Entete -->
                <div class="login-header">
                    <div class="brand">
                        <span class="logo"></span> <b>Confirmation</b>
                        <small>Réinitialisation de  mot de passe</small>
                    </div>
                    <div class="icon">
                        <i class="fa fa-lock"></i>
                    </div>
                </div>

                <!-- Form -->
                <div class="login-body">

                    <div class="login-content">
                        <form action="userMainController" method="POST" id="confirmEmailReinitForm" class="margin-bottom-0">

                            <!-- Email -->
                            <div class="form-group m-b-20">
                                <input type="text" id="confirmEmailReinit" name="email" class="form-control form-control-lg inverse-mode" placeholder="Adresse Email" required />
                                <p class="error-message"></p>
                            </div>

                            
                            <!-- Confirmeer -->
                            <div class="login-buttons">
                                <button type="submit" id="btnSubmitConfirmEmailReinit" name="frmConfirmEmailReinit" class="btn btn-success btn-block btn-lg">Confirmer</button>
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