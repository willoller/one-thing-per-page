<!DOCTYPE html>
<html lang="en" ng-app="onethingperpage">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>One Thing Per Page</title>

  <!-- Bootstrap -->
  <link href="/css/bootstrap.min.css" rel="stylesheet">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
      <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.11/angular.min.js"></script>

      <script type="text/javascript">
        var app = angular.module('onethingperpage', []);
       
        app.controller('Home', function ($scope) {

          $scope.pages = [];
          $scope.jumbo = {value: 'As a product owner, I want to print my backlog so I don\'t have to write it out by hand'};
          $scope.$broadcast("$myNgModelSet");

          $scope.add = function(){
            var cards = $scope.jumbo.value.split("\n");
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
      </script>

      <style type="text/css">
        .jumbotron {
          background: #222;
          color: white;
          border-bottom: 1px solid #ddd;
        }
        .jumbotron h1 { font-size: 400%; margin-top: 0; }
        .jumbotron p { font-size: 200%; font-weight: 150}

        .preview {
          width: 100%; 
          height: 400px;
          text-align: center; 
          font-size: 300px;
          overflow: hidden;
          text-align: center;
        }

        h1 span {
          border: 1px solid #ddd;
          color: black;
          background: white;
          display: inline-block;
          overflow: hidden;
          padding: .25em;
        }

        .list-group-item {
          word-wrap: break-word;
        }

        /* xs */
        @media (max-width: 767px) {
          .jumbotron {
            font-size: 50%;
            padding: 20px;
          }
          textarea.form-control {
            height: 200px;
          }
        }
        /* s */
        @media (min-width: 768px) and (max-width: 991px) {
          .jumbotron {
            font-size: 60%;
            padding: 30px;
          }
          textarea.form-control {
            height: 250px;
          }
        }
        /* md */
        @media (min-width: 992px) and (max-width: 1199px) {
          .jumbotron {
            font-size: 80%;
            padding: 40px;
          }
          textarea.form-control {
            height: 300px;
          }
        }
        /* lg */
        @media (min-width: 1200px) {
          .jumbotron {
            font-size: 100%;
            padding: 50px;
          }
          textarea.form-control {
            height: 400px;
          }
        }

      </style>

    </head>
    <body ng-controller="Home">
      <div class="jumbotron">
        <div class="container">
          <div class="row">
            <div class="col-md-9">

              <h1> 
                <span>One</span>
                <span>Thing</span>
                <span>Per</span>
                <span>Page</span>
              </h1>
              <p>Put your user stories in the box, and add them to your stack. Then, print your stack to 5x8&#8243; index cards - perfect for scrum boards!</p>
             
            </div>
          </div>
        </div>
      </div>

      <div class="container">
        <!-- Example row of columns -->
        <div class="row">

          <div class="col-md-8 col-sm-7 col-xs-12">

            <p resize-font-size></p>

            <button style="float: right;" class="btn btn-primary btn-lg" ng-click="add();">
              Add &rarr;
            </button>

          </div>

          <div class="col-md-4 col-sm-5 col-xs-12">
            
            <form class="list-group" action="/print" method="post" target="_blank">
              <p>
                <button class="btn btn-primary btn-lg" style="width: 100%">
                  <span class="glyphicon glyphicon-print"></span>
                  Print All
                  <span class="badge pull-right">{{pages.length}}</span>
                </button>
              </p>

              <div class="list-group">
                <a ng-repeat="page in pages" ng-model="page.value" ng-click="edit($index)" class="list-group-item">
                  <span class="glyphicon glyphicon-chevron-left"></span>
                  {{page.value}}
                  <input name="pages[]" type="hidden" value="{{page.value}}" />
                </a>
              </div>
            </form>

            <div style="border: 1px solid #999; padding: 4px; height: 15em;" class="hidden-xs" ng-hide="pages.length">
              <a 
                style="height: 100%;
                  display: block;
                  background: white url(http://ecx.images-amazon.com/images/I/317KKCTkiOL._SL900_.jpg) center center no-repeat"
                href="http://www.amazon.com/gp/product/B002OB49L4/ref=as_li_ss_tl?ie=UTF8&camp=1789&creative=390957&creativeASIN=B002OB49L4&linkCode=as2&tag=willollercom-20">
                
                <p style="padding: 20px;">

                  <?php if (rand(0,1) > 0.5) : ?>
                    <span style="background: #666; background: rgba(0,0,0,0.75); color: white; font-style: oblique; font-weight: 900; font-size: 175%;">
                      Wait! Do you need some more index cards?
                    </span>
                  <?php else : ?>
                    <span style="background: #357ebd; color: white; font-style: oblique; font-weight: 900; font-size: 175%; ">
                      Buy 500 Oxford Ruled 5x8 Index Cards
                    </span>
                  <?php endif; ?>

                </p>
              </a>
            </div>

          </div>
        
        </div>

        <hr>

        <footer>
          <p>&copy; Will Oller 2014</p>

        </footer>
      </div> <!-- /container -->


      <script type="">

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
                  $log.debug( e.offsetHeight + " is more than " + (e.scrollHeight + 5) );

                  font = font + 1;

                  element
                  .css('font-size', font + 'px')
                  .css('height',    height);
                }

                while (font > 8 && (e.offsetHeight < e.scrollHeight)) {
                  $log.debug( e.offsetHeight + " is less than " + (e.scrollHeight) );

                  font = font - 2;
                  
                  $log.debug(font);

                  element
                  .css('font-size', font + 'px')
                  .css('height',    height);
                }
              }

              scope.$watch('jumbo', function(){
                console.log(scope.jumbo);
                resize();
              }, true);

              box.bind("keyup", function(){
                resize();
              });
            }

          };
        
        }]); 
      </script>

      </body>
    </html>