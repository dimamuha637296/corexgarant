<?

//*
foreach($arResult as  $key => $arItem){
    if($arItem["DEPTH_LEVEL"] == "3" || $arItem["DEPTH_LEVEL"] == "4"){
        unset($arResult[$key]);
    }elseif($arItem["DEPTH_LEVEL"] == "2"){
        $arResult[$key]["IS_PARENT"] = false;
    }
}
//*/

?>