<!-- ================== Récupération liste services dans la BD ================== -->
<?php
	require_once('model/ServiceReaRepository.php');
	$serviceRepository = new ServiceReaRepository();
	try {
		$listeServices = $serviceRepository->getAllByEtatAndType(1, 'S');
	} catch (Exception $error) {
		"<p>Erreur lors du chargement de la liste des services ".$error->getMessage() . "</p>";
		$listeServices = [];
	}
?>
<div id="service" class="content" data-scrollview="true">

	<div class="container">
		<h2 class="content-title">Nos Services</h2>
		<p class="content-desc">
			Vour trouverez ici tous les services que nous proposons. Nous vous garantissons un service de qualité et un suivi personnalisé.
		</p>
		<div class="row">
		<?php if(!empty($listeServices)) : ?>
			<?php foreach($listeServices as $service) : ?>
				<div class="col-lg-4 col-md-6">
					<div class="service">
						<div class="icon" data-animation="true" data-animation-type="bounceIn">
							<a href="#">
								<img style="object-fit: cover;" width="50px" height="50px" src="public/images/servicesRea/<?= htmlspecialchars($service['photo'])?>" alt="Photo service" />
							</a>
						</div>
						<div class="info">
							<h4 class="title"><?= htmlspecialchars($service['nom'])?></h4>
							<p class="desc"><?= htmlspecialchars($service['description'])?></p>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		<?php else : ?>
			<div class="col-lg-12 col-md-12">
				<div class="alert alert-warning" role="alert">
					Aucun service trouvé.
				</div>
			</div>
		<?php endif; ?>
		</div>
	</div>
</div>