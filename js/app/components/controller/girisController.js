app.controller('girisCtrl', function($scope, serverService,notificationService) {
	$scope.giris = function(){
		var formData = $("#girisAdminForm").serializeArray();
		var fd = new FormData();
		for(i=0;i<formData.length;i++){
	    	fd.append(formData[i].name,formData[i].value);
	    }
		
		serverService.sendFormDataObject("../php/giris/girisP.php",fd).then(function(payload){
			debugger;
				if(payload.data[0].warningId == 0){
					serverService.redirect("../admin/firmalistele");
				}
				else{
					notificationService.error1(payload.data[0].warningTnm);
				}
//			$('#returnData').html(payload.data);
			});
	};
});