<!DOCTYPE HTML>
<html>
<head>
<?php
require_once ('userDahilDosyalar.html');
?>
<script type="text/javascript"
	src="./js/app/components/controller/fotografciDetayController.js"></script>
<title>Fotoğrafçı Detay</title>
</head>
<body data-ng-app="fotografRehber">
	<!--========== HEADER ==========-->
	<header class="navbar-fixed-top s-header-v2 js__header-sticky">
		<main-nav-bar color-class="g-color--dark"></main-nav-bar>
	</header>
	<input type="hidden" id="mainFirmaID" name="mainFirmaID"
		value="<?php echo ($_GET["id"]); ?>">
	<div data-ng-controller="fotografciDetayCtrl"
		data-ng-init="fotografciDetayGetir(<?php echo ($_GET["id"]); ?>)">
		<!--========== PROMO BLOCK ==========-->
		<div class="g-bg-color--sky-light">
			<div class="container g-padding-y-150--xs">
				<div class="row">
					<div class="col-md-12">
						<div class="col-md-2">
							<img alt="" src="{{logoSrc}}">
						</div>
						<div class="col-md-10">
							<div class="col-md-12">
								<p class="g-font-size-18--xs g-font-size-18--md g-margin-b-0--xs">Fotoğrafçı Adı: {{firmaAdi}}</p>
							</div>
							<div ng-repeat="row in iletisimList track by $index">
    							<div class="col-md-12">
    								<p class="g-font-size-16--xs g-font-size-16--md g-margin-b-0--xs">{{row.deger}}: {{row.deger1}}</p>							
    							</div>
							</div>
							
							<div class="col-md-12">
								<p class="g-font-size-16--xs g-font-size-16--md g-margin-b-0--xs">Adres: {{adresText}}</p>							
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--========== END PROMO BLOCK ==========-->
		
		<!-- Portfolio Filter -->
<!--         <div class="container g-padding-y-100--xs"> -->
<!--             <div class="s-portfolio"> -->
<!--                 <div id="js__filters-portfolio-gallery" class="s-portfolio__filter-v1 cbp-l-filters-text cbp-l-filters-center"> -->
<!--                     <div data-filter="*" class="s-portfolio__filter-v1-item cbp-filter-item cbp-filter-item-active">Show All</div> -->
<!--                     <div data-filter=".graphic" class="s-portfolio__filter-v1-item cbp-filter-item">Graphic</div> -->
<!--                     <div data-filter=".logos" class="s-portfolio__filter-v1-item cbp-filter-item">Logo</div> -->
<!--                     <div data-filter=".motion" class="s-portfolio__filter-v1-item cbp-filter-item">Motion</div> -->
<!--                 </div> -->
<!--             </div> -->
<!--         </div> -->
        <!-- End Portfolio Filter -->
		
		<?php
		require_once ('./php/genelVTK.php');
		$genelVTK = new genelVTK();
		$fotoList = $genelVTK->getFirmaFotografList($_GET["id"]);
		?>
		
		<!-- Portfolio Gallery -->
		<div class="container">
			<div id="js__grid-portfolio-gallery" class="cbp">
		<?php 
		
		
		
		for($i = 0 ; $i<count($fotoList);$i++ ){ 
		    $tempObj = $fotoList[$i][0];
		    ?>
		<!-- Item -->
				<div class="s-portfolio__item cbp-item">
                    <div class="s-portfolio__img-effect">
                        <img src="<?php echo $tempObj ?>" alt="Portfolio Image">
                    </div>
                    <div class="s-portfolio__caption-hover--cc">
                        <div class="g-margin-b-25--xs">
                            <h2 class="g-font-size-18--xs g-color--white g-margin-b-5--xs">Portfolyö</h2>
                            <p class="g-color--white-opacity">{{firmaAdi}}</p>
                        </div>
                        <ul class="list-inline g-ul-li-lr-5--xs g-margin-b-0--xs">
                            <li>
                                <a href="<?php echo $fotoList[$i][0]?>" class="cbp-lightbox s-icon s-icon--sm s-icon--white-bg g-radius--circle" data-title="Portfolyö <br/> {{firmaAdi}}">
                                    <i class="ti-fullscreen"></i>
                                </a>
                            </li>
                            
                        </ul>
                    </div>
                </div>
		
		
		<?php     
		}
		?>	
			
			</div>
		</div>

		
	</div>
<div id="returnData"></div>
</body>
</html>