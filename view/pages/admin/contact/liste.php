<!DOCTYPE html>
<html lang="fr">
<!-- ================== SECTION HEAD ================== -->
<?php require_once("../../../section/admin/head.php") ?>

<!-- ================== Vérification session ================== -->
<?php require_once("../../../section/admin/verifySession.php") ?>

<body>
	
	<!-- ================== Récupération liste contacts dans la BD ================== -->
	<?php
		require_once('../../../../model/contactRepository.php');
		$contactRepository = new contactRepository();
		try {
			$listeContacts = $contactRepository->getAll();

		} catch (Exception $error) {
			"<p>Erreur lors du chargement de la liste des contacts ".$error->getMessage() . "</p>";
			$listeContacts = [];
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
				
				<li id="btn-show-liste-user" class="breadcrumb-item">
					<a href="#"  class="btn btn-sm btn-dark text-white">Contacts</a>
				</li>

				<li id="btn-show-corbeille-user" class="breadcrumb-item">
					<a href="listeServiceRea" class="btn btn-sm btn-dark text-white">Réalisations</a>
				</li>

				
				
			</ol>
			
			<h1 class="page-header"># contacts</h1>
			
			<!-- Liste contact -->
			<div id="table-liste-user" class="panel panel-inverse">
				
				<div class="panel-heading">
					<h4 class="panel-title">Liste contacts</h4>
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
								<th width="1%" data-orderable="false">Nom</th>
								<th class="text-nowrap text-center">Email</th>
								<th class="text-nowrap text-center">Sujet</th>
								<th class="text-nowrap text-center">Message</th>
								<th class="text-nowrap text-center">Créer le</th>
							</tr>
						</thead>
						<tbody>
							<?php if(!empty($listeContacts)) : ?>
								<?php foreach($listeContacts as $contact) : ?>
									<tr class="odd gradeX">

										<!-- Nom -->
										<td width="1%" class="with-img text-center">
											<?= htmlspecialchars($contact['nom'])?>
										</td>

										<!-- Email -->
										<td class="text-center">
											<?= htmlspecialchars($contact['email'])?>
										</td>

										<!-- Sujet -->
										<td class="text-center">
											<?= htmlspecialchars($contact['sujet'])?>
										</td>

										<!-- Message -->
										<td class="text-center">
											
											<span data-toggle="tooltip" data-placement="top" title="<?= htmlspecialchars($contact['message'])?>">
												<?= htmlspecialchars(mb_substr($contact['message'], 0, 20)) .
												(strlen($contact['message']) > 20 ? '...' : '')?>
											</span>
										</td>
										
										<!-- Date de création-->
										<td class="text-center">
											<?= htmlspecialchars(date('d/m/Y à H:i'), strtotime($contact['created_at']))?> </br>
										</td>
										
									</tr>
								<?php endforeach ?>
							<?php else : ?>
								<p class="alert alert-danger text-center h4 fw-bold">La liste des contacts est vide.</p>
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

	<!-- ================== SECTION SCRIPT JS ================== -->
	<?php require_once("../../../section/admin/script.php") ?>

	<!-- ================== Message Erreur/Success =============== -->
	<?php require_once("../../../section/admin/msgErreurSuccess.php") ?>

</body>

</html>