<!--NAV-->
<?php 
    $p = explode('/', $_SERVER['SCRIPT_NAME']);
	$page = $p[count($p)-1];
	
    switch($page) {
        case 'map.php':
        case 'tax.php':
        case 'case.php':
        case 'license.php':
        case 'company.php':
        case 'academy.php':
?>

<div class="nav">
    <div class="container-fluid fixed nav-menu" style="margin-top: -10px; padding: 0;">
        <div class="col-md-5">
        <ul class="nav navbar-nav nav-sec">
                <!--<li><a href="tax.php" class="btn-primary" style="margin: 2px;padding: 1.3vh;"><span style="font-size: 2.5vh;">งานภาษี</span></a></li>-->
                <li><a href="case.php" class="btn-primary" style="margin: 2px;padding: 1.3vh;"><span style="font-size: 2.5vh;">งานปราบปราม</span></a></li> 
                <li><a href="license.php" class="btn-primary" style="margin: 2px;padding: 1.3vh;"><span style="font-size: 2.5vh;">ใบอนุญาต</span></a></li> 
                <li><a href="company.php" class="btn-primary" style="margin: 2px;padding: 1.3vh;"><span style="font-size: 2.5vh;">สถานประกอบการ</span></a></li>
                <li><a href="academy.php" class="btn-primary" style="margin: 2px;padding: 1.3vh;"><span style="font-size: 2.5vh;">สถานศึกษา</span></a></li>    
            </ul>  
        </div>
            <div class="col-md-2 " ><select class="form-control input-md" id="year"><option value="" selected>เลือกปีงบประมาณ</option></select></div>
            <div class="col-md-1" ><select class="form-control input-md" id="region"><option value="" selected>เลือกภาค</option></select></div>
            <div class="col-md-2 "><select class="form-control input-md" id="area"><option value="-999" selected>เลือกพื้นที่</option></select>
            </div>
            <div class="col-md-1" id="btn-view"><a href="#" class="btn btn-danger btn-md btn-mobile-center">แสดงข้อมูล</a></div>

            <div class="col-md-1 btn-group text-center export-menu">
                <div class="row export-menu">
                    <a href="#" class="btn btn-primary btn-md dropdown-toggle" data-toggle="dropdown"> Export <span class="caret"></span></a>&nbsp;
                    <ul class="dropdown-menu" style="min-width: 100px;">
                        <li><a href="#" class="export-file">PDF</a></li>
                    </ul>
                </div>
            </div> 
        </div>
</div>
              

<?php
            break;
        case 'search_tax.php':
        case 'search_case.php':
        case 'search_license.php':
        case 'search_company.php':
        case 'search_academy.php':
        case 'search_zoning.php':
?>

<div class="nav">
    <div class="container-fluid fixed nav-menu" style="margin-top: -10px; padding: 0;">
        <div class="col-md-6">
        <ul class="nav navbar-nav nav-sec">
                <!--<li><a href="search_tax.php" class="btn-primary" style="margin: 2px;padding: 1.3vh;"><span style="font-size: 2.5vh;">งานภาษี</span></a></li>-->
                <li><a href="search_case.php" class="btn-primary" style="margin: 2px;padding: 1.3vh;"><span style="font-size: 2.5vh;">งานปราบปราม</span></a></li> 
                <li><a href="search_license.php" class="btn-primary" style="margin: 2px;padding: 1.3vh;"><span style="font-size: 2.5vh;">ใบอนุญาต</span></a></li> 
                <li><a href="search_company.php" class="btn-primary" style="margin: 2px;padding: 1.3vh;"><span style="font-size: 2.5vh;">สถานประกอบการ</span></a></li>
                <li><a href="search_academy.php" class="btn-primary" style="margin: 2px;padding: 1.3vh;"><span style="font-size: 2.5vh;">สถานศึกษา</span></a></li>  
                <li><a href="search_zoning.php" class="btn-primary" style="margin: 2px;padding: 1.3vh;"><span style="font-size: 2.5vh;">ข้อมูลโซนนิ่ง</span></a></li>   
            </ul>  
        </div>
            <div class="col-md-2 nav-select-year" ><select class="form-control input-md" id="year"><option value="" selected="true">เลือกปีงบประมาณ</option></select></div>
            <div class="col-md-1 problem nav-select" ><select class="form-control input-md" id="region"><option value="" selected="true">เลือกภาค</option></select></div>
            <div class="col-md-2 nav-select"><select class="form-control input-md" id="province"><option value="" selected="true">เลือกจังหวัด</option></select>
            </div>
            <div class="col-md-1 btn-group text-center export-menu">
                <div class="row export-menu">
                    <a href="#" class="btn btn-primary btn-md dropdown-toggle" data-toggle="dropdown"> Export <span class="caret"></span></a>&nbsp;
                    <ul class="dropdown-menu" style="min-width: 100px;">
                        <li><a href="#" class="export-file">PDF</a></li>
                    </ul>
                </div>
            </div>
    </div>
</div>

<?php
            break;
        case 'report_tax.php':
        case 'report_case.php':
        case 'report_license.php':
        case 'report_zoning.php':
        case 'report_company.php':
        case 'report_academy.php':
?>

<div class="nav">
    <div class="container-fluid fixed nav-menu" style="margin-top: -10px; padding: 0;">
        <div class="col-md-6">
        <ul class="nav navbar-nav nav-sec">
                <!--<li><a href="report_tax.php" class="btn-primary" style="margin: 2px;padding: 1.3vh;"><span style="font-size: 2.5vh;">งานภาษี</span></a></li>-->
                <li><a href="report_case.php" class="btn-primary" style="margin: 2px;padding: 1.3vh;"><span style="font-size: 2.5vh;">งานปราบปราม</span></a></li> 
                <li><a href="report_license.php" class="btn-primary" style="margin: 2px;padding: 1.3vh;"><span style="font-size: 2.5vh;">ใบอนุญาต</span></a></li> 
                <li><a href="report_academy.php" class="btn-primary" style="margin: 2px;padding: 1.3vh;"><span style="font-size: 2.5vh;">สถานศึกษา</span></a></li> 
                <li><a href="report_company.php" class="btn-primary" style="margin: 2px;padding: 1.3vh;"><span style="font-size: 2.5vh;">สถานประกอบการ</span></a></li> 
                <li><a href="report_zoning.php" class="btn-primary" style="margin: 2px;padding: 1.3vh;"><span style="font-size: 2.5vh;">ข้อมูลโซนนิ่ง</span></a></li>   
            </ul>  
        </div>
            <div class="col-md-2 nav-select-year" ><select class="form-control input-md" id="year"><option value="" selected="true">เลือกปีงบประมาณ</option></select></div>
            <div class="col-md-1 problem nav-select" ><select class="form-control input-md" id="region"><option value="" selected="true">เลือกภาค</option></select></div>
            <div class="col-md-2 nav-select"><select class="form-control input-md" id="province"><option value="" selected="true">เลือกจังหวัด</option></select>
            </div>
            <div class="col-md-1 btn-group text-center export-menu">
                <div class="row export-menu">
                    <a href="#" class="btn btn-primary btn-md dropdown-toggle" data-toggle="dropdown"> Export <span class="caret"></span></a>&nbsp;
                    <ul class="dropdown-menu" style="min-width: 100px;">
                        <li><a href="#" class="export-file" onclick="tableToExcel('getexc')">Excel</a></li>
                    </ul>
                </div>
            </div>
    </div>
</div>

<?php
            break;
        case 'e_form_academy.php':
        case 'e_form_company.php':
        case 'e_form_illegal.php':
?>

<div class="nav">
    <div class="container-fluid fixed nav-menu" style="margin-top: -10px; padding: 0;">
        <div class="col-md-6 text-left">
           <ul class="nav navbar-nav nav-sec">
                <li><a href="e_form_academy.php" class="btn-primary" style="margin: 2px;padding: 1.3vh;"><span style="font-size: 2.5vh;">สถานศึกษา</span></a></li> 
                <li><a href="e_form_company.php" class="btn-primary" style="margin: 2px;padding: 1.3vh;"><span style="font-size: 2.5vh;">สถานประกอบการ</span></a></li> 
                <li><a href="e_form_illegal.php" class="btn-primary" style="margin: 2px;padding: 1.3vh;"><span style="font-size: 2.5vh;">คดี</span></a></li>  
            </ul> 
        </div>
        <div class="col-md-6 text-right" style="margin-top: 5px;">
            <span class="label label-success" id="Province" data-provice="0" style="padding: 0 15px; font-size: 2.5vh; border-radius: 0;">อยู่ที่จังหวัด : <span id="ProvinceTXT"></span></span>
        </div>
    </div>
</div>

<?php 
            break;
    } 
?>