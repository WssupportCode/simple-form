<?php

use WS\ReduceMigrations\Builder\Entity\Iblock;
use WS\ReduceMigrations\Builder\Entity\UserField;
use WS\ReduceMigrations\Builder\IblockBuilder;

/**
 * Class definition update migrations scenario actions
 **/
class ws_m_1623969284_add_iblock_ws_simple_form extends \WS\ReduceMigrations\Scenario\ScriptScenario
{

    const IBLOCK_TYPE = "ws_simple_form";
    const IBLOCK_NAME = "ws_simple_form";
    const IBLOCK_CODE = "ws_simple_form";

    /**
     * Name of scenario
     **/
    static public function name()
    {
        return "Создание инфоблока \"ws.simple.form\"";
    }

    /**
     * Priority of scenario
     **/
    static public function priority()
    {
        return self::PRIORITY_MEDIUM;
    }

    /**
     * @return string hash
     */
    static public function hash()
    {
        return "2c3132d6ba1f8c31632fbe68d6b4033d7c17b221";
    }

    /**
     * @return int approximately time in seconds
     */
    static public function approximatelyTime()
    {
        return 2;
    }

    /**
     * Write action by apply scenario. Use method `setData` for save need rollback data
     **/
    public function commit()
    {
        // my code
        $builder = new IblockBuilder();
        $iblock = $builder->createIblock(self::IBLOCK_TYPE, self::IBLOCK_NAME, function (Iblock $iblock) {
            $iblock
                ->siteId('s1')
                ->sort(100)
                ->code(self::IBLOCK_CODE)
                ->groupId(['2' => 'R']);
            $iblock->setAttribute('INDEX_SECTION', 'N');
            $iblock->setAttribute('INDEX_ELEMENT', 'N');
            $iblock
                ->addProperty('Имя')
                ->code('NAME')
                ->typeString()
                ->sort(100);
            $iblock
                ->addProperty('E-mail')
                ->code('EMAIL')
                ->typeString()
                ->sort(200);
            $iblock
                ->addProperty('Телефон')
                ->code('PHONE')
                ->typeString()
                ->sort(300);
            $iblock
                ->addProperty('Сообщение')
                ->code('MESSAGE')
                ->typeHtml()
                ->sort(400);
            $iblock
                ->addProperty('Файл')
                ->code('FILE')
                ->typeFile()
                ->sort(500);
        });
    }

    /**
     * Write action by rollback scenario. Use method `getData` for getting commit saved data
     **/
    public function rollback()
    {
        // my code
        $builder = new IblockBuilder();
        $data = $this->getData();
        $builder->updateIblock($data["IBLOCK_ID"], function (Iblock $iblock) {
            $iblock->deleteProperty('Имя');
            $iblock->deleteProperty('E-mail');
            $iblock->deleteProperty('Телефон');
            $iblock->deleteProperty('Сообщение');
            $iblock->deleteProperty('Файл');
        });
        $builder->removeIblockById($data["IBLOCK_ID"]);
    }
}