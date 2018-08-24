app.controller('fotografciListeleCtrl', function($scope, serverService,sabitler) {
	
	$scope.fotografciListGetir = function(){
		$('#rNum').val(sabitler.ROW_DEGER);
		var formData = $("#theForm").serializeArray();
		var fd = new FormData();
		for(i=0;i<formData.length;i++){
	    	fd.append(formData[i].name,formData[i].value);
	    	console.log("name: " +formData[i].name + " value: " + formData[i].value);
	    }
		serverService.sendFormDataObject("./php/firma/firmaP.php",fd).then(function(payload){
			if(payload.data[0].warningId==0)
				$scope.list=payload.data[1];
			else
				$('#returnData').html(payload.data[0].warningTnm);
		});
	};
	
	$scope.dahaFotografciListGetir = function(){
		$('#rNum').val(parseInt($('#rNum').val()) + sabitler.ROW_DEGER);
		var formData = $("#theForm").serializeArray();
		var fd = new FormData();
		for(i=0;i<formData.length;i++){
			fd.append(formData[i].name,formData[i].value);
		}
		serverService.sendFormDataObject("./php/firma/firmaP.php",fd).then(function(payload){
			$scope.list= payload.data[1];
		});
	};
	
	$scope.sehirList = function(){
		serverService.getComboList("./php/gnlDegerKumesi/gnlDegerKumesiComboList.php?degerKodu=IL").then(function(payload){
			$scope.ilList=payload.data;
		});
	};
	
	$scope.fotografciDetay = function(value){
		window.open("fotografcidetay.php?id="+ value);
	};
	
});