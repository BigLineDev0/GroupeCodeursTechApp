<script src="public/template/templateAdmin/assets/js/app.min.js"></script>
<script src="public/template/templateAdmin/assets/js/theme/default.min.js"></script>


<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="public/template/templateAdmin/assets/plugins/d3/d3.min.js"></script>
<script src="public/template/templateAdmin/assets/plugins/nvd3/build/nv.d3.min.js"></script>
<script src="public/template/templateAdmin/assets/plugins/jvectormap-next/jquery-jvectormap.min.js"></script>
<script src="public/template/templateAdmin/assets/plugins/jvectormap-next/jquery-jvectormap-world-mill.js"></script>
<script src="public/template/templateAdmin/assets/plugins/apexcharts/dist/apexcharts.min.js"></script>
<script src="public/template/templateAdmin/assets/plugins/moment/min/moment.min.js"></script>
<script src="public/template/templateAdmin/assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="public/template/templateAdmin/assets/js/demo/dashboard-v3.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->

<!-- ================== DATATABLE JS ================== -->
<script src="public/template/templateAdmin/assets/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="public/template/templateAdmin/assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="public/template/templateAdmin/assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="public/template/templateAdmin/assets/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
<script src="public/template/templateAdmin/assets/js/demo/table-manage-default.demo.js"></script>
<!-- ================== END DATATABLE JS ================== -->
 
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- ================== GLOBAL JS ================== -->
<script src="public/js/global/Validator.js"></script>

<!-- ================== JS APP ================== -->
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

    loaderScriptsIfPathEndsWith("listeServiceRea", [
        "public/js/serviceRea/addFrmValidator.js",
        "public/js/serviceRea/editFrmValidator.js",
        "public/js/serviceRea/confirmDelete.js",
        "public/js/serviceRea/showHide.js",
        "public/js/serviceRea/confirmRestaurer.js",
        "public/js/serviceRea/confirmDeleteDef.js",
    ]);

    loaderScriptsIfPathEndsWith("listeUser", [
        "public/js/users/addFrmValidator.js",
        "public/js/users/editFrmValidator.js",
        "public/js/users/confirmDelete.js",
        "public/js/users/showHide.js",
        "public/js/users/confirmRestaurer.js",
        "public/js/users/confirmDeleteDef.js",
    ]);
</script>