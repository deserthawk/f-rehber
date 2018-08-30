<!DOCTYPE html>
<html>
<!-- Begin Head -->
<head>
<title>İletişim</title>
        <?php
        require_once ('userDahilDosyalar.html');
        ?>
        <script type="text/javascript"
	src="./js/app/components/controller/iletisimController.js"></script>
	
    </head>
<!-- End Head -->

<!-- Body -->
<body data-ng-app="fotografRehber">
<!--========== HEADER ==========-->
	<header class="navbar-fixed-top s-header-v2 js__header-sticky">
		<main-nav-bar color-class="g-color--dark"></main-nav-bar>
	</header>
	<!--========== END HEADER ==========-->
	
	<div class="g-position--relative g-bg-color--white" data-ng-controller="iletisimCtrl"
		data-ng-init="konuGetir();">
            <div class="g-container--md g-padding-y-125--xs">
                <div class="g-text-center--xs g-margin-t-50--xs g-margin-b-60--xs">
                    <h2 class="g-font-size-32--xs g-font-size-36--sm g-color--dark g-margin-b-20--xs">İletişim</h2>
                    <p class="g-font-size-16--xs g-color--dark-opacity">Sorularınız ve önerileriniz için formu doldurup gönderebilirsiniz.</p>
                </div>
                
                <div class="row g-row-col--5 g-margin-b-80--xs">
                    <div class="col-xs-12 g-full-width--xs g-margin-b-50--xs g-margin-b-0--sm">
                        <div class="g-text-center--xs">
                            <i class="g-display-block--xs g-font-size-40--xs g-color--dark-opacity g-margin-b-30--xs ti-email"></i>
                            <h4 class="g-font-size-18--xs g-color--dark g-margin-b-5--xs">e-posta</h4>
                            <p class="g-color--dark-opacity">support@keenthemes.com</p>
                        </div>
                    </div>          
                </div>
                <form class="center-block g-width-500--sm g-width-550--md" id="theForm">
                	<input type="hidden" id="pGetId" name="pGetId" value="1501"> 
                    <div class="g-margin-b-30--xs">
        				<select data-ng-model="iletisimKonu" class="form-control s-form-v4__input"
        					name="iletisimKonu" id="iletisimKonu">
        					<option value="">KONU SEÇİNİZ</option>
    					<option ng-repeat="konular in konuList" value="{{konular.ID}}">{{konular.DEGER}}</option>
        				</select>
    				</div>
                    <div class="g-margin-b-30--xs">
                        <input type="text" class="form-control s-form-v4__input" placeholder="* Ad Soyad" name="adSoyad" id="adSoyad">
                    </div>
                    <div class="row g-row-col-5 g-margin-b-50--xs">
                        <div class="col-sm-6 g-margin-b-30--xs g-margin-b-0--md">
                            <input type="email" class="form-control s-form-v4__input" placeholder="e-Posta" name="ePosta" id="ePosta">
                        </div>
                        <div class="col-sm-6">
                            <input type="text" class="form-control s-form-v4__input" placeholder="Telefon" name="telefon" id="telefon">
                        </div>
                    </div>
                    <div class="g-margin-b-80--xs">
                        <textarea class="form-control s-form-v4__input" rows="5" placeholder="* Mesaj" name="mesaj" id="mesaj"></textarea>
                    </div>
                    <div class="alert alert-success" style="display:none;" id="warningMessageSuccess">
  						<strong>{{returnMessageSuccess}}</strong>
					</div>
                    <div class="alert alert-danger" style="display:none;" id="warningMessageDanger">
  						<strong>{{returnMessageDanger}}</strong>
					</div>
                    <div class="g-text-center--xs">
                        <button type="submit" data-ng-click="iletisimEkle();" class="text-uppercase s-btn s-btn--md s-btn--primary-bg g-radius--50 g-padding-x-70--xs g-margin-b-20--xs">Gönder</button>
                    </div>
                    
                </form>
            </div>
            
            <img class="s-mockup-v2" src="img/mockups/pencil-01.png" alt="Mockup Image">
        </div>

		
</body>
</html>