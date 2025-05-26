<!DOCTYPE html>
<html lang="fr">
<!-- ================== SECTION HEAD ================== -->
<?php require_once("../../../section/admin/head.php") ?>

<!-- ================== Vérification session ================== -->
<?php require_once("../../../section/admin/verifySession.php") ?>

<body>
	
	<!-- ================== Récupération liste servicesRea dans la BD ================== -->
	<?php
		require_once('../../../../model/UserRepository.php');
		$userRepository = new UserRepository();
		try {
			$listeUsers = $userRepository->getAll(1);
			
			$usersSupprimes = $userRepository->getAll(0);
		} catch (Exception $error) {
			"<p>Erreur lors du chargement de la liste des users ".$error->getMessage() . "</p>";
			$listeUsers = [];
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
					<a href="#modal-add-user" class="btn btn-sm btn-dark text-white" data-toggle="modal">Ajouter</a>
				</li>

				<li id="btn-show-liste-user" class="breadcrumb-item">
					<a href="#"  class="btn btn-sm btn-dark text-white">Afficher liste</a>
				</li>

				<li id="btn-show-corbeille-user" class="breadcrumb-item">
					<a href="#" class="btn btn-sm btn-dark text-white">Afficher Corbeille</a>
				</li>

				<li class="breadcrumb-item">
					<a href="#modal-change-password" class="btn btn-sm btn-dark text-white" data-toggle="modal">Changer le mot de passe</a>
				</li>
				
			</ol>
			
			<h1 class="page-header"># Utilisateurs</h1>
			
			<!-- Liste Utilisateur -->
			<div id="table-liste-user" class="panel panel-inverse">
				
				<div class="panel-heading">
					<h4 class="panel-title">Liste Utilisateurs</h4>
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
								<th class="text-nowrap text-center">Adresse</th>
								<th class="text-nowrap text-center">Téléphone</th>
								<th class="text-nowrap text-center">Email</th>
								<th class="text-nowrap text-center">Role</th>
								<th class="text-nowrap text-center">Créer le</th>
								<th class="text-nowrap text-center">Modifier le</th>
								<th class="text-nowrap text-center">Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php if(!empty($listeUsers)) : ?>
								<?php foreach($listeUsers as $user) : ?>
									<tr class="odd gradeX">

										<!-- Photo -->
										<td width="1%" class="with-img text-center">
											<?php if(!empty($user['photo'])) : ?>
												<img src="public/images/users/<?= htmlspecialchars($user['photo'])?>" style="width: 40px;" class="img-rounded height-30" />
											<?php else : ?>
												<img src="public/images/users/default.jpg" class="img-rounded height-30" />
											<?php endif ?>
										</td>

										<!-- Nom -->
										<td class="text-center">
											<?= htmlspecialchars($user['nom'])?>
										</td>

										<!-- Adresse -->
										<td class="text-center">
											<?= htmlspecialchars($user['adresse'])?>
										</td>

										<!-- Téléphone -->
										<td class="text-center">
											<?= htmlspecialchars($user['telephone'])?>
										</td>
										
										<!-- Email -->
										<td class="text-center">
											<?= htmlspecialchars($user['email'])?>
										</td>

										<!-- Role -->
										<td class="text-center">
											<?= htmlspecialchars($user['role'])?>
										</td>
									
										<!-- Date de création-->
										<td class="text-center">
											<?= htmlspecialchars(date('d/m/Y à H:i'), strtotime($user['created_at']))?> </br>
											par 
											<?php if($user['created_by_name']) :?>
												<?= htmlspecialchars($user['created_by_name'])?>
											<?php else :?>
												<span class='fw-bold'>admin@gmail.com</span>
											<?php endif?>
										</td>

										<!-- Date de modification -->
										<td class="text-center">
											<?php if($user['updated_at']) :?>
												<?= htmlspecialchars(date('d/m/Y à H:i'), strtotime($user['updated_at']))?> </br>
												par <?= htmlspecialchars($user['updated_by_name'])?>
											<?php else :?>
												<span class='text-danger fw-bold'>Jamais modifier</span>
											<?php endif?>
										</td>

										<!-- Actions -->
										<td class="text-center">
											<!-- Edit -->
											<a href="javascript:;"
												class="btn-edit-user"
												data-edit-id="<?= htmlspecialchars($user['id'])?>"
												data-edit-nom="<?= htmlspecialchars($user['nom'])?>"
												data-edit-adresse="<?= htmlspecialchars($user['adresse'])?>"
												data-edit-telephone="<?= htmlspecialchars($user['telephone'])?>"
												data-edit-email="<?= htmlspecialchars($user['email'])?>"
												data-edit-role="<?= htmlspecialchars($user['role'])?>"
												data-edit-photo="<?= htmlspecialchars($user['photo'])?>"
											    data-toggle="modal" data-target="#modal-edit-user" title="Modifier">
												<i class="fa fa-edit btn btn-success"></i>
											</a>

											<!-- Supprimer -->
											<a href="#" 
												class="btn-delete-user" 
												data-id-user="<?= htmlspecialchars($user['id'])?>" 
												data-nom-user="<?= htmlspecialchars($user['nom'])?>"
												data-toggle="tooltip" data-placement="top" title="Supprimer">
												<i class="fa fa-trash btn btn-danger"></i>
											</a>
										</td>
									</tr>
								<?php endforeach ?>
							<?php else : ?>
								<p class="alert alert-danger text-center h4 fw-bold">La liste des utilisateurs est vide.</p>
							<?php endif ?>
						</tbody>
					</table>
				</div>
			</div>

			<!-- Corbeille Utilisateur -->
			<div id="corbeille-liste-user" class="panel panel-inverse">
				
				<div class="panel-heading">
					<h4 class="panel-title">Corbeille Utilisateurs</h4>
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
								<th class="text-nowrap text-center">Adresse</th>
								<th class="text-nowrap text-center">Téléphone</th>
								<th class="text-nowrap text-center">Email</th>
								<th class="text-nowrap text-center">Role</th>
								<th class="text-nowrap text-center">Créer le</th>
								<th class="text-nowrap text-center">Modifier le</th>
								<th class="text-nowrap text-center">Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php if(!empty($usersSupprimes)) : ?>
								<?php foreach($usersSupprimes as $user) : ?>
									<tr class="odd gradeX">
										<!-- Photo -->
										<td width="1%" class="with-img text-center">
											<?php if(!empty($user['photo'])) : ?>
												<img src="public/images/users/<?= htmlspecialchars($user['photo'])?>" style="width: 40px;" class="img-rounded height-30" />
											<?php else : ?>
												<img src="public/images/users/default.jpg" class="img-rounded height-30" />
											<?php endif ?>
										</td>

										<!-- Nom -->
										<td class="text-center">
											<?= htmlspecialchars($user['nom'])?>
										</td>

										<!-- Adresse -->
										<td class="text-center">
											<?= htmlspecialchars($user['adresse'])?>
										</td>

										<!-- Téléphone -->
										<td class="text-center">
											<?= htmlspecialchars($user['telephone'])?>
										</td>
										
										<!-- Email -->
										<td class="text-center">
											<?= htmlspecialchars($user['email'])?>
										</td>

										<!-- Role -->
										<td class="text-center">
											<?= htmlspecialchars($user['role'])?>
										</td>
									
										<!-- Date de création-->
										<td class="text-center">
											<?= htmlspecialchars(date('d/m/Y à H:i'), strtotime($user['created_at']))?> </br>
											par 
											<?php if($user['created_by_name']) :?>
												<?= htmlspecialchars($user['created_by_name'])?>
											<?php else :?>
												<span class='fw-bold'>admin@gmail.com</span>
											<?php endif?>
										</td>

										<!-- Actions -->
										<td class="text-center">
											<!-- Restaurer -->
											<a href="javascript:;"
												class="btn-restaurer-user"
												data-id-user="<?= htmlspecialchars($user['id'])?>"
												data-nom-user="<?= htmlspecialchars($user['nom'])?>">
												<span class="btn btn-warning">Restaurer</span>
											</a>

											<!-- Supprimer -->
											<a href="#" 
												class="btn-delete-definitive-user" 
												data-id-user="<?= htmlspecialchars($user['id'])?>" 
												data-nom-user="<?= htmlspecialchars($user['nom'])?>">
												<span class="btn btn-danger">Supp def</span>
											</a>
										</td>
									</tr>
								<?php endforeach ?>
							<?php else : ?>
								<p class="alert alert-danger text-center h4 fw-bold">Aucun utilisateur supprimé.</p>
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

	<!-- ========== MODAL ADD USER ========== -->
	<div class="modal fade" id="modal-add-user" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog">
			<div class="modal-content">

				<div class="modal-header">
					<h4 class="modal-title">Ajouter un utilisateur</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				
				<div class="modal-body">
					<form id="addUserForm" action="userMainController" method="post" enctype="multipart/form-data">
						<!-- Nom -->
						<div class="mb-3">
							<label for="user-nom" class="form-label">Nom</label>
							<input type="text" name="nom" class="form-control" id="user-nom" placeholder="Nom" required>
							<p class="error-message mt-2"></p>
						</div>

						<!-- Adresse -->
						<div class="mb-3">
							<label for="user-adresse" class="form-label">Adresse</label>
							<input type="text" name="adresse" class="form-control" id="user-adresse" placeholder="Adresse" required>
							<p class="error-message mt-2"></p>
						</div>

						<!-- Téléphone -->
						<div class="mb-3">
							<label for="telephone" class="form-label">Téléphone</label>
							<input type="tel" name="telephone" class="form-control" id="user-telephone" placeholder="Téléphone" required>
							<p class="error-message mt-2"></p>
						</div>

						<!-- Email -->
						<div class="mb-3">
							<label for="user-email" class="form-label">Email</label>
							<input type="email" name="email" class="form-control" id="user-email" placeholder="Email" required>
							<p class="error-message mt-2"></p>
						</div>

						<!-- Photo -->
						<div class="mb-3">
							<label for="user-photo" class="form-label">Photo</label><br>
							<input type="file" name="photo" class="form-control-file" id="user-photo" accept="image/*" required>
							<p class="error-message mt-2"></p>
						</div>

						<!-- Rôle -->
						<div class="mb-3">
							<label for="user-role" class="form-label">Rôle</label>
							<select class="form-control" name="role" id="user-role" required>
								<option value="">--Selectionner un rôle--</option>
								<option value="Admin">Admin</option>
								<option value="Equipe">Equipe</option>
							</select>
							<p class="error-message mt-2"></p>
						</div>

						<!-- Btn soumition -->
						<div style="display: flex; justify-content: center;">
							<button type="submit" name="frmAddUser" class="btn btn-primary fw-bold" id="btnAddUser">Ajouter</button>
							&nbsp; &nbsp;
							<button type="reset" class="btn btn-danger fw-bold">Annuler</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- ========== MODAL EDIT USER ========== -->
	<div class="modal fade" id="modal-edit-user" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog">
			<div class="modal-content">

				<div class="modal-header">
					<h4 class="modal-title">Modifier un utilisateur</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				
				<div class="modal-body">
					<form id="formEditUser" action="userMainController" method="POST" enctype="multipart/form-data">
						
						<!-- Nom -->
						<div class="mb-3">
							<label for="user-nom" class="form-label">Nom</label>
							<input type="hidden" name="edit-user-id" id="edit-user-id" value="">
							<input type="text" name="edit-user-nom" class="form-control" id="edit-user-nom" placeholder="Nom" required>
							<p class="error-message mt-2"></p>
						</div>

						<!-- Adresse -->
						<div class="mb-3">
							<label for="user-adresse" class="form-label">Adresse</label>
							<input type="text" name="edit-user-adresse" class="form-control" id="edit-user-adresse" placeholder="Adresse" required>
							<p class="error-message mt-2"></p>
						</div>

						<!-- Téléphone -->
						<div class="mb-3">
							<label for="user-telephone" class="form-label">Téléphone</label>
							<input type="tel" name="edit-user-telephone" class="form-control" id="edit-user-telephone" placeholder="Téléphone" required>
							<p class="error-message mt-2"></p>
						</div>

						<!-- Email -->
						<div class="mb-3">
							<label for="user-email" class="form-label">Email</label>
							<input type="email" name="edit-user-email" class="form-control" id="edit-user-email" placeholder="Email" required>
							<p class="error-message mt-2"></p>
						</div>

						<!-- Photo -->
						<div class="mb-3">
							<label for="user-photo" class="form-label">Photo</label><br>
							<input type="file" name="edit-user-photo" class="form-control-file" id="edit-user-photo" accept="image/*" required>
							<div class="image-preview-container">
								<img src="" id="edit-photo-preview" alt="Aperçu de l'image">
							</div>
							<p class="error-message mt-2"></p>
						</div>

						<!-- Rôle -->
						<div class="mb-3">
							<label for="role" class="form-label">Rôle</label>
							<select class="form-control" name="edit-user-role" id="edit-user-role" required>
								<option value="">--Selectionner un rôle--</option>
								<option value="Admin">Admin</option>
								<option value="Equipe">Equipe</option>
							</select>
							<p class="error-message mt-2"></p>
						</div>

						<!-- Btn soumition -->
						<div style="display: flex; justify-content: center;">
							<button type="submit" name="frmEditUser" class="btn btn-primary fw-bold" id="edit-user-btn">Modifier</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- ========== MODAL CHANGE PASSWORD ========== -->
	<div class="modal fade" id="modal-change-password" data-backdrop="static" data-keyboard="false">
		<div class="modal-dialog">
			<div class="modal-content">

				<div class="modal-header">
					<h4 class="modal-title">Changer votre mot passe</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				</div>
				
				<div class="modal-body">
					<form id="fmrchangePwd" action="userMainController" method="post" enctype="multipart/form-data">

						<!-- Mot de passe actuel -->
						<div class="mb-3">
							<label for="current_password" class="form-label">Mot de passe actuel</label>
							<input type="password" name="current_password" class="form-control" id="current_password" placeholder="Entrer le Mot de passe actuel" required>
							<p class="error-message mt-2"></p>
						</div>

						<!-- Nouveau Mot de passe -->
						<div class="mb-3">
							<label for="new_password" class="form-label">Nouveau Mot de passe</label>
							<input type="password" name="new_password" class="form-control" id="new_password" placeholder="Entrer le Nouveau Mot de passe" required>
							<p class="error-message mt-2"></p>
						</div>

						<!-- Confirmer Mot de passe -->
						<div class="mb-3">
							<label for="confirm_password" class="form-label">Confirmer Mot de passe</label>
							<input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="Entrer le Mot de passe de confirmation" required>
							<p class="error-message mt-2"></p>
						</div>

						<!-- Btn soumition -->
						<div style="display: flex; justify-content: center;">
							<button type="submit" name="frmChangePwd" class="btn btn-primary fw-bold" id="frmChangePwd">Changer le mot de passe</button>
							&nbsp; &nbsp;
							<button type="reset" class="btn btn-danger fw-bold">Annuler</button>
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