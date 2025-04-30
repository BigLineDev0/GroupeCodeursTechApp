<!DOCTYPE html>
<html lang="fr">
	<!-- ================== SECTION HEAD ================== -->
	<?php require_once("view/section/vitrine/head.php") ?>
	
<body data-spy="scroll" data-target="#header" data-offset="51">
	
	<div id="page-container" class="fade">

		<!-- ================== SECTION MENU ================== -->
		<?php require_once("view/section/vitrine/menu.php") ?>
		
		<!-- ================== SECTION HOME ================== -->
		<?php require_once("view/section/vitrine/home.php") ?>
		
		<!-- ================== SECTION ABOUT ================== -->
		<?php require_once("view/section/vitrine/about.php") ?>
		
		<!-- ================== SECTION CHIFFRAGES ================== -->
		<?php require_once("view/section/vitrine/chiffreage.php") ?>
		
		<!-- ================== SECTION EQUIPE ================== -->
		<?php require_once("view/section/vitrine/team.php") ?>

		<!-- ================== SECTION QUOTE ================== -->
		<?php require_once("view/section/vitrine/quote.php") ?>
		
		<!-- ================== SECTION SERVICE ================== -->
		<?php require_once("view/section/vitrine/service.php") ?>
		
		<!-- ================== SECTION BOX ================== -->
		<?php require_once("view/section/vitrine/box.php") ?>
		
		<!-- ================== SECTION REALISATION ================== -->
		<?php require_once("view/section/vitrine/realisation.php") ?>
		
		<!-- ================== SECTION CLIENT ================== -->
		<?php require_once("view/section/vitrine/temoignage.php") ?>

		<!-- ================== SECTION PRINCING ================== -->
		<?php require_once("view/section/vitrine/princing.php") ?>

		<!-- ================== SECTION CONTACT ================== -->
		<?php require_once("view/section/vitrine/contact.php") ?>
		
		<!-- ================== SECTION FOOTER ================== -->
		<?php require_once("view/section/vitrine/footer.php") ?>
		
		<!-- ================== SECTION CONFIG ================== -->
		<?php require_once("view/section/vitrine/config.php") ?>

		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

		<!-- ================== Message Erreur/Success =============== -->
	   <?php require_once("view/section/admin/msgErreurSuccess.php") ?>
		
	</div>
	
	<!-- ================== BASE JS ================== -->
	<script src="public/template/templateVitrine/assets/js/one-page-parallax/app.min.js"></script>
	
</body>
</html>
