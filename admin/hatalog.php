<!DOCTYPE HTML>
<html>
<head>
<?php
require_once ('../adminDahilDosyalar.html');
require_once ('kullaniciKontrol.php');
?>
<script type="text/javascript"
	src="../js/app/components/controller/hataLogController.js"></script>
<script type="text/javascript"
	src="../js/app/components/controller/adminNavBarController.js"></script>
<title>Hata Log</title>
</head>
<body data-ng-app="fotografRehber">
	<admin-nav-bar></admin-nav-bar>
	<div data-ng-controller="hataLogCtrl">
		<section>
			<div class="container-fluid">
				<div class="row">
					<form id="theForm" name="theForm">
						<input type="hidden" id="hataLogFormTipId" name="hataLogFormTipId" value="1511"> 
						<input type="hidden" id="rNum" name="rNum" value="2">
						<div class="form-inline">
							<div class="form-group">
								<label>Başlangıç Tarihi:</label> <input class="form-control"
									type="text" id="firmaAdi" name="firmaAdi">
							</div>
							<div class="form-group">
								<label>Bitiş Tarihi:</label> <input class="form-control"
									type="text" id="telefon" name="telefon">
							</div>
							<div class="form-group">
								<input type="button" class="btn btn-primary" id="btnFirmaAra"
									data-ng-click="hataLogListGetir()" value="Sorgula">
							</div>
						</div>
					</form>

				</div>
			</div>
		</section>
		<section>
			<div class="container-fluid">
				<div class="row">
					<table st-table="displayedCollection" st-safe-src="rowCollection"
						class="table table-striped">
						<thead>
							<tr>
							<th>Id</th>
							<th>Hata Kodu</th>
							<th>Mesaj</th>
							<th>Hata Fonksiyon</th>
							<th>Sql Cümlesi</th>
							<th>Ekleme Ip</th>
							<th>Ekleme Tarihi</th>
							</tr>
						</thead>
						<tbody>
							<tr ng-repeat="row in list track by $index"
								ng-class="{'selected':$index == selectedRow}"
								data-ng-click="setClickedRow($index)">
								<td>{{row.id}}</td>
								<td>{{row.exception_tanim}}</td>
								<td>{{row.exception_msj}}</td>
								<td>{{row.fonksiyon_tnm}}</td>
								<td>{{row.sql_cumle}}</td>
								<td>{{row.ekleme_ip}}</td>
								<td>{{row.ekleme_tarihi}}</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</section>
	</div>
</body>
</html>