app.controller('iletisimListesiCtrl', function($scope, serverService,notificationService) {
	$scope.konuGetir = function(){
		serverService.getComboList("../php/gnlDegerKumesi/gnlDegerKumesiComboList.php?degerKodu=ILTSM_KONU").then(function(payload){
			$scope.konuList=payload.data;
		});
	};
	
	$scope.mesajDurumGetir = function(){
		serverService.getComboList("../php/gnlDegerKumesi/gnlDegerKumesiComboList.php?degerKodu=ILTSM_DRM").then(function(payload){
			$scope.mesajDurumList=payload.data;
		});
	};
	
	$scope.iletisimAra = function(){

	}
});