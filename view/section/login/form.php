<div class="login login-v1">

    <div class="login-container">

        <!-- Entete -->
        <div class="login-header">
            <div class="brand">
                <span class="logo"></span> <b>Connexion</b>
                <small>Bienvenue sur Groupe Codeurs App</small>
            </div>
            <div class="icon">
                <i class="fa fa-lock"></i>
            </div>
        </div>
        
        <!-- Form -->
        <div class="login-body">
            
            <div class="login-content">
                <form action="userMainController" method="POST" id="loginForm" class="margin-bottom-0">

                    <!-- Email -->
                    <div class="form-group m-b-20">
                        <input type="text" id="email" name="email" class="form-control form-control-lg inverse-mode" placeholder="Adresse Email" required />
                        <p class="error-message"></p>
                    </div>
                    
                    <!-- Password -->
                    <div class="form-group m-b-20">
                        <input type="password" id="password" name="password" class="form-control form-control-lg inverse-mode" placeholder="Mot de passe" required />
                        <p class="error-message small"></p>
                    </div>

                    <!-- Souvenir de moi -->
                    <div class="checkbox checkbox-css m-b-20">
                        <input type="checkbox" id="remember_checkbox" name="remember" />
                        <label for="remember_checkbox">
                            Se souvenir de moi
                        </label>
                        <small class="ml-3">
                            <a href="home" class="text-white fw-bold h6">Retour vers l'accueil</a>
                        </small>

                         <small class="ml-3">
                            <a href="reinitEmail" class="text-white fw-bold h6">Mot de passe oublié</a>
                        </small>
                    </div>

                    <!-- Se connecter -->
                    <div class="login-buttons">
                        <button type="submit" id="btnSubmit" name="frmLogin" class="btn btn-success btn-block btn-lg">Se connecter</button>
                    </div>

                </form>
            </div>
           
        </div>
       
    </div>
   
</div>