
<!DOCTYPE html>
<html lang="fr">
    <!-- ================== SECTION HEAD ================== -->
	<?php require_once("view/section/admin/head.php") ?>
<body>
	
	<!-- ================== Vérification session ================== -->
	<?php require_once("view/section/admin/verifySession.php") ?>

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