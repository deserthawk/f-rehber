<!DOCTYPE HTML>
<html>
<head>
<?php
require_once ('../adminDahilDosyalar.html');
require_once ('kullaniciKontrol.php');
?>
<script type="text/javascript"
	src="../js/app/components/controller/firmaGuncelleController.js"></script>
<style>
.tableform label{
font-weight: normal;
}
.tableform td{
padding-left: 10px;
}
.heightModal{
height:100px;
}
.dgHeightModal{
height:200px;
}
.padding-top10{
padding-top: 10px;
}
</style>
<title></title>
</head>
<body data-ng-app="fotografRehber">
<input type="hidden" id="mainFirmaID" name="mainFirmaID" value="<?php echo ($_GET["firmaId"]); ?>">
<input type="hidden" id="mainFirmaDrm" name="mainFirmaDrm" data-ng-model="mainFirmaDrm">
	<div data-ng-controller="firmaGuncelleCtrl"
		data-ng-init="getSehirList(); firmaDetayGetir(<?php echo ($_GET["firmaId"]); ?>); getIletisimTipList();getFirmaDurumList();">
		<div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
   
   
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">{{firmaAdi}}</h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="{{logoSrc}}" class="img-circle img-responsive"> 
                </div>
                
                
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>Firma Adı:</td>
                        <td><input class="form-control" type="text"
							id="firmaAdi" name="firmaAdi" data-ng-model="firmaAdi"></td>
                      </tr>
                      <form  id="logoGuncelleForm" name="logoGuncelleForm" method="post" enctype="multipart/form-data">
                      <input type="hidden" id="logoGuncelleFormTipId" name="logoGuncelleFormTipId" value="1512">
                      <input type="hidden" id="logoGuncelleFirmaId" name="logoGuncelleFirmaId" value="<?php echo ($_GET["firmaId"]); ?>">
                      <tr>
                      <td>Logo</td>
                      <td>
    					<input type="file" file-model="myFile" name="fileToUpload" id="fileToUpload" >
                      </td>
                      <td>
                      <button type="button"
										class="btn btn-default glyphicon glyphicon-upload"
										data-toggle="modal" data-target="#firmaDetayModal"
										data-ng-click="firmaLogoGuncelle('logoGuncelleForm');"></button>
                      </td> 
                      </tr>
                      </form>
                      <tr>
                        <td>Firma Durum:</td>
                        <td>{{firmaDrm}}</td>
                        <td><button type="button"
										class="btn btn-default glyphicon glyphicon-edit"
										data-toggle="modal" data-target="#firmaDetayModal"
										data-ng-click="durumGuncelleModal();"></button></td>
                      </tr>
                      <tr ng-repeat="row in iletisimList track by $index">
                      <td>{{row.deger}}</td>
                      <td>{{row.deger1}}</td>
                      <td><button type="button"
										class="btn btn-default glyphicon glyphicon-edit"
										data-toggle="modal" data-target="#firmaDetayModal"
										data-ng-click="iletisimGuncelleModal(row);"></button></td>
                      </tr>
                    </tbody>
                  </table>
                  
                  
<!--                   <a href="#" class="btn btn-primary">My Sales Performance</a> -->
<!--                   <a href="#" class="btn btn-primary">Team Sales Performance</a> -->
                </div>
              </div>
            </div>
                 <div class="panel-footer">
                 <button type="button"	class="btn btn-primary"
						data-toggle="modal" data-target="#firmaDetayModal"
						data-ng-click="iletisimEkleModal();">İletişim Bilgisi Ekle</button>
						
