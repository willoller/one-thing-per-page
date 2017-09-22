var app = angular.module('onethingperpage', []);

app.factory('logService', function ($log, $http) {
  function log (level, message) {
    $log[level](message);

    $http.post(
      "/log",
      { level: level, message: message }
    ).catch(function(err){
      $log.warn(err);
    });
  }

  return log;
});

app.controller('Home', function ($scope, logService) {
  var log = logService;

  $scope.pages = [];
  $scope.jumbo = {value: 'As a product owner, I want to print my backlog so I don\'t have to write it out by hand'};
  $scope.$broadcast("$myNgModelSet");

  $scope.add = function(){
    var cards = $scope.jumbo.value.split("\n");
    log('info', 'Clicked "Add"');
    log('debug', 'Added ' + cards.length + " cards to the stack");
    angular.forEach(cards, function(card){
      $scope.pages.push({value: card});
    });
    $scope.jumbo = {value: ''};
  };

  $scope.edit = function(index){
    $scope.jumbo.value = $scope.pages[index].value;
    $scope.pages.splice(index, 1);
  };

});

app.directive("resizeFontSize", ["$window", "$log", function($window, $log){
  
  return {
    replace: true,

    template: '<textarea class="form-control preview" name="text" ng-model="jumbo.value"></textarea>',

    link: function(scope, element, attr){

      var box = element;
      var e = element[0];

      var resize = function(){

        var font = parseFloat( $window.document.defaultView.getComputedStyle(element[0], '').fontSize );
        var height = parseFloat( $window.document.defaultView.getComputedStyle(element[0], '').height );

        while (font < 160 && !(e.offsetHeight < e.scrollHeight - 10)) {
          //$log.debug( e.offsetHeight + " is more than " + (e.scrollHeight + 5) );

          font = font + 1;

          element
          .css('font-size', font + 'px')
          .css('height',    height);
        }

        while (font > 8 && (e.offsetHeight < e.scrollHeight)) {
          //$log.debug( e.offsetHeight + " is less than " + (e.scrollHeight) );

          font = font - 2;
          
          //$log.debug(font);

          element
          .css('font-size', font + 'px')
          .css('height',    height);
        }
      }

      scope.$watch('jumbo', function(){
        //console.log(scope.jumbo);
        resize();
      }, true);

      box.bind("keyup", function(){
        resize();
      });
    }

  };

}]); 