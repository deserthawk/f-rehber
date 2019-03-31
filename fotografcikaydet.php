<!DOCTYPE html>
<html>
<!-- Begin Head -->
<head>
<title>Fotoğrafçı Kaydet</title>
        <?php
        require_once ('userDahilDosyalar.html');
        ?>
        <script type="text/javascript"
	src="./js/app/components/controller/fotografciKaydetController.js"></script>
    </head>
<!-- End Head -->
<!-- Body -->
<body data-ng-app="fotografRehber">
	<!--========== HEADER ==========-->
	<header class="navbar-fixed-top s-header-v2 js__header-sticky">
		<main-nav-bar color-class="g-color--dark"></main-nav-bar>
	</header>
	<!--========== END HEADER ==========-->
	<div class="g-position--relative g-bg-color--white" data-ng-controller="fotografciKaydetCtrl">
		<div class="g-container--md g-padding-y-125--xs">
			<div class="g-text-center--xs g-margin-t-50--xs g-margin-b-80--xs">
				<h2
					class="g-font-size-18--xs g-font-size-24--sm g-color--dark-opacity">Fotoğrafçı
					Kaydet</h2>
			</div>
			<form class="center-block g-width-500--sm g-width-550--md" name="userForm" ng-submit="submitForm(userForm.$valid)" novalidate>
				<div class="g-margin-b-30--xs">
					<input type="text" class="form-control s-form-v4__input"
						id="firmaAdi" name="firmaAdi" placeholder="* Fotoğrafçı Adı" ng-model="user.firmaAdi" required>
						<p ng-show="userForm.firmaAdi.$touched && userForm.firmaAdi.$invalid" class="help-block">Lütfen Firma adı alanını giriniz.</p>
				</div>
				<!-- tek kolon -->
				<div class="g-margin-b-30--xs">
					<input type="text" class="form-control s-form-v4__input"
						id="telefon" name="telefon" ng-model="user.telefon" placeholder="(___)___-____" required  ui-mask="(999)999-9999" >
				    <p ng-show="userForm.telefon.$touched && userForm.telefon.$invalid" class="help-block">Lütfen telefon alanını doldurunuz.</p>
				</div>
				<!-- end tek kolon -->
				<!-- çift kolon -->
				<div class="row g-row-col-5 g-margin-b-50--xs">
					<div class="col-sm-6 g-margin-b-30--xs g-margin-b-0--md">
						<input type="text" class="form-control s-form-v4__input"
							id="kisiad" name="kisiad" ng-model="user.kisiad" 
							placeholder="* Kişi Ad" required>
							<p ng-show="userForm.kisiad.$touched && userForm.kisiad.$invalid" class="help-block">Lütfen kişi ad alanını doldurunuz.</p>
					</div>
					<div class="col-sm-6">
						<input type="text" class="form-control s-form-v4__input"
							id="kisisoyad" name="kisisoyad" ng-model="user.kisisoyad"
							placeholder="* Kişi Soyad" required>
							<p ng-show="userForm.kisisoyad.$touched && userForm.kisisoyad.$invalid" class="help-block">Lütfen kişi soyad alanını doldurunuz.</p>
					</div>
				</div>
				<div class="g-margin-b-30--xs">
					<input type="email" class="form-control s-form-v4__input"
						id="email" name="email" ng-model="user.email" placeholder="* e-mail" required>
				    <p ng-show="userForm.email.$touched && userForm.email.$invalid" class="help-block">Lütfen e-mail alanını doldurunuz.</p>
				</div>

				<div class="g-text-center--xs ">
					<button type="submit" data-ng-click="fotografciEkle();"
						class="text-uppercase s-btn s-btn--md s-btn--primary-bg g-radius--50 g-padding-x-70--xs g-margin-b-20--xs">Kaydet</button>
				</div>

				<!-- end çift kolon -->
			</form>

		</div>

	</div>
</body>
</html>
