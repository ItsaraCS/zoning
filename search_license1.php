<?php require('header.php'); ?>
<?php require('nav.php'); ?>
<!--SECTION-->

<style type="text/css">
    table tbody td{
        font-size: 14px;
    }
    table thead th{
        font-size: 15px;
    }
    .list-group-item{
        padding-top: 0;
        padding-bottom: 0;
    }
    .search-align{
        font-size: 14px;
        color: green;
        text-align: right;
        width: 80%;
    }

</style>



<div class="section" style="margin-top: 10px;">
    <div class="col-md-12">
        <div class="row">
            <!--DATA-->
            <div class="col-md-4">

                <div class="panel panel-default" style="height: 40vh; border-radius: 0; border: 0;">
                    <div class="panel-body" style="padding: 0;">
                        <table class="table table-striped search-detail-table bg-info" style="margin-top: 0; margin-bottom: 0;">
                            <thead><tr></tr></thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    <div class="input-group" style="margin-top: 20px;">
                        <input style="" class="form-control input-sm" id="SearchName" placeholder="ค้นหาผู้ประกอบการ">
                        <span class="input-group-btn">
                            <button class="btn btn-primary" type="submit">
                                <i class="fa fa-search" aria-hidden="true"></i>
                                Search
                            </button>
                        </span>
                    </div>
                    <ul class="list-group" style="margin-top: 1vh;">
                        <li class="list-group-item">Item 1 <i class="fa fa-search search-align"></i></li>
                        <li class="list-group-item">Item 2 <i class="fa fa-search search-align"></i></li>
                        <li class="list-group-item">Item 3 <i class="fa fa-search search-align"></i></li>
                        <li class="list-group-item">Item 4 <i class="fa fa-search search-align"></i></li>
                        <li class="list-group-item">Item 5 <i class="fa fa-search search-align"></i></li>
                        <li class="list-group-item">Item 6 <i class="fa fa-search search-align"></i></li>
                        <li class="list-group-item">Item 7 <i class="fa fa-search search-align"></i></li>
                    </ul>
                </div>
            </div>

            <!--MAP-->
            <div class="col-md-8 get-map">
                <div class="panel panel-default" style="height: 40vh; border-radius: 0; padding: 0;">
                    <div class="panel-body" style="padding-top: 0; padding-bottom: 0;">
                        <div class="row">
                            <div id="map" class="map" style="width: 100%; height: 40vh;"></div>
                                <div id="popup" class="ol-popup">
                                    <a href="#" id="popup-closer" class="ol-popup-closer"></a>
                                    <div id="popup-content"></div>
                                </div>
                            </div>
                            <div id="dvloading" class="loader"><div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--HEAD DATE-->
    <div class="select-date" style="margin-top: 2vh;">
                            <div class="col-md-8">
                                <h3 class="text-center" style="margin-top: 5px;">ตารางข้อมูล</h3>                       
                            </div>
                            <div class="col-md-1 col-md-offset-1" style="padding-right: 0px;">
                                <select name="" id="input" class="form-control" required="required">
                                    <option value="">วัน</option>
                                </select>
                            </div>
                            <div class="col-md-1" style="padding-right: 0px;">
                                 <select name="" id="input" class="form-control" required="required">
                                    <option value="">เดือน</option>
                                </select>
                            </div>
                            <div class="col-md-1" style="padding-right: 0px;">
                                 <select name="" id="input" class="form-control" required="required">
                                    <option value="">ปี</option>
                                </select>
                            </div> 
    </div>
    <!--TABLE DATA-->
    <div class="col-md-12" style="margin:0;">
        <div class="row">
            <div class="panel-default" style="height: 32vh;">         
                        <div class="panel-body" style="padding: 0;">        
                            <div class="table-responsive " style="height: 30vh;">
                                <table class="table table-striped search-table bg-info table-bordered" style="margin-top: 0;"> 
                                                <thead>
                                                    <tr>
                                                        <th class="bg-primary text-center text-nowrap">#</th>
                                                        <th class="bg-primary text-center text-nowrap" class="bg-primary" class="bg-primary">ชื่อสถานประกอบการ</th>
                                                        <th class="bg-primary text-center text-nowrap" class="bg-primary">ชื่อผู้ประกอบการ</th>
                                                        <th class="bg-primary text-center text-nowrap">ประเภท</th>
                                                        <th class="bg-primary text-center text-nowrap">เลขใบอนุญาต</th>
                                                        <th class="bg-primary text-center text-nowrap">สถานที่ตั้ง</th>
                                                        <th class="bg-primary text-center text-nowrap">ละติจูด</th>
                                                        <th class="bg-primary text-center text-nowrap">ลองติจูด</th>
                                                        <th class="bg-primary text-center text-nowrap">อยู่ในโซนนิ่งของ</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td><td>ร้านกรีน สโตร์</td><td>ไม่ระบุ</td><td>ไม่ระบุ</td><td>-</td><td>2/2 ถ.ราชพกฤษ์ ต.ช้างเผือก อ.เมือง จ.เชียงใหม่</td><td>18.80009</td><td>98.97537</td><td>วิทยาลัยสารพัดช่างเชียงใหม่</td>
                                                    </tr>
                                                    <tr>
                                                        <td>1</td><td>ร้านกรีน สโตร์</td><td>ไม่ระบุ</td><td>ไม่ระบุ</td><td>-</td><td>2/2 ถ.ราชพกฤษ์ ต.ช้างเผือก อ.เมือง จ.เชียงใหม่</td><td>18.80009</td><td>98.97537</td><td>วิทยาลัยสารพัดช่างเชียงใหม่</td>
                                                    </tr>
                                                    <tr>
                                                        <td>1</td><td>ร้านกรีน สโตร์</td><td>ไม่ระบุ</td><td>ไม่ระบุ</td><td>-</td><td>2/2 ถ.ราชพกฤษ์ ต.ช้างเผือก อ.เมือง จ.เชียงใหม่</td><td>18.80009</td><td>98.97537</td><td>วิทยาลัยสารพัดช่างเชียงใหม่</td>
                                                    </tr>
                                                    <tr>
                                                        <td>1</td><td>ร้านกรีน สโตร์</td><td>ไม่ระบุ</td><td>ไม่ระบุ</td><td>-</td><td>2/2 ถ.ราชพกฤษ์ ต.ช้างเผือก อ.เมือง จ.เชียงใหม่</td><td>18.80009</td><td>98.97537</td><td>วิทยาลัยสารพัดช่างเชียงใหม่</td>
                                                    </tr>
                                                    <tr>
                                                        <td>1</td><td>ร้านกรีน สโตร์</td><td>ไม่ระบุ</td><td>ไม่ระบุ</td><td>-</td><td>2/2 ถ.ราชพกฤษ์ ต.ช้างเผือก อ.เมือง จ.เชียงใหม่</td><td>18.80009</td><td>98.97537</td><td>วิทยาลัยสารพัดช่างเชียงใหม่</td>
                                                    </tr>


                                                </tbody>
                                </table> 
                            </div>   
                        </div>
                    <div class="col-md-12 pagination" style="padding: 0; margin: 0px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
            var layers_deemap =  new ol.layer.Tile( { 
                source: new ol.source.TileWMS( {
                    url: 'http://www.dee-map.com/geoserver/gwc/service/wms/dmwms',
                    params: { 'LAYERS': 'Dee-Map', 'VERSION': '1.1.1', 'FORMAT': 'image/png8' },
                    serverType: 'geoserver', crossOrigin: 'anonymous', noWrap: true,  wrapX: false
                }),  
                extent: [ -20037508.34, -20037508.34, 20037508.34, 20037508.34 ]
            });

            var projection = ol.proj.get('EPSG:3857');

            map = new ol.Map({
                layers : [ layers_deemap ],
            //    overlays: [overlay],//for popup
                target : 'map',
                view: new ol.View({
                center: [13.0, 100.5],
                projection: projection,
                zoom: 6    
                })
            });

            $('#dvloading').hide().fadeOut();

            /* Zoom Slider */ 
            zoomslider = new ol.control.ZoomSlider();
            map.addControl(zoomslider);

            map.getView().setCenter(ol.proj.transform([99.697123, 17.231792], 'EPSG:4326', 'EPSG:3857'));
            map.getView().setZoom(5.0);
    

</script>