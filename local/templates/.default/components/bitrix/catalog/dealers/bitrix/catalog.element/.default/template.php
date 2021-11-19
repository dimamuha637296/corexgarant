<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
if(strlen($arResult["PROPERTIES"]['LAN_LAT']['VALUE']) > 0):
	$arLan_Lat = explode(",", $arResult["PROPERTIES"]['LAN_LAT']['VALUE']);
	$arParams['MAP_DATA'] = array(
		'google_lat' => trim($arLan_Lat[0]),
		'google_lon' => trim($arLan_Lat[1]),
		'google_scale' => 15,
		'PLACEMARKS' => array(),
	);
?>
<div class="b-index-map m-mb-10">
	<div class="b-index-map-info _hide" id="map-info-to-show"></div>
	<div class="b-map" id="map">
		<?$APPLICATION->IncludeComponent("bitrix:map.google.view", "contacts-jq-map", array(
			"INIT_MAP_TYPE" => "ROADMAP",
			"MAP_DATA" => serialize($arParams['MAP_DATA']),
			"MAP_WIDTH" => "100%",
			"MAP_HEIGHT" => "415",
			"CONTROLS" => array(
				0 => "SMALL_ZOOM_CONTROL",
			),
			"OPTIONS" => array(
				0 => "ENABLE_DBLCLICK_ZOOM",
				1 => "ENABLE_DRAGGING",
				2 => "ENABLE_KEYBOARD",
			),
			"MAP_ID" => "google_map_main_page"
			),
			$component,
			array(
			"HIDE_ICONS" => "N",
			"ACTIVE_COMPONENT" => "Y"
			)
		);?>
	</div>
</div>
<?endif;?>
<div class="b-contact-info-block">
<div class="fix-alert">
<?if($arResult['ALL_VAC_CNT'] > 0):?>
	<div class="shop-vac">
		<a href="<?=SITE_DIR?>work/vacancy/?IT_MANUFACTURES=<?=$arResult['ID']?>&set_filter=Y&set_FIX_REGION=Y"><?=GetMessage("T_CANDIDATES_TITLE")?><sup><?=$arResult['ALL_VAC_CNT']?></sup></a>
	</div>
	<?endif;?>
<?if(strlen($arResult["PROPERTIES"]['ADRESS']['VALUE']) > 0 || strlen($arResult["PROPERTIES"]['TIME_WORK']['VALUE']) > 0):?>
	<div class="shop-adr">
		<?if(strlen($arResult["PROPERTIES"]['ADRESS']['VALUE']) > 0):?>
			<span class="map-info"><?=$arResult["PROPERTIES"]['ADRESS']['VALUE']?></span>
		<?endif;?>
		<?if(strlen($arResult["PROPERTIES"]['TIME_WORK']['VALUE']) > 0):?>
			<div class="ugc"><?=nl2br($arResult["PROPERTIES"]['TIME_WORK']['VALUE'])?></div>
		<?endif;?>
	</div>
