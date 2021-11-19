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
function BX_SetPlacemarks_<?echo $arParams['MAP_ID']?>()
{
    var imgIconDef = '<?=$arParams["MAPS_ICON"]?>';
    
    var map_id = '<?=$arParams['MAP_ID']?>';
    var map = GLOBAL_arMapObjects[map_id];
    var objShowInfo = $('#map-info-to-show');
    var DefCenter = map.getCenter();
    var DefZoom = map.getZoom();

    $('div.b-contact-info-block').each(function(key, divContener) {
        if ($('span.lnk', divContener).length) {
            var infoBlock = $('span.lnk', divContener);
            //var            
            var PlacemarkLat = infoBlock.attr('data-lat');
            var PlacemarkLon = infoBlock.attr('data-lon');
            var PlacemarkNum = infoBlock.attr('data-num');
            var imgIcon = infoBlock.attr('data-type-icon');
            if(imgIcon){
                mapIcon = imgIcon;
            }else{
            	mapIcon = imgIconDef;
            }
            
            var PlacemarkContext = $('.inf', infoBlock ).html();

            if (BX.type.isNotEmptyString(PlacemarkLat)){
            
                var obPlacemark = new google.maps.Marker({
                    'position': new google.maps.LatLng(PlacemarkLat, PlacemarkLon),
                    'map': map,
                    icon: mapIcon
                });
                if (BX.type.isNotEmptyString(PlacemarkContext))
                {
                    google.maps.event.addListener(obPlacemark, 'click', function() {
                        map.panTo(obPlacemark.getPosition());
						objShowInfo.html(PlacemarkContext).show();
});
                }
				
                infoBlock.click(function(){
				//$(window).scrollTop($('#BX_GMAP_'+map_id).offset().top);
				$('html, body').animate({ scrollTop: $('#title').offset().top }, 600);map.setZoom(15);
                    map.panTo(obPlacemark.getPosition());
                    
					objShowInfo.html(PlacemarkContext).show();
					
                });
				
				if(PlacemarkNum == 0) {
					//objShowInfo.html(PlacemarkContext).show();
				}
            }
        }
    });
}

function BXShowMap_<?echo $arParams['MAP_ID']?>() {BXWaitForMap_view('<?echo $arParams['MAP_ID']?>');}

BX.ready(BXShowMap_<?echo $arParams['MAP_ID']?>);

if (null == window.BXWaitForMap_view)
{
	function BXWaitForMap_view(map_id)
	{
		if (null == window.GLOBAL_arMapObjects)
			return;
	
		if (window.GLOBAL_arMapObjects[map_id])
			window['BX_SetPlacemarks_' + map_id]();
		else
			setTimeout('BXWaitForMap_view(\'' + map_id + '\')', 300);
	}
}

</script>