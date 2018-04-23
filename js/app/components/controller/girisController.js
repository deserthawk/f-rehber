app.controller('girisCtrl', function($scope, serverService,notificationService) {
	$scope.giris = function(){
		var formData = $("#girisAdminForm").serializeArray();
		var fd = new FormData();
		for(i=0;i<formData.length;i++){
	    	fd.append(formData[i].name,formData[i].value);
	   // 	console.log("name: " + formData[i].name + "value: " + formData[i].value);
	    }
		
		serverService.sendFormDataObject("../php/giris/girisP.php",fd).then(function(payload){
			//serverService.sendJsonObject("php/firmaEkle.php",JSON.stringify(fd)).then(function(payload){
				console.log(payload.data);
				//console.log(payload.data[0]);
				if(payload.data[0].warningId == 0){
					//notificationService.success(payload.data[0].warningTnm);
					serverService.redirect("../admin/firmalistele");
				}
				else{
					notificationService.error1(payload.data[0].warningTnm);
				}
			$('#returnData').html(payload.data);
			});
	};
});