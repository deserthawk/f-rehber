app.controller('fotografciKaydetCtrl', function($scope, serverService,notificationService) {
	
	$scope.ilGetir = function(){
		serverService.getComboList("./php/gnlDegerKumesi/gnlDegerKumesiComboList.php?degerKodu=IL").then(function(payload){
			$scope.ilList=payload.data;
		});
	};
	
	$scope.ilceGetir = function(value){
		serverService.getComboList("./php/gnlDegerKumesi/gnlDegerKumesiComboListUstDeger.php?degerKodu=ILCE&ustDegerId="+value).then(function(payload){
			$scope.ilceList=payload.data;
		});
	};
	
	$scope.fotografciEkle = function(isValid){
		if(!isValid){
			$("#warningMessageDanger").show();
			$("#warningMessageSuccess").hide();
			$scope.returnMessageDanger = "Lütfen zorunlu alanları doldurun.";
			return;
		}
		var formData = $("#userForm").serializeArray();
		var fd = new FormData();
		for(i=0;i<formData.length;i++){
	    	fd.append(formData[i].name,formData[i].value);
	    }
		serverService.sendFormDataObject("./php/firma/firmaP.php",fd).then(function(payload){
			if(payload.data[0].warningId == 0){
				$("#warningMessageSuccess").show();
				$("#warningMessageDanger").hide();
				$scope.returnMessageSuccess = payload.data[0].warningTnm;
			}
			else if(payload.data[0].warningId == 1){
				$("#warningMessageDanger").show();
				$("#warningMessageSuccess").hide();
				$scope.returnMessageDanger = payload.data[0].warningTnm;
				grecaptcha.reset();
			}
			else{
				$("#warningMessageDanger").show();
				$("#warningMessageSuccess").hide();
				$('#warningMessageDanger').html(payload.data);
				grecaptcha.reset();
			}
	
		});
	}
});