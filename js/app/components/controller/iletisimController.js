app.controller('iletisimCtrl', function($scope, serverService,notificationService) {
	$scope.konuGetir = function(){
		serverService.getComboList("./php/gnlDegerKumesi/gnlDegerKumesiComboList.php?degerKodu=ILTSM_KONU").then(function(payload){
			$scope.konuList=payload.data;
		});
	};
	
	$scope.iletisimEkle = function(){
		var formData = $("#theForm").serializeArray();
		var fd = new FormData();
		for(i=0;i<formData.length;i++){
	    	fd.append(formData[i].name,formData[i].value);
	    }
		serverService.sendFormDataObject("./php/iletisim/iletisimP.php",fd).then(function(payload){
			debugger;
			if(payload.data[0].warningId == 0){
				$("#warningMessageSuccess").show();
				$("#warningMessageDanger").hide();
				$scope.returnMessageSuccess = payload.data[0].warningTnm;
			}
			else if(payload.data[0].warningId == 1){
				$("#warningMessageDanger").show();
				$("#warningMessageSuccess").hide();
				$scope.returnMessageDanger = payload.data[0].warningTnm;
			}
			else{
				$("#warningMessageDanger").show();
				$("#warningMessageSuccess").hide();
				$('#warningMessageDanger').html(payload.data);
				//$scope.returnMessageDanger = payload.data;
			}
	
		});
	};
});