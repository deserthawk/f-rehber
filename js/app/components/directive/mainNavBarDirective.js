app.directive('mainNavBar',function(){
	return{
		restrict: 'E',
	    scope: {
	    	colorClass : '@'
	    },
	    templateUrl:'./template/mainNavBar.html'
	};
	
});