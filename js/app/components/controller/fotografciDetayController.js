app.controller('fotografciDetayCtrl', function($scope, serverService,sabitler) {
	
	$scope.fotografciDetayGetir = function(id){
		frmDetayetir(id);
	};
	
	var frmDetayetir = function(firmaId){
		serverService.getComboList("./php/firma/firmaDetay.php?pFirmaId="+firmaId).then(function(payload){
			debugger;
			$scope.firmaAdi=payload.data[0].firma_adi;
			$scope.firmaDrm=payload.data[0].DEGER;
			
			$scope.logoSrc="./img/firma/logo/" + payload.data[0].firma_logo;
		
			$scope.iletisimList=payload.data[1];
			$scope.adresText=payload.data[4].adres;
	//		$scope.fotografList=payload.data[5];
			
		
		});
	};
	
	
	
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
	
});