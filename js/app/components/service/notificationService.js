app.service('notificationService', function(Notification){
	
	this.error = function(value) {
		
    		Notification.error(value);
	};
	this.error1 = function(value) {
		
		Notification.error(value);
	};
	this.success = function(value) {
		Notification.success(value);
    };
});