<!DOCTYPE html>
<html lang="fr">
<!-- ================== Section loader ================== -->
<?php require_once("view/section/login/head.php") ?>

<body class="pace-top">
	<!-- ================== Section loader ================== -->
	<?php require_once("view/section/login/loader.php") ?>
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade">
		<!-- ================== Section form ================== -->
		<?php require_once("view/section/login/form.php") ?>
		
		<!-- ================== Section config ================== -->
		<?php require_once("view/section/login/config.php") ?>
		
		<!-- ================== Section Scroll top btn ================== -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		
	</div>
	
	<!-- ================== SECTION SCRIPT JS ================== -->
	<?php require_once("view/section/login/scripts.php") ?>

	<!-- ================== Message Erreur/Success =============== -->
	<?php require_once("view/section/admin/msgErreurSuccess.php") ?>
</body>
</html>