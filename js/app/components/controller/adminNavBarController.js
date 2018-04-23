app.controller('adminNavBarCtrl', function($scope, serverService,notificationService) {
	$scope.cikis = function(){
		serverService.sendGetJson("../php/giris/cikisG.php?pGetId=1501").then(function(payload){
			if(payload.data.warningId==0){
				serverService.redirect("../admin/giris");
			}
			console.log(payload.data);
//			$scope.etiketList = payload.data;
			$('#returnData').html(payload.data);
		});
	};
});