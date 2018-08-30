<!DOCTYPE HTML>
<html>
<head>
<?php
require_once ('../adminDahilDosyalar.html');
require_once ('kullaniciKontrol.php');
?>
<script type="text/javascript"
	src="../js/app/components/controller/adminNavBarController.js"></script>
<script type="text/javascript"
	src="../js/app/components/controller/iletisimListesiController.js"></script>
<title>İletişim Listesi</title>
</head>
<body data-ng-app="fotografRehber">
	<admin-nav-bar></admin-nav-bar>
	<div data-ng-controller="iletisimListesiCtrl"
		data-ng-init="konuGetir(); mesajDurumGetir();" class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12  toppad">
				<div class="panel panel-info">
					<div class="panel-heading">
						<h3 class="panel-title">İletişim Listesi</h3>
					</div>
					<div class="panel-body">
						<div class="row">
							<form id="theForm" method="post" name="theForm">
								<div class="col-lg-12 padding_t_5">
									<input class="form-control" type="text" id="mesaj" name="mesaj"
										placeholder="Aranacak mesajı giriniz...">
								</div>
								<div class="col-lg-6 padding_t_5">
									<select data-ng-model="iletisimKonu" class="form-control"
										name="iletisimKonu" id="iletisimKonu">
										<option value="">Konu Seçiniz</option>
										<option ng-repeat="konular in konuList" value="{{konular.ID}}">{{konular.DEGER}}</option>
									</select>
								</div>
								<div class="col-lg-6 padding_t_5">
									<select data-ng-model="mesajDurum" class="form-control"
										name="mesajDurum" id="mesajDurum">
										<option value="">Seçiniz</option>
										<option ng-repeat="mesajDurumlar in mesajDurumList"
											value="{{mesajDurumlar.ID}}">{{mesajDurumlar.DEGER}}</option>
									</select>
								</div>
								<div class="col-lg-6 padding_t_5">
									<button type="submit" class="btn btn-success"
										data-ng-click="iletisimAra();">Ara</button>
								</div>
							</form>
						</div>
						<div class="row">
							<div class="col-lg-12 padding_t_5" id="iletisimListesiDiv"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>