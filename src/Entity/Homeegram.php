<?php /** @noinspection DuplicatedCode */

namespace HomeeApi\Entity;

use DateTime;
use DateTimeInterface;
use Exception;
use HomeeApi\Entity\Homeegram\Action\AttributeAction;
use HomeeApi\Entity\Homeegram\Condition\AttributeCondition;
use HomeeApi\Entity\Homeegram\Trigger\SwitchTrigger;
use HomeeApi\Entity\Homeegram\Trigger\TimeTrigger;
use ReflectionException;
use ReflectionProperty;

class Homeegram
{
    use PropertyFactoryTrait;

    public ?int $id = null;
    public ?string $name = null;
    public ?string $image = null;
    public ?int $state = null;
    public ?int $visible = null;
    public ?int $favorite = null;
    public ?int $order = null;
    public ?int $active = null;
    public ?int $play = null;
    public ?DateTimeInterface $added = null;
    public ?string $phonetic_name = null;
    public ?string $note = null;
    public ?int $services = null;
    public ?DateTimeInterface $last_triggered = null;
    public ?int $owner = null;
    public array $triggers = [
        'attribute_triggers' => [],
        'celestial_triggers' => [],
        'group_triggers' => [],
        'homeegram_triggers' => [],
        'plan_triggers' => [],
        'switch_triggers' => [],
        'time_triggers' => [],
        'user_triggers' => [],
        'webhook_triggers' => [],
    ];
    public array $conditions = [
        'attribute_conditions' => [],
        'celestial_conditions' => [],
        'group_conditions' => [],
        'homeegram_conditions' => [],
        'plan_conditions' => [],
        'time_conditions' => [],
        'user_conditions' => [],
    ];
    public array $actions = [
        'attribute_actions' => [],
        'group_actions' => [],
        'homeegram_actions' => [],
        'notification_actions' => [],
        'plan_actions' => [],
        'tts_actions' => [],
        'user_actions' => [],
        'webhook_actions' => [],
    ];


    /**
     * @throws ReflectionException
     * @throws Exception
     */
    public static function factory(string|array $data): Homeegram
    {
        if (is_string($data)) {
            $data = json_decode($data, true);
        }
        $homeegram = new Homeegram();
        foreach ($data as $property => $value) {
            if ($property == 'triggers') {
                foreach ($value as $triggerType => $triggerData) {
                    switch ($triggerType) {
                        case 'switch_triggers':
                            foreach ($triggerData as $data) {
                                $trigger = new SwitchTrigger();
                                $trigger->id = $data['id'];
                                $trigger->homeegram_id = $data['homeegram_id'];
                                $homeegram->triggers[$triggerType][] = $trigger;
                            }
                            break;
                        case 'time_triggers':
                            foreach ($triggerData as $data) {
                                $trigger = new TimeTrigger();
                                $trigger->id = $data['id'];
                                $trigger->homeegram_id = $data['homeegram_id'];
                                $trigger->dtstart = new DateTime($data['dtstart']);
                                $trigger->rrule = $data['rrule'];
                                $trigger->next_invocation = new DateTime($data['next_invocation']);
                                $homeegram->triggers[$triggerType][] = $trigger;
                            }
                            break;
                        default:
                            file_put_contents(
                                __FILE__.'.log',
                                'not implemented "' . $triggerType . '": ' . print_r($data, true)
                            );
                    }
                }
                continue;
            }
            elseif ($property == 'conditions') {
                foreach ($value as $conditionType => $conditionData) {
                    switch ($conditionType) {
                        case 'attribute_conditions':
                            foreach ($conditionData as $data) {
                                $condition = new AttributeCondition();
                                $condition->id = $data['id'];
                                $condition->homeegram_id = $data['homeegram_id'];
                                $condition->node_id = $data['node_id'];
                                $condition->attribute_id = $data['attribute_id'];
                                $condition->operator = $data['operator'];
                                $condition->check_moment = $data['check_moment'];
                                $condition->operand = $data['operand'];
                                $condition->value = $data['value'];
                                $homeegram->conditions[$conditionType][] = $condition;
                            }
                            break;
                        default:
                            file_put_contents(
                                __FILE__.'.log',
                                'not implemented "' . $conditionType . '": ' . print_r($data, true)
                            );
                    }
                }
                continue;
            }
            elseif ($property == 'actions') {
                foreach ($value as $actionType => $actionData) {
                    switch ($actionType) {
                        case 'attribute_actions':
                            foreach ($actionData as $data) {
                                $action = new AttributeAction();
                                $action->id = $data['id'];
                                $action->homeegram_id = $data['homeegram_id'];
                                $action->delay = $data['delay'];
                                $action->node_id = $data['node_id'];
                                $action->attribute_id = $data['attribute_id'];
                                $action->source_attribute_id = $data['source_attribute_id'];
                                $action->value = $data['value'];
                                $action->command = $data['command'];
                                $homeegram->actions[$actionType][] = $action;
                            }
                            break;
                        default:
                            file_put_contents(
                                __FILE__.'.log',
                                'not implemented "' . $actionType . '": ' . print_r($data, true)
                            );
                    }
                }
                continue;
            }


            self::setProperty($homeegram, $property, $value);
        }

        return $homeegram;
    }
}
