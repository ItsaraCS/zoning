<?php require('header.php'); ?>
<?php require('nav.php');?>


        <!-- Map -->
        <div class="container-fluid">
            <div class="row">
                <div id="map" class="map" style="width:100%; height: 100%; position:fixed"></div>
            </div>
        </div>
        <!-- Loading -->
        <div id="dvloading" class="loader"><div></div></div>
        <!-- CHART GRAPH  -->   

        <div id="chart_container" class="panel">
            <div id="chart_group">
                <div id="chart_title" class="panel text-center" data-toggle="collapse" href="#collapse1">กราฟข้อมูล</div>
                <div id="collapse1" class="panel-collapse collapse">
                    <div id="chartContainer" style="height: 180px; width: 100%;">
                    </div>
                </div>
            </div>
        </div>
       

<script type="text/javascript">
        /* M A P*/
            var filer_region = null;
            var styleCache = {};
            /* Load Data GeoJSON */
            $('#dvloading').show();
            getJSON('data/geojson/excise_region.geojson', function(data) {
                dataGJson_region10 = data;

                 /* POLYGON Excise */
                var features_poly_region10 = new ol.format.GeoJSON().readFeatures(dataGJson_region10, {
                    featureProjection :  'EPSG:3857'
                });
                var tmpSourceRegion = new ol.source.Vector({
                    features : features_poly_region10,
                    wrapX : false
                });

                vectorLayer_poly_region10 = new ol.layer.Vector({
                    source : tmpSourceRegion,
                    style : function (feature, resolution) { 
                            var cat = feature.get('REG_CODE');
                            styleCache[cat] = new ol.style.Style({
                                fill : new ol.style.Fill({
                                    color : categories[cat]
                                }),
                                stroke : new ol.style.Stroke({
                                    color : '#000',
                                    width : 1.0
                                })
                            });
                            return [ styleCache[cat] ];
                        }
                });
                var projection = ol.proj.get('EPSG:3857');

                map = new ol.Map({
                    layers : [ vectorLayer_poly_region10 ],
                    //overlays: [overlay],//for popup
                    target : 'map',
                    view: new ol.View ({
                        center: [100, 13],
                        projection: projection,
                        zoom: 3
                    })
                });
                
                $('#dvloading').hide();
                map.getView().setCenter(ol.proj.transform([103.0, 8.5], 'EPSG:4326', 'EPSG:3857'));
                map.getView().setZoom(5.5);
            
            }, function (xhr) {
                console.error(xhr);
            });
            
            /* Function */
            function getJSON(path, success, error) {
                var xhr = new XMLHttpRequest();

                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            if (success)
                                success(JSON.parse(xhr.responseText));
                        } else {
                            if (error)
                                error(xhr);
                        }
                    }
                };
                xhr.open("GET", path, true);
                xhr.send();
            }
</script>
<?php require('footer.php'); ?>   
    </body>
</html>