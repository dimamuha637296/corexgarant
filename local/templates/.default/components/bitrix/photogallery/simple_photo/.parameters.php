<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

CModule::IncludeModule("iblock");

if(intval($arCurrentValues["IBLOCK_ID"]) > 0){
	$arSections=Array();
	$arFilter = Array('IBLOCK_ID'=>$arCurrentValues["IBLOCK_ID"], 'GLOBAL_ACTIVE'=>'Y');
	$db_sect = CIBlockSection::GetList(Array($by=>$order), $arFilter, true);
	while($arSectRes = $db_sect->Fetch())
		$arSections[$arSectRes["ID"]] = $arSectRes["NAME"];

	$arTemplateParameters["PARENT_SECTION"] = array(
			"PARENT" => "BASE",
			"NAME" => GetMessage("MESS_IBLOCK_SECTION_ID"),
			"TYPE" => "LIST",
			"VALUES" => $arSections,
			"REFRESH" => "N",
			"DEFAULT" => "33",
			"ADDITIONAL_VALUES" => "Y",
	);
}
?>