app.service('serverService',function($http,$window,spinnerService,$location,$timeout){
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
	
	this.getOneParameter = function(action, params){
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
	
	this.sendGetJson = function(action, params){
		spinnerService.startSpin();
		var config = {
				transformRequest: angular.identity,
				headers : {
					'Content-Type': 'application/json'
				}
		};
		var promise = $http.get(action, params, config).success(function(data, status, headers, config){
			spinnerService.stopSpin();
			return data;
		})
		
		.error(function(){
			console.log("HATA");
		});
		return promise;
	}
	
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
	
	this.redirect = function(directURL){
		$window.location.href = directURL + ".php?t=" + (new Date()).getTime();//cacheten getirmesin diye zaman parametresi gönderiyoruz.
	};
	
	this.popupWindow = function(popupURL, pExtraParams, pWidth = 100, pHeight = 100){
		window.open("/PRICECALC/" + popupURL + ".action?t=" + (new Date()).getTime() + pExtraParams, "MsgWindow", "width=" + pWidth + ",height=" + pHeight);
	}
});