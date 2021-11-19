<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="mb_2">
	<div class="b-left _left">
		<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arResult["PREVIEW_TEXT"]):?>
			<div class="ugc b-left-info-txt">
				<?=$arResult["PREVIEW_TEXT"]?>
			</div>		
		<?endif;?>
		<?if(count($arResult["PROPERTIES"]['INFRASTRUCTURE']['VALUE']) > 0):?>
			<h3 class=" mb_1 mt_2"><?=$arResult["PROPERTIES"]['INFRASTRUCTURE']['NAME']?></h3>
			<div class="mb_3">
				<ul class="b-spec list-unstyled ">
					<?foreach($arResult["PROPERTIES"]['INFRASTRUCTURE']['VALUE'] as $key => $arVal):?>
						<li><img src="<?=SITE_TEMPLATE_PATH?>/images/<?=$arResult["PROPERTIES"]['INFRASTRUCTURE']['VALUE_XML_ID'][$key]?>.png" alt="<?=$arVal?>" title="<?=$arVal?>"/></li>
					<?endforeach;?>
				</ul>
				<div class="_clear"></div>
			</div>
		<?endif;?>
		<?if(is_array($arResult["PREVIEW_PICTURE"])):?>
			<a href="/price/">
				<img src="<?=$arResult["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arResult["PREVIEW_PICTURE"]["ALT"]?>"/>
			</a>
		<?endif;?>
		<?if($arResult["PROPERTIES"]["STORE_TYPE"]["VALUE_XML_ID"] == "m-green"):?>
			<a href="/buyers/actions/supermarkets/">
				<img src="<?=SITE_TEMPLATE_PATH?>/images/basket.jpg" alt="<?=$arResult["PROPERTIES"]["STORE_TYPE"]["VALUE"]?>"/>
			</a>
		<?elseif($arResult["PROPERTIES"]["STORE_TYPE"]["VALUE_XML_ID"] == "m-dark-green"):?>
			<a href="/buyers/actions/superstors/">
				<img src="<?=SITE_TEMPLATE_PATH?>/images/basket2.jpg" alt="<?=$arResult["PROPERTIES"]["STORE_TYPE"]["VALUE"]?>"/>
			</a>
		<?endif;?>
	</div>
	<div class="_right mt_1">
		<div class="b-info">
			<?if(is_array($arResult["DETAIL_PICTURE"])):?>
				<img src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" alt="<?=$arResult["DETAIL_PICTURE"]["ALT"]?>"/>
			<?endif;?>
		   <div class="b-lab">
				<?if(strlen($arResult["PROPERTIES"]['ADRESS']['VALUE']) > 0):?>
					<p class="mb_0"><?=$arResult["PROPERTIES"]['ADRESS']['VALUE']?></p>
				<?endif;?>
				<?if(strlen($arResult["PROPERTIES"]['TIME_WORK']['VALUE']) > 0):?>
					<p class="mb_0 mt_0"><?=$arResult["PROPERTIES"]['TIME_WORK']['NAME']?>:</p>
					<p class="text-muted  mb_0"><?=nl2br($arResult["PROPERTIES"]['TIME_WORK']['VALUE'])?></p>
				<?endif;?>			   
				<?if(strlen($arResult["PROPERTIES"]['TELEPHONES']['VALUE']) > 0):?>
					<p class="mb_1"><?=$arResult["PROPERTIES"]['TELEPHONES']['NAME']?>: <span class="text-muted"><?=$arResult["PROPERTIES"]['TELEPHONES']['VALUE']?></span></p>					
				<?endif;?>
				<?if(strlen($arResult["PROPERTIES"]['LAN_LAT']['VALUE']) > 0):?>
					<p class="bold text-green  pointer mb_0" id="scroll-map"><?=$arResult["PROPERTIES"]['HOW_TO_GET']['NAME']?></p>
				<?endif;?>
				<?if($arResult['ALL_VAC_CNT'] > 0):?>
					<div class="shop-vac mt_3">
						<a href="<?=SITE_DIR?>work/vacancy/?IT_MANUFACTURES=<?=$arResult['ID']?>&set_filter=Y&set_FIX_REGION=Y"><?=GetMessage("T_CANDIDATES_TITLE")?><sup><?=$arResult['ALL_VAC_CNT']?></sup></a>
					</div>
				<?endif;?>
		   </div>
		</div>
	</div>
   <div class="_clear"></div>
</div>

<?if($arParams["DISPLAY_DETAIL_TEXT"]!="N" && $arResult["DETAIL_TEXT"]):?>
	<div class="ugc">
			<?=($arResult["DETAIL_TEXT"])?>
	</div>
<?endif;?>
<?if(count($arResult['DOP_IMAGES']) > 0):?>
<div class="slider mt_6 mb_4">
   <h3 class="mb_1"><?=$arResult["PROPERTIES"]["MORE_PHOTOS"]["NAME"]?> 
   <?if(strlen($arResult["PROPERTIES"]['STORE_TYPE']['VALUE']) > 0):?>
		<?=ToLower($arResult["PROPERTIES"]['STORE_TYPE']['VALUE']).GetMessage('T_A')?>
   <?endif;?>
   </h3>
   <div id="wrapper">
	   <div id="carousel">
		   <ul>
		   		<?foreach($arResult['DOP_IMAGES'] as $arPhoto):?>
				   <li>
				   		<a class="lightbox m-no-bd" rel="group<?=$arResult['ID']?>" href="<?=$arPhoto['PATH']?>" title="<?=$arPhoto['TITLE']?>">
					   		<img width="<?=$arPhoto['WIDTH']?>" src="<?=$arPhoto['SRC']?>" alt="<?=$arPhoto['ALT']?>" title="<?=$arPhoto['TITLE']?>">
					   </a>
					   <p><?=$arPhoto['TITLE']?></p>
				   </li>
			   <?endforeach;?>
		   </ul>
		   <div class="clearfix"></div>
		   <a id="prev" class="prev2" href="#">&lt;</a>
		   <a id="next" class="next2" href="#">&gt;</a>
		   <div id="pager" class="pager"></div>
	   </div>
   </div>
   <script>
	   $(function() {
		   $('#carousel ul').carouFredSel({
			   width: '100%',
			   prev: '#prev',
			   next: '#next',
			   scroll: 1000,
			   auto: false,
			   align: false,
			   scroll: {
				   easing: 'quadratic',
				   items: 1
			   },
			   items: {
				   visible:4,
				   width: 'variable',
				   height: 195
			   }
		   });
	   });
	   $('#scroll-map').click(function(){
			$('html, body').animate({ scrollTop: $('#map').offset().top }, 600);map.setZoom(15);			
		});
   </script>
