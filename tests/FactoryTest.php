<?php

namespace HomeeApi\Tests;

use DateTime;
use HomeeApi\Entity\Group;
use HomeeApi\Entity\Homeegram;
use HomeeApi\Entity\Node;
use HomeeApi\Entity\Node\NodeAttribute;
use HomeeApi\Entity\Relationship;
use HomeeApi\Entity\User;
use PHPUnit\Framework\TestCase;
use ReflectionException;

class FactoryTest extends TestCase
{

    /**
     * @covers \HomeeApi\Entity\Node::factory
     * @covers \HomeeApi\Entity\NodeAttribute::factory
     *
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
        $nodeAttribute->unit = "%25";
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

        $switchTrigger = new Homeegram\Trigger\SwitchTrigger();
        $switchTrigger->id = 103;
        $switchTrigger->homeegram_id = $expected->id;
        $expected->triggers['switch_triggers'][] = $switchTrigger;

        $timeTrigger = new Homeegram\Trigger\TimeTrigger();
        $timeTrigger->id = 160;
        $timeTrigger->homeegram_id = $expected->id;
        $timeTrigger->dtstart = new DateTime('20230618T190000Z');
        $timeTrigger->rrule = 'FREQ=DAILY;INTERVAL=1;BYHOUR=19;BYMINUTE=0';
        $timeTrigger->next_invocation = new DateTime('2023-06-19T19:00:00');
        $expected->triggers['time_triggers'][] = $timeTrigger;

        $attributeAction = new Homeegram\Action\AttributeAction();
        $attributeAction->id = 2;
        $attributeAction->homeegram_id = 1;
        $attributeAction->delay = 0;
        $attributeAction->node_id = 2;
        $attributeAction->attribute_id = 28;
        $attributeAction->source_attribute_id = 0;
        $attributeAction->value = 100.0;
        $attributeAction->command = 1;
        $expected->actions['attribute_actions'][] = $attributeAction;

        $attributeAction->id = 16;
        $attributeAction->homeegram_id = 1;
        $attributeAction->delay = 0;
        $attributeAction->node_id = 11;
        $attributeAction->attribute_id = 123;
        $attributeAction->source_attribute_id = 0;
        $attributeAction->value = 100.0;
        $attributeAction->command = 1;
        $expected->actions['attribute_actions'][] = $attributeAction;

        $attributeAction->id = 17;
        $attributeAction->homeegram_id = 1;
        $attributeAction->delay = 0;
        $attributeAction->node_id = 15;
        $attributeAction->attribute_id = 154;
        $attributeAction->source_attribute_id = 0;
        $attributeAction->value = 100.0;
        $attributeAction->command = 1;
        $expected->actions['attribute_actions'][] = $attributeAction;

        $attributeAction->id = 271;
        $attributeAction->homeegram_id = 1;
        $attributeAction->delay = 0;
        $attributeAction->node_id = 72;
        $attributeAction->attribute_id = 697;
        $attributeAction->source_attribute_id = 0;
        $attributeAction->value = 100.0;
        $attributeAction->command = 1;
        $expected->actions['attribute_actions'][] = $attributeAction;

        $json = file_get_contents(__DIR__ . '/data/Homeegram.json');
        $actual = Relationship::factory($json);

        self::assertEquals($expected, $actual);
    }


}
