<!DOCTYPE html>
<html lang="en" ng-app="onethingperpage">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap 101 Template</title>

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
          $scope.jumbo = {value: 'test'};

          $scope.add = function(){
            $scope.pages.push($scope.jumbo);
            $scope.jumbo = {value: ''};
          };

          $scope.edit = function(index){
            $scope.jumbo.value = $scope.pages[index].value;
            $scope.pages.splice(index,1);
          };
        });
      </script>

      <style type="text/css">
        .preview {
          width: 100%; 
          height: 400px !important;
          text-align: center; 
          font-size: 300px;
          overflow: hidden;
        }

        .list-group-item {
          word-wrap: break-word;
        }
      </style>

    </head>
    <body ng-controller="Home">
      <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">One Thing Per Page</a>
          </div>
          <div class="navbar-collapse collapse">
            <form class="navbar-form navbar-right" role="form">
              <div class="form-group">
                <input type="text" placeholder="Email" class="form-control">
              </div>
              <div class="form-group">
                <input type="password" placeholder="Password" class="form-control">
              </div>
              <button type="submit" class="btn btn-success">Sign in</button>
            </form>
          </div><!--/.navbar-collapse -->
        </div>
      </div>

      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron">
        <div class="container">
          <div class="row">
            <div class="col-md-9">
              <h1>One Thing Per Page</h1>
              <p>Easily put one simple phrase on one printable page. Then, print your stack to paper, index cards, or whatever you use for your Scrum backlogs!</p>
            </div>

            <div class="col-md-3">
            </div>
          </div>
        </div>
      </div>

      <div class="container">
        <!-- Example row of columns -->
        <div class="row">

          <div class="col-md-9">

            <p>
              <textarea class="form-control preview" name="text" ng-model="jumbo.value"></textarea>
            </p>

            <button style="float: right;" class="btn btn-primary btn-lg" ng-click="add();">
              Add &rarr;
            </button>

          </div>

          <div class="col-md-3">
            
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

          </div>
        
        </div>

        <hr>

        <footer>
          <p>&copy; Will Oller 2014</p>
        </footer>
      </div> <!-- /container -->

      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      <script src="https://code.jquery.com/jquery.js"></script>
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script src="/js/bootstrap.min.js"></script>

      <script type="">
        $(function(){
          var fontstep = 1;
          
          $('body .preview').on( 'keyup', function () {

            var font = parseFloat($(this).css('font-size'));
            var height = $(this).css('height');

            // console.log(this.offsetHeight);
            // console.log(this.scrollHeight);

            if (this.offsetHeight < this.scrollHeight - 5) {

              while (this.offsetHeight < this.scrollHeight) {
                font = font - 1;
                $(this)
                .css('font-size', font + 'px')
                .css('height',    height);
              }

            } else if (this.offsetHeight > this.scrollHeight) {

              while (this.offsetHeight > this.scrollHeight + 5) {
                font = font + 1;
                $(this)
                .css('font-size', font + 'px')
                .css('height',    height);  
              }

            }

          });
          $('body .preview').keyup();
        });
      </script>

      </body>
    </html>