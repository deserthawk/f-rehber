app.controller('firmaGuncelleCtrl', function($scope, serverService,notificationService,$http) {
	$scope.firmaDetayGetir = function(firmaId){
		frmDetayetir(firmaId);
	};
	
	var frmDetayetir = function(firmaId){
		serverService.getComboList("../php/firma/firmaDetay.php?pFirmaId="+firmaId).then(function(payload){
			$scope.firmaAdi=payload.data[0].firma_adi;
			$scope.firmaDrm=payload.data[0].DEGER;
			$scope.durumGuncelleNot=payload.data[0].FIRMA_NOTE;
			$scope.logoSrc="../img/firma/logo/" + payload.data[0].firma_logo;
		//	console.log(payload.data[0].firma_logo);
			$('#mainFirmaDrm').val(payload.data[0].firma_drm);
			$scope.iletisimList=payload.data[1];
			initAdresGuncelleForm(payload.data[2]);
			initKontakPersonelForm(payload.data[3]);
			//$('#returnData').html(payload.data);
		});
	};
	
	var initAdresGuncelleForm = function(data){
		$('#adresGuncelleId').val(data.id);
		$('#ilGuncelle').val(data.deger1);
		ilceList(data.deger1,data.deger2);
		$scope.adresGuncelle = data.deger3;
	}
	
	var initKontakPersonelForm = function(data){
		$('#kontakPersonelGuncelleId').val(data.id);
		$('#kontakPersonelGuncelleAdSoyad').val(data.deger1);
		$('#kontakPersonelGuncelleTelefon').val(data.deger2);
		$('#kontakPersonelGuncelleEmail').val(data.deger3);
	}
	
	$scope.iletisimGuncelleModal = function(iletisimRow){
		$('#iletisimGuncelleModal').modal('show');
		$('#iletisimGuncelleId').val(iletisimRow.id);
		$('#iletisimGuncelleFirmaId').val(iletisimRow.firma_id);
		$('#iletisimGuncelleIletisimTipId').val(iletisimRow.tipId);
		$scope.iletisimLabel=iletisimRow.deger;
		$('#iletisimGuncelleDeger1').val(iletisimRow.deger1);
	};
	
	$scope.iletisimGuncelle = function(pFormId){
		iletisim(pFormId);
	};
	
	var iletisim = function(pFormId){
		var formData = $("#" + pFormId).serializeArray();
		var fd = new FormData();
		for(i=0;i<formData.length;i++){
	    	fd.append(formData[i].name,formData[i].value);
	    	console.log("name: " +formData[i].name + " value: " + formData[i].value);
	    }
		serverService.sendFormDataObject("../php/firmaIletisim/firmaIletisim.php",fd).then(function(payload){
			console.log(payload.data);
			if(payload.data[0].warningId == 0){
				notificationService.success(payload.data[0].warningTnm);
				frmDetayetir($('#mainFirmaID').val());
			}
			else{
				notificationService.error1(payload.data[0].warningTnm);
			}
	//	$('#returnData').html(payload.data);
		});
	};
	
	var firma = function(pFormId){
		var formData = $("#" + pFormId).serializeArray();
		var fd = new FormData();
		for(i=0;i<formData.length;i++){
	    	fd.append(formData[i].name,formData[i].value);
	    	console.log("name: " +formData[i].name + " value: " + formData[i].value);
	    }
		serverService.sendFormDataObject("../php/firma/firma.php",fd).then(function(payload){
			console.log(payload.data);
			if(payload.data[0].warningId == 0){
				notificationService.success(payload.data[0].warningTnm);
				frmDetayetir($('#mainFirmaID').val());
			}
			else{
				notificationService.error1(payload.data[0].warningTnm);
			}
		$('#returnData').html(payload.data);
		});
	};
	
	$scope.iletisimEkleModal = function(){
		$('#iletisimEkleModal').modal('show');
	};
	
	$scope.getIletisimTipList = function(){
		iletisimTipList();
	};
	
	var iletisimTipList = function(){
		serverService.getComboList("../php/gnlDegerKumesi/gnlDegerKumesiComboList.php?degerKodu=ILTSM").then(function(payload){
			$scope.iletisimTipList=payload.data;
		});
	}
	
	$scope.getSehirList = function(){
		sehirList();
	};
	
	var sehirList = function(){
		serverService.getComboList("../php/gnlDegerKumesi/gnlDegerKumesiComboList.php?degerKodu=IL").then(function(payload){
			$scope.ilList=payload.data;
		});
	};
	
	$scope.getIlceList = function(value){
		ilceList(value);
	};
	
	var ilceList = function(value,ilceId){
		serverService.getComboList("../php/gnlDegerKumesi/gnlDegerKumesiComboListUstDeger.php?degerKodu=ILCE&ustDegerId="+value).then(function(payload){
			$scope.ilceList=payload.data;
			if(ilceId!=null){
				$scope.ilceGuncelle = ilceId;
			}
		});
	};
	
	$scope.getFirmaDurumList = function(){
		firmaDurumList();
	};
	
	var firmaDurumList = function(){
		serverService.getComboList("../php/gnlDegerKumesi/gnlDegerKumesiComboList.php?degerKodu=FRM_DRM").then(function(payload){
			$scope.firmaDurumList=payload.data;
		});
	}
	
	$scope.iletisimEkle = function(pFormId){
		$('#iletisimEkleFirmaId').val($('#mainFirmaID').val());
		iletisim(pFormId);
	};
	
	$scope.durumGuncelleModal = function(){
		$('#firmaDurumGuncelle').val($('#mainFirmaDrm').val());
		$('#durumGuncelleModal').modal('show');
	}
	$scope.firmaDrmNotGuncelle = function(){
		firma('durumGuncelleForm');	
	}
	$scope.firmaLogoGuncelle = function(){
		var formData = $("#logoGuncelleForm").serializeArray();
		var fd = new FormData();
		var file = $scope.myFile;
		var extn = file.name.split(".").pop();
		if(extn!="png"){
			notificationService.error1("Lütfen uzantısı .png olan bir doysa seçiniz.");
			return false;
		}
		
		
		fd.append('fileToUpload',file);
		for(i=0;i<formData.length;i++){
	    	fd.append(formData[i].name,formData[i].value);
	    	console.log("name: " +formData[i].name + " value: " + formData[i].value);
	    }
		
		serverService.sendFormDataObject("../php/firma/firma.php",fd).then(function(payload){
			debugger;
		//	console.log(payload.data);
			if(payload.data[0].warningId == 0){
				notificationService.success(payload.data[0].warningTnm);
				frmDetayetir($('#mainFirmaID').val());
			}
			else{
				notificationService.error1(payload.data[0].warningTnm);
			}
		$('#returnData').html(payload.data);
		});
	};
	
});