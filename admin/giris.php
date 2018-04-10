<!DOCTYPE HTML>
<html>
<head>
<?php
require_once ('../adminDahilDosyalar.html');
?>
<script type="text/javascript"
	src="../js/app/components/controller/girisController.js"></script>
<style type="text/css">
.container {
	max-width: 400px;
	padding-top: 100px;
}

.loginHeader {
	border-top-left-radius: 10px;
	border-top-right-radius: 10px;
	margin-right: 0px;
	margin-left: 0px;
}

.bc {
	background-color: #d2dfef;
}

.bs {
	border-style: solid;
	border-width: 1px;
	border-radius: 10px;
}

.pt-0 {
	padding-top: 10px;
}

.pb-0 {
	padding-bottom: 10px;
}

.pl-0 {
	padding-left: 10px;
}

.pl-1 {
	padding-left: 20px;
}

.pl-2 {
	padding-left: 30px;
}
.pr-0{
padding-right: 10px;
}
.pr-1{
padding-right: 20px;
}
.pr-2{
padding-right: 30px;
}

</style>
<title>Admin Giriş</title>
</head>
<?php 
session_start();
$_SESSION["sessionId"] = session_id ();
?>
<body data-ng-app="fotografRehber">
	<div class="container" data-ng-controller="girisCtrl">
		<div class="row bs">
			<form id="giris" name="giris">
			<input type="hidden" id="pGirisId" name="pGirisId" value="1501">
				<div class="row bc loginHeader pl-0 pt-0 pb-0">
					<div class="col-md-6 col-xs-12">Admin Girişi</div>
				</div>
				<div class="row">
					<div class="col-md-6 col-xs-6 pt-0 pl-1">Kullanıcı Adı:</div>
					<div class="col-md-6 col-xs-6 pt-0 pr-1">
						<input type="text" class="form-control">
					</div>
					<div class="col-md-6 col-xs-6 pt-0 pb-0 pl-1">Şifre:</div>
					<div class="col-md-6 col-xs-6 pt-0 pb-0 pr-1">
						<input type="password" class="form-control">
					</div>
				</div>
				<div class="row pl-2 pb-0">
					<div class="col-md-6 col-xs-12">
						<input type="button" class="btn btn-primary" id="btnGiris"
							data-ng-click="giris()" value="Giriş">
					</div>
				</div>
			</form>
		</div>
	</div>
</body>
</html>