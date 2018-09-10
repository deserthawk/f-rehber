<!DOCTYPE html>
<html>
<!-- Begin Head -->
<style>
.img-radius_1 {
    height: 100px; 
    width: 100px; 
    overflow: hidden;
    border-radius: 50%;
}
</style>
<head>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-125243469-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-125243469-1');
</script>

<title>Fotoğrafçı Listesi</title>
        <?php
        require_once ('userDahilDosyalar.html');
        ?>
        <script type="text/javascript"
	src="./js/app/components/controller/fotografciListeleController.js"></script>
</head>
<!-- End Head -->

<!-- Body -->
<body data-ng-app="fotografRehber">
	<!--========== HEADER ==========-->
	<header class="navbar-fixed-top s-header-v2 js__header-sticky">
		<main-nav-bar color-class="g-color--dark"></main-nav-bar>
	</header>
	<!--========== END HEADER ==========-->
	
	<!--========== PROMO BLOCK ==========-->
<!--          
    <div class="g-fullheight--md js__parallax-window" style="background: url(img/site/fotografcilistele01.jpg) 50% 0 no-repeat fixed;">

    </div>
        -->
    <!--========== END PROMO BLOCK ==========-->
	
	<div class="g-position--relative g-bg-color--sky-light"
		data-ng-controller="fotografciListeleCtrl"
		data-ng-init="fotografciListGetir();sehirList();">
		<div class="g-container--md  g-padding-y-150--xs">

			<form id="theForm" name="theForm">
				<input type="hidden" id="fotografciListTipId" name="fotografciListTipId" value="1501"> 
				<input type="hidden" id="rNum" name="rNum" value="2">
				
				<div class="g-margin-b-30--xs">
					<input type="text" class="form-control s-form-v4__input"
						id="firmaAdi" name="firmaAdi" placeholder="FİRMA ADI GİRİNİZ">
				</div>
				<div class="g-margin-b-30--xs">
    				<select data-ng-model="ilAra" class="form-control s-form-v4__input"
    					name="ilAra" id="ilAra">
    					<option value="">İl SEÇİNİZ</option>
    					<option ng-repeat="ilLer in ilList" value="{{ilLer.ID}}">{{ilLer.DEGER}}</option>
    				</select>
				</div>
				<div>
					<input type="button" id="btnFirmaAra"
						class="text-uppercase s-btn s-btn--md s-btn--white-bg g-radius--50 g-padding-x-70--xs g-margin-b-20--xs"
						data-ng-click="fotografciListGetir()" value="Ara">
				</div>
			</form>

			<div class="row g-row-col-5 g-margin-b-50--xs g-padding-y-20--lg g-padding-x-30--lg" ng-repeat="row in list track by $index">
    			<div class="col-sm-2 g-margin-b-30--xs g-margin-b-0--md">
    			<div class=" img-radius_1">
    				<img class="g-bg-color--white" width="100px"  src="img/firma/logo/{{row.firma_logo}}">
    				</div>
    			</div>
    			<div class="col-sm-10">
    				{{row.firma_adi}}
    			</div>
    			<div>
    			<input type="button" class="btn btn-primary" id="btnFirmaEkle"
						data-ng-click="fotografciDetay(row.id)" value="İncele" >
    			</div>
			</div>
			
			<input type="button" id="btnFirmaAra" 
				class="text-uppercase s-btn s-btn--md s-btn--white-bg g-radius--50 g-padding-x-70--xs g-margin-b-20--xs" 
				data-ng-click="dahaFotografciListGetir()" 
				value="Daha Fazla Kayıt Getir">
			
		</div>
		</div>
	<!-- <div id="returnData"></div> -->
</body>
</html>