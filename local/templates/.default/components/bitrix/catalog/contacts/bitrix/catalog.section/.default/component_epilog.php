<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
	$this->arResult['JSCORE'][] = 'fx';
	if (!isset($arParams['YANDEX_VERSION']))
		$arParams['YANDEX_VERSION'] = '2.0';
	
	$arParams['DEV_MODE'] = $arParams['DEV_MODE'] == 'Y' ? 'Y' : 'N';
	
	if (!$arParams['LOCALE'])
	{
		switch (LANGUAGE_ID)
		{
			case 'ru':
				$arParams['LOCALE'] = 'ru-RU';
				break;
			case 'ua':
				$arParams['LOCALE'] = 'ru-UA';
				break;
			case 'tk':
				$arParams['LOCALE'] = 'tr-TR';
				break;
			default:
				$arParams['LOCALE'] = 'en-US';
				break;
		}
	}
	
	if (!defined('DB_YMAP_SCRIPT_LOADED'))
	{
		$scheme = (CMain::IsHTTPS() ? "https" : "http");
		$arResult['MAPS_SCRIPT_URL'] = $scheme.'://api-maps.yandex.ru/'.$arParams['YANDEX_VERSION'].'/?load=package.full&mode=release&lang='.$arParams['LOCALE'].'&wizard=bitrix';
		if ($arParams['DEV_MODE'] != 'Y')
		{
	
			$APPLICATION->AddHeadString(
					'<script src="'.$arResult['MAPS_SCRIPT_URL'].'"></script>'
			);
			define('DB_YMAP_SCRIPT_LOADED', 1);
		}
	}
	
?>
