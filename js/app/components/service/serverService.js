app.service('serverService',function($http,$window,spinnerService,$location,$timeout){
	this.getJsonObject = function(action,params){
		spinnerService.startSpin();
		var config = {
                headers : {
                    'Content-Type': 'application/json'
                }
            };
		if(params!=null)
			var maps = angular.toJson(params);
		
		var promise = $http.post(action+".action",maps,config).success(
				function(data, status, headers, config){
					spinnerService.stopSpin();
					var res = action.substring(0, 5);
					
					if(res.localeCompare("Login") != 0){
						sessionExpired().then(function(payload){
							if(payload.data.warningInformation.warningId==1){
								$timeout(function(){$window.location.href = $location.protocol()+ "://" + $location.host() + ":" + $location.port() + "/PRICECALC/"}, 3000);
//								$window.location.href = $location.protocol()+ "://" + $location.host() + ":" + $location.port() + "/PRICECALC/";
							}
						});
						
						sessionYetkiKontrol(action).then(function(payload){
							 if(payload.data.warningInformation.warningId==1){
								}
							});
					}
//					console.log(data);
					return data;
				}).error(function(data, status, headers, config) {
					spinnerService.stopSpin();
					return false;
	                // called asynchronously if an error occurs
	                // or server returns response with an error status.
			});
		return promise;
	};
	
	this.sendJsonObject = function(action, params){
		spinnerService.startSpin();
		var config = {
				transformRequest: angular.identity,
                headers : {
                	'Content-Type': 'application/json'
                }
            };
//		console.log(params);
		 var promise = $http.post(action, params, config).success(function(data, status, headers, config){
			 spinnerService.stopSpin();
			 return data;
          })
       
          .error(function(){
        	  console.log("HATA");
          });
		 return promise;
	};
	
	
	this.sendFormDataObject = function(action, params){
		spinnerService.startSpin();
		var config = {
				transformRequest: angular.identity,
				headers : {
					'Content-Type': undefined
				}
		};
//		console.log(params);
		var promise = $http.post(action, params, config).success(function(data, status, headers, config){
			spinnerService.stopSpin();
			return data;
		})
		
		.error(function(){
			console.log("HATA");
		});
		return promise;
	};
	
	this.getComboList = function(action, params){
		spinnerService.startSpin();
		var config = {
				transformRequest: angular.identity,
                headers : {
                	'Content-Type': 'application/json'
                }
            };
//		console.log(params);
		 var promise = $http.get(action, params, config).success(function(data, status, headers, config){
			 spinnerService.stopSpin();
			 return data;
          })
       
          .error(function(){
        	  console.log("HATA");
          });
		 return promise;
	};
	
	var sessionExpired = function(){
		var config = {
                headers : {
                    'Content-Type': 'application/json'
                }
            };
		var params = {
				"warningInformation":{}
		};
		var maps = angular.toJson(params);
		var promise = $http.post("LoginSessionControl"+".action",maps,config).success(
				function(data, status, headers, config){
//					console.log("deneme");
//					console.log(data);
					return data;
				}).error(function(data, status, headers, config) {
					spinnerService.stopSpin();
					return false;
	                // called asynchronously if an error occurs
	                // or server returns response with an error status.
			});
		return promise;
	};
	
	var sessionYetkiKontrol = function(action){
		var config = {
				headers : {
					'Content-Type': 'application/json'
				}
		};
		var params = {
				"actionName":action
		};
		var maps = angular.toJson(params);
//		console.log(params);
		var promise = $http.post("LoginYetkiControl"+".action",maps,config).success(
				function(data, status, headers, config){
//					console.log("deneme");
//					console.log(data);
					return data;
				}).error(function(data, status, headers, config) {
					spinnerService.stopSpin();
					return false;
					// called asynchronously if an error occurs
					// or server returns response with an error status.
				});
		return promise;
	};
	
	this.redirect = function(directURL){
		$window.location.href = directURL + ".action?t=" + (new Date()).getTime();//cacheten getirmesin diye zaman parametresi gönderiyoruz.
	};
	
	this.popupWindow = function(popupURL, pExtraParams, pWidth = 100, pHeight = 100){
		window.open("/PRICECALC/" + popupURL + ".action?t=" + (new Date()).getTime() + pExtraParams, "MsgWindow", "width=" + pWidth + ",height=" + pHeight);
	}
});