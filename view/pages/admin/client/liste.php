<!DOCTYPE html>
<html lang="fr">
    <!-- ================== SECTION HEAD ================== -->
	<?php require_once("../../../section/admin/head.php") ?>
<body>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade show">
		<span class="spinner"></span>
	</div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
		
        <!-- ================== SECTION MENU HAUT ================== -->
		<?php require_once("../../../section/admin/menuHaut.php") ?>
		
		<!-- ================== SECTION MENU GAUCHE ================== -->
		<?php require_once("../../../section/admin/menuGauche.php") ?>
		
		<!-- ================== SECTION BASE CONTENT ================== -->
		<div id="content" class="content">
			<!-- begin breadcrumb -->
			<ol class="breadcrumb float-xl-right">
				<li class="breadcrumb-item"><a href="javascript:;">Ajouter</a></li>
				<li class="breadcrumb-item"><a href="javascript:;">Corbeille</a></li>
				<li class="breadcrumb-item active">Utilisateur</li>
			</ol>
			<!-- end breadcrumb -->
			<!-- begin page-header -->
			<h1 class="page-header"># Client</h1>
			<!-- end page-header -->
			<!-- begin panel -->
			<div class="panel panel-inverse">
				<!-- begin panel-heading -->
				<div class="panel-heading">
					<h4 class="panel-title">Liste des Clients</h4>
					<div class="panel-heading-btn">
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
						<a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
					</div>
				</div>
				<!-- end panel-heading -->
				<!-- begin panel-body -->
				<div class="panel-body">
					<table id="data-table-default" class="table table-striped table-bordered table-td-valign-middle">
						<thead>
							<tr>
								<th width="1%"></th>
								<th width="1%" data-orderable="false"></th>
								<th class="text-nowrap">Rendering engine</th>
								<th class="text-nowrap">Browser</th>
								<th class="text-nowrap">Platform(s)</th>
								<th class="text-nowrap">Engine version</th>
								<th class="text-nowrap">CSS grade</th>
							</tr>
						</thead>
						<tbody>
							<tr class="odd gradeX">
								<td width="1%" class="f-w-600 text-inverse">1</td>
								<td width="1%" class="with-img"><img src="public/template/templateAdmin/assets/img/user/user-1.jpg" class="img-rounded height-30" /></td>
								<td>Trident</td>
								<td>Internet Explorer 4.0</td>
								<td>Win 95+</td>
								<td>4</td>
								<td>X</td>
							</tr>
							<tr class="even gradeC">
								<td class="f-w-600 text-inverse">2</td>
								<td class="with-img"><img src="public/template/templateAdmin/assets/img/user/user-2.jpg" class="img-rounded height-30" /></td>
								<td>Trident</td>
								<td>Internet Explorer 5.0</td>
								<td>Win 95+</td>
								<td>5</td>
								<td>C</td>
							</tr>
							<tr class="odd gradeA">
								<td class="f-w-600 text-inverse">3</td>
								<td class="with-img"><img src="public/template/templateAdmin/assets/img/user/user-3.jpg" class="img-rounded height-30" /></td>
								<td>Trident</td>
								<td>Internet Explorer 5.5</td>
								<td>Win 95+</td>
								<td>5.5</td>
								<td>A</td>
							</tr>
						</tbody>
					</table>
				</div>
				<!-- end panel-body -->
			</div>
			<!-- end panel -->
		</div>
		
		<!-- ================== SECTION CONFIG ================== -->
		<?php require_once("../../../section/admin/config.php") ?>
		
		<!-- ================== SECTION SCROL ================== -->
		<?php require_once("../../../section/admin/scrol.php") ?>
		
	</div>
	
	<!-- ================== SECTION SCRIPT JS ================== -->
	<?php require_once("../../../section/admin/script.php") ?>

</body>
</html>