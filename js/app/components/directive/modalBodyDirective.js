app.directive('modalBody',function(){
	return{
		restrict: 'E',
	    transclude: true,
	    scope: {
	    	modalClass : '@'
	    },
	    templateUrl:'../template/modalBody.html'
	};
	
})