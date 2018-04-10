app.controller('girisCtrl', function($scope, serverService,notificationService) {
	$scope.giris = function(){
		alert("test");
	};
	
	
	$scope.firmaEkleme = function() {
		var formData = $("#theForm").serializeArray();
//		console.log(JSON.stringify(formData));
		
		var formData = $("#theForm").serializeArray();
		var fd = new FormData();
		for(i=0;i<formData.length;i++){
	    	fd.append(formData[i].name,formData[i].value);
//	    	console.log("name: " + formData[i].name + "value: " + formData[i].value);
	    	
	    }
//		console.log(JSON.stringify(fd));
		
//		debugger;
		serverService.sendJsonObject("../php/firma/firmaEkle.php",JSON.stringify(formData)).then(function(payload){
		//serverService.sendJsonObject("php/firmaEkle.php",JSON.stringify(fd)).then(function(payload){
			console.log(payload.data);
			console.log(payload.data[0]);
			if(payload.data[0].warningId == 0){
				notificationService.success(payload.data[0].warningTnm);
			}
			else{
				notificationService.error1(payload.data[0].warningTnm);
			}
//		$('#returnData').html(payload.data[0].warningTnm);
		});
	};
	

});