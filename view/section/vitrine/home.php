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
			Bienvenue sur Groupe Codeurs
		</h1>
        <h3>Multipurpose One Page Theme</h3>
        <p>
            We have created a multi-purpose theme that take the form of One-Page or Multi-Page Version.<br />
            Use our <a href="#">theme panel</a> to select your favorite theme color.
        </p>
        <a href="#" class="btn btn-theme btn-primary">Explore More</a> <a href="#" class="btn btn-theme btn-outline-white">Purchase Now</a><br />
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