<!--                         <a data-original-title="Broadcast Message" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-envelope"></i></a> -->
<!--                         <span class="pull-right"> -->
<!--                             <a href="edit.html" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a> -->
<!--                             <a data-original-title="Remove this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a> -->
<!--                         </span> -->
                    </div>
            
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
   
   
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">Adres</h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <form id="adresGuncelleForm" name="adresGuncelleForm">
                		<input type="hidden" id="adresGuncelleFormTipId" name="adresGuncelleFormTipId" value="1512">
                		<input type="hidden" id="adresGuncelleId" name="adresGuncelleId">
                		<input type="hidden" id="adresGuncelleFirmaId" name="adresGuncelleFirmaId" value="<?php echo ($_GET["firmaId"]); ?>">
                    <div class=" col-md-12 col-lg-12 "> 
                      <table class="table table-user-information">
                        <tbody>
                          <tr>
                            <td>Şehir:</td>
    						<td><select data-ng-model="ilGuncelle" class="form-control"
    								name="ilGuncelle" id="ilGuncelle" ng-change="getIlceList(ilGuncelle);">
    									<option value="">Seçiniz...</option>
    									<option ng-repeat="ilLer in ilList" value="{{ilLer.ID}}">{{ilLer.DEGER}}</option>
    							</select>
    						</td>
    					  </tr>
    					  <tr>
                            <td>İlçe:</td>
    						<td>
    							<select data-ng-model="ilceGuncelle" class="form-control" name="ilceGuncelle" id ="ilceGuncelle" >
    					    		<option ng-repeat="ilceLer in ilceList" value="{{ilceLer.ID}}">{{ilceLer.DEGER}} </option>
    							</select>
    						</td>
    					  </tr>
    					  <tr>
                            <td>Adres:</td>
    						<td>
    							<textarea data-ng-model="adresGuncelle" name="adresGuncelle" id="adresGuncelle" class="form-control" rows="5"></textarea>
    						</td>
    					  </tr>
                        </tbody>
                      </table>
                    </div>
                </form>
              </div>
            </div>
                 <div class="panel-footer">
                 <button type="button" class="btn btn-primary glyphicon glyphicon-floppy-disk"
						data-toggle="modal" data-target="#firmaDetayModal"
						data-ng-click="iletisimGuncelle('adresGuncelleForm');"></button>
                    </div>
            
          </div>
        </div>
      </div>
      
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
   
   
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">Kontak Personel</h3>
            </div>
            <div class="panel-body">
              <div class="row">
               <form id="kontakPersonelGuncelleForm" name="kontakPersonelGuncelleForm">
               			<input type="hidden" id="kontakPersonelGuncelleFormTipId" name="kontakPersonelGuncelleFormTipId" value="1513">
                		<input type="hidden" id="kontakPersonelGuncelleId" name="kontakPersonelGuncelleId">
                		<input type="hidden" id="kontakPersonelGuncelleFirmaId" name="kontakPersonelGuncelleFirmaId" value="<?php echo ($_GET["firmaId"]); ?>">
                		<div class=" col-md-12 col-lg-12 ">
                		<table class="table table-user-information">
                        <tbody>
                          <tr>
                            <td>Kontak Kişi Ad Soyad:</td>
    						<td>
    							<input class="form-control" type="text" id="kontakPersonelGuncelleAdSoyad" name="kontakPersonelGuncelleAdSoyad" data-ng-model="kontakPersonelGuncelleAdSoyad">
    						</td>
    					  </tr>
    					  <tr>
                            <td>Telefon:</td>
    						<td>
    							<input class="form-control" type="text" id="kontakPersonelGuncelleTelefon" name="kontakPersonelGuncelleTelefon" data-ng-model="kontakPersonelGuncelleTelefon">
    						</td>
    					  </tr>
    					  <tr>
                            <td>Email:</td>
    						<td>
    							<input class="form-control" type="text" id="kontakPersonelGuncelleEmail" name="kontakPersonelGuncelleEmail" data-ng-model="kontakPersonelGuncelleEmail">
    						</td>
    					  </tr>
                        </tbody>
                      </table>
                		 
                		</div>
               </form>
              </div>
            </div>
                 <div class="panel-footer">
                 <button type="button" class="btn btn-primary glyphicon glyphicon-floppy-disk"
						data-toggle="modal" data-target="#firmaDetayModal"
						data-ng-click="iletisimGuncelle('kontakPersonelGuncelleForm');"></button>
                    </div>
            
          </div>
        </div>
      </div>
    </div>
    <!-- FİRMA İLETİŞİM BİLSİGİ GÜNCELLE START -->
		<modal modal-name="iletisimGuncelleModal" modal-class="modal-dialog modal-md"> 
			<modal-header>Firma	İletişim Bilgisi Güncelle</modal-header> 
    			<modal-body modal-class="heightModal">
    				<form id="iletisimGuncelleForm" name="iletisimGuncelleForm" method="post">
    					<input type="hidden" id="iletisimGuncelleFormTipId" name="iletisimGuncelleFormTipId" value="1511">
    					<input type="hidden" id="iletisimGuncelleId" name="iletisimGuncelleId">
    					<input type="hidden" id="iletisimGuncelleFirmaId" name="iletisimGuncelleFirmaId">
    					<input type="hidden" id="iletisimGuncelleIletisimTipId" name="iletisimGuncelleIletisimTipId">
            			<div class="form-inline col-sm-12">
                			<div class="col-sm-12">
                        		<div class="form-group">
                        			<div class="form-inline">
                        				<label>{{iletisimLabel}}</label> <input class="form-control" type="text"
                        					id="iletisimGuncelleDeger1" name="iletisimGuncelleDeger1" data-ng-model="iletisimInput">
                        			</div>
                        		</div>
                        	</div>
                    	</div>
                	</form>
            	</modal-body> 
            <modal-footer kapat-icerik="Kapat">
        		<button type="submit" class="btn btn-success"
        			data-ng-click="iletisimGuncelle('iletisimGuncelleForm');">Güncelle</button>
    		</modal-footer> 
		</modal>
		<!-- FİRMA İLETİŞİM BİLSİGİ GÜNCELLE END -->
		<!-- FİRMA İLETİŞİM BİLSİGİ EKLE START -->
		<modal modal-name="iletisimEkleModal" modal-class="modal-dialog modal-md"> 
			<modal-header>Firma	İletişim Bilgisi Ekle</modal-header> 
    			<modal-body modal-class="heightModal">
    				<form id="iletisimEkleForm" name="iletisimEkleForm" method="post">
    					<input type="hidden" id="iletisimEkleFormTipId" name="iletisimEkleFormTipId" value="1514">
    					<input type="hidden" id="iletisimEkleFirmaId" name="iletisimEkleFirmaId">
            			<div class="col-sm-12">
                			<div class="col-sm-12">
                        		<div class="form-group">
            							<table class="table table-user-information">
            								<tr>
            									<td>İletişim Tipi</td>
            									<td><select data-ng-model="iletisimTipEkle" class="form-control"
            										name="iletisimTipEkle" id="iletisimTipEkle">
            											<option value="">Seçiniz...</option>
            											<option ng-repeat="iletisimTipLer in iletisimTipList" value="{{iletisimTipLer.ID}}">{{iletisimTipLer.DEGER}}</option>
            									</select></td>
            								</tr>
            								<tr>
            									<td>Değer</td>
            									<td><input class="form-control" type="text" id="iletisimDegerEkle" name="iletisimDegerEkle" data-ng-model="iletisimDegerEkle"></td>
            								</tr>
            							</table>
            					</div>
                        	</div>
                    	</div>
                	</form>
            	</modal-body> 
            <modal-footer kapat-icerik="Kapat">
        		<button type="submit" class="btn btn-success"
        			data-ng-click="iletisimEkle('iletisimEkleForm');">Ekle</button>
    		</modal-footer> 
		</modal>
		<!-- FİRMA İLETİŞİM BİLSİGİ EKLE END -->
		<!-- FİRMA DURUM/NOT GÜNCELLE START -->
		<modal modal-name="durumGuncelleModal" modal-class="modal-dialog modal-md"> 
			<modal-header>Firma	Durum/Not Güncelle</modal-header> 
    			<modal-body modal-class="dgHeightModal">
    				<form id="durumGuncelleForm" name="durumGuncelleForm" method="post">
    					<input type="hidden" id="durumGuncelleFormTipId" name="durumGuncelleFormTipId" value="1511">
    					<input type="hidden" id="durumGuncelleFirmaId" name="durumGuncelleFirmaId" value="<?php echo ($_GET["firmaId"]); ?>">
            			<div class="col-s-12">
                			<div class="col-sm-12">
                        		<div class="form-group">
            							<table class="table table-user-information">
            								<tr>
            									<td>Firma Durum</td>
            									<td><select data-ng-model="firmaDurumGuncelle" class="form-control"
            										name="firmaDurumGuncelle" id="firmaDurumGuncelle">
            											<option value="">Seçiniz...</option>
            											<option ng-repeat="firmaDurumLar in firmaDurumList" value="{{firmaDurumLar.ID}}">{{firmaDurumLar.DEGER}}</option>
            									</select></td>
            								</tr>
            								<tr>
            									<td>Not</td>
            									<td><textarea class="form-control" id="durumGuncelleNot" name="durumGuncelleNot" data-ng-model="durumGuncelleNot" rows="5"></textarea></td>
            								</tr>
            							</table>
            					</div>
                        	</div>
                    	</div>
                	</form>
            	</modal-body> 
            <modal-footer kapat-icerik="Kapat">
        		<button type="submit" class="btn btn-success"
        			data-ng-click="firmaDrmNotGuncelle();">Güncelle</button>
    		</modal-footer> 
		</modal>
		<!-- FİRMA DURUM/NOT GÜNCELLE END -->
	</div>
	<section>
			<div id="returnData"></div>
	</section>
</body>
</html>