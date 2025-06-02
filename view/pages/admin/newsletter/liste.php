<!DOCTYPE html>
<html lang="fr">
<!-- ================== SECTION HEAD ================== -->
<?php require_once("../../../section/admin/head.php") ?>

<!-- ================== Vérification session ================== -->
<?php require_once("../../../section/admin/verifySession.php") ?>

<body>
	
	<!-- ================== Récupération liste newsletters dans la BD ================== -->
	<?php
		require_once('../../../../model/NewsletterRepository.php');
		$newsletterRepository = new NewsletterRepository();
		try {
			$listenewsletters = $newsletterRepository->getAll();

		} catch (Exception $error) {
			"<p>Erreur lors du chargement de la liste des newsletters ".$error->getMessage() . "</p>";
			$listenewsletters = [];
		}
	?>

	<!-- ================== SECTION LOADER ================== -->
	<div id="page-loader" class="fade show">
		<span class="spinner"></span>
	</div>

	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">

		<!-- ================== SECTION MENU HAUT ================== -->
		<?php require_once("../../../section/admin/menuHaut.php") ?>

		<!-- ================== SECTION MENU GAUCHE ================== -->
		<?php require_once("../../../section/admin/menuGauche.php") ?>

		<!-- ================== SECTION BASE CONTENT ================== -->
		<div id="content" class="content">
			<ol class="breadcrumb float-xl-right">
				<li class="breadcrumb-item">
					<a href="#modal-send-newsletter" class="btn btn-sm btn-dark text-white" data-toggle="modal">Enoyer un message aux abonnés</a>
				</li>

				<li id="btn-show-liste-user" class="breadcrumb-item">
					<a href="listeContact" class="btn btn-sm btn-dark text-white">Contact</a>
				</li>

				<li id="btn-show-corbeille-user" class="breadcrumb-item">
					<a href="listeServiceRea" class="btn btn-sm btn-dark text-white">Réalisations</a>
				</li>
			</ol>
			
			<h1 class="page-header"># Newsletters</h1>
			
			<!-- Liste newsletter -->
			<div id="table-liste-user" class="panel panel-inverse">
				
				<div class="panel-heading">
					<h4 class="panel-title">Liste Newsletters</h4>
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
				</div>

				<div class="panel-body">
					<table id="data-table-default" class="table table-striped table-bordered table-td-valign-middle">
						<thead>
							<tr>
								<th class="text-nowrap text-center">Email</th>
								<th class="text-nowrap text-center">Créer le</th>
							</tr>
						</thead>
						<tbody>
							<?php if(!empty($listenewsletters)) : ?>
								<?php foreach($listenewsletters as $newsletter) : ?>
									<tr class="odd gradeX">

										<!-- Email -->
										<td class="text-center">
											<?= htmlspecialchars($newsletter['email'])?>
										</td>

										<!-- Date de création-->
										<td class="text-center">
											<?= htmlspecialchars(date('d/m/Y à H:i'), strtotime($newsletter['created_at']))?> </br>
										</td>
										
									</tr>
								<?php endforeach ?>
							<?php else : ?>
								<p class="alert alert-danger text-center h4 fw-bold">La liste des newsletters est vide.</p>
							<?php endif ?>
						</tbody>
					</table>
				</div>
			</div>

			

		</div>

		<!-- ================== SECTION CONFIG ================== -->
		<?php require_once("../../../section/admin/config.php") ?>

		<!-- ================== SECTION SCROL ================== -->
		<?php require_once("../../../section/admin/scrol.php") ?>

	</div>

	<!-- ========== MODAL SEND MESSAGE AUX ABONNES ========== -->
	<div class="modal fade" id="modal-send-newsletter" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog">
			<div class="modal-content">

				<div class="modal-header">
					<h4 class="modal-title">Envoyer un message aux abonnés</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				
				<div class="modal-body">
					<form id="sendMessageForm" action="newsletterMainController" method="POST">

						<!-- Description -->
						<div class="mb-3">
							<label for="message" class="form-label">Message</label>
							<textarea name="message" class="form-control" id="message" rows="3" placeholder="Ecrivez votre message" required></textarea>
							<p class="error-message mt-2"></p>
						</div>

						<!-- Btn soumition -->
						<div style="display: flex; justify-content: center;">
							<button type="submit" name="frmSendMessage" class="btn btn-primary fw-bold">Envoyer</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- ================== SECTION SCRIPT JS ================== -->
	<?php require_once("../../../section/admin/script.php") ?>

	<!-- ================== Message Erreur/Success =============== -->
	<?php require_once("../../../section/admin/msgErreurSuccess.php") ?>

</body>

</html>