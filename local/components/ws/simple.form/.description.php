<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?php

use Bitrix\Main\Localization\Loc;

$arComponentDescription = [
    'NAME' => Loc::getMessage("NAME"),
    'DESCRIPTION' => Loc::getMessage("DESCRIPTION"),
    'PATH' => [
        'ID' => Loc::getMessage("ID"),
    ],
];

?>