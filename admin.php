<!DOCTYPE html>
<html lang="fr">
    <!-- ================== SECTION HEAD ================== -->
	<?php require_once("view/section/admin/head.php") ?>
<body>
	
	<!-- ================== Vérification session ================== -->
	<?php 
		session_start();
		if (!$_SESSION['email']) {
			header("Location: login?error=1&message=" . urldecode('Merci de vous connecter') . "&title=" . urldecode('Accès interdit !'));
			exit;
		}
	?>

	<!-- ================== SECTION LOADER ================== -->
	<div id="page-loader" class="fade show">
		<span class="spinner"></span>
	</div>
	
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
		
        <!-- ================== SECTION MENU HAUT ================== -->
		<?php require_once("view/section/admin/menuHaut.php") ?>
		
		<!-- ================== SECTION MENU GAUCHE ================== -->
		<?php require_once("view/section/admin/menuGauche.php") ?>
		
		<!-- ================== SECTION BASE CONTENT ================== -->
		<?php require_once("view/section/admin/baseContent.php") ?>
		
		<!-- ================== SECTION CONFIG ================== -->
		<?php require_once("view/section/admin/config.php") ?>
		
		<!-- ================== SECTION SCROL ================== -->
		<?php require_once("view/section/admin/scrol.php") ?>
		
	</div>
	
	<!-- ================== SECTION SCRIPT JS ================== -->
	<?php require_once("view/section/admin/script.php") ?>
	
	<!-- ================== Message Erreur/Success =============== -->
	<?php require_once("view/section/admin/msgErreurSuccess.php") ?>

</body>
</html>