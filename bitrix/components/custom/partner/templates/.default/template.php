<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); 

if($arResult['ITEMS']):?>
	<?if(count($arResult['ITEMS'])>1):?>
	<ul class="tabs">
		<?endif?>
		<?foreach ($arResult['ITEMS'] as $id => $arItem):?> 
		<?print_r();
		$arFilter = array( "IBLOCK_ID" => 4, "ID" => $id, ); 
		$arPartners = CIBlockElement::GetList(Array("SORT" => "ASC"), $arFilter, false, false, Array());
		if($ob = $arPartners->GetNextElement())
			$tabName = $ob->GetFields()['NAME'];
		$page = new CDBResult;
		$page->InitFromArray($arItem);
		$page->NavStart($arResult['CNT_ALL']);?>
		<?if(count($arResult['ITEMS'])>1):?>
		<li>
			<input type="radio" name="tabs" id="tab-<?=$id?>" checked>
			<label for="tab-<?=$id?>"><?=$tabName?></label>
			<div class="tab-content">
				<?endif?>
				<p><?$page->NavPrint("", false, "tablebodytext", "--");?></p>
				<div class="bx_catalog_tile">
					<div class="sections">
						<table cellpadding="0" cellspacing="0" border="0">
							<tr>
								<?
								$cell = 0;
								while ($arElement = $page->Fetch()):?>
									<?$section = CIBlockSection::GetByID($arElement["IBLOCK_SECTION_ID"]);
									if($ar_res = $section->GetNext())
										$sectionURL = $ar_res['SECTION_PAGE_URL'];?>
									<td valign="top" width="33%" id="<?=$this->GetEditAreaId($arElement['ID']);?>">
										<table cellpadding="0" cellspacing="0" border="0">
											<tr>
												<td valign="top">
													<?if($arElement["DETAIL_PICTURE"]):?>
													<?if($arElement["ACTIVE"] == 'Y'):?>
													<a href="/catalog/dresses/<?=$arElement["CODE"]?>/">
														<?else :?><a>
															<?endif?>
															<img
															border="0"
															src="<?=CFile::GetPath($arElement["DETAIL_PICTURE"])?>"
															alt="<?=$arElement["NAME"]?>"
															title="<?=$arElement["NAME"]?>"
															/></a><br />
															<?endif?>
														</td>
														<td valign="top">
															<a href="<?=$sectionURL?><?=$arElement["CODE"]?>/">
																<?=$arElement["NAME"]?></a><br />
																<small>
																	<button class="btn" id = <?=$arElement["ID"]?> onclick="toogle(this.id)">
																		<?if($arElement["ACTIVE"] == 'Y'):?>Деактивировать<?else:?>Активировать
																		<?endif?></button>
																	</small><br/>
																	<br/>
																</td>
															</tr>
														</table>
													</td>
													<?
													$cell++;
													if($cell>=$arResult["CNT_ROW"]):
														$cell = 0;
														?>
													</tr>
													<tr>
														<?
													endif; 
												endwhile;
												while ($cell<$arResult["CNT_ROW"]):
													$cell++;
													?><td>&nbsp;</td><?
												endwhile;
												?>
											</tr>
										</table>
									</div>
								</div>
								<?if(count($arResult['ITEMS'])>1):?>
							</div>
						</li>
						<?endif?>
						<?endforeach?>
						<?if(count($arResult['ITEMS'])>1):?>
					</ul>
					<?endif?>
					<?else:?>
					<h2 class="alert">Доступ запрещен</h2>
					<?endif?>
					<script type="text/javascript">
						function toogle(element) {
							var url = '<?php echo ($templateFolder)?>/ajax.php';
							console.log(document.getElementById(element).textContent);
							var status = '';
							if( document.getElementById(element).textContent == 'Активировать'){
								document.getElementById(element).textContent = 'Деактивировать';
								status = 'Y';
							}
							else{
								document.getElementById(element).textContent = 'Активировать';
								status = 'N';
							}
							BX.ajax({
								url: url,
								data: {id: element, status : status},
								method: 'POST',        
								onsuccess: function(data){

								},
								onfailure: function(){

								}
							});
						}
					</script>