<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?if(count($arResult["ITEMS"]) < 1): return false; endif;
	$arResult['PLACEMARK'] = array();
?>

<div class="b-table-adress ugc" id="db-adres-tabl">
	<table>
		<thead>
			<tr></tr>
		</thead>
		<tbody>
		<?foreach($arResult["ITEMS"] as $num => $arElement):
            $this->AddEditAction($arElement['ID'], $arElement['EDIT_LINK'], CIBlock::GetArrayByID($arElement["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arElement['ID'], $arElement['DELETE_LINK'], CIBlock::GetArrayByID($arElement["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            $coord = explode(',', $arElement['PROPERTIES']['LAN_LAT']['VALUE']);
            $bHasPicture = is_array($arElement['PREVIEW_IMG']);
            
            if($arElement['PROPERTIES']['LAN_LAT']['VALUE']){
				$tmp = explode(',', trim($arElement['PROPERTIES']['LAN_LAT']['VALUE']));
	            $arTmp['ARGS']['PLACEMARK'][0] = array(
	            		'LAT' => $tmp[0],
	            		'LON' => $tmp[1],
	            		'ICON' => COption::GetOptionString("db.base","ICHON_HREF",BX_PERSONAL_ROOT."/templates/html/images/gy_map_icon.png"),
							
	            );
	            $arElement['LAN_LAT'] = $arTmp;
            }
           
         ?>
			<tr id="<?=$this->GetEditAreaId($arElement['ID']);?>">
				<td>
					<p><?=$arElement["NAME"]?></p>
				</td>
				<?if((strlen($arElement["PROPERTIES"]["ADRESS"]["VALUE"]) > 0) || $ADRESS):?>
					<td style="width: 320px;" id="distribution-<?=$arElement['ID']?>" >
						<?if(count($arElement['LAN_LAT']) > 0):
							$arResult['PLACEMARK'][$arElement["ID"]] = $arElement['LAN_LAT']['ARGS']['PLACEMARK'][0];
							$arResult['PLACEMARK'][$arElement['ID']]['TEXT'] = $arElement["DETAIL_TEXT"];
						?>
							<span class="_lnk_pseudo table-adress-lnk" id="db-ymap-elem-<?=$arElement['ID']?>">
							<?=$arElement["PROPERTIES"]["ADRESS"]["VALUE"]?>
							</span>
						<?else:?>
							<span><?=$arElement["PROPERTIES"]["ADRESS"]["VALUE"]?></span>
						<?endif;?>
			<div class="hide gy-map-info" id="elem-gy-map-info-<?=$arElement['ID']?>">
                <button type="button" class="close"></button>
				<div class="title b-index-map-info-header"><?=$arElement["NAME"]?></div>				
				<div class="b-index-map-info-contacts">
					<?if(strlen($arElement["PROPERTIES"]["ADRESS"]["VALUE"]) > 0):?>
						<div>
						<b><?=$arElement["PROPERTIES"]["ADRESS"]["NAME"]?>:</b> <?=$arElement["PROPERTIES"]["ADRESS"]["VALUE"]?>
						</div>
					<?endif;?>
					<?if(count($arElement["PROPERTIES"]["TELEPHONES"]["VALUE"]) > 0  && strlen($arElement["PROPERTIES"]["TELEPHONES"]["VALUE"][0]) > 0):?>
						<dl class="b-map-e-TELEPHONES contact">
							<dt class="b-map-e-ugc-title"><?=$arElement["PROPERTIES"]["TELEPHONES"]["NAME"]?>:</dt>
								<?foreach($arElement["PROPERTIES"]["TELEPHONES"]["VALUE"] as $num => $strVal):?>
									<dd><?=$strVal?><?
										if(strlen($arElement["PROPERTIES"]["TELEPHONES"]["DESCRIPTION"][$num]) > 0):
										?><small>&nbsp;<?=$arElement["PROPERTIES"]['TELEPHONES']['DESCRIPTION'][$num]?></small><?
										endif;
									?></dd>
								<?endforeach;?>
						</dl>
					<?endif;?>
				</div>					
			</div>
					</td>
				<?elseif(count($arElement['LAN_LAT']) > 0):
					$arResult['PLACEMARK'][$arElement["ID"]] = $arElement['LAN_LAT']['ARGS']['PLACEMARK'][0];
					$arResult['PLACEMARK'][$arElement['ID']]['TEXT'] = $arElement["DETAIL_TEXT"];
				?>
				<?endif;?>
			    <?if((count($arElement["PROPERTIES"]["TELEPHONES"]["VALUE"]) > 0  && strlen($arElement["PROPERTIES"]["TELEPHONES"]["VALUE"][0]) > 0)):?>
					<td>
						<?foreach($arElement["PROPERTIES"]["TELEPHONES"]["VALUE"] as $num => $strVal):?>
							<div><?=$strVal?><?
								if(strlen($arElement["PROPERTIES"]["TELEPHONES"]["DESCRIPTION"][$num]) > 0):
								?><small>&nbsp;<?=$arElement["PROPERTIES"]['TELEPHONES']['DESCRIPTION'][$num]?></small><?
								endif;
							?></div>
						<?endforeach;?>
					</td>
				<?endif;?>							
			</tr>
		<?endforeach;?>
		</tbody>
	</table>
</div>
<?/*/?><pre><?print_r($arResult['PLACEMARK'])?></pre><?//*/?>
<script>




if(!window.DBElementsMapWork){
	function DBElementsMapWork(map, arObject, divId, elemId ){
		map.setCenter(arObject.geometry.getCoordinates(), 12, {
			callback: function (){
				var objDiv = BX(divId),
					objDivInfo = BX(elemId);
				var trg = $('.b-index-map-info');
				if(!!objDiv && !!objDivInfo){
					objDiv.innerHTML = objDivInfo.innerHTML;
					BX.show(objDiv);										
					trg.find('.close').on('click', function() {    
					    trg.hide();
					});
				}
	        },
	        duration: 300
		});
	}
	ale
}
if (!window.DBElementsListAdd) {
	function DBElementsListAdd(map, arObjects, db_obClusterer){
		map.setCenter(
				 [<?=(intval($arResult['SECTION_INFO']['UF_GOOGLE_LAT']) > 0 ? $arResult['SECTION_INFO']['UF_GOOGLE_LAT'] : '53')?>, <?=(intval($arResult['SECTION_INFO']['UF_GOOGLE_LON']) > 0 ? $arResult['SECTION_INFO']['UF_GOOGLE_LON'] : '27')?>],
				<?=(intval($arResult['SECTION_INFO']['UF_GOOGLE_SCALE']) > 0 ? $arResult['SECTION_INFO']['UF_GOOGLE_SCALE'] : '5')?>
		);
		
		<?if(is_array($arResult['PLACEMARK']) && ($cnt = count($arResult['PLACEMARK']))):
			$i = 0; foreach($arResult['PLACEMARK'] as $elemID => $arPlMark):
				if(strlen(trim($arPlMark['TEXT'])) <= 0) {
					unset($arPlMark['TEXT']);
				}
		?>
			arObjects.GEOOBJECTS[<?=$i?>] = DB_YMapAddPlacemark(map, <?echo CUtil::PhpToJsObject($arPlMark)?>);
			arObjects.GEOOBJECTS[<?=$i?>].events.add('click', function () {
				DBElementsMapWork(map, arObjects.GEOOBJECTS[<?=$i?>], 'map-info-to-show-<?=$arParams['MAP_ID']?>', 'elem-gy-map-info-<?=$elemID?>' );
	        });
	        
			BX.bind(BX('db-ymap-elem-<?=$elemID?>'), "click", function(e){
				BX.PreventDefault(e);
				IdScrollTo = BX('BX_YMAP_<?=$arParams['MAP_ID']?>');
				if(!!IdScrollTo){
					var windowScroll = BX.GetWindowScrollPos(),
					objPos = BX.pos((IdScrollTo), true);			
					(new BX.fx({
						start: windowScroll.scrollTop,
						finish: objPos.top-50,
						time: 0.7,
						step: 0.01,
						type: 'linear',
						callback: function(top)
						{
							window.scrollTo(windowScroll.scrollLeft,top);
						},
						callback_complete: function(){
							DBElementsMapWork(map, arObjects.GEOOBJECTS[<?=$i?>], 'map-info-to-show-<?=$arParams['MAP_ID']?>', 'elem-gy-map-info-<?=$elemID?>' );
							
						}
					})).start();
				}
                
				return false;
			});

		<?$i = $i + 1; endforeach;
		endif;?>
		db_obClusterer.add(arObjects.GEOOBJECTS);
		map.geoObjects.add(db_obClusterer);
	}
}
</script>
<?/*/?><pre><?print_r($arParams)?></pre><?//*/?>
<?/*/?><pre><?print_r($arResult)?></pre><?//*/?>