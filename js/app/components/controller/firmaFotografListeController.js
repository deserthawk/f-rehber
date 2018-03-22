app.controller('firmaListeleCtrl', function($scope, serverService,notificationService) {
	$scope.firmaDetayGetir = function(firmaId){
		frmAdiGetir(firmaId);
		getFirmaFotografList(firmaId);
	};
	var frmAdiGetir = function(firmaId){
		serverService.getOneParameter("../php/firma/firmaG.php?pGetId=1501&pId="+firmaId).then(function(payload){
			$scope.firmaAdi=payload.data.firma_adi;
		});
	};
	var getFirmaFotografList = function(firmaId){
		serverService.sendGetJson("../php/galeri/galeriG.php?pGetId=1501&pFirmaId="+firmaId).then(function(payload){
			$scope.list=payload.data;
		});
	};
	var getFotografEtiketList = function(id){
		serverService.sendGetJson("../php/galeri/galeriG.php?pGetId=1511&pId="+id).then(function(payload){
			//$('#returnData').html(payload.data);
			//$scope.firmaAdi=payload.data.firma_adi;
			//$scope.list=payload.data;
			//console.log(payload.data);
			$scope.etiketList = payload.data; 
		});
	};
	
	$scope.getEtiketList = function(){
		etiketList();
	};
	
	var etiketList = function(){
		serverService.getComboList("../php/gnlDegerKumesi/gnlDegerKumesiComboList.php?degerKodu=GLR_ETK").then(function(payload){
			$scope.etiketDegerList=payload.data;
		});
	};
	$scope.getOnayList = function(){
		onayList();
	};
	var onayList = function(){
		serverService.getComboList("../php/gnlDegerKumesi/gnlDegerKumesiComboList.php?degerKodu=FT_DRM").then(function(payload){
			$scope.onayList=payload.data;
		});
	};
	
	$scope.fotografTanimlama = function(id,pBDosya, pFotografDurum,pFotografNot){
		$("#fotografTanimlaFormImg").attr("src",pBDosya);
		$('#fotografTanimlamaModal').modal('show');
		$("#fotografTanimlaFormId").val(id);
		$("#onayGuncelle").val(pFotografDurum);
		$("#fotografTanimlaFormNot").val(pFotografNot);
		getFotografEtiketList(id);
	};
	$scope.fotografEtiketEkle = function(){
		etiketId = $("#etiketGuncelle").val();
		fotografId = $("#fotografTanimlaFormId").val();
		serverService.sendGetJson("../php/galeriEtiket/galeriEtiketG.php?pGetId=1501&pEtiketId="+etiketId+"&pFotografId="+fotografId).then(function(payload){
			console.log(payload.data);
			if(payload.data.warningId == 0){
				notificationService.success(payload.data.warningTnm);
				getFotografEtiketList($("#fotografTanimlaFormId").val());
			}
			else{
				notificationService.error(payload.data.warningTnm);
			}
			$('#returnData').html(payload.data);
		});
		//alert($("#etiketGuncelle").val());
	};
	$scope.fotografEtiketSil = function(id){
		serverService.sendGetJson("../php/galeriEtiket/galeriEtiketG.php?pGetId=1511&pId="+id).then(function(payload){
			console.log(payload.data);
			if(payload.data.warningId == 0){
				notificationService.success(payload.data.warningTnm);
				getFotografEtiketList($("#fotografTanimlaFormId").val());
			}
			else{
				notificationService.error(payload.data.warningTnm);
			}
			$('#returnData').html(payload.data);
		});
	}
});