<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$arResult['PLACEMARK'] = array();?>
<div id="db-adres-tabl" class="table-responsive">

		<?$i=1;foreach($arResult["ITEMS"] as $num => $arItem):
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

              
         ?>	
		<?if(strlen($arItem["PROPERTIES"]['ADRESS']['VALUE']) > 0):?>					
			<?if(strlen($arItem["PROPERTIES"]['LAN_LAT']['VALUE']) > 0):
				$arLan_Lat = explode(",", $arItem["PROPERTIES"]['LAN_LAT']['VALUE']);

			?>
			<div class="b-contact-info-block" >

				<div class="e-contact-left-info" id="distribution-<?=$arItem['ID']?>">	
												
					<span class="lnk" data-lon="<?=trim($arLan_Lat[1])?>" data-lat="<?=trim($arLan_Lat[0])?>" data-num="<?=$num?>" data-type-icon="/local/templates/.default/images/gy_map_group.png">
						<span class="_dash"></span>
							<div class="gy-map-info b-map-info hide inf">	
								<button type="button" class="close"></button>
                                <div class="title b-index-map-info-header">
									<?=$arItem["NAME"]?>
								<?if(($arItem["PROPERTIES"]["SUBTITLE"]["VALUE"] && strlen($arItem["PROPERTIES"]["SUBTITLE"]["VALUE"]) > 0)):?>
									<small><?=$arItem["PROPERTIES"]["SUBTITLE"]["VALUE"]?></small>
								<?endif;?>	
								</div>				
								<div class="b-index-map-info-contacts">
									<?if(strlen($arItem["PROPERTIES"]["ADRESS"]["VALUE"]) > 0):?>	
										<h4><?=$arItem["PROPERTIES"]["ADRESS"]["VALUE"]?></h4>
									<?endif;?>
									<?if(count($arItem["PROPERTIES"]["TELEPHONES"]["VALUE"]) > 0  && strlen($arItem["PROPERTIES"]["TELEPHONES"]["VALUE"][0]) > 0):?>
										<dl class="b-map-e-TELEPHONES contact">
											<dt class="b-map-e-ugc-title"><?=$arItem["PROPERTIES"]["TELEPHONES"]["NAME"]?>:</dt>
											<?foreach($arItem["PROPERTIES"]["TELEPHONES"]["VALUE"] as $num => $strVal):?>
												<dd><?=$strVal?><?
													if(strlen($arItem["PROPERTIES"]["TELEPHONES"]["DESCRIPTION"][$num]) > 0):
													?><small>&nbsp;<?=$arItem["PROPERTIES"]['TELEPHONES']['DESCRIPTION'][$num]?></small><?
													endif;
												?></dd>
											<?endforeach;?>
										</dl>
									<?endif;?>
									<?if($bHassite):?>
										<dl class="b-map-e-EMAIL contact">
											<dt class="b-map-e-ugc-title"><?=$arItem["PROPERTIES"]["SITE"]["NAME"]?>:</dt>
											<dd><a class="lnk" target="_blank" href="<?=$tp_link.$link ?>"><?=$link ?></a></dd>
										</dl>
									<?endif;?>
									<?if(count($arItem["PROPERTIES"]["EMAIL"]["VALUE"]) > 0  && strlen($arItem["PROPERTIES"]["EMAIL"]["VALUE"][0]) > 0):?>
										<dl class="b-map-e-EMAIL contact">
											<dt class="b-map-e-ugc-title"><?=$arItem["PROPERTIES"]["EMAIL"]["NAME"]?>:</dt>
												<?foreach($arItem["PROPERTIES"]["EMAIL"]["VALUE"] as $strVal):?>
													<dd><a href="mailto:<?=$strVal?>"><?=$strVal?></a></dd>
												<?endforeach;?>
										</dl>
									<?endif;?>
								</div>
                            </div>
						</span>
					</div>
				</div>								
				<?endif; ?>
		<?endif;?>
		<?$i++;endforeach;?>

</div>

<script>

if(!window.DBElementsMapWork){
	function DBElementsMapWork(map, arObject, divId, elemId ){
		map.setCenter(arObject.geometry.getCoordinates(), 12, {
			callback: function (){
				var objDiv = BX(divId),
					objDivInfo = BX(elemId);
				var trg = $('.gy-map-info');
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
BX.ready(function(){
	var r = t = null;
	r = new RegExp('^#distribution-([0-9]+)+$', 'ig');
	t = r.exec(window.location.hash);
	if(t != null){
		//BX.debug(t);
		BX.DbScrollTo(t[0].substr(1));
	};
});
</script>
<?/*/?><!--pre><?print_r($arResult)?></pre--><?//*/?> 