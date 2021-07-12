<?php

use WS\ReduceMigrations\Builder\Entity\IblockType;
use WS\ReduceMigrations\Builder\IblockBuilder;


/**
 * Class definition update migrations scenario actions
 **/
class ws_m_1623968284_add_type_iblock_ws_simple_form extends \WS\ReduceMigrations\Scenario\ScriptScenario
{

    const IBLOCK_TYPE = "ws_simple_form";

    /**
     * Name of scenario
     **/
    static public function name()
    {
        return "Создание типа инфоблока \"ws.simple.form\"";
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
        return "d6734603bcc5c3547ebbba053b48696e13b4d757";
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
        $builder->createIblockType(self::IBLOCK_TYPE, function (IblockType $type) {
            $type
                ->inRss(false)
                ->sort(100)
                ->sections('Y')
                ->lang(
                    [
                        'ru' => [
                            'NAME' => 'ws_simple_form',
                            'SECTION_NAME' => 'Разделы',
                            'ELEMENT_NAME' => 'Элементы',
                        ],
                    ]
                );
        });
    }

    /**
     * Write action by rollback scenario. Use method `getData` for getting commit saved data
     **/
    public function rollback()
    {
        // my code
        $builder = new IblockBuilder();
        $builder->removeIblockType(self::IBLOCK_TYPE);
    }
}