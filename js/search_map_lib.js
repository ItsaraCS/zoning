/**
 * Zoom to given geographic coordinates.
 *
 * @param o    Openlayer itself
 * @param m    Openlayer's map
 * @param lat  Latitude (horizontal)
 * @param lon  Longitude (vertical)
 * @param z    Target zoom level
 */

var path = (window.location.pathname).split('/');
var headerMenuTitle = path[path.length - 1];

function zoom_to_factory(o, m, lat, lon, z) {
	m.getView().setCenter(o.proj.transform([lon, lat], 'EPSG:4326', 'EPSG:3857'));
	m.getView().setZoom(z);
}

/**
 * Load data
 */
function search_load_point_layers() {
	switch(headerMenuTitle) {
		case 'search_case.php':
			getJSON(
				'data/geojson-update/illigal_points.geojson', //--ผู้กระทำผิด
				function(data) {
					vec_case_point = create_vector_layer(data, 'EPSG:3857', case_point_style_function);
					map.addLayer(vec_case_point);
					$('#dvloading').hide().fadeOut();
				}, 
				function(xhr) {
				}
			);

			break;
		case 'search_license.php':
			getJSON(
				'data/geojson-update/shop_points.geojson', //--ผู้ประกอบการ
				function(data) {
					vec_license_point = create_vector_layer(data, 'EPSG:3857', license_point_style_function);
					map.addLayer(vec_license_point);
					$('#dvloading').hide().fadeOut();
				}, 
				function(xhr) {
				}
			);

			break;
		case 'search_company.php':
			(function getZoningVector() {
				getJSON(
					'data/geojson-update/zoning_polygon.geojson', //--พื้นที่โซนนิ่ง
					function(data) {
						vec_zoning_polygon = create_vector_layer(data, 'EPSG:3857', zoning_polygon_style_function);
						map.addLayer(vec_zoning_polygon);
						getShopVector();
					}, 
					function(xhr) {
					}
				);
			})()

			function getShopVector() {
				getJSON(
					'data/geojson-update/shop_points.geojson', //--ร้านค้า
					function(data) {
						vec_shop_point = create_vector_layer(data, 'EPSG:3857', shop_point_style_function);
						map.addLayer(vec_shop_point);
						$('#dvloading').hide().fadeOut();
					}, 
					function(xhr) {
					}
				);
			}

			break;
		case 'search_academy.php':
			(function getZoningVector() {
				getJSON(
					'data/geojson-update/zoning_polygon.geojson', //--พื้นที่โซนนิ่ง
					function(data) {
						vec_zoning_polygon = create_vector_layer(data, 'EPSG:3857', zoning_polygon_style_function);
						map.addLayer(vec_zoning_polygon);
						getSchoolVector();
					}, 
					function(xhr) {
					}
				);
			})()

			function getSchoolVector() {
				getJSON(
					'data/geojson-update/school_points.geojson', //--สถานศึกษา
					function(data) {
						vec_school_point = create_vector_layer(data, 'EPSG:3857', school_point_style_function);
						map.addLayer(vec_school_point);
						$('#dvloading').hide().fadeOut();
					}, 
					function(xhr) {
					}
				);
			}

			break;
		case 'search_zoning.php':
			(function getZoningVectorForZoning() {
				getJSON(
					'data/geojson-update/zoning_polygon.geojson', //--พื้นที่โซนนิ่ง
					function(data) {
						vec_zoning_polygon = create_vector_layer(data, 'EPSG:3857', zoning_polygon_style_function);
						map.addLayer(vec_zoning_polygon);
						getSchoolPolygonVectorForZoning();
					}, 
					function(xhr) {
					}
				);
			})()

			function getSchoolPolygonVectorForZoning() {
				getJSON(
					'data/geojson-update/school_polygon.geojson', //--พื้นที่สถานศึกษา
					function(data) {
						vec_school_polygon = create_vector_layer(data, 'EPSG:3857', school_polygon_style_function);
						map.addLayer(vec_school_polygon);
						getShopVectorForZoning();
					}, 
					function(xhr) {
					}
				);
			}

			function getShopVectorForZoning() {
				getJSON(
					'data/geojson-update/shop_points.geojson', //--ร้านค้า
					function(data) {
						vec_shop_point = create_vector_layer(data, 'EPSG:3857', shop_point_style_function);
						map.addLayer(vec_shop_point);
						getSchoolVectorForZoning();
						$('#dvloading').hide().fadeOut();
					}, 
					function(xhr) {
					}
				);
			}

			function getSchoolVectorForZoning() {
				getJSON(
					'data/geojson-update/school_points.geojson', //--สถานศึกษา
					function(data) {
						vec_school_point = create_vector_layer(data, 'EPSG:3857', school_point_style_function);
						map.addLayer(vec_school_point);
						$('#dvloading').hide().fadeOut();
					}, 
					function(xhr) {
					}
				);
			}

			break;
	}
}

