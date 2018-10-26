<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
if ($arResult['ITEMS']):?>
    <? if (count($arResult['ITEMS']) > 1): ?>
        <ul class="tabs">
    <? endif ?>
    <? foreach ($arResult['ITEMS'] as $id => $arItem): ?>
        <? $page = new CDBResult;
        $page->InitFromArray($arItem);
        if (count($arResult['ITEMS']) > 1):?>
            <li>
            <input type="radio" name="tabs" id="tab-<?= $id ?>" checked>
            <label for="tab-<?= $id ?>"><?= $arResult["TAB_NAME"][$id] ?></label>
            <div class="tab-content">
        <? endif ?>
        <p><? $page->NavPrint("", false, "tablebodytext", "--"); ?></p>
        <div class="bx_catalog_tile">
            <div class="sections">
                <table cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <?
                        $cell = 0;
                        while ($arElement = $page->Fetch()): ?>
                        <td valign="top" width="33%" id="<?= $this->GetEditAreaId($arElement['ID']); ?>">
                            <table cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td valign="top">
                                        <?
                                        if ($arElement["DETAIL_PICTURE"]): ?>
                                        <?
                                        if ($arElement["ACTIVE"] == 'Y'): ?>
                                        <a href="/catalog/dresses/<?= $arElement["CODE"] ?>/">
                                            <?
                                            else : ?><a>
                                                <?
                                                endif ?>
                                                <img
                                                        border="0"
                                                        src="<?= CFile::GetPath($arElement["DETAIL_PICTURE"]) ?>"
                                                        alt="<?= $arElement["NAME"] ?>"
                                                        title="<?= $arElement["NAME"] ?>"
                                                /></a><br/>
                                            <?
                                            endif ?>
                                    </td>
                                    <td valign="top">
                                        <a href="<?= $arElement["SECTION_PAGE_URL"] ?><?= $arElement["CODE"] ?>/">
                                            <?= $arElement["NAME"] ?></a><br/>
                                        <small>
                                            <button class="btn" data-active=<?
                                            if ($arElement["ACTIVE"] == 'Y'): ?>"Y"<?
                                            else:?>"N"<?
                                            endif ?> id = <?= $arElement["ID"] ?> onclick="toogle(this.id)">
                                            <?
                                            if ($arElement["ACTIVE"] == 'Y'):?>
                                                <?= GetMessage("CT_NAME_FOR_BUTTON_ACTIVE") ?>
                                            <? else: ?>
                                            <?= GetMessage("CT_NAME_FOR_BUTTON_DEACTIVE") ?>
                                            <?
                                            endif ?></button>
                                        </small>
                                        <br/>
                                        <br/>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <?
                        $cell++;
                        if ($cell >= $arResult["CNT_ROW"]):
                        $cell = 0;
                        ?>
                    </tr>
                    <tr>
                        <?
                        endif;
                        endwhile;
                        while ($cell < $arResult["CNT_ROW"]):
                            $cell++;
                            ?>
                            <td>&nbsp;</td><?
                        endwhile;
                        ?>
                    </tr>
                </table>
            </div>
        </div>
        <? if (count($arResult['ITEMS']) > 1): ?>
            </div>
            </li>
        <? endif ?>
    <? endforeach ?>
    <? if (count($arResult['ITEMS']) > 1): ?>
        </ul>
    <? endif ?>
<? else: ?>
    <h2 class="alert">Доступ запрещен</h2>
<? endif ?>