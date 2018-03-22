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
	height: 870px;
}

.padding-top10 {
	padding-top: 10px;
}
</style>
<title>Fotoğraf Listesi</title>
</head>
<body data-ng-app="fotografRehber">
	<div data-ng-controller="firmaListeleCtrl"
		data-ng-init="firmaDetayGetir(<?php echo ($_GET["firmaId"]); ?>);getEtiketList();getOnayList();">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12  toppad">
					<div class="panel panel-info">
						<div class="panel-heading">
							<h3 class="panel-title">{{firmaAdi}}</h3>
						</div>
						<div class="panel-body">
							<div class="row">
								<table st-table="displayedCollection"
									st-safe-src="rowCollection" class="table table-striped">
									<thead>
										<tr>
											<th>İncele</th>
											<th>Dosya Adı</th>
											<th>Durum</th>
											<th>Önizleme</th>
											<th>Not</th>
										</tr>
									</thead>
									<tbody>
										<tr ng-repeat="row in list track by $index"
											ng-class="{'selected':$index == selectedRow}"
											data-ng-click="setClickedRow($index)">
											<td style="width: 2%;"><button type="button"
													class="btn btn-default glyphicon glyphicon-search"
													data-ng-click="fotografTanimlama(row.id,row.b_dosya_adi,row.fotograf_durum,row.fotograf_not);"></button></td>
											<td>{{row.dosya_adi}}</td>
											<td>{{row.fotograf_durum_tnm}}</td>
											<td><img  src="{{row.k_dosya_adi}}" height="50px" ></td>
											<td style="width: 20%;">{{row.fotograf_not}}</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- FOTOGRAF TANIMLAMA START -->
		<modal modal-name="fotografTanimlamaModal" modal-class="modal-dialog modal-lg"> 
			<modal-header>Fotoğraf Tanımlama</modal-header> 
    			<modal-body modal-class="heightModal">
    				<form id="fotografTanimlaForm" name="fotografTanimlaForm" method="post">
    					<input type="hidden" id="fotografTanimlaFormTipId" name="fotografTanimlaFormTipId" value="1511">
    					<input type="hidden" id="fotografTanimlaFormId" name="fotografTanimlaFormId">
    					<input type="hidden" id="fotografTanimlaFormFirmaId" name="fotografTanimlaFormFirmaId">
            			<div class="form-inline col-sm-12">
                			<div class="col-sm-12">
                        		<div class="form-group">
                        			<div class="form-inline">
                        				<img id="fotografTanimlaFormImg" src="" height="555px">
                        			</div>
                        		</div>
                        	</div>
                    	</div>
                    	<div class="form-inline col-sm-12">
                    	<ul class="tags">
										<li ng-repeat="etiket in etiketList track by $index"><a href="#" data-ng-click="fotografEtiketSil(etiket.id)"> {{etiket.deger}}</a>
										
										</li>
						</ul>
						</div>
						<div class="form-inline col-sm-12 form-padding">
						<legend>Fotoğraf Etiket İşlemi</legend>
                        			<select data-ng-model="etiketGuncelle" class="form-control"
    								name="etiketGuncelle" id="etiketGuncelle">
    									<option value="">Seçiniz...</option>
    									<option ng-repeat="etiketLer in etiketDegerList" value="{{etiketLer.ID}}">{{etiketLer.DEGER}}</option>
    							</select>
    							<button type="button"
													class="btn btn-default"
													data-ng-click="fotografEtiketEkle();">Ekle</button>
                        </div>
            			<div class="form-inline col-sm-12 form-padding">
            			<legend>Fotoğraf Onay İşlemi</legend>
            			<label>Not</label>
            			<textarea rows="4" cols="50" id="fotografTanimlaFormNot">
            			</textarea>
            			</div>
            			<div class="form-inline col-sm-12 form-padding">
            				
            				<select data-ng-model="onayGuncelle" class="form-control"
            					name="onayGuncelle" id="onayGuncelle">
            					<option value="">Seçiniz...</option>
            					<option ng-repeat="onayLar in onayList" value="{{onayLar.ID}}">{{onayLar.DEGER}}</option>
            				</select>
            			</div>
		</form>
            	</modal-body> 
            <modal-footer kapat-icerik="Kapat">
        		<button type="submit" class="btn btn-success"
        			data-ng-click="iletisimGuncelle('iletisimGuncelleForm');">Güncelle</button>
    		</modal-footer> 
		</modal>
		<!-- FOTOGRAF TANIMLAMA END -->
	</div>
	<div id="returnData"></div>
</body>
</html>