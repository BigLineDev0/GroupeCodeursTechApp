<script src="public/template/templateAdmin/assets/js/app.min.js"></script>
<script src="public/template/templateAdmin/assets/js/theme/default.min.js"></script>
<script src="public/js/global/Validator.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
    function loaderScriptsIfPathEndsWith(path, scriptsSources)
    {
        if (window.location.pathname.endsWith(path)) {
            
            scriptsSources.forEach(src => {
                const script = document.createElement("script");
                script.src = src;
                document.body.appendChild(script);
            });
        }
    }

    loaderScriptsIfPathEndsWith("login", [
        "public/js/users/login.js",
    ]);

    loaderScriptsIfPathEndsWith("reinitEmail", [
        "public/js/users/confirmReinitEmailValidator.js",
    ]);

    loaderScriptsIfPathEndsWith("reinit", [
        "public/js/users/reinitPwdFrmValidator.js",
    ]);

    
</script>