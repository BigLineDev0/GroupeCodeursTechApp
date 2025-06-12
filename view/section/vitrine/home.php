<div id="home" class="content has-bg home">
    <!-- begin content-bg -->
    <div class="content-bg" style="background-image: url(public/template/templateVitrine/assets/img/bg/bg-home.jpg);" 
        data-paroller="true" 
        data-paroller-factor="0.5"
        data-paroller-factor-xs="0.25">
    </div>
    <!-- end content-bg -->
    <!-- begin container -->
    <div class="container home-content">
        <h1>
			Welcome to Groupe Codeurs
		</h1>
        <h3>
			L'innovation au service de votre succès
		</h3>
        <p>
            Chez Groupe Codeurs, nous sommes passionnés par la création de solutions numériques innovantes qui transforment les idées en réalité. 
			Notre équipe d'experts est dédiée à fournir des services de développement web, de design graphique et de marketing digital de haute 
			qualité pour aider votre entreprise à atteindre ses objectifs. 
        </p>
        <a href="#" class="btn btn-theme btn-primary">
			En savoir plus
		</a> <a href="#" class="btn btn-theme btn-outline-white">
			Contactez-nous
		</a><br />
        <br />
        ou <a href="#modal-add-newsletter" data-toggle="modal">S'inscrire</a> newsletter
    </div>
    <!-- end container -->
</div>

<!-- ========== MODAL ADD NEWSLETTER ========== -->
<div class="modal fade" id="modal-add-newsletter" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header">
				<h4 class="modal-title">S'incrire à notre Newsletter</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			
			<div class="modal-body">
				<form id="newsletterForm" action="newsletterMainController" method="post">
					<!-- Email -->
					<div class="mb-3">
						<label for="email-newsletter" class="form-label">Email</label>
						<input type="email" name="email" class="form-control" id="email-newsletter" placeholder="Entrer votre email" required>
						<p class="error-message mt-2"></p>
					</div>
					
					<!-- Btn soumition -->
					<div style="display: flex; justify-content: center;">
						<button type="submit" name="frmAddNewsletter" class="btn btn-primary fw-bold" id="save-btn">S'inscrire</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
