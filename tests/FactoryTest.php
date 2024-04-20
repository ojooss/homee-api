<?php

namespace HomeeApi\Tests;

use DateTime;
use HomeeApi\Entity\Homeegram;
use HomeeApi\Entity\Homeegram\Action\AttributeAction;
use HomeeApi\Entity\Homeegram\Condition\AttributeCondition;
use HomeeApi\Entity\Homeegram\Condition\GroupCondition;
use HomeeApi\Entity\Homeegram\Condition\UserCondition;
use HomeeApi\Entity\Homeegram\Trigger\SwitchTrigger;
use HomeeApi\Entity\Homeegram\Trigger\TimeTrigger;
use HomeeApi\Entity\Node;
use HomeeApi\Entity\Node\NodeAttribute;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use ReflectionException;

#[CoversClass(Node::class)]
#[CoversClass(NodeAttribute::class)]
#[CoversClass(Homeegram::class)]
class FactoryTest extends TestCase
{

    /**
     * @return void
     * @throws ReflectionException
     */
    public function testNodeFactory()
    {
        $expected = new Node();
        $expected->id = 75;
        $expected->name = "Sensor.Stripe.Window";
        $expected->profile = 0;
        $expected->image = "default";
        $expected->favorite = 0;
        $expected->order = 36;
        $expected->protocol = 1;
        $expected->routing = 0;
        $expected->state = 1;
        $expected->state_changed = (new DateTime())->setTimestamp(1686858819);
        $expected->added = (new DateTime())->setTimestamp(1686480680);
        $expected->history = 1;
        $expected->cube_type = 1;
        $expected->note = "# Sensative Strips";
        $expected->services = 5;
        $expected->phonetic_name = "";
        $expected->owner = 8;
        $expected->security = 0;

        $nodeAttribute = new NodeAttribute();
        $nodeAttribute->id = 759;
        $nodeAttribute->node_id = 75;
        $nodeAttribute->instance = 0;
        $nodeAttribute->minimum = 0;
        $nodeAttribute->maximum = 1;
        $nodeAttribute->current_value = 1.0;
        $nodeAttribute->target_value = 1.0;
        $nodeAttribute->last_value = 0.0;
        $nodeAttribute->unit = "";
        $nodeAttribute->step_value = 1.0;
        $nodeAttribute->editable = 1;
        $nodeAttribute->type = 385;
        $nodeAttribute->state = 1;
        $nodeAttribute->last_changed = (new DateTime())->setTimestamp(1686480680);
        $nodeAttribute->changed_by = 1;
        $nodeAttribute->changed_by_id = 0;
        $nodeAttribute->based_on = 1;
        $nodeAttribute->data = "";
        $nodeAttribute->name = "";
        $nodeAttribute->node = $expected;
        $expected->attributes[] = $nodeAttribute;

        $nodeAttribute = new NodeAttribute();
        $nodeAttribute->id = 762;
        $nodeAttribute->node_id = 75;
        $nodeAttribute->instance = 0;
        $nodeAttribute->minimum = 0;
        $nodeAttribute->maximum = 100;
        $nodeAttribute->current_value = 100.0;
        $nodeAttribute->target_value = 100.0;
        $nodeAttribute->last_value = 100.0;
        $nodeAttribute->unit = "%";
        $nodeAttribute->step_value = 1.0;
        $nodeAttribute->editable = 0;
        $nodeAttribute->type = 8;
        $nodeAttribute->state = 1;
        $nodeAttribute->last_changed = (new DateTime())->setTimestamp(1686858819);
        $nodeAttribute->changed_by = 1;
        $nodeAttribute->changed_by_id = 0;
        $nodeAttribute->based_on = 1;
        $nodeAttribute->data = "";
        $nodeAttribute->name = "";
        $nodeAttribute->options = [
            "history" => [
                "day" => 182,
                "week" => 26,
                "month" => 6
            ]
        ];
        $nodeAttribute->node = $expected;
        $expected->attributes[] = $nodeAttribute;

        $nodeAttribute = new NodeAttribute();
        $nodeAttribute->id = 767;
        $nodeAttribute->node_id = 75;
        $nodeAttribute->instance = 0;
        $nodeAttribute->minimum = 0;
        $nodeAttribute->maximum = 1;
        $nodeAttribute->current_value = 0.0;
        $nodeAttribute->target_value = 0.0;
        $nodeAttribute->last_value = 0.0;
        $nodeAttribute->unit = "";
        $nodeAttribute->step_value = 1.0;
        $nodeAttribute->editable = 0;
        $nodeAttribute->type = 12;
        $nodeAttribute->state = 1;
        $nodeAttribute->last_changed = (new DateTime())->setTimestamp(1686480681);
        $nodeAttribute->changed_by = 1;
        $nodeAttribute->changed_by_id = 0;
        $nodeAttribute->based_on = 1;
        $nodeAttribute->data = "";
        $nodeAttribute->name = "";
        $nodeAttribute->options = [
            "automations" => [
                "reset"
            ],
            "history" => [
                "day" => 182,
                "week" => 26,
                "month" => 6,
                "stepped" => true
            ]
        ];
        $nodeAttribute->node = $expected;
        $expected->attributes[] = $nodeAttribute;

        $json = file_get_contents(__DIR__ . '/data/Node.json');
        $actual = Node::factory($json);

        self::assertEquals($expected, $actual);
    }

