<!-- ================== Récupération liste utilisateurs dans la BD ================== -->
<?php
    require_once('model/UserRepository.php');
    $userRepository = new UserRepository();
    try {
        $listeUsers = $userRepository->getAllByEtatAndRole(1, 'Equipe');
    } catch (Exception $error) {
        "<p>Erreur lors du chargement de la liste des utilisateurs " . $error->getMessage() . "</p>";
        $listeUsers = [];
    }
?>
<div id="team" class="content" data-scrollview="true">

    <div class="container">
        <h2 class="content-title">Notre Equipe</h2>
        <p class="content-desc">
            Phasellus suscipit nisi hendrerit metus pharetra dignissim. Nullam nunc ante, viverra quis<br />
            ex non, porttitor iaculis nisi.
        </p>

        <div class="row">
            <?php if(!empty($listeUsers)) : ?>
                <?php foreach($listeUsers as $user) : ?>
                    <div class="col-lg-4">
                        <div class="team">
                            <div class="image" data-animation="true" data-animation-type="flipInX">
                                <img style="object-fit: cover;" width="100px" height="100px" src="public/images/users/<?= htmlspecialchars($user['photo'])?>" alt="Photo <?= htmlspecialchars($service['nom'])?>" />
                            </div>
                            <div class="info">
                                <h3 class="name"><?= htmlspecialchars($user['nom'])?></h3>
                                <div class="title text-primary"><?= htmlspecialchars($user['role'])?></div>
                                <div class="social">
                                    <a href="#"><i class="fab fa-facebook-f fa-lg fa-fw"></i></a>
                                    <a href="#"><i class="fab fa-twitter fa-lg fa-fw"></i></a>
                                    <a href="#"><i class="fab fa-google-plus-g fa-lg fa-fw"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="col-lg-12 col-md-12">
                    <div class="alert alert-warning text-center h4 fw-bold" role="alert">
                        Aucun utilisateur trouvé.
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>