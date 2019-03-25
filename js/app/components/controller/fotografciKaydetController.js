app.controller('fotografciKaydetCtrl', function($scope, serverService,notificationService) {
	$scope.submitForm = function(isValid){
		if(isValid){
			alert("Form Doğru");
		}
	};
	
	$scope.fotografciEkle = function(){
		
	}
});