    /**
     * @throws ReflectionException
     */
    public function testHomeegramFactory()
    {
        $expected = new Homeegram();
        $expected->id = 1;
        $expected->name = "roller_shutter.ground_floor";
        $expected->image = "homeegramicon_shutter_value_5";
        $expected->state = 1;
        $expected->visible = 0;
        $expected->favorite = 0;
        $expected->order = 1;
        $expected->active = 1;
        $expected->play = 0;
        $expected->added = (new DateTime())->setTimestamp(1565352522);
        $expected->phonetic_name = "";
        $expected->note = "";
        $expected->services = 3;
        $expected->last_triggered = (new DateTime())->setTimestamp(1687107601);
        $expected->owner = 1;

        $attributeTrigger = new Homeegram\Trigger\AttributeTrigger();
        $attributeTrigger->id = 161;
        $attributeTrigger->homeegram_id = $expected->id;
        $attributeTrigger->node_id = 53;
        $attributeTrigger->attribute_id = 532;
        $attributeTrigger->operator = 3;
        $attributeTrigger->operand = 1;
        $attributeTrigger->operand_id = 552;
        $attributeTrigger->value = 0;
        $expected->triggers['attribute_triggers'][] = $attributeTrigger;

        $celestialTriggers = new Homeegram\Trigger\CelestialTrigger();
        $celestialTriggers->id = 30;
        $celestialTriggers->homeegram_id = $expected->id;
        $celestialTriggers->celestial_type = 2;
        $celestialTriggers->time_offset = -90;
        $expected->triggers['celestial_triggers'][] = $celestialTriggers;

        $switchTrigger = new SwitchTrigger();
        $switchTrigger->id = 103;
        $switchTrigger->homeegram_id = $expected->id;
        $expected->triggers['switch_triggers'][] = $switchTrigger;

        $timeTrigger = new TimeTrigger();
        $timeTrigger->id = 160;
        $timeTrigger->homeegram_id = $expected->id;
        $timeTrigger->dtstart = new DateTime('20230618T190000Z');
        $timeTrigger->rrule = 'FREQ=DAILY;INTERVAL=1;BYHOUR=19;BYMINUTE=0';
        $timeTrigger->next_invocation = new DateTime('2023-06-19T19:00:00');
        $expected->triggers['time_triggers'][] = $timeTrigger;

        $webhookTrigger = new Homeegram\Trigger\WebhookTrigger();
        $webhookTrigger->id = 124;
        $webhookTrigger->homeegram_id = $expected->id;
        $webhookTrigger->event = 'Push-Benachrichtigung';
        $expected->triggers['webhook_triggers'][] = $webhookTrigger;

        $attributeCondition = new AttributeCondition();
        $attributeCondition->id = 48;
        $attributeCondition->homeegram_id = $expected->id;
        $attributeCondition->node_id = -1;
        $attributeCondition->attribute_id = 1;
        $attributeCondition->operator = 1;
        $attributeCondition->check_moment = 1;
        $attributeCondition->operand = 1;
        $attributeCondition->value = 0.0;
        $expected->conditions['attribute_conditions'][] = $attributeCondition;

        $groupCondition = new GroupCondition();
        $groupCondition->id = 48;
        $groupCondition->homeegram_id = $expected->id;
        $groupCondition->node_id = -1;
        $groupCondition->attribute_id = 1;
        $groupCondition->operator = 1;
        $groupCondition->check_moment = 1;
        $groupCondition->operand = 1;
        $groupCondition->value = 0;
        $expected->conditions['group_conditions'][] = $groupCondition;

        $timeCondition = new Homeegram\Condition\TimeCondition();
        $timeCondition->id = 47;
        $timeCondition->homeegram_id = $expected->id;
        $timeCondition->dtstart = new DateTime('20160127T133700Z');
        $timeCondition->rrule = 'FREQ=DAILY;INTERVAL=1;BYHOUR=16;BYMINUTE=0';
        $timeCondition->duration = 'PT12600S';
        $timeCondition->check_moment = 1;
        $expected->conditions['time_conditions'][] = $timeCondition;

        $userCondition = new UserCondition();
        $userCondition->id = 198;
        $userCondition->homeegram_id = $expected->id;
        $expected->conditions['user_conditions'][] = $userCondition;

        $attributeAction = new AttributeAction();
        $attributeAction->id = 2;
        $attributeAction->homeegram_id = $expected->id;
        $attributeAction->delay = 0;
        $attributeAction->node_id = 2;
        $attributeAction->attribute_id = 28;
        $attributeAction->source_attribute_id = 0;
        $attributeAction->value = 100.0;
        $attributeAction->command = 1;
        $expected->actions['attribute_actions'][] = $attributeAction;

        $attributeAction = new AttributeAction();
        $attributeAction->id = 16;
        $attributeAction->homeegram_id = $expected->id;
        $attributeAction->delay = 0;
        $attributeAction->node_id = 11;
        $attributeAction->attribute_id = 123;
        $attributeAction->source_attribute_id = 0;
        $attributeAction->value = 100.0;
        $attributeAction->command = 1;
        $expected->actions['attribute_actions'][] = $attributeAction;

        $attributeAction = new AttributeAction();
        $attributeAction->id = 17;
        $attributeAction->homeegram_id = $expected->id;
        $attributeAction->delay = 0;
        $attributeAction->node_id = 15;
        $attributeAction->attribute_id = 154;
        $attributeAction->source_attribute_id = 0;
        $attributeAction->value = 100.0;
        $attributeAction->command = 1;
        $expected->actions['attribute_actions'][] = $attributeAction;

        $attributeAction = new AttributeAction();
        $attributeAction->id = 271;
        $attributeAction->homeegram_id = $expected->id;
        $attributeAction->delay = 0;
        $attributeAction->node_id = 72;
        $attributeAction->attribute_id = 697;
        $attributeAction->source_attribute_id = 0;
        $attributeAction->value = 100.0;
        $attributeAction->command = 1;
        $expected->actions['attribute_actions'][] = $attributeAction;

#        $groupAction = new Homeegram\Action\GroupAction();
#        $groupAction->
#        $expected->actions['group_actions'][] = $groupAction;

        $homeegramAction = new Homeegram\Action\HomeegramAction();
        $homeegramAction->id = 247;
        $homeegramAction->homeegram_id = $expected->id;
        $homeegramAction->delay = 0;
        $homeegramAction->target_homeegram_id = 85;
        $homeegramAction->homeegram_event = 3;
        $expected->actions['homeegram_actions'][] = $homeegramAction;

        $notificationAction = new Homeegram\Action\NotificationAction();
        $notificationAction->id = 181;
        $notificationAction->homeegram_id = $expected->id;
        $notificationAction->style = 1;
        $notificationAction->delay = 0;
        $notificationAction->critical = 0;
        $notificationAction->user_ids = [8];
        $notificationAction->message = 'Hallo Oliver';
        $expected->actions['notification_actions'][] = $notificationAction;

#        $ttsAction = new Homeegram\Action\TtsAction();
#        $expected->actions['tts_actions'][] = $ttsAction;

        $attributeAction = new Homeegram\Action\UserAction();
        $attributeAction->id = 271;
        $attributeAction->homeegram_id = $expected->id;
        $attributeAction->delay = 5;
        $attributeAction->node_id = 72;
        $attributeAction->attribute_id = 491;
        $attributeAction->source_attribute_id = 0;
        $attributeAction->value = 0;
        $attributeAction->command = 1;
        $expected->actions['user_actions'][] = $attributeAction;

        $attributeAction = new Homeegram\Action\WebhookAction();
        $attributeAction->id = 280;
        $attributeAction->homeegram_id = $expected->id;
        $attributeAction->delay = 0;
        $attributeAction->method = 'GET';
        $attributeAction->url = 'http://192.168.21.202/station/7/play';
        $attributeAction->body= "";
        $attributeAction->content_type = "text/plain";
        $expected->actions['webhook_actions'][] = $attributeAction;


        $json = file_get_contents(__DIR__ . '/data/Homeegram.json');
        $actual = Homeegram::factory($json);

        self::assertEquals($expected, $actual);
    }
}
