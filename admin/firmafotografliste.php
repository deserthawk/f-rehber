<!DOCTYPE HTML>
<html>
<head>
<?php
require_once ('../adminDahilDosyalar.html');
?>
<script type="text/javascript"
	src="../js/app/components/controller/firmaFotografListeController.js"></script>

<style>
.tableform label {
	font-weight: normal;
}

.tableform td {
	padding-left: 10px;
}

.heightModal {
	height: 300px;
}

.padding-top10 {
	padding-top: 10px;
}
</style>
<title>Fotoğraf Listesi</title>
</head>
<body data-ng-app="fotografRehber">
	<div data-ng-controller="firmaListeleCtrl"
		data-ng-init="firmaDetayGetir(<?php echo ($_GET["firmaId"]); ?>);">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12  toppad">
					<div class="panel panel-info">
						<div class="panel-heading">
							<h3 class="panel-title">{{firmaAdi}}</h3>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class=" col-md-12 col-lg-12 ">test</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>