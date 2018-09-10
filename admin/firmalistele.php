<!DOCTYPE HTML>
<html>
<head>
<?php
require_once ('../adminDahilDosyalar.html');
require_once ('kullaniciKontrol.php');
?>
<script type="text/javascript"
	src="../js/app/components/controller/firmaListeleController.js"></script>
<script type="text/javascript"
	src="../js/app/components/controller/adminNavBarController.js"></script>
	
<style>
.tableform label{
font-weight: normal;
}
.tableform td{
padding-left: 10px;
}
.heightModal{
height:300px;
}
.padding-top10{
padding-top: 10px;
}
</style>
<title>Fotoğrafçı Listesi</title>
</head>
<body data-ng-app="fotografRehber">
<admin-nav-bar></admin-nav-bar>
	<div data-ng-controller="firmaListeleCtrl"
		data-ng-init="sehirList();">
		<section>
			<div class="container-fluid">
				<div class="row">
					<form id="theForm" name="theForm">
						<input type="hidden" id="firmaListTipId" name="firmaListTipId" value="1511"> 
						<input type="hidden" id="rNum" name="rNum" value="2">
						<div class="form-inline">
							<div class="form-group">
								<label>Firma Adı:</label> <input class="form-control"  type="text" id="firmaAdi" name="firmaAdi">
							</div>
							<div class="form-group">
								<label>Telefon:</label> <input class="form-control"  type="text" id="telefon"	name="telefon">
							</div>
							<div class="form-group">
								<input type="button" class="btn btn-primary" id="btnFirmaAra" data-ng-click="firmaAra()" value="Ara">
							</div>
							<div class="form-group">
								<input type="button" class="btn btn-default" id="btnFirmaEkle"  data-ng-click="firmaEkleModal()" value="Ekle">
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
								<th>Firma Adı</th>
								<th>Telefon</th>
								<th>Durum</th>
								<th>Fotoğraf Listesi</th>
								<th>Güncelle</th>
								<th>Listeden Kaldır</th>
							</tr>
						</thead>
						<tbody>
							<tr ng-repeat="row in list track by $index"
								ng-class="{'selected':$index == selectedRow}"
								data-ng-click="setClickedRow($index)">
								<td>{{row.firma_adi}}</td>
								<td></td>
								<td></td>
								<td style="width: 2%;"><button type="button"
										class="btn btn-default glyphicon glyphicon-camera"
										data-ng-click="firmaFotoListele(row.id);"></button></td>
								<td style="width: 2%;"><button type="button"
										class="btn btn-default glyphicon glyphicon-edit"
										data-ng-click="firmaGuncelle(row.id);"></button></td>
								<td style="width: 2%;"><button type="button"
										class="btn btn-danger glyphicon glyphicon-trash"
										data-toggle="modal" data-target="#firmaDetayModal"
										data-ng-click="firmaDetayGetir(row.id)"></button></td>
							</tr>
						</tbody>
					</table>
				</div>
				<input type="button" id="btnDahaFirma" 
				class="btn btn-primary" 
				data-ng-click="dahaFirmaListGetir()" 
				value="Daha Fazla Kayıt Getir">
			</div>
		</section>

		<modal modal-name="firmaEkleModal" modal-class="modal-dialog modal-lg"> 
			<modal-header>Firma	Ekle</modal-header> 
			<modal-body modal-class="heightModal">
		<form id="firmaEkleForm" name="firmaEkleForm">
			<div class="form-inline col-sm-12">
				<div class="col-sm-12">
					<div>
						<label class="col-form-label">Firma Adı:</label>
					</div>
					<div>
						<input type="text" class="form-control" id="firmaAdiEkle"
							name="firmaAdiEkle">
					</div>
				</div>
				<div class="col-sm-4">
					<div>
						<label>Telefon:</label>
					</div>
					<div>
						<input type="text" class="form-control" id="telefonEkle"
							name="telefonEkle">
					</div>
				</div>
				<div class="col-sm-4">
					<div>
						<label>Cep Telefonu:</label>
					</div>
					<div>
						<input type="text" class="form-control" id="cepTelefonuEkle"
							name="cepTelefonuEkle">
					</div>
				</div>
				<div class="col-sm-4">
					<div>
						<label>Email:</label>
					</div>
					<div>
						<input type="text" class="form-control" id="emailEkle"
							name="emailEkle">
					</div>
				</div>
				<div class="col-sm-4">
					<div>
						<label>Kontak Kişi:</label>
					</div>
					<div>
						<input type="text" class="form-control" id="kontakKisiEkle"
							name="kontakKisiEkle">
					</div>
				</div>
				<div class="col-sm-4">
					<div>
						<label>Kontak Kişi Telefon:</label>
					</div>
					<div>
						<input type="text" class="form-control" id="kontakKisiTelefonEkle"
							name="kontakKisiTelefonEkle">
					</div>
				</div>
				<div class="col-sm-4">
					<div>
						<label>Kontak Kişi Email:</label>
					</div>
					<div>
						<input type="text" class="form-control" id="kontakKisiEmailEkle"
							name="kontakKisiEmailEkle">
					</div>
				</div>
				<div class="col-sm-4">
					<div>
						<label>İl:</label>
					</div>
					<div>
					<select data-ng-model="ilEkle" class="form-control" name="ilEkle" id="ilEkle"  ng-change="getIlceList(ilEkle);">
					    <option value="">Seçiniz...</option>
					    <option ng-repeat="ilLer in ilList" value="{{ilLer.ID}}">{{ilLer.DEGER}} </option>
					</select>
					</div>
				</div>
				<div class="col-sm-4">
					<div>
						<label>İlçe:</label>
					</div>
					<div>
					<select data-ng-model="ilceEkle" class="form-control" name="ilceEkle" id ="ilceEkle" >
					    <option ng-repeat="ilceLer in ilceList" value="{{ilceLer.ID}}">{{ilceLer.DEGER}} </option>
					</select>
					</div>
				</div>
				<div class="col-sm-4">
					<div>
						<label>Adres:</label>
					</div>
					<div>
						<input type="text" class="form-control" id="adresEkle"
							name="adresEkle">
					</div>
				</div>
				<div class="col-sm-4">
					<div>
						<label>Web Adresi:</label>
					</div>
					<div>
						<input type="text" class="form-control" id="webAdresiEkle"
							name="webAdresiEkle">
					</div>
				</div>
			</div>
		</form>
		</modal-body> <modal-footer kapat-icerik="Kapat">
		<button type="submit" class="btn btn-success"
			data-ng-click="firmaEkleme();">Ekle</button>
		</modal-footer> </modal>


		<section>
			<div id="returnData"></div>
		</section>
	</div>
</body>
</html>