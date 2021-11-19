<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>
<div id="db-adres-tabl" class="table-responsive">
	<table>
		<thead>
			<tr>
				<th><?=GetMessage("DB_MSG_NAME")?></th>
				<th><?=GetMessage("DB_MSG_ADRESS")?></th>
				<th><?=GetMessage("DB_MSG_FACE")?></th>
			</tr>
		</thead>	
		<tbody>
		<?foreach($arResult["ITEMS"] as $num => $arItem):
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            $coord = explode(',', $arItem['PROPERTIES']['LAN_LAT']['VALUE']);
         ?>	
			<tr id="<?=$this->GetEditAreaId($arItem['ID']);?>">
				<td>
					<div class="title"><?=$arItem["NAME"]?></div>
					<?if(($arItem["PROPERTIES"]["SUBTITLE"]["VALUE"] && strlen($arItem["PROPERTIES"]["SUBTITLE"]["VALUE"]) > 0)):?>
						<div class="sub-title"><?=$arItem["PROPERTIES"]["SUBTITLE"]["VALUE"]?></div>
					<?endif;?>	
					<?if((strlen($arItem["PROPERTIES"]["SITE"]["VALUE"]) > 0 && $arItem["PROPERTIES"]["SITE"]["VALUE"])):
						$bHassite = true;
						$tp_link = 'http://';
						$link = trim($arItem['PROPERTIES']['SITE']['VALUE']);
						if(strstr($link , 'http://') !==false){
							$link = substr($link, 7);
						}elseif(strstr($link , 'https://') !==false){
							$link = substr($link, 8);
							$tp_link = 'https://';
						}else{
							$link = $link;
						}
					?>
						<a class="lnk" target="_blank" href="<?=$tp_link.$link ?>"><?=$link ?></a>
					<?else: $bHassite = false;?>
					<?endif;?>					
				</td>
				<td id="distribution-<?=$arItem['ID']?>" >
					<?if(strlen($arItem["PROPERTIES"]['ADRESS']['VALUE']) > 0):?>					
						<?if(strlen($arItem["PROPERTIES"]['LAN_LAT']['VALUE']) > 0):
							$arLan_Lat = explode(",", $arItem["PROPERTIES"]['LAN_LAT']['VALUE']);
						?>
						<div class="b-contact-info-block" >
							<div class="e-contact-left-info">									
								<span class="lnk" data-lon="<?=trim($arLan_Lat[1])?>" data-lat="<?=trim($arLan_Lat[0])?>" data-num="<?=$num?>" data-type-icon="<?=$arItem["ICON_TYPE"]?>"><span class="_dash"><?=$arItem["PROPERTIES"]['ADRESS']['VALUE']?></span>
									<div class="gy-map-info b-map-info hide inf">	                                
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
					
				</td>			
				<td>
					<?if((count($arItem["PROPERTIES"]["TELEPHONES"]["VALUE"]) > 0  && strlen($arItem["PROPERTIES"]["TELEPHONES"]["VALUE"][0]) > 0)):?>
						<?foreach($arItem["PROPERTIES"]["TELEPHONES"]["VALUE"] as $num => $strVal):?>
							<div class="info-phone">
							<?if(strlen($arItem["PROPERTIES"]["TELEPHONES"]["DESCRIPTION"][$num]) > 0):?>
								<?=$arItem["PROPERTIES"]['TELEPHONES']['DESCRIPTION'][$num]?>:
							<?endif;?>
							<span class="number"><?=$strVal?></span>								
							</div>
						<?endforeach;?>
					<?endif;?>
					
					<?if((count($arItem["PROPERTIES"]["EMAIL"]["VALUE"]) > 0  && strlen($arItem["PROPERTIES"]["EMAIL"]["VALUE"][0]) > 0) || $EMAIL):?>
						<?foreach($arItem["PROPERTIES"]["EMAIL"]["VALUE"] as $strVal):?>
							<a href="mailto:<?=$strVal?>"><?=$strVal?></a>
						<?endforeach;?>
					<?endif;?>	
					
					<?if((count($arItem["PROPERTIES"]["FACE"]["VALUE"]) > 0 && $arItem["PROPERTIES"]["FACE"]["VALUE"])):?>
						<?foreach($arItem["PROPERTIES"]["FACE"]["VALUE"] as $num => $strVal):?>
							<div class="info-dop-contacts"><?=$strVal?></div>
						<?endforeach;?>
					<?endif;?>
				</td>
			</tr>
		<?endforeach;?>
		</tbody>
	</table>
</div>
<script>
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