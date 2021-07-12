<?php

use WS\ReduceMigrations\Builder\EventsBuilder;
use WS\ReduceMigrations\Builder\Entity\EventType;
use WS\ReduceMigrations\Builder\Entity\EventMessage;

/**
 * Class definition update migrations scenario actions
 **/
class ws_m_1623970284_add_mail_event_ws_simple_form extends \WS\ReduceMigrations\Scenario\ScriptScenario
{

    const EVENT_TYPE = "WS_SIMPLE_FORM";
    const EVENT_NAME = "WS_SIMPLE_FORM";

    /**
     * Name of scenario
     **/
    static public function name()
    {
        return "Создание почтового события и шаблона \"ws.simple.form\"";
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
        return "e7e2ca988c9234c258957adbcb30bbfd5c097719";
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
        $builder = new EventsBuilder();
        $builder->createEventType(self::EVENT_TYPE, 'ru', function (EventType $event) {
            $event
                ->name(self::EVENT_NAME)
                ->sort(10)
                ->description('#NAME# - Имя
#EMAIL# - Email
#PHONE# - Телефон
#MESSAGE# - Сообщение
#FILE# - Ссылка на файл');
            $event
                ->addEventMessage('#DEFAULT_EMAIL_FROM#', '#EMAIL_TO#', 's1')
                ->subject('#SITE_NAME#: Новое сообщение')
                ->body('Информационное сообщение сайта #SITE_NAME#
------------------------------------------
Вам было отправлено новое сообщение:

Имя: #NAME#
Email: #EMAIL#
Телефон: #PHONE#
Ссылка на файл: #FILE#

Сообщение: 
#MESSAGE#

------------------------------------------
Сообщение сгенерировано автоматически.')
                ->bodyType(EventMessage::BODY_TYPE_TEXT)
                ->active();
        });
    }

    /**
     * Write action by rollback scenario. Use method `getData` for getting commit saved data
     **/
    public function rollback()
    {
        // my code
        $by = 'id';
        $order = 'desc';
        $eventMessages = CEventMessage::GetList($by, $order, ['TYPE' => self::EVENT_TYPE]);
        $eventMessage = new CEventMessage;
        while ($template = $eventMessages->Fetch()) {
            $eventMessage->Delete((int)$template['ID']);
        }
        CEventType::Delete(self::EVENT_TYPE);
    }
}