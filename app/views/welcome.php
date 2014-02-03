<!DOCTYPE html>
<html lang="en">
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
    </head>
    <body>
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
          <h1>Just One Thing Per Page</h1>
          <p>Easily put one simple phrase on one printable page. Then, print your stack to paper, index cards, or whatever you use for your Scrum backlogs!</p>
        </div>
      </div>

      <div class="container">
        <!-- Example row of columns -->
        <div class="row">

          <div class="col-md-10 col-md-offset-1">
            <form action="/page" method="get">
              <p><textarea class="form-control preview" name="text"></textarea></p>
              <p>
                <button class="btn btn-default btn-lg"><span class="glyphicon glyphicon-print"></span> Print this one</button>
                <!-- <button style="float: right;" class="btn btn-primary btn-lg">Add &rarr;</button> -->
              </p>
            </form>
          </div>

          <div class="col-md-3">
<!--
            <ul class="nav nav-pills nav-stacked">
              <li class="active">
                <a href="#">
                  <span class="badge pull-right">{{count}}</span>
                  Print All
                </a>
              </li>
            </ul>
            <p><textarea class="form-control preview" name="text" style="height: 100px;"></textarea></p>
            <p><textarea class="form-control preview" name="text" style="height: 100px;"></textarea></p>
            <p><textarea class="form-control preview" name="text" style="height: 100px;"></textarea></p>
            <p><textarea class="form-control preview" name="text" style="height: 100px;"></textarea></p>
-->

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

      <style type="text/css">
        .preview {
          width: 100%; 
          height: 5in; 
          text-align: center; 
          font-size: 150px;
          overflow: hidden;
        }
      </style>

      <script type="">
        $(function(){
          var fontstep = 5;
          
          $('body .preview').on( 'keyup', function () {

            var font = parseFloat($(this).css('font-size'));
            var height = $(this).css('height');
            var width = $(this).css('width');
            
            if (this.offsetHeight < this.scrollHeight - 5) {

              while (this.offsetHeight < this.scrollHeight) {
                font = font - 1;
                $(this)
                .css('font-size', font + 'px')
                .css('height',    height)
                .css('width',     width);
              }

            } else if (this.offsetHeight > this.scrollHeight + 5) {

              while (this.offsetHeight > this.scrollHeight) {
                font = font + 1;
                $(this)
                .css('font-size', font + 'px')
                .css('height',    height)
                .css('width',     width);
              }

            }

          });
          $('body .preview').keyup();
        });
      </script>

      </body>
    </html>