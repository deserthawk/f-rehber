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
			<div class="row "  >
    			<div class="col-lg-4 col-md-6 col-sm-6" style="border-style: solid; border-width: 0px;text-align: center; border-radius: 5%;" ng-repeat="row in list track by $index">
    				<div class="g-radius--50 col-lg-12 offset-lg-3 g-margin-t-20--xs" >
        				<img class="g-bg-color--white" width="100px"  src="img/firma/logo/{{row.firma_logo}}">
        			</div>
        			<div class=" col-lg-12 g-radius--50 g-margin-t-20--xs">{{row.firma_adi}}</div>
        			<div class="col-lg-12 g-radius--50 g-margin-t-20--xs g-margin-b-20--xs">
        				<input type="button" class="text-uppercase s-btn s-btn--md s-btn--white-bg g-radius--50" id="btnFirmaEkle"
    						data-ng-click="fotografciDetay(row.id)" value="İncele" >
    				</div>
        		</div>    			
			</div>
			
			<input type="button" id="btnFirmaAra" 
				class="text-uppercase s-btn s-btn--md s-btn--white-bg g-radius--50 g-padding-x-70--xs g-margin-b-20--xs" 
				data-ng-click="dahaFotografciListGetir()" 
				value="Daha Fazla Kayıt Getir">
			
		</div>
		</div>
	<!-- <div id="returnData"></div> -->
	<!--========== FOOTER ==========-->
        <footer class="g-bg-color--white">
            <!-- Links -->
            
            <!-- End Links -->

            <!-- Copyright -->
            <div class="container g-padding-y-50--xs">
                <div class="row">
                    <div class="col-xs-6">
                        <a href="index.php">
                            <img class="g-width-100--xs g-height-auto--xs" src="img/logo.png" alt="Megakit Logo">
                        </a>
                    </div>
                </div>
            </div>
            <!-- End Copyright -->
        </footer>
        <!--========== END FOOTER ==========-->
</body>
</html>