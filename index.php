<html>
<head>
    <title>Link Preview - LeoCardz</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-2.1.4.min.js" type="text/javascript"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.js" type="text/javascript"></script>
    <!--    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js" type="text/javascript"></script>-->

    <link rel="stylesheet" type="text/css" href="demo/css/demo.css"/>
    <script src="demo/js/app.js" type="text/javascript"></script>
    <script src="demo/js/controller.js" type="text/javascript"></script>

    <link href="src/link-preview/css/link-preview.css" rel="stylesheet">
    <script src="src/link-preview/js/link-preview.js" type="text/javascript"></script>
</head>

<body>
<div class="page-header-fixed demo-bar">
    <a href="http://leocardz.com" target="_blank">
        <img src="demo/img/leocardz.png"/>
    </a>

</div>
<div class="row" ng-app="MyApp" ng-controller="MyController">
    <div class="col-md-12 demo-github text-center">
        <iframe src="https://ghbtns.com/github-btn.html?user=leonardocardoso&repo=link-preview&type=watch&count=true"
                frameborder="0"
                scrolling="0" width="170px" height="20px"></iframe>
        <iframe src="https://ghbtns.com/github-btn.html?user=leonardocardoso&repo=link-preview&type=fork&count=true"
                frameborder="0"
                scrolling="0" width="170px" height="20px"></iframe>

    </div>

    <div class="col-sm-4 demo-col-padding">
        <link-preview
            tpage="%N ➜ %N"
            btext="Post This Preview"
            type="left"
            cbtext="Go Back"
            iamount="10"/>
    </div>
    <div class="col-sm-4 demo-col-padding">
        <link-preview placeholder="What's in your mind?"
                      limage="src/link-preview/img/loader.gif"
                      bclass="success"/>
    </div>
    <div class="col-sm-4 demo-col-padding">
        <link-preview
            placeholder="Placeholder"
            limage="http://4.bp.blogspot.com/-L2Td-3QtUTo/UcbAvCQTYvI/AAAAAAAAAUM/Z4_GBilAu9g/s1600/spinner_64_3f4fa14117c586c002a98cd7c5fbb2d3.gif"
            btext="Submit"
            ltext=""
            ttext="Pick a image"
            bclass="default"/>
    </div>
</div>
</body>
</html>
