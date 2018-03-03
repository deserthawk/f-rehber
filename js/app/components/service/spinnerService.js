app.service('spinnerService',function(usSpinnerService){
	this.startSpin = function(){
	        usSpinnerService.spin('spinner-1');
	    };
	this.stopSpin = function(){
        usSpinnerService.stop('spinner-1');
    }; 
});