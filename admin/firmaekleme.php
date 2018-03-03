<!DOCTYPE html>
<html>
<head>

<?php
require_once ('../adminDahilDosyalar.html');
?>
<script type="text/javascript" src="../js/app/components/controller/firmaeklemeController.js"></script>
<title></title>
</head>
<body data-ng-app="fotografRehber">
	<div data-ng-controller="firmaEklemeCtrl" class="container">
		<div class="row">
			<div class="col-sm-12">
				<form id="theForm" name="theForm">
					<div class="form-group col-sm-12">
						<div class="col-sm-2">
							<label class="col-form-label">Firma Adı:</label>
						</div>
						<div class="col-sm-10">
							<input type="text" class="form-control-plaintext" id="firmaAdi"
								name="firmaAdi">
						</div>
					</div>
					<div class="form-group">
						<label>Telefon:</label> <input type="text" id="telefon"
							name="telefon">
					</div>
					<div class="form-group">
						<label>Kontak Kişi Ad:</label> <input type="text"
							id="kontakKisiAd" name="kontakKisiAd"> <label>Kontak Kişi Soyad:</label>
						<input type="text" id="kontakKisiSoyad" name="kontakKisiSoyad">
					</div>

					<input type="button" class="btn btn-primary" id="btnFirmaEkle"
						data-ng-click="firmaEkleme()" value="Firma Ekle">
				</form>
			</div>
		</div>
		<div id="returnData" class="row"></div>
	</div>
	<span us-spinner="{radius:30, width:8, length: 16}"
		spinner-key="spinner-1"></span>
</body>
</html>