<?php require('header.php'); ?>
<?php require('nav.php'); ?>

<div class="section" style="margin-top: 10px;">
    <!--FORM DATA-->
    <div class="col-md-4">
        <form name="insertForm" enctype="multipart/form-data" novalidate>
            <div class="panel panel-default" style="height: 68vh; overflow-y: scroll; border-radius: 0;">
                <div class="panel-body" style="margin: 0;"> 
                    <table class="table table-striped " style="margin-top: 0; margin-bottom: 0;">
                        <tbody>
                            <tr>
                                <td class="col-md-12" colspan="2" style="padding: 10px !important;">
                                    <input type="text" class="form-control input-sm" id="SearchName" 
                                        data-factory-id="0"
                                        placeholder="ชื่อสถานประกอบการ,ชื่อผู้ประกอบการ">
                                    <span class="error-content hide" data-label="ชื่อสถานประกอบการ"></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-md-5"><p class="data-important">ชื่อสถานประกอบการ</p></td>
                                <td class="col-md-7">
                                    <input type="text" class="form-control input-sm" id="NameBar" maxlength="6" required>
                                    <span class="error-content hide" data-label="ชื่อสถานประกอบการ"></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-md-5"><p class="data-important">ชื่อผู้ประกอบการ</p></td>
                                <td class="col-md-7">
                                    <input type="text" class="form-control input-sm" id="NameOwner" maxlength="6" required>
                                    <span class="error-content hide" data-label="ชื่อผู้ประกอบการ"></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-md-5"><p class="data-important">เลขที่ทะเบียนสรรพสามิต</p></td>
                                <td class="col-md-7">
                                    <input type="text" class="form-control input-sm" id="NumLicense" maxlength="6" required>
                                    <span class="error-content hide" data-label="เลขที่ทะเบียนสรรพสามิต"></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-md-5"><p class="data-important">ประเภท</p></td>
                                <td class="col-md-7">
                                    <select class="form-control input-sm" id="BarType" required>
                                        <option value="">--เลือกประเภท--</option>
                                        <option value="1">เครื่องดื่ม</option>
                                        <option value="2">ไพ่</option>
                                    </select>
                                    <span class="error-content hide" data-label="ประเภทสหกรณ์"></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-md-5"><p class="data-important">สถานที่ตั้ง</p></td>
                                <td class="col-md-7">
                                    <textarea class="form-control input-sm" id="BarAddress" required></textarea>
                                    <span class="error-content hide" data-label="สถานที่ตั้ง"></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-md-5"><p class="data-important">วันที่สำรวจ</p></td>
                                <td class="col-md-7">
                                    <input type="text" class="form-control input-sm" id="dateS" maxlength="6" required>
                                    <span class="error-content hide" data-label="รหัสสถานศึกษา"></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-md-5"><p class="data-important">วันที่รายงาน</p></td>
                                <td class="col-md-7">
                                    <input type="text" class="form-control input-sm" id="dateR" maxlength="6" required>
                                    <span class="error-content hide" data-label="รหัสสถานศึกษา"></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-md-5"><p class="data-important">สถานะ</p></td>
                                <td class="col-md-7">
                                    <select class="form-control input-sm" id="barStatus" required>
                                        <option value="">--เลือกสถานะ--</option>
                                        <option value="1">มีเลขทะเบียน</option>
                                        <option value="2">ไม่พบเลขทะเบียน</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-md-5"><p class="data-important">พิกัดที่ตั้ง (ละติจูด)</p></td>
                                <td class="col-md-7">
                                    <input type="text" class="form-control input-sm" id="Lat" required>
                                    <span class="error-content hide" data-label="ละติจูด"></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-md-5"><p class="data-important">พิกัดที่ตั้ง (ลองจิจูด)</p></td>
                                <td class="col-md-7">
                                    <input type="text" class="form-control input-sm" id="Lon" required>
                                    <span class="error-content hide" data-label="ลองจิจูด"></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-md-5"><p class="data-important">รหัสภาค</p></td>
                                <td class="col-md-7">
                                    <input type="text" class="form-control input-sm" id="" required>
                                    <span class="error-content hide" data-label="รหัสภาค"></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-md-5"><p class="data-important">รหัสพื้นที่</p></td>
                                <td class="col-md-7">
                                    <input type="text" class="form-control input-sm" id="" required>
                                    <span class="error-content hide" data-label="รหัสพื้นที่"></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-md-5"><p class="data-important">รหัสสาขา</p></td>
                                <td class="col-md-7">
                                    <input type="text" class="form-control input-sm" id="" required>
                                    <span class="error-content hide" data-label="รหัสสาขา"></span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel panel-default" style="border-radius: 0;">
                <div class="panel-body text-right">
                    <button type="submit" class="btn btn-submit btn-sm" id="insertBtn">บันทึก</button>
                    <button type="submit" class="btn btn-warning btn-sm hide" id="updateBtn">แก้ไข</button>
                    <button type="reset" class="btn btn-sm btn-danger" id="resetBtn">ยกเลิก</button>
                </div>
            </div>
        </form>
    </div>

    <!--MAP AND TABLE DATA-->
    <div class="col-md-8">
        <div class="panel panel-default" style="height: 50vh; border-radius: 0; padding: 0;">
            <div class="panel-body" style="padding-top: 0; padding-bottom: 0;">
                <div class="row">
                    <div id="map" class="map" style="width: 100%; height: 50vh;"></div>
                        <div id="popup" class="ol-popup">
                            <a href="#" id="popup-closer" class="ol-popup-closer"></a>
                            <div id="popup-content"></div>
                        </div>
                    </div>
                    <div id="dvloading" class="loader"><div>
                </div>
            </div>
        </div>
        <div class="panel panel-default" style="border-radius: 0; padding: 0; margin: 0;height: 25vh;">
            <div class="panel-body" style="padding: 0; margin: 0;">
                <div class="table-responsive" style="margin: 0;">
                    <table class="table table-striped table-bordered eform-table bg-info" style="margin: 0;"> 
                        <thead>
                            <tr>
                                <th class="text-center text-nowrap bg-primary" style="font-size: 16px;">ชื่อสถานประกอบการ</th>
                                <th class="text-center text-nowrap bg-primary" style="font-size: 16px;">ชื่อผู้ประกอบการ</th>
                                <th class="text-center text-nowrap bg-primary" style="font-size: 16px;">เลขที่ทะเบียนสรรพสามิต</th>
                                <th class="text-center text-nowrap bg-primary" style="font-size: 16px;">ประเภท</th>
                                <th class="text-center text-nowrap bg-primary" style="font-size: 16px;">สถานที่ตั้ง</th>
                                <th class="text-center text-nowrap bg-primary" style="font-size: 16px;">วันที่สำรวจ</th>
                                <th class="text-center text-nowrap bg-primary" style="font-size: 16px;">วันที่รายงาน</th>
                                <th class="text-center text-nowrap bg-primary" style="font-size: 16px;">สถานะ</th>
                                <th class="text-center text-nowrap bg-primary" style="font-size: 16px;">ละติจูด</th>
                                <th class="text-center text-nowrap bg-primary" style="font-size: 16px;">ลองติจูด</th>
                                <th class="text-center text-nowrap bg-primary" style="font-size: 16px;">รหัสภาค</th>
                                <th class="text-center text-nowrap bg-primary" style="font-size: 16px;">รหัสพื้นที่</th>
                                <th class="text-center text-nowrap bg-primary" style="font-size: 16px;">รหัสสาขา</th>
                                <th class="text-center text-nowrap bg-primary" style="font-size: 16px;">รูป</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center text-nowrap" style="font-size: 13px;">ร้านสุดสะแนนผับ</td>
                                <td class="text-center text-nowrap" style="font-size: 13px;">นายอรุณ ศรีสวัสดิ์</td>
                                <td class="text-center text-nowrap" style="font-size: 13px;">2558-5011-58-243-00771</td>
                                <td class="text-center text-nowrap" style="font-size: 13px;">ไม่ระบุข้อมูล</td>
                                <td class="text-center text-nowrap" style="font-size: 13px;">30/1 ถ.ห้วยแก้ว ต.ช้างเผือก อ.เมือง จ.เชียงใหม่</td>
                                <td class="text-center text-nowrap" style="font-size: 13px;">19/07/2559</td>
                                <td class="text-center text-nowrap" style="font-size: 13px;">19/07/2559</td>
                                <td class="text-center text-nowrap" style="font-size: 13px;">ไม่ระบุ</td>
                                <td class="text-center text-nowrap" style="font-size: 13px;">14.97663</td>
                                <td class="text-center text-nowrap" style="font-size: 13px;">100.48096</td>
                                <td class="text-center text-nowrap " style="font-size: 16px;">1</td>
                                <td class="text-center text-nowrap " style="font-size: 16px;">1161</td>
                                <td class="text-center text-nowrap " style="font-size: 16px;">116102</td>
                                <td class="text-center text-nowrap " style="font-size: 16px;"></td>
                            </tr>
                            <tr>
                                <td class="text-center text-nowrap" style="font-size: 13px;">ร้านสุดสะแนนผับ</td>
                                <td class="text-center text-nowrap" style="font-size: 13px;">นายอรุณ ศรีสวัสดิ์</td>
                                <td class="text-center text-nowrap" style="font-size: 13px;">2558-5011-58-243-00771</td>
                                <td class="text-center text-nowrap" style="font-size: 13px;">ไม่ระบุข้อมูล</td>
                                <td class="text-center text-nowrap" style="font-size: 13px;">30/1 ถ.ห้วยแก้ว ต.ช้างเผือก อ.เมือง จ.เชียงใหม่</td>
                                <td class="text-center text-nowrap" style="font-size: 13px;">19/07/2559</td>
                                <td class="text-center text-nowrap" style="font-size: 13px;">19/07/2559</td>
                                <td class="text-center text-nowrap" style="font-size: 13px;">ไม่ระบุ</td>
                                <td class="text-center text-nowrap" style="font-size: 13px;">14.97663</td>
                                <td class="text-center text-nowrap" style="font-size: 13px;">100.48096</td>
                                <td class="text-center text-nowrap " style="font-size: 16px;">1</td>
                                <td class="text-center text-nowrap " style="font-size: 16px;">1161</td>
                                <td class="text-center text-nowrap " style="font-size: 16px;">116102</td>
                                <td class="text-center text-nowrap " style="font-size: 16px;"></td>
                            </tr>
                            <tr>
                                <td class="text-center text-nowrap" style="font-size: 13px;">ร้านสุดสะแนนผับ</td>
                                <td class="text-center text-nowrap" style="font-size: 13px;">นายอรุณ ศรีสวัสดิ์</td>
                                <td class="text-center text-nowrap" style="font-size: 13px;">2558-5011-58-243-00771</td>
                                <td class="text-center text-nowrap" style="font-size: 13px;">ไม่ระบุข้อมูล</td>
                                <td class="text-center text-nowrap" style="font-size: 13px;">30/1 ถ.ห้วยแก้ว ต.ช้างเผือก อ.เมือง จ.เชียงใหม่</td>
                                <td class="text-center text-nowrap" style="font-size: 13px;">19/07/2559</td>
                                <td class="text-center text-nowrap" style="font-size: 13px;">19/07/2559</td>
                                <td class="text-center text-nowrap" style="font-size: 13px;">ไม่ระบุ</td>
                                <td class="text-center text-nowrap" style="font-size: 13px;">14.97663</td>
                                <td class="text-center text-nowrap" style="font-size: 13px;">100.48096</td>
                                <td class="text-center text-nowrap " style="font-size: 16px;">1</td>
                                <td class="text-center text-nowrap " style="font-size: 16px;">1161</td>
                                <td class="text-center text-nowrap " style="font-size: 16px;">116102</td>
                                <td class="text-center text-nowrap " style="font-size: 16px;"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </br>
        
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