<?endif;?>
</div>
	<?if(strlen($arResult["PROPERTIES"]['LAN_LAT']['VALUE']) > 0):?>
	<span class="lnk" data-lon="<?=trim($arLan_Lat[1])?>" data-lat="<?=trim($arLan_Lat[0])?>" data-num="<?=$num?>">
		<div class="_hide inf">
			<?if($arParams["DISPLAY_NAME"]!="N" && $arResult["NAME"]):?>
				<div class="b-index-map-info-header"><?=$arResult['NAME']?></div>
			<?endif;?>	
			<div class="b-index-map-info-contacts">
				<?if(strlen($arResult["PROPERTIES"]['ADRESS']['VALUE']) > 0):?>
					<h4><?=$arResult["PROPERTIES"]['ADRESS']['VALUE']?></h4>
				<?endif;?>
				<?if(strlen($arResult["PROPERTIES"]['TIME_WORK']['VALUE']) > 0):?>
					<p><?=$arResult["PROPERTIES"]['TIME_WORK']['VALUE']?></p>
				<?endif;?>
			</div>
		</div>
	</span>
	<?endif; ?>

	<div>
		<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arResult["PREVIEW_TEXT"]):?>
			<div class="ugc">
				<?=($arResult["PREVIEW_TEXT"])?>
			</div>		
		<?endif;?>
		<?if($arParams["DISPLAY_DETAIL_TEXT"]!="N" && $arResult["DETAIL_TEXT"]):?>
			<div class="ugc">
					<?=($arResult["DETAIL_TEXT"])?>
			</div>
		<?endif;?>
		
		
		<?if($arResult["PROPERTIES"]['SERVICIES']['VALUE']['TEXT']):?>
			<h6><?=($arResult["PROPERTIES"]['SERVICIES']['NAME'])?>:</h6>
			<div class="ugc">
				<?=($arResult["PROPERTIES"]['SERVICIES']['VALUE']['TEXT'])?>
			</div>
		<?endif;?>
		<?if(count($arResult['PROPERTIES']['SERVICIES_PRODUCT']['VALUE']) > 0):?>	
			<ul class="products">
				<?foreach($arResult['PROPERTIES']['SERVICIES_PRODUCT']['VALUE_XML_ID'] as $key => $arItem):?>
				<li>
					<img src="<?=SITE_TEMPLATE_PATH?>/images/<?=($arItem)?>.png" width="87" height="80" alt="<?=($arResult['PROPERTIES']['SERVICIES_PRODUCT']['VALUE'][$key])?>">
					<span><?=($arResult['PROPERTIES']['SERVICIES_PRODUCT']['VALUE'][$key])?></span>
				</li>
				<?endforeach;?>
			</ul>
		<?endif;?>
		<?if(count($arResult['PROPERTIES']['SERVICIES_PAY']['VALUE']) > 0):?>	
			<ul class="service dop-top">
				<?foreach($arResult['PROPERTIES']['SERVICIES_PAY']['VALUE_XML_ID'] as $key => $arItem):?>
				<li>
					<img src="<?=SITE_TEMPLATE_PATH?>/images/<?=($arItem)?>.png" width="87" height="80" alt="<?=($arResult['PROPERTIES']['SERVICIES_PAY']['VALUE'][$key])?>">
					<span><?=($arResult['PROPERTIES']['SERVICIES_PAY']['VALUE'][$key])?></span>
				</li>
				<?endforeach;?>
			</ul>
		<?endif;?>
		<?if(count($arResult['DOP_IMAGES']) > 0):?>	
		<div class="group db-catalog-galery dop-top">
			<h3><?=GetMessage("T_NEWS_DOP_IMAGES_TITLE")?></h3>
			<div class="grid-holder db-catalog-galery group">
				<?foreach($arResult['DOP_IMAGES'] as $arPhoto):?>
				<div class="col_3">
					<a class="lightbox m-no-bd" rel="group<?=$arResult['ID']?>" href="<?=$arPhoto['PATH']?>" title="<?=$arPhoto['TITLE']?>">
						<img width="<?=$arPhoto['WIDTH']?>" src="<?=$arPhoto['SRC']?>" alt="<?=$arPhoto['ALT']?>" title="<?=$arPhoto['TITLE']?>">
					</a>
					<div class="clear"></div>
					<div class="info"><?=$arPhoto['TITLE']?></div>
				</div>
				<?endforeach;?>
			</div>
		</div>
		<?endif;?>
	</div>
</div>
<?$this->SetViewTarget('left-block');?>
	
	<?if(count($arResult['ALL_MAGG']) > 1):?>
	<div class="alert alert-info ugc m-mb-0">
		<h6 class="m-mb-10"><?=GetMessage("T_ALL_MAGG_TITLE")?>:</h6>
		<ul class="m-mb-0">
		<?foreach($arResult['ALL_MAGG'] as $arElement):
			if(strlen($arElement['PROPERTY_ADRESS_VALUE']) > 0){
				$arElement['NAME'] = $arElement['PROPERTY_ADRESS_VALUE'];
			}
		?>
			<?if($arElement['ID'] == $arResult['ID']):?>
				<li class="active"><span><?=$arElement['NAME']?><span></li>
			<?else:?>
				<li class=""><a href="<?=$arElement['DETAIL_PAGE_URL']?>"><?=$arElement['NAME']?></a></li>
			<?endif;?>
			
		<?endforeach;?>
		</ul>
	</div>
	<?endif;?>
<?$this->EndViewTarget();?>
<?//*/?><!--pre><?print_r($arResult)?></pre--><?//*/?> 