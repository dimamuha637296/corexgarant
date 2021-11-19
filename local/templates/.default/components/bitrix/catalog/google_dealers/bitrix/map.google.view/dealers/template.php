<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$this->setFrameMode(true);

$arTransParams = array(
    'INIT_MAP_TYPE' => $arParams['INIT_MAP_TYPE'],
    'INIT_MAP_LON' => $arResult['POSITION']['google_lon'],
    'INIT_MAP_LAT' => $arResult['POSITION']['google_lat'],
    'INIT_MAP_SCALE' => $arResult['POSITION']['google_scale'],
    'MAP_WIDTH' => $arParams['MAP_WIDTH'],
    'MAP_HEIGHT' => $arParams['MAP_HEIGHT'],
    'CONTROLS' => $arParams['CONTROLS'],
    'OPTIONS' => $arParams['OPTIONS'],
    'MAP_ID' => $arParams['MAP_ID'],
);
if ($arParams['DEV_MODE'] == 'Y')
{
    $arTransParams['DEV_MODE'] = 'Y';
    if ($arParams['WAIT_FOR_EVENT'])
        $arTransParams['WAIT_FOR_EVENT'] = $arParams['WAIT_FOR_EVENT'];
}
?>
<div class="bx-yandex-view-layout">
    <div class="bx-yandex-view-map">
        <?
        $APPLICATION->IncludeComponent('bitrix:map.google.system', '.default', $arTransParams, false, array('HIDE_ICONS' => 'Y'));
        ?>
    </div>
</div>
<script type="text/javascript">
    function BX_SetPlacemarks_<?echo $arParams['MAP_ID']?>(tempId)
    {
        var imgIconDef = '<?=$arParams["MAPS_ICON"]?>';
        var map_id = '<?=$arParams['MAP_ID']?>';
        var map = GLOBAL_arMapObjects[map_id];
        var objShowInfo = $('#map-info-to-show-<?=$arParams['MAP_ID']?>');
        var DefCenter = map.getCenter();
        var DefZoom = map.getZoom();
        var temp_mark = '';
        var markers = <?=json_encode($arParams['MARKERS'])?>;
        var tempImgIconDefault = '';
        var infowindow = '';
        var activeIW = '';
        var activeOP = '';

        if(map_id != 'temp_map'){
            $('div.b-contact-info-block').each(function(key, divContener) {
                if ($('span.lnk', divContener).length) {
                    var infoBlock = $('span.lnk', divContener);
                    var PlacemarkLat = infoBlock.attr('data-lat');
                    var PlacemarkLon = infoBlock.attr('data-lon');
                    var PlacemarkNum = infoBlock.attr('data-num');
                    var PlacemarkId = infoBlock.attr('data-id');
                    if(infoBlock.attr('data-type-icon') != ''){
                        var imgIconDefault = markers[infoBlock.attr('data-type-icon')]['MARKER_DEFAULT'];
                        var imgIconActive = markers[infoBlock.attr('data-type-icon')]['MARKER_ACTIVE'];
                    }
                    var PlacemarkContext = $('.inf', infoBlock ).html();
                    if (BX.type.isNotEmptyString(PlacemarkLat)){

                        var obPlacemark = new google.maps.Marker({
                            'position': new google.maps.LatLng(PlacemarkLat, PlacemarkLon),
                            'map': map,
                            icon: imgIconDef
                        });

                        if (BX.type.isNotEmptyString(PlacemarkId))
                        {
                            google.maps.event.addListener(obPlacemark, 'click', function() {
                                /*if(temp_mark!='') {
                                    temp_mark.setIcon(tempImgIconDefault);
                                }
                                temp_mark = obPlacemark;
                                temp_mark.setIcon(imgIconActive);
                                tempImgIconDefault = imgIconDefault;*/
                                var latLng = new google.maps.LatLng(String(Number(PlacemarkLat)+0.02), String(Number(PlacemarkLon)));
                                map.setZoom(15);
                                map.panTo(latLng);
                                if(infowindow != '') {
                                    infowindow.close();
                                }
                                infowindow = new google.maps.InfoWindow({
                                    content: PlacemarkContext
                                });
                                infowindow.open(map,obPlacemark);
                                activeOP = obPlacemark;
                                //objShowInfo.html(PlacemarkContext).show();
                            });
                        }

                        infoBlock.click(function(){
                            $('html, body').animate({ scrollTop: $('#title').offset().top }, 600);map.setZoom(15);
                            google.maps.event.trigger(obPlacemark, "click");
                        });

                    }
                }
            });
        } else {
            var tempIblock =  $('#distribution-'+tempId+' span.lnk');
            var PlacemarkLat = tempIblock.attr('data-lat');
            var PlacemarkLon = tempIblock.attr('data-lon');
            var PlacemarkNum = tempIblock.attr('data-num');
            var PlacemarkId = tempIblock.attr('data-id');
            var PlacemarkContext = $('.inf', $('#distribution-'+tempId) ).html();
            if (BX.type.isNotEmptyString(PlacemarkLat)) {
                var obPlacemark = new google.maps.Marker({
                    'position': new google.maps.LatLng(PlacemarkLat, PlacemarkLon),
                    'map': map,
                    icon: imgIconDef
                });
                if (BX.type.isNotEmptyString(PlacemarkId)) {
                    google.maps.event.addListener(obPlacemark, 'click', function () {
                        if(GLOBAL_arMapObjects['prev_marker'] && GLOBAL_arMapObjects['prev_marker']!='' && GLOBAL_arMapObjects['prev_marker']!= obPlacemark) {
                            GLOBAL_arMapObjects['prev_marker'].setMap(null);
                        }
                        GLOBAL_arMapObjects['prev_marker'] = obPlacemark;
                        //obPlacemark.setIcon(imgIconActive);
                        var latLng = new google.maps.LatLng(String(Number(PlacemarkLat)), PlacemarkLon);
                        map.setZoom(13);
                        map.panTo(latLng);
                        var infowindow = new google.maps.InfoWindow({
                            content: PlacemarkContext
                        });
                        infowindow.open(map,obPlacemark);

                        //objShowInfo.html(PlacemarkContext).show();
                    });
                    google.maps.event.trigger(obPlacemark, "click");
                }
            }
        }
        /*map.addListener('zoom_changed', function() {
            if(infowindow.map != null){
                infowindow.open(map,activeOP);
            }
        });*/

    }


    function BXShowMap_<?echo $arParams['MAP_ID']?>() {BXWaitForMap_view('<?echo $arParams['MAP_ID']?>');}

    BX.ready(BXShowMap_<?echo $arParams['MAP_ID']?>);

    function BXWaitForMap_view(map_id) {
        if (null == window.GLOBAL_arMapObjects)
            return;

        if (window.GLOBAL_arMapObjects[map_id]) {
            window['BX_SetPlacemarks_' + map_id]();
        } else {
            setTimeout('BXWaitForMap_view(\'' + map_id + '\')', 300);

        }
    }

</script>