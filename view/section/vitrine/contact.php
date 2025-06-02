<div id="contact" class="content bg-silver-lighter" data-scrollview="true">
			
			<div class="container">
				<h2 class="content-title">Contact-Nous</h2>
				<div class="row">
					<!-- Informations -->
					<div class="col-lg-6" data-animation="true" data-animation-type="fadeInLeft">
						<h3>Si vous avez un projet dont vous souhaitez discuter, contactez-nous.</h3>
						<p>
							Nous sommes toujours heureux de discuter de nouveaux projets, de répondre à vos questions ou de vous aider à trouver la solution parfaite pour vos besoins. N'hésitez pas à nous contacter par téléphone, email ou en utilisant le formulaire ci-dessous. Nous nous engageons à vous répondre dans les plus brefs délais.
						</p>
						<p>
							<strong>
								Mbour, Thiès, Dakar, Sénégal<br />
							</strong><br />
							78 475 16 39
							<br />
						</p>
						<p>
							<span class="phone">78 155 64 94</span><br />
							<a href="mailto:line119549@gmail.com" class="text-primary">line119549@gmail.com</a>
						</p>
					</div>
					
					<!-- Formulaire -->
					<div class="col-lg-6 form-col" data-animation="true" data-animation-type="fadeInRight">
						<form action="contactMainController" method="POST" id="contactForm" class="form-horizontal">
							<!-- Nom -->
							<div class="form-group row m-b-15">
								<label for="nom" class="col-form-label col-lg-3 text-lg-right">Nom <span class="text-primary">*</span></label>
								<div class="col-lg-9">
									<input type="text" name="nom" id="nom" placeholder="Entrer votre nom complet" class="form-control" />
									<p class="error-message"></p>
								</div>
							</div>

							<!-- Email -->
							<div class="form-group row m-b-15">
								<label for="email-contact" class="col-form-label col-lg-3 text-lg-right">Email <span class="text-primary">*</span></label>
								<div class="col-lg-9">
									<input type="email" name="email-contact" id="email-contact" placeholder="Entrer votre email"  class="form-control" />
									<p class="error-message"></p>
								</div>
							</div>

							<!-- Sujet -->
							<div class="form-group row m-b-15">
								<label for="sujet" class="col-form-label col-lg-3 text-lg-right">Sujet <span class="text-primary">*</span></label>
								<div class="col-lg-9">
									<input type="text" name="sujet" id="sujet" placeholder="De quoi s'agit-il ?"  class="form-control" />
									<p class="error-message"></p>
								</div>
							</div>

							<!-- Message -->
							<div class="form-group row m-b-15">
								<label for="message" class="col-form-label col-lg-3 text-lg-right">Message <span class="text-primary">*</span></label>
								<div class="col-lg-9">
									<textarea name="message" id="message" placeholder="Ecrivez votre message" class="form-control" rows="5"></textarea>
									<p class="error-message"></p>
								</div>
							</div>

							<div class="form-group row m-b-15">
								<label class="col-form-label col-lg-3 text-lg-right"></label>
								<div class="col-lg-9 text-left">
									<button type="submit" name="frmAddContact" class="btn btn-theme btn-primary btn-block">Envoyer le Message</button>
								</div>
							</div>
						</form>
					</div>
					<!-- end col-6 -->
				</div>
				<!-- end row -->
			</div>
			<!-- end container -->
		</div>