<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if (CModule::IncludeModule('sale'))
{
	$dbStat = CSaleStatus::GetList(array('sort' => 'asc'), array('LID' => LANGUAGE_ID), false, false, array('ID', 'NAME'));
	$statList = array();
	while ($item = $dbStat->Fetch())
		$statList[$item['ID']] = $item['NAME'];

	$statList['PSEUDO_CANCELLED'] = 1;	

	$availColors = array(
		'green' => GetMessage("SPO_STATUS_COLOR_GREEN"),
		'yellow' => GetMessage("SPO_STATUS_COLOR_YELLOW"),
		'red' => GetMessage("SPO_STATUS_COLOR_RED"),
		'gray' => GetMessage("SPO_STATUS_COLOR_GRAY"),
	);

	$colorDefaults = array(
		'N' => 'green', // new
		'P' => 'yellow', // payed
		'F' => 'gray', // finished
		'PSEUDO_CANCELLED' => 'red' // cancelled
	);

	foreach ($statList as $id => $name)
		$arTemplateParameters["STATUS_COLOR_".$id] = array(
			"NAME" => $id == 'PSEUDO_CANCELLED' ? GetMessage("SPO_PSEUDO_CANCELLED_COLOR") : GetMessage("SPO_STATUS_COLOR").' "'.$name.'"',
			"TYPE" => "LIST",
			"MULTIPLE" => "N",
			"VALUES" => $availColors,
			"DEFAULT" => empty($colorDefaults[$id]) ? 'gray' : $colorDefaults[$id],
		);
}
if (CModule::IncludeModule("catalog"))
{
    $arSKU = false;
    $boolSKU = false;
    $arOfferProps = array();

    // get iblock props from all catalog iblocks including sku iblocks
    $arSkuIblockIDs = array();
    $dbCatalog = CCatalog::GetList(array(), array());
    while ($arCatalog = $dbCatalog->GetNext())
    {
        $arSKU = CCatalogSKU::GetInfoByProductIBlock($arCatalog['IBLOCK_ID']);

        if (!empty($arSKU) && is_array($arSKU))
        {
            $arSkuIblockIDs[] = $arSKU["IBLOCK_ID"];
            $arSkuData[$arSKU["IBLOCK_ID"]] = $arSKU;

            $boolSKU = true;
        }
    }

    // iblock props
    $arProps = array();
    foreach ($arSkuIblockIDs as $iblockID)
    {
        $dbProps = CIBlockProperty::GetList(
            array(
                "SORT"=>"ASC",
                "NAME"=>"ASC"
            ),
            array(
                "IBLOCK_ID" => $iblockID,
                "ACTIVE" => "Y",
                "CHECK_PERMISSIONS" => "N",
            )
        );

        while ($arProp = $dbProps->GetNext())
        {
            if ($arProp['ID'] == $arSkuData[$arSKU["IBLOCK_ID"]]["SKU_PROPERTY_ID"])
                continue;

            if ($arProp['XML_ID'] == 'CML2_LINK')
                continue;

            $strPropName = '['.$arProp['ID'].'] '.('' != $arProp['CODE'] ? '['.$arProp['CODE'].']' : '').' '.$arProp['NAME'];

            if ($arProp['PROPERTY_TYPE'] != 'F')
            {
                $arOfferProps[$arProp['CODE']] = $strPropName;
            }
        }

        if (!empty($arOfferProps) && is_array($arOfferProps))
        {
            $arTemplateParameters['OFFERS_PROPS'] = array(
                'PARENT' => 'OFFERS_PROPS',
                'NAME' => GetMessage('SALE_PROPERTIES_RECALCULATE_BASKET'),
                'TYPE' => 'LIST',
                'MULTIPLE' => 'Y',
                'SIZE' => '7',
                'ADDITIONAL_VALUES' => 'N',
                'REFRESH' => 'N',
                'DEFAULT' => '-',
                'VALUES' => $arOfferProps
            );
        }
    }
}
?>