<!DOCTYPE html>
<html lang="fr">
<!-- ================== SECTION HEAD ================== -->
<?php require_once("../../../section/admin/head.php") ?>

<!-- ================== Vérification session ================== -->
<?php require_once("../../../section/admin/verifySession.php") ?>

<body>
	
	<!-- ================== Récupération liste servicesRea dans la BD ================== -->
	<?php
		require_once('../../../../model/ServiceReaRepository.php');
		$serviceReaRepository = new ServiceReaRepository();
		try {
			$listeServiceReas = $serviceReaRepository->getAll(1);
			$serviceReasSupprimes = $serviceReaRepository->getAll(0);
		} catch (Exception $error) {
			"<p>Erreur lors du chargement de la liste des serviceReas ".$error->getMessage() . "</p>";
			$listeServiceReas = [];
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
				<li class="breadcrumb-item"><a href="#modal-add-service-rea" class="btn btn-sm btn-dark text-white" data-toggle="modal">Ajouter</a></li>
				<li id="btn-show-liste" class="breadcrumb-item"><a href="#"  class="btn btn-sm btn-dark text-white">Afficher liste</a></li>
				<li id="btn-show-corbeille" class="breadcrumb-item"><a href="#" class="btn btn-sm btn-dark text-white">Afficher Corbeille</a></li>
				<li id="btn-show-liste" class="breadcrumb-item"><a href="listeUser" class="btn btn-sm btn-dark text-white">Utilisateur</a></li>
			</ol>
			
			<h1 class="page-header"># Service / Réalisation</h1>
			
			<!-- Liste service / réalisation -->
			<div id="table-liste" class="panel panel-inverse">
				
				<div class="panel-heading">
					<h4 class="panel-title">Liste Service / Réalisation</h4>
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
								<th width="1%" data-orderable="false">Photo</th>
								<th class="text-nowrap text-center">Nom</th>
								<th class="text-nowrap text-center">Description</th>
								<th class="text-nowrap text-center">Type</th>
								<th class="text-nowrap text-center">Créer le</th>
								<th class="text-nowrap text-center">Modifier le</th>
								<th class="text-nowrap text-center">Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php if(!empty($listeServiceReas)) : ?>
								<?php foreach($listeServiceReas as $serviceRea) : ?>
									<tr class="odd gradeX">

										<!-- Photo -->
										<td width="1%" class="with-img text-center">
											<?php if(!empty($serviceRea['photo'])) : ?>
												<img src="public/images/servicesRea/<?= htmlspecialchars($serviceRea['photo'])?>" style="width: 40px;" class="img-rounded height-30" />
											<?php else : ?>
												<img src="public/images/servicesRea/default.jpg" class="img-rounded height-30" />
											<?php endif ?>
										</td>

										<!-- Nom -->
										<td class="text-center"><?= htmlspecialchars($serviceRea['nom'])?></td>

										<!-- Description -->
										<td class="text-center">
											<span data-toggle="tooltip" data-placement="top" title="<?= htmlspecialchars($serviceRea['description']) ?>">
												<?= htmlspecialchars(mb_substr($serviceRea['description'], 0, 20)) .
												(strlen($serviceRea['description']) > 20 ? '...' : '')?>
											</span>
										</td>

										<!-- Type -->
										<td class="text-center">
											<?= htmlspecialchars($serviceRea['type'] == 'R' ?'Réalisation' : 'Service')?>
										</td>

										<!-- Date de création-->
										<td class="text-center">
											<?= htmlspecialchars(date('d/m/Y à H:i'), strtotime($serviceRea['created_at']))?> </br>
											par <?= htmlspecialchars($serviceRea['created_by_name'])?>
										</td>

										<!-- Date de modification -->
										<td class="text-center">
											<?php if($serviceRea['updated_at']) :?>
												<?= htmlspecialchars(date('d/m/Y à H:i'), strtotime($serviceRea['updated_at']))?> </br>
												par <?= htmlspecialchars($serviceRea['updated_by_name'])?>
											<?php else :?>
												<span class='text-danger fw-bold'>Jamais modifier</span>
											<?php endif?>
										</td>

										<!-- Actions -->
										<td class="text-center">
											<!-- Edit -->
											<a href="javascript:;"
												class="btn-edit"
												data-id="<?= htmlspecialchars($serviceRea['id'])?>"
												data-nom="<?= htmlspecialchars($serviceRea['nom'])?>"
												data-description="<?= htmlspecialchars($serviceRea['description'])?>"
												data-type="<?= htmlspecialchars($serviceRea['type'])?>"
												data-photo="<?= htmlspecialchars($serviceRea['photo'])?>"
											    data-toggle="modal" data-target="#modal-edit-service-rea" title="Modifier">
												<i class="fa fa-edit btn btn-success"></i>
											</a>

											<!-- Supprimer -->
											<a href="#" 
												class="btn-delete" 
												data-id="<?= htmlspecialchars($serviceRea['id'])?>" 
												name-serviceRea="<?= htmlspecialchars($serviceRea['nom'])?>"
												data-toggle="tooltip" data-placement="top" title="Supprimer">
												<i class="fa fa-trash btn btn-danger"></i>
											</a>
										</td>
									</tr>
								<?php endforeach ?>
							<?php else : ?>
								<p class="alert alert-danger text-center h4 fw-bold">La liste des serviceRea est vide.</p>
							<?php endif ?>
						</tbody>
					</table>
				</div>
			</div>

			<!-- Corbeille service / réalisation -->
			<div id="corbeille-liste" class="panel panel-inverse">
				
				<div class="panel-heading">
					<h4 class="panel-title">Corbeille Service / Réalisation</h4>
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
								<th width="1%" data-orderable="false">Photo</th>
								<th class="text-nowrap text-center">Nom</th>
								<th class="text-nowrap text-center">Description</th>
								<th class="text-nowrap text-center">Type</th>
								<th class="text-nowrap text-center">Créer le</th>
								<th class="text-nowrap text-center">Modifier le</th>
								<th class="text-nowrap text-center">Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php if(!empty($serviceReasSupprimes)) : ?>
								<?php foreach($serviceReasSupprimes as $serviceRea) : ?>
									<tr class="odd gradeX">

										<!-- Photo -->
										<td width="1%" class="with-img text-center">
											<?php if(!empty($serviceRea['photo'])) : ?>
												<img src="public/images/servicesRea/<?= htmlspecialchars($serviceRea['photo'])?>" style="width: 40px;" class="img-rounded height-30" />
											<?php else : ?>
												<img src="public/images/servicesRea/default.jpg" class="img-rounded height-30" />
											<?php endif ?>
										</td>

										<!-- Nom -->
										<td class="text-center"><?= htmlspecialchars($serviceRea['nom'])?></td>

										<!-- Description -->
										<td class="text-center">
											<span data-toggle="tooltip" data-placement="top" title="<?= htmlspecialchars($serviceRea['description']) ?>">
												<?= htmlspecialchars(mb_substr($serviceRea['description'], 0, 20)) .
												(strlen($serviceRea['description']) > 20 ? '...' : '')?>
											</span>
										</td>

										<!-- Type -->
										<td class="text-center">
											<?= htmlspecialchars($serviceRea['type'] == 'R' ?'Réalisation' : 'Service')?>
										</td>

										<!-- Date de création-->
										<td class="text-center">
											<?= htmlspecialchars(date('d/m/Y à H:i'), strtotime($serviceRea['created_at']))?> </br>
											par <?= htmlspecialchars($serviceRea['created_by_name'])?>
										</td>

										<!-- Date de modification -->
										<td class="text-center">
											<?php if($serviceRea['updated_at']) :?>
												<?= htmlspecialchars(date('d/m/Y à H:i'), strtotime($serviceRea['updated_at']))?> </br>
												par <?= htmlspecialchars($serviceRea['updated_by_name'])?>
											<?php else :?>
												<span class='text-danger fw-bold'>Jamais modifier</span>
											<?php endif?>
										</td>

										<!-- Actions -->
										<td class="text-center">
											<!-- Restaurer -->
											<a href="javascript:;"
												class="btn-restaurer"
												data-id="<?= htmlspecialchars($serviceRea['id'])?>"
												name-serviceRea="<?= htmlspecialchars($serviceRea['nom'])?>">
												<span class="btn btn-warning">Restaurer</span>
											</a>

											<!-- Supprimer -->
											<a href="#" 
												class="btn-delete-definitive" 
												data-id="<?= htmlspecialchars($serviceRea['id'])?>" 
												name-serviceRea="<?= htmlspecialchars($serviceRea['nom'])?>">
												<span class="btn btn-danger">Supp def</span>
											</a>
										</td>
									</tr>
								<?php endforeach ?>
							<?php else : ?>
								<p class="alert alert-danger text-center h4 fw-bold">Aucun serviceRea ou réalisation supprimé.</p>
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

	<!-- ========== MODAL ADD SERVICE / REALISATION ========== -->
	<div class="modal fade" id="modal-add-service-rea" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog">
			<div class="modal-content">

				<div class="modal-header">
					<h4 class="modal-title">Ajouter une Réalisation / Service</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				
				<div class="modal-body">
					<form id="formAddServiceRea" action="serviceReaMainController" method="post" enctype="multipart/form-data">
						<!-- Nom -->
						<div class="mb-3">
							<label for="nom" class="form-label">Nom</label>
							<input type="text" name="nom" class="form-control" id="nom" placeholder="Nom de la réalisation" required>
							<p class="error-message mt-2"></p>
						</div>

						<!-- Description -->
						<div class="mb-3">
							<label for="description" class="form-label">Description</label>
							<textarea name="description" class="form-control" id="description" rows="3" placeholder="Description" required></textarea>
							<p class="error-message mt-2"></p>
						</div>

						<!-- Photo -->
						<div class="mb-3">
							<label for="photo" class="form-label">Photo</label><br>
							<input type="file" name="photo" class="form-control-file" id="photo" accept="image/*" required>
							<p class="error-message mt-2"></p>
						</div>

						<!-- Type -->
						<div class="mb-3">
							<label for="type" class="form-label">Type</label>
							<select class="form-control" name="type" id="type" required>
								<option value="">--Selectionner un type--</option>
								<option value="R">Réalisation</option>
								<option value="S">Service</option>
							</select>
							<p class="error-message mt-2"></p>
						</div>

						<!-- Btn soumition -->
						<div style="display: flex; justify-content: center;">
							<button type="submit" name="frmAddServiceRea" class="btn btn-primary fw-bold" id="save-btn">Ajouter</button>
							&nbsp; &nbsp;
							<button type="reset" class="btn btn-danger fw-bold">Annuler</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- ========== MODAL EDIT SERVICE / REALISATION ========== -->
	<div class="modal fade" id="modal-edit-service-rea" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog">
			<div class="modal-content">

				<div class="modal-header">
					<h4 class="modal-title">Modifier une Réalisation / Service</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				
				<div class="modal-body">
					<form id="formEditServiceRea" action="serviceReaMainController" method="POST" enctype="multipart/form-data">
						<!-- Nom -->
						<div class="mb-3">
							<input type="hidden" name="edit-id" id="edit-id" value="">
							<label for="edit-nom" class="form-label">Nom</label>
							<input type="text" name="edit-nom" class="form-control" id="edit-nom" placeholder="Nom de la réalisation" required>
							<p class="error-message mt-2"></p>
						</div>

						<!-- Description -->
						<div class="mb-3">
							<label for="edit-description" class="form-label">Description</label>
							<textarea name="edit-description" class="form-control" id="edit-description" rows="3" placeholder="Description" required></textarea>
							<p class="error-message mt-2"></p>
						</div>

						<!-- Photo -->
						<div class="mb-3">
							<label for="edit-photo" class="form-label">Photo</label><br>
							<input type="file" name="edit-photo" class="form-control-file" id="edit-photo" accept="image/*" required>
							<div class="image-preview-container">
								<img src="" id="photo-preview" alt="Aperçu de l'image">
							</div>
							<p class="error-message mt-2"></p>
						</div>

						<!-- Type -->
						<div class="mb-3">
							<label for="edit-type" class="form-label">Type</label>
							<select class="form-control" name="edit-type" id="edit-type" required>
								<option value="">--Selectionner un type--</option>
								<option value="R">Réalisation</option>
								<option value="S">Service</option>
							</select>
							<p class="error-message mt-2"></p>
						</div>

						<!-- Btn soumition -->
						<div style="display: flex; justify-content: center;">
							<button type="submit" name="frmEditServiceRea" class="btn btn-primary fw-bold" id="save-btn">Modifier</button>
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