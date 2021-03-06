app.controller('iletisimListesiCtrl', function($scope, serverService,notificationService,sabitler) {
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
		iletisimAraList();
	};
	
	var iletisimAraList = function(tempRowNum){
		if(tempRowNum==null)
			$('#rNum').val(sabitler.ROW_DEGER);
		var formData = $("#theForm").serializeArray();
		var fd = new FormData();
		for(i=0;i<formData.length;i++){
	    	fd.append(formData[i].name,formData[i].value);
	    	console.log("name: " +formData[i].name + " value: " + formData[i].value);
	    }
		serverService.sendFormDataObject("../php/iletisim/iletisimP.php",fd).then(function(payload){
			if(payload.data[0].warningId==0)
				$scope.list=payload.data[1];
			else
				notificationService.error1(payload.data[0].warningTnm);
		});
	};
	
	$scope.mesajGoruntule = function(value,pIletisimId){
		$('#mesajGoruntulemeModal').modal('show');
		$scope.mesajIcerik = value;
		serverService.sendGetJson("../php/iletisim/iletisimG.php?pGetId=1501&pIletisimId=" +pIletisimId).then(function(payload){
			notificationService.success(payload.data.warningTnm);
			iletisimAraList($('#rNum').val());
		});
	};
	
	$scope.dahaFazlaKayit = function(){
		$('#rNum').val(parseInt($('#rNum').val()) + sabitler.ROW_DEGER);
		var formData = $("#theForm").serializeArray();
		var fd = new FormData();
		for(i=0;i<formData.length;i++){
			fd.append(formData[i].name,formData[i].value);
		}
		serverService.sendFormDataObject("../php/iletisim/iletisimP.php",fd).then(function(payload){
			$scope.list= payload.data[1];
		});
	};
	
	$scope.iletisimSil = function(pIletisimId){
		serverService.sendGetJson("../php/iletisim/iletisimG.php?pGetId=1511&pIletisimId=" +pIletisimId).then(function(payload){
			notificationService.success(payload.data.warningTnm);
			iletisimAraList($('#rNum').val());
		});
	}
});