</div>
<?endif;?>
<div class="clear"></div>
<?if(strlen($arResult["PROPERTIES"]['HOW_TO_GET']['VALUE']) > 0):?>
	<h2 class="mb_1 mt_0"><?=$arResult["PROPERTIES"]['HOW_TO_GET']['NAME']?></h2>
	<p><?=$arResult["PROPERTIES"]['HOW_TO_GET']['VALUE']?></p>
<?endif;?>

<ul class="transport-list ">
<?
$arTrans[] = $arResult["PROPERTIES"]['trol'];
$arTrans[] = $arResult["PROPERTIES"]['aut'];
$arTrans[] = $arResult["PROPERTIES"]['tramv'];
$arTrans[] = $arResult["PROPERTIES"]['marsh'];

foreach($arTrans as $arVal):
	if(strlen($arVal['VALUE']) > 0):?>		
   		<li><i class="<?=$arVal['CODE']?>"></i><?=$arVal['NAME']?>: <?=$arVal['VALUE']?></li>		
	<?endif;
endforeach;?>
</ul>
<?if(strlen($arResult["PROPERTIES"]['LAN_LAT']['VALUE']) > 0):
	$arLan_Lat = explode(",", $arResult["PROPERTIES"]['LAN_LAT']['VALUE']);
	$arParams['MAP_DATA'] = array(
			'google_lat' => trim($arLan_Lat[0]),
			'google_lon' => trim($arLan_Lat[1]),
			'google_scale' => 15,
			'PLACEMARKS' => array(),
	);
	
	if($arResult["PROPERTIES"]['STORE_TYPE']['VALUE'] && strlen($arResult["PROPERTIES"]['STORE_TYPE']['VALUE']) > 0){
		if($arResult["PROPERTIES"]['STORE_TYPE']['VALUE_ENUM_ID'] == 104){
			$arResult["ICON_TYPE"] = 2;
		}elseif($arResult["PROPERTIES"]['STORE_TYPE']['VALUE_ENUM_ID'] == 105){
			$arResult["ICON_TYPE"] = 1;
		}elseif($arResult["PROPERTIES"]['STORE_TYPE']['VALUE_ENUM_ID'] == 106){
			$arResult["ICON_TYPE"] = 3;
		}	
	}else{
		$arResult["ICON_TYPE"] = 0;
	}
?>
<div class="b-contact-info-block">
	<span class="lnk" data-lon="<?=trim($arLan_Lat[1])?>" data-lat="<?=trim($arLan_Lat[0])?>" data-type-icon="<?=$arResult["ICON_TYPE"]?>" data-num="<?=$num?>"></span>
</div>
<?endif; ?>
<?if(strlen($arResult["PROPERTIES"]['LAN_LAT']['VALUE']) > 0):?>
<h3 class="mb_2 mt_0"><?=GetMessage('T_SHEME')?></h3>
<div class="b-index-map">
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
		 <div class="b-map-info-marks">
			   <h6 class="bold  mt_0"><?=$arResult["NAME"]?></h6>
			   <?if(strlen($arResult["PROPERTIES"]['ADRESS']['VALUE']) > 0):?>
					<p class="mb_2 small"><?=$arResult["PROPERTIES"]['ADRESS']['VALUE']?></p>
				<?endif;?>
				<?if(strlen($arResult["PROPERTIES"]['TIME_WORK']['VALUE']) > 0):?>
					<p class="small"><?=$arResult["PROPERTIES"]['TIME_WORK']['NAME']?> </p>
					<p class="small text-muted"><?=nl2br($arResult["PROPERTIES"]['TIME_WORK']['VALUE'])?></p>
				<?endif;?>
				<?if(strlen($arResult["PROPERTIES"]['TELEPHONES']['VALUE']) > 0):?>
					<p class="small mb_1"><?=$arResult["PROPERTIES"]['TELEPHONES']['NAME']?>: <span class="small text-muted"><?=$arResult["PROPERTIES"]['TELEPHONES']['VALUE']?></span></p>					
				<?endif;?>
		   </div>
	</div>
</div>
<?endif;?>
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
			<?if($arElement['ID'] == $arResult['ID'] || $arElement['PROPERTY_STORE_TYPE_ENUM_ID'] == 106 ):?>
				<li class="active text-muted"><span><?=$arElement['NAME']?><span></li>
			<?else:?>
				<li class=""><a href="<?=$arElement['DETAIL_PAGE_URL']?>"><?=$arElement['NAME']?></a></li>
			<?endif;?>
			
		<?endforeach;?>
		</ul>
	</div>
	<?endif;?>
<?$this->EndViewTarget();?>
<?/*/?><!--pre><?print_r($arResult)?></pre--><?//*/?> 