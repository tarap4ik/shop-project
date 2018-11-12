<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
if ($arResult['ITEMS']):?>
    <? if (count($arResult['ITEMS']) > 1): ?>
        <ul class="tabs">
        <? endif ?>
        <? foreach ($arResult['ITEMS'] as $id => $arItem): ?>
            <? if (count($arResult['ITEMS']) > 1):?>
                <li>
                    <input type="radio" name="tabs" id="tab-<?= $id ?>" checked>
                    <label for="tab-<?= $id ?>"><?= $arResult["TAB_NAME"][$id] ?></label>
                    <div class="tab-content">
                    <? endif ?>
                    <div class="sections">
                        <?=($arResult["NAV_STRING"][$id])?>
                        <table cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <?
                                $cell = 0;
                                foreach ($arItem as $arElement): ?>
                                    <td valign="top" width="33%" id="<?= $this->GetEditAreaId($arElement['ID']); ?>">
                                        <table cellpadding="0" cellspacing="0" border="0">
                                            <tr>
                                                <td valign="top">
                                                    <?
                                                    if ($arElement["DETAIL_PICTURE"]): ?>
                                                        <?
                                                        if ($arElement["ACTIVE"] == 'Y'): ?>
                                                            <a href="<?= $arResult['SECTIONS'][$arElement["IBLOCK_ID"]]?><?= $arElement["CODE"] ?>/">
                                                                <?else : ?><a>
                                                                    <?endif ?>
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
                                                                <a href="<?= $arResult['SECTIONS'][$arElement["IBLOCK_ID"]]?><?= $arElement["CODE"] ?>/">
                                                                    <?= $arElement["NAME"] ?></a><br/>
                                                                    <small>
                                                                        <button class="btn" data-active=<?
                                                                        if ($arElement["ACTIVE"] == 'Y'): ?>"Y"<?
                                                                            else:?>"N"<?
                                                                                endif ?> id = <?= $arElement["ID"] ?> onclick="toogle(this.id)">
                                                                                <?
                                                                                if ($arElement["ACTIVE"] == 'Y'):?>
                                                                                    <?= GetMessage("CT_NAME_FOR_BUTTON_DEACTIVE") ?>
                                                                                    <? else: ?>
                                                                                        <?= GetMessage("CT_NAME_FOR_BUTTON_ACTIVE") ?>
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
                                                                endforeach;
                                                                while ($cell < $arResult["CNT_ROW"]):
                                                                    $cell++;
                                                                    ?>
                                                                    <td>&nbsp;</td><?
                                                                endwhile;
                                                                ?>
                                                            </tr>
                                                        </table>
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
                                        <h2 class="alert"><?= GetMessage("CT_ALERT") ?></h2>
                                        <? endif ?>