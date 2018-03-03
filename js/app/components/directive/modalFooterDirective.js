app.directive('modalFooter',function(){
	return{
		restrict: 'E',
	    transclude: true,
	    scope: {
	    	kapatIcerik: '@'
	    },
	    templateUrl:'../template/modalFooter.html'
	};
	
})