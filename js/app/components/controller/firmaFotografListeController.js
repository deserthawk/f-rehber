app.controller('firmaListeleCtrl', function($scope, serverService,notificationService) {
	$scope.firmaDetayGetir = function(firmaId){
		frmDetayetir(firmaId);
	};
	var frmDetayetir = function(firmaId){
		serverService.getOneParameter("../php/firma/firmaG.php?pGetId=1501&pId="+firmaId).then(function(payload){
			//$('#returnData').html(payload.data);
			$scope.firmaAdi=payload.data.firma_adi;
		});
	};
});