<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$level1 = '';
$level2 = '';
$level3 = '';
$firstLevel = 1;
foreach($arResult as $key => $item) {
    if($item['DEPTH_LEVEL'] == $firstLevel) {
        $arResult['MENU'][$key] = $item;
        $level1 = $key;
    }elseif($item['DEPTH_LEVEL'] == ($firstLevel + 1)) {
        $arResult['MENU'][$level1]['ITEMS'][$key] = $item;
        $level2 = $key;
    }elseif($item['DEPTH_LEVEL'] == ($firstLevel + 2)) {
        $arResult['MENU'][$level1]['ITEMS'][$level2]['ITEMS'][$key] = $item;
        $level3 = $key;
    }
}
?>
