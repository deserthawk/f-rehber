<!DOCTYPE HTML>
<html>
<head>
<?php
require_once ('../adminDahilDosyalar.html');
require_once ('kullaniciKontrol.php');
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
.fotografYukleModal{
	height: 50px;
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
						<div>
						<button type="button"
													class="btn btn-default"
													data-ng-click="fotografYukleModal()">Fotoğraf Yükle</button>
						</div>
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
											<th style="width: 1%; text-align: center;">Sil</th>
										</tr>
									</thead>
									<tbody>
										<tr ng-repeat="row in list track by $index"
											ng-class="{'selected':$index == selectedRow}"
											data-ng-click="setClickedRow($index)">
											<td style="width: 2%;"><button type="button"
													class="btn btn-default glyphicon glyphicon-search"
													data-ng-click="fotografTanimlama(row.id,row.b_dosya_adi,row.fotograf_durum,row.fotograf_not,row.firma_id);"></button></td>
											<td>{{row.dosya_adi}}</td>
											<td>{{row.fotograf_durum_tnm}}</td>
											<td><img  src="{{row.k_dosya_adi}}" height="50px" ></td>
											<td style="width: 20%;">{{row.fotograf_not}}</td>
											<td style="width: 1%; text-align: center;">
											<button type="button"
													class="btn btn-danger glyphicon glyphicon-trash"
													data-ng-click="fotografSil(row.id,row.firma_id);"></button>
											</td>
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
    					<input type="hidden" id="fotografTanimlaFormNotHidden" name="fotografTanimlaFormNotHidden">
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
            			<label class="col-sm-2">Not</label>
            			<textarea class="form-control col-sm-4" rows="4" cols="50" id="fotografTanimlaFormNot">
            			</textarea>
            			</div>
            			<div class="form-inline col-sm-12 form-padding">
            				<label class="col-sm-2">Onay durumu</label>
            				<select class="form-control col-sm-4" data-ng-model="onayGuncelle" class="form-control"
            					name="onayGuncelle" id="onayGuncelle">
            					<option value="">Seçiniz...</option>
            					<option ng-repeat="onayLar in onayList" value="{{onayLar.ID}}">{{onayLar.DEGER}}</option>
            				</select>
            			</div>
		</form>
            	</modal-body> 
            <modal-footer kapat-icerik="Kapat">
        		<button type="submit" class="btn btn-success"
        			data-ng-click="fotografGuncelle();">Güncelle</button>
    		</modal-footer> 
		</modal>
		<!-- FOTOGRAF TANIMLAMA END -->
		<!-- FOTOGRAF YUKLE START -->
		<div class="modal fade" id="fotografYukleModal" role="dialog">
  			<div class="modal-dialog modal-md">
    			<div class="modal-content">
      				<div class="modal-header">
        				<h4 class="modal-title">Fotoğraf Yükle</h4>
        				<button type="button" class="close" data-dismiss="modal"></button>
      				</div>
      				<div class="modal-body">
        				<form  id="fotografYukleForm" name="fotografYukleForm" method="post" enctype="multipart/form-data">
        					<input type="hidden" id="fotografYukleFirmaId" name="fotografYukleFirmaId" value="<?php echo ($_GET["firmaId"]); ?>">
        					<input type="hidden" id="fotografYukleFormTipId" name="fotografYukleFormTipId" value="1521">
            				<input type="file" file-model="myFile" name="fileToUpload" id="fileToUpload" >
        				</form>
      				</div>
      				<div class="modal-footer">
          				<div style="float:left">
          					<button type="button" class="btn btn-success" data-ng-click="fotografYukle();">Dosya Yükle</button>
          				</div>
        				<button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
              </div>
            </div>
          </div>
        </div>
		<!-- FOTOGRAF YUKLE END -->
	</div>
	<div id="returnData"></div>
</body>
</html>