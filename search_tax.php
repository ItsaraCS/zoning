<?php require('header.php'); ?>
<?php require('nav.php'); ?>
<!--SECTION-->
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
                        <input style="" class="form-control input-sm" id="FactoryName" placeholder="ค้นหา">
                        <span class="input-group-btn">
                            <button class="btn btn-primary" type="submit">
                                <i class="fa fa-search" aria-hidden="true"></i>
                                Search
                            </button>
                        </span>
                    </div>
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

    <!--TABLE DATA-->
    <div class="col-md-12" style="margin-top: 10px;">
        <div class="row">
            <div class="panel panel-default" style="height: 37vh;">
                
                <div class="panel-body" style="padding: 0;">
                    <div class="table-responsive" style="height: 30vh;">
                        <table class="table table-striped search-table bg-info table-bordered" style="margin-top: 0;"> 
                            <thead><tr></tr></thead>
                            <tbody></tbody>
                        </table>
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