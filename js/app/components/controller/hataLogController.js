app.controller('hataLogCtrl', function($scope, serverService,notificationService,sabitler) {
	
	var hataLogListeGetir = function(flag){
		var formData = $("#theForm").serializeArray();
		var fd = new FormData();
		for(i=0;i<formData.length;i++){
	    	fd.append(formData[i].name,formData[i].value);
	    	console.log("name: " +formData[i].name + " value: " + formData[i].value);
	    }
		serverService.sendFormDataObject("../php/hata/hata.php",fd).then(function(payload){
			
			debugger;
			if(payload.data[0].warningId==0)
				$scope.list=payload.data[1];
			else
				$('#returnData').html(payload.data);
		});
	};
	
	$scope.hataLogListGetir = function(){
		hataLogListeGetir();
	};
	
	
	$scope.firmaEkleme = function() {
		debugger;
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
	
	$scope.firmaListeGetir = function(){
		firmaListGetir();
	};
	
	var firmaListGetir = function(flag){
		$('#rNum').val(sabitler.ROW_DEGER);
		if(flag ==1){
			$('#rNum').val(parseInt($('#rNum').val()) + sabitler.ROW_DEGER);
		}
		var formData = $("#theForm").serializeArray();
		var fd = new FormData();
		for(i=0;i<formData.length;i++){
	    	fd.append(formData[i].name,formData[i].value);
	    	console.log("name: " +formData[i].name + " value: " + formData[i].value);
	    }
		serverService.sendFormDataObject("../php/firma/firmaP.php",fd).then(function(payload){
			
			debugger;
			if(payload.data[0].warningId==0)
				$scope.list=payload.data[1];
			else
				$('#returnData').html(payload.data);
		});
		
		
		$scope.dahaFirmaListGetir = function(){
			firmaListGetir(1);
		}
		
		
//		var formData = $("#theForm").serializeArray();
//		serverService.sendJsonObject("../php/firma/firmaListele.php",JSON.stringify(formData)).then(function(payload){
//			if(payload.data[0].warningId == 0){
//				$scope.list=payload.data[1];
//			}
//			else{
//				notificationService.error1(payload.data[0].warningTnm);
//			}
//		});
	};
	
	$scope.firmaAra = function(){
		firmaListGetir();
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
	};
	
	$scope.firmaFotoListele = function(value){
		window.open("../admin/firmafotografliste.php?firmaId="+ value);
	};
});