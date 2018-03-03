app.controller('firmaListeleCtrl', function($scope, serverService,notificationService) {
	
	
	$scope.firmaEkleme = function() {
		var formData = $("#firmaEkleForm").serializeArray();
		serverService.sendJsonObject("../php/firma/firmaEkle.php",JSON.stringify(formData)).then(function(payload){
			console.log(payload.data);
			if(payload.data[0].warningId == 0){
				notificationService.success(payload.data[0].warningTnm);
			}
			else{
				notificationService.error1(payload.data[0].warningTnm);
			}
		$('#returnData').html(payload.data);
		});
	};
	
	
	$scope.firmaListGetir = function(){
		var formData = $("#theForm").serializeArray();
		serverService.sendJsonObject("../php/firma/firmaListele.php",JSON.stringify(formData)).then(function(payload){
			if(payload.data[0].warningId == 0){
				$scope.list=payload.data[1];
			}
			else{
				notificationService.error1(payload.data[0].warningTnm);
			}
		});
	};
	$scope.sehirList = function(){
		serverService.getComboList("../php/gnlDegerKumesi/gnlDegerKumesiComboList.php?degerKodu=IL").then(function(payload){
			$scope.ilList=payload.data;
		});
	};
	$scope.getIlceList = function(value){
		serverService.getComboList("../php/gnlDegerKumesi/gnlDegerKumesiComboListUstDeger.php?degerKodu=ILCE&ustDegerId="+value).then(function(payload){
			$scope.ilceList=payload.data;
		});
	};
	$scope.firmaGuncelle = function(value){
		window.open("../admin/firmaguncelle.php?firmaId="+ value);
	};
	$scope.firmaEkleModal = function(){
		$('#firmaEkleModal').modal('show');
	}
});