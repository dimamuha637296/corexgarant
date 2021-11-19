<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();


/** Markers **/
foreach ($arResult['ITEMS'] as $key => $arItem) {
    if($arItem['PROPERTIES']['LAN_LAT']['VALUE']){
        $tempArr = array();
        $tempArr['placemark_id'] = $arItem['ID'];

        $gPos = explode(',', $arItem['PROPERTIES']['LAN_LAT']['VALUE']);
        if(is_array($gPos) && count($gPos) > 1){
            $tempArr['google_lat'] = $gPos[0];
            $tempArr['google_lon'] = $gPos[1];
        } else {
            continue;
        }

        $tempArr['context'] = '<div class="baloon">';
        $tempArr['context'] .= '<div class="name"><b>'.$arItem['NAME'].'</b></div>';
        if($arItem['PROPERTIES']['ADRESS']['VALUE']){
            $tempArr['context'] .= '<div class="help-item">'.$arItem['PROPERTIES']["ADRESS"]["VALUE"].'</div>';
            if(is_array($arItem['PROPERTIES']['ADRESS']['VALUE'])){
                $tempArr['context'] .= '<div class="item">';
                foreach($arItem['PROPERTIES']['ADRESS']['VALUE'] as $propVal) {
                    $tempArr['context'] .= '<div>'.$propVal.' </div>';
                }
                $tempArr['context'] .= '</div>';
            }
        }
/*
        if(!empty($arItem['PROPERTIES']['FACE'])){
            if (!empty($arItem['PROPERTIES']['FACE']['VALUE'][0])) {
                $tempArr['context'] .= '<div class="help-item">' . $arItem['PROPERTIES']['FACE']['NAME'] . '</div>';
                if (is_array($arItem['PROPERTIES']['FACE']['VALUE'])) {
                    $tempArr['context'] .= '<div class="item">';
                    foreach ($arItem['PROPERTIES']['FACE']['VALUE'] as $propVal) {
                        $tempArr['context'] .= '<div>' . $propVal . ' </div>';
                    }
                    $tempArr['context'] .= '</div><p />';
                }
            }
        }

        if($arItem['PROPERTIES']['TELEPHONES']){
            $tempArr['context'] .= '<div class="help-item">'.$arItem['PROPERTIES']['TELEPHONES']['NAME'].'</div>';
            if(is_array($arItem['PROPERTIES']['TELEPHONES']['VALUE'])){
                $tempArr['context'] .= '<div class="item">';
                foreach($arItem['PROPERTIES']['TELEPHONES']['VALUE'] as $propVal) {
                    $tempArr['context'] .= '<div>'.$propVal.' </div>';
                }
                $tempArr['context'] .= '</div>';
            }
        }
//*/
        $tempArr['context'] .= '</div>';
    } else {
        continue;
    }
    $arResult['PLACEMARKS'][$arItem['ID']] = $tempArr;
}

$cp = $this->__component;
if (is_object($cp))
{
    $cp->SetResultCacheKeys(array("PLACEMARKS"));
}
?>