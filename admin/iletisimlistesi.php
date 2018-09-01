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
<style>
.heightModal {
	height: 100px;
}
</style>
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
								<input type="hidden" id="theFormId" name="theFormId"
									value="1511"> <input type="hidden" id="rNum" name="rNum"
									value="2">
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
									<button type="submit" class="btn btn-primary"
										data-ng-click="iletisimAra();">Ara</button>
								</div>
							</form>
						</div>
						<div class="row">
							<table st-table="displayedCollection" st-safe-src="rowCollection"
								class="table table-striped">
								<thead>
									<tr>
										<th>İletişim Tip</th>
										<th>Ad Soyad</th>
										<th>E-Posta</th>
										<th>Telefon</th>
										<th>Mesaj</th>
										<th>Ekleme Tarihi</th>
										<th>Mesaj Durum</th>
										<th>Sil</th>
									</tr>
								</thead>
								<tbody>
									<tr ng-repeat="row in list track by $index"
										ng-class="{'selected':$index == selectedRow}"
										data-ng-click="setClickedRow($index)">
										<td>{{row.ILETISIM_TIP_TNM}}</td>
										<td>{{row.AD_SOYAD}}</td>
										<td>{{row.E_POSTA}}</td>
										<td>{{row.TELEFON}}</td>
										<td><button
												class="btn btn-primary glyphicon glyphicon-search font-size_8"
												data-ng-click="mesajGoruntule(row.MESAJ,row.ID);"></button>{{row.TEMP_MESAJ}}</td>
										<td>{{row.EKLEME_TARIHI}}</td>
										<td>{{row.MESAJ_DURUM_TNM}}</td>
										<td><button
												class="btn btn-danger glyphicon glyphicon-trash font-size_8"
												data-ng-click="iletisimSil(row.ID);"></button></td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="row">
						<div class="col-lg-12">
						<button type="submit" class="btn btn-primary"
										data-ng-click="dahaFazlaKayit();">Daha Fazla Kayıt</button>
						</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- MESAJ GORUNTULEME START -->
		<modal modal-name="mesajGoruntulemeModal"
			modal-class="modal-dialog modal-lg"> <modal-header>Mesaj Gürüntüleme</modal-header>
		<modal-body modal-class="heightModal">
		<div class="row">
			<div class="col-lg-12 padding_l_40">{{mesajIcerik}}</div>
		</div>
		</modal-body> <modal-footer kapat-icerik="Kapat"> </modal-footer> </modal>
		<!-- MESAJ GORUNTULEME END -->
	</div>
</body>
</html>