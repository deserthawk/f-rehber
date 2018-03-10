app.controller('firmaListeleCtrl', function($scope, serverService,notificationService) {
	$scope.firmaDetayGetir = function(firmaId){
		frmAdiGetir(firmaId);
		getFirmaFotografList(firmaId);
	};
	var frmAdiGetir = function(firmaId){
		serverService.getOneParameter("../php/firma/firmaG.php?pGetId=1501&pId="+firmaId).then(function(payload){
			//$('#returnData').html(payload.data);
			$scope.firmaAdi=payload.data.firma_adi;
		});
	};
	var getFirmaFotografList = function(firmaId){
		serverService.sendGetJson("../php/galeri/galeriG.php?pGetId=1501&pFirmaId="+firmaId).then(function(payload){
			//$('#returnData').html(payload.data);
			//$scope.firmaAdi=payload.data.firma_adi;
			$scope.list=payload.data;
			//console.log(payload.data);
		});
	};
});