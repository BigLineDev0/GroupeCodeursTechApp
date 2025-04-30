<!-- ================== Récupération liste réalisations dans la BD ================== -->
<?php
	require_once('model/ServiceReaRepository.php');
	$realisationRepository = new ServiceReaRepository();
	try {
		$listeRealisations = $realisationRepository->getAllByEtatAndType(1, 'R');
	} catch (Exception $error) {
		"<p>Erreur lors du chargement de la liste des réalisations ".$error->getMessage() . "</p>";
		$listeRealisations = [];
	}
?>

<!-- ================== liste réalisations dans la BD ================== -->
<div id="work" class="content" data-scrollview="true">
	<div class="container" data-animation="true" data-animation-type="fadeInDown">
		<h2 class="content-title">Nos Réalisations</h2>
		<p class="content-desc">
			Vous trouverez les réalisations de Groupe Codeurs
		</p>
		<div class="row row-space-10">
			<?php if(!empty($listeRealisations)) : ?>
				<?php foreach($listeRealisations as $realisation) : ?>

					<div class="col-lg-3 col-md-4">
						
						<div class="work">
							<!-- Photo -->
							<div class="image">
								<a href="#">
									<img style="object-fit:cover" height="250px;" src="public/images/servicesRea/<?= htmlspecialchars($realisation['photo'])?>" alt="Photo réalisation" />
								</a>
							</div>
							<div class="desc">
								<!-- nom -->
								<span class="desc-title"><?= htmlspecialchars($realisation['nom'])?></span>
								<!-- description -->
								<span class="desc-text" 
									data-toggle="tooltip" data-placement="top" 
									title="<?= htmlspecialchars($realisation['description']) ?>">
									<?= htmlspecialchars(mb_substr($realisation['description'], 0, 50)) .
									(strlen($realisation['description']) > 50 ? '...' : '')?>
								</span>
							</div>
						</div>
					</div>
				<?php endforeach ?>
			<?php else : ?>
				<p class="alert alert-danger text-center h4 fw-bold">Aucune réalisation trouvée.</p>
			<?php endif ?>

		</div>
	</div>
</div>