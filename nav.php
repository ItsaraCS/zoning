<!--NAV-->
<?php 
    $p = explode('/', $_SERVER['SCRIPT_NAME']);
    $page = $p[count($p)-1];

    switch($page) {
        case 'map.php':
?>

        <div class="nav">
            <div class="container-fluid" style="margin-top: -10px;">
                                <div class="col-md-6">      
                                        <ul class="nav navbar-nav">
                                            <li ><a href="#"><span style="font-size: 2.5vh;">งานภาษี</span></a></li>                                 
                                            <li><a href="#"><span style="font-size: 2.5vh;">งานปราบปราม</span></a></li> 
                                            <li><a href="#"><span style="font-size: 2.5vh;">ใบอนุญาต</span></a></li> 
                                            <li><a href="#"><span style="font-size: 2.5vh;">ข้อมูลโซนนิ่ง</span></a></li>   
                                        </ul>                       
                                </div>                                   
                                <div class="col-md-2 ">
                                    <select class="form-control input-sm" id="year">
                                        <option value="" selected>เลือกปีงบประมาณ</option>
                                    </select>
                                </div>                     
                                <div class="col-md-2">
                                    <select class="form-control input-sm" id="#">
                                        <option>เลือกภาค</option>
                                    </select>
                                </div>
                                <div class="col-md-2 ">
                                    <select class="form-control input-sm" id="#">
                                        <option>เลือกพื้นที่</option>
                                    </select>
                                </div>
            </div>                       
        </div>


<?php
        break;
        case 'search_license1.php':
        case 'search_license2.php':
?>

         <div class="nav">
            <div class="container-fluid fixed nav-menu" style="margin-top: -5px;">
                <div class="col-md-12">
                    <div class="row">     
                                <div class="col-md-6">      
                                    <div class="btn-group">
                                        <a href="search_license1.php" class="btn btn-primary btn-sm dropdown-toggle" data-license1-type="<?php echo (isset($_GET['license1-type'])) ? $_GET['license1-type'] : 0; ?>" data-toggle="dropdown"> ใบอนุญาตพรบ.2527 (ยาสูบ)<span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="search_license1.php" class="export-file">สุรา</a></li>
                                            <li><a href="search_license1.php" class="export-file">ยาสูบ</a></li>
                                            <li><a href="search_license1.php" class="export-file">ไผ่</a></li>
                                        </ul>
                                </div>
                                    <a href="search_license2.php" class="btn btn-primary btn-sm">ใบอนุญาตรายวัน</a>                                
                          
                                </div>                        
                                <div class="col-md-2 col-md-offset-1">
                                    <select class="form-control input-sm" id="#">
                                        <option>เลือกภาค</option>
                                    </select>
                                </div>
                                <div class="col-md-2 ">
                                    <select class="form-control input-sm" id="#">
                                        <option>เลือกพื้นที่</option>
                                    </select>
                                </div>
                                <div class="col-md-1 btn-group text-center">
                                    <div class="row">
                                        <a href="#" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown"> Export <span class="caret"></span></a>&nbsp;
                                        <ul class="dropdown-menu" style="min-width: 100px;">
                                        <li><a href="#" class="export-file">PDF</a></li>
                                        <li><a href="#" class="export-file">Excel</a></li>
                                        </ul>
                                    </div>
                                </div>

                    </div>                       
                </div>
            </div>
        </div>

<?php
        break;
        case 'report.php':
?>

         <div class="nav">
            <div class="container-fluid fixed nav-menu" style="margin-top: -5px;">
                <div class="col-md-12">
                    <div class="row">     
                                <div class="col-md-6">                                                                           
                                    <button type="button" class="btn btn-primary">งานภาษี</button>                                     
                                    <button type="button" class="btn btn-primary">งานปราบปราม</button>  
                                    <button type="button" class="btn btn-primary">ใบอนุญาต</button> 
                                    <button type="button" class="btn btn-primary">ข้อมูลโซนนิ่ง</button>                            
                                </div>        
                                <div class="col-md-2">
                                    <select class="form-control input-sm" id="year">
                                        <option value="" selected>เลือกปีงบประมาณ</option>
                                    </select>
                                </div>                 
                                <div class="col-md-2">
                                    <select class="form-control input-sm" id="#">
                                        <option>เลือกภาค</option>
                                    </select>
                                </div>
                                <div class="col-md-2 ">
                                    <select class="form-control input-sm" id="#">
                                        <option>เลือกพื้นที่</option>
                                    </select>
                                </div>
                    </div>                       
                </div>
            </div>
        </div>
        <?php
        break;
        case 'e_form_academy.php':
        case 'e_form_bar.php':
?>

         <div class="nav">
            <div class="container-fluid fixed nav-menu" style="margin-top: -5px;">
                <div class="col-md-12">
                    <div class="row">     
                                <div class="col-md-6">                                         
                                    <a href="e_form_academy.php" class="btn btn-primary btn-sm">สถานศึกษา</a>                                   
                                    <a href="e_form_bar.php" class="btn btn-primary btn-sm">ร้านค้า</a>     
                     
                                </div>                        
                    </div>                       
                </div>
            </div>
        </div>

<?php 
            break;
    } 
?>