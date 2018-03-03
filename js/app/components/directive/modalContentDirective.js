app.directive('modal',function(){
	return{
		restrict: 'E',
	    transclude: true,
	    scope: {
	    	modalName : '@',
	    	modalClass: '@'
	    },
	    templateUrl:'../template/modal.html'
	};
	
})