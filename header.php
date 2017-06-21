<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>Zoning</title>
    <!--bootstrap-select-->
    <!--jQuery-->
    <script src="lib/jquery/jquery-11.0.min.js" type="text/javascript"></script>
    <script src="lib/jquery/jquery-ui-1.12.1.custom/jquery-ui.js" type="text/javascript"></script>
    <link href="lib/jquery/jquery-ui-1.12.1.custom/jquery-ui.min.css" rel="stylesheet" type="text/css">
    <script src="lib/jquery/jquery-ui-1.12.1.custom/jquery-ui-timepicker-addon.js" type="text/javascript"></script>
    <link href="lib/jquery/jquery-ui-1.12.1.custom/jquery-ui-timepicker-addon.css" rel="stylesheet" type="text/css">
    <!--Bootstarp-->
    <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <script src="lib/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!--Openlayer-->
    <link href="lib/openlayer/ol.css" rel="stylesheet" type="text/css">
    <script src="lib/openlayer/ol.js" type="text/javascript"></script>
    <!--ChartJS-->
    <script src="lib/chartjs/Chart.min.js" type="text/javascript"></script>
    <!--Font Awesome-->
    <link href="lib/fontawesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!--CSS-->
    <link href="img/logoheader.png" rel="shortcut icon" type="image/x-icon">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <!--JS-->
    <script src="js/categories.js" type="text/javascript"></script>
    <script src="js/chart.js" type="text/javascript"></script>
    <script src="js/factory.js" type="text/javascript"></script>
      <script type="text/javascript" src="lib/canvasjs-1.9.8/jquery.canvasjs.min.js"></script>
</head>
<body>
        <div class="header">
            <nav class="navbar navbar-default header-menu" role="navigation">
                <div class="container-fluid">
                     <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                         <a class="navbar-brand" href="#" style="padding-top: 5px;margin-bottom: 20px; "><img src="img/logoheader.png"></a>
                     </div>
                        <ul class="nav navbar-nav navbar-left">
                            <li>
                                <h4 style="margin: 5px;font-size: 3.0vh; font-weight: bold;">ระบบตรวจสอบกำกับและติดตามเพื่อจัดทำฐานข้อมูลการจำหน่ายสุรา บริเวณใกล้เคียงรอบบริเวณสถานศึกษาตามนโยบายรัฐบาล</h4>
                                <h4 class="header-menu-title" style="margin-top: 0px;"><i class="fa fa-caret-right text-right-indent"></i> <span></span></h4>
                            </li>
                        </ul>
                    <div class="collapse navbar-collapse navbar-ex1-collapse">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="navbar-icon"><a href="map.php" data-header-menu="แผนที่"><span style="font-size: 2.5vh;"><i class="glyphicon glyphicon-map-marker"></i> แผนที่</span></a></li>
                            <li class="navbar-icon"><a href="search_license1.php" data-header-menu="ค้นหา"><span style="font-size: 2.5vh;"><i class="glyphicon glyphicon-search"></i> ค้นหา</span></a></li>
                            <li class="navbar-icon"><a href="report.php" data-header-menu="รายงาน"><span style="font-size: 2.5vh;"><i class="glyphicon glyphicon-stats"></i> รายงาน</span></a></li>
                             <li class="navbar-icon"><a href="e_form_academy.php" data-header-menu="E-Form"><span style="font-size: 2.5vh;"><i class="glyphicon glyphicon-list-alt"></i> E-Form</span></a></li>
                             <li class="navbar-icon">
                                    <a href="#" data-header-menu="ผู้ใช้งานระบบ">
                                        <div class="user-menu">
                                            <img> <i class="fa fa-caret-down"></i>
                                        </div>
                                    </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
                <div class="user-menu-detail hide">
                    <div class="user-menu-detail-avatar text-center">
                        <img>
                    </div>
                    <div class="user-menu-detail-label text-center" style="margin: 10px auto;">
                        <p></p>
                    </div>
                    <div class="col-md-12 user-menu-detail-btn text-center">              
                        <div class="col-md-6 text-left">
                            <div class="row">
                                <a href="user.php" class="btn btn-default">ตั้งค่าบัญชี</a>
                            </div>
                        </div>
                        <div class="col-md-6 text-right">
                            <div class="row">
                                <a class="btn btn-default" id="logoutBtn">ออกจากระบบ</a>
                            </div>
                        </div>
                    </div>
                </div>
        </div>