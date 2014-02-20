<!DOCTYPE html>
<html lang="en" ng-app="onethingperpage">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>One Thing Per Page</title>

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.11/angular.min.js"></script>
    <script type="text/javascript" src="/js/app.js"></script>

  </head>
  <body ng-controller="Home">
    
    <div class="jumbotron">

      <div class="container">
        <div class="row">
          <div class="col-md-8">

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

          <?php include ('ads.php'); ?>

        </div>
      
      </div>

      <hr>

      <footer>
        <p>&copy; Will Oller 2014</p>
      </footer>
    </div> <!-- /container -->

  </body>
</html>