/**
 * Point style
 */
var my_dom = {
	text:           'normal',
	align:          'center',
	baseline:       'bottom',
	rotation:       '0',
	font:           'MS Sans Serif',
	weight:         'normal',
	size:           '13px',
	offsetX:        '0',
	offsetY:        '-10',
	color:          'rgba(0, 0, 0, 1.0)',
	outline:        'rgba(255, 255, 255, 0.0)',
	outlineWidth:   '4',
	maxreso:        '200'
};

function case_point_style_function(feature, resolution) {
	console.log(feature);

	if(resolution < 100) {
		image = new ol.style.Icon({
			opacity: 1,
			scale: 0.12,
			src: 'img/marker-case.png'
		});
	} else {
		image = new ol.style.Circle({
			radius: 2,
			fill: new ol.style.Fill({color: 'rgba(255, 0, 0, 0.8)'}),
			stroke: new ol.style.Stroke({color: 'rgba(255, 0, 0, 0.8)', width: 1})
		});
	}

	text = search_create_text_style(
		feature, 
		resolution,
		my_dom,
		'CHARGE_NAM'
	)

	return new ol.style.Style({
		image,
		text: text
	});
}

function license_point_style_function(feature, resolution) {
	if(resolution < 350) {
		image = new ol.style.Icon({
			opacity: 1,
			scale: 0.05,
			src: 'img/marker-company.png'
		});

		text = search_create_text_style(
			feature, 
			resolution,
			my_dom,
			'COM_NAME'
		)

		return new ol.style.Style({
			image,
			text: text
		});
	} else {
		return new ol.style.Style();
	}
}

function shop_point_style_function(feature, resolution) {
	if(resolution < 100) {
		image = new ol.style.Icon({
			opacity: 1,
			scale: 0.05,
			src: 'img/marker-company.png'
		});

		text = search_create_text_style(
			feature, 
			resolution,
			my_dom,
			'COM_NAME'
		)

		return new ol.style.Style({
			image,
			text: text
		});
	} else {
		return new ol.style.Style();
	}
}

function school_point_style_function(feature, resolution) {
	if(resolution < 100) {
		image = new ol.style.Icon({
			opacity: 1,
			scale: 0.03,
			src: 'img/marker-academy.png'
		});

		text = search_create_text_style(
			feature, 
			resolution,
			my_dom,
			'SCHOOLNAME'
		)

		return new ol.style.Style({
			image,
			text: text
		});
	} else {
		return new ol.style.Style();
	}
}

/**
 * Create labeled text.
 */
function search_create_text_style(feature, resolution, dom, field) {
	var align = dom.align;
	var baseline = dom.baseline;
	var size = dom.size;
	var offsetX = parseInt(dom.offsetX, 10);
	var offsetY = parseInt(dom.offsetY, 10);
	var weight = dom.weight;
	var rotation = parseFloat(dom.rotation);
	var font = weight + ' ' + size + ' ' + dom.font;
	var fillColor = dom.color;
	var outlineColor = dom.outline;
	var outlineWidth = parseInt(dom.outlineWidth, 10);
	
	if(resolution < 10) {
		return new ol.style.Text({
			textAlign: align,
			textBaseline: baseline,
			font: font,
			text: search_get_text(feature, resolution, dom, field),
			fill: new ol.style.Fill({color: fillColor}),
			stroke: new ol.style.Stroke({color: outlineColor, width: outlineWidth}),
			offsetX: offsetX,
			offsetY: offsetY,
			rotation: rotation
		});
	}
}

/**
 * Get labeled text.
 */
function search_get_text(feature, resolution, dom, field) {
	var maxResolution = dom.maxreso;
	var r_code = feature.get(field);
	var idx = parseInt(r_code) - 1;
	
	// Get value to label
	var text;
	if( field == '' ) {
		text = odata[idx].VAL.toFixed(2);
	} else {
		text = feature.get(field);
	}

	if (resolution > maxResolution) {
		text = '';
	}
	
	if (text == 0.0) {
		//text = '';
	}
	
	//console.log('resolution', resolution, 'maxreso', maxResolution);
	return text;
}