<?php /** @noinspection DuplicatedCode */

namespace HomeeApi\Entity;

use DateTime;
use DateTimeInterface;
use Exception;
use HomeeApi\Entity\Homeegram\Action\AttributeAction;
use HomeeApi\Entity\Homeegram\Action\GroupAction;
use HomeeApi\Entity\Homeegram\Action\HomeegramAction;
use HomeeApi\Entity\Homeegram\Action\NotificationAction;
use HomeeApi\Entity\Homeegram\Action\TtsAction;
use HomeeApi\Entity\Homeegram\Action\UserAction;
use HomeeApi\Entity\Homeegram\Action\WebhookAction;
use HomeeApi\Entity\Homeegram\Condition\AttributeCondition;
use HomeeApi\Entity\Homeegram\Condition\GroupCondition;
use HomeeApi\Entity\Homeegram\Condition\TimeCondition;
use HomeeApi\Entity\Homeegram\Condition\UserCondition;
use HomeeApi\Entity\Homeegram\Trigger\AttributeTrigger;
use HomeeApi\Entity\Homeegram\Trigger\CelestialTrigger;
use HomeeApi\Entity\Homeegram\Trigger\SwitchTrigger;
use HomeeApi\Entity\Homeegram\Trigger\TimeTrigger;
use HomeeApi\Entity\Homeegram\Trigger\WebhookTrigger;
use ReflectionException;

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
                                foreach ($data as $triggerProperty => $triggerValue) {
                                    self::setProperty($trigger, $triggerProperty, $triggerValue);
                                }
                                $homeegram->triggers[$triggerType][] = $trigger;
                            }
                            break;
                        case 'attribute_triggers':
                            foreach ($triggerData as $data) {
                                $trigger = new AttributeTrigger();
                                foreach ($data as $triggerProperty => $triggerValue) {
                                    self::setProperty($trigger, $triggerProperty, $triggerValue);
                                }
                                $homeegram->triggers[$triggerType][] = $trigger;
                            }
                            break;
                        case 'time_triggers':
                            foreach ($triggerData as $data) {
                                $trigger = new TimeTrigger();
                                foreach ($data as $triggerProperty => $triggerValue) {
                                    self::setProperty($trigger, $triggerProperty, $triggerValue);
                                }
                                $homeegram->triggers[$triggerType][] = $trigger;
                            }
                            break;
                        case 'celestial_triggers':
                            foreach ($triggerData as $data) {
                                $trigger = new CelestialTrigger();
                                foreach ($data as $triggerProperty => $triggerValue) {
                                    self::setProperty($trigger, $triggerProperty, $triggerValue);
                                }
                                $homeegram->triggers[$triggerType][] = $trigger;
                            }
                            break;
                        case 'webhook_triggers':
                            foreach ($triggerData as $data) {
                                $trigger = new WebhookTrigger();
                                foreach ($data as $triggerProperty => $triggerValue) {
                                    self::setProperty($trigger, $triggerProperty, $triggerValue);
                                }
                                $homeegram->triggers[$triggerType][] = $trigger;
                            }
                            break;
                        default:
                            if (!empty($triggerData))
                            file_put_contents(
                                __FILE__.'.log',
                                'not implemented "' . $triggerType . '": ' . print_r($triggerData, true),
                                FILE_APPEND
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
                                foreach ($data as $conditionProperty => $conditionValue) {
                                    self::setProperty($condition, $conditionProperty, $conditionValue);
                                }
                                $homeegram->conditions[$conditionType][] = $condition;
                            }
                            break;
                        case 'group_conditions':
                            foreach ($conditionData as $data) {
                                $condition = new GroupCondition();
                                foreach ($data as $conditionProperty => $conditionValue) {
                                    self::setProperty($condition, $conditionProperty, $conditionValue);
                                }
                                $homeegram->conditions[$conditionType][] = $condition;
                            }
                            break;
                        case 'user_conditions':
                            foreach ($conditionData as $data) {
                                $condition = new UserCondition();
                                foreach ($data as $conditionProperty => $conditionValue) {
                                    self::setProperty($condition, $conditionProperty, $conditionValue);
                                }
                                $homeegram->conditions[$conditionType][] = $condition;
                            }
                            break;
                        case 'time_conditions':
                            foreach ($conditionData as $data) {
                                $condition = new TimeCondition();
                                foreach ($data as $conditionProperty => $conditionValue) {
                                    self::setProperty($condition, $conditionProperty, $conditionValue);
                                }
                                $homeegram->conditions[$conditionType][] = $condition;
                            }
                            break;
                        default:
                            if (!empty($triggerData))
                            file_put_contents(
                                __FILE__.'.log',
                                'not implemented "' . $conditionType . '": ' . print_r($conditionData, true),
                                FILE_APPEND
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
                                foreach ($data as $actionProperty => $actionValue) {
                                    self::setProperty($action, $actionProperty, $actionValue);
                                }
                                $homeegram->actions[$actionType][] = $action;
                            }
                            break;
                        case 'user_actions':
                            foreach ($actionData as $data) {
                                $action = new UserAction();
                                foreach ($data as $actionProperty => $actionValue) {
                                    self::setProperty($action, $actionProperty, $actionValue);
                                }
                                $homeegram->actions[$actionType][] = $action;
                            }
                            break;
                        case 'group_actions':
                            foreach ($actionData as $data) {
                                $action = new GroupAction();
                                foreach ($data as $actionProperty => $actionValue) {
                                    self::setProperty($action, $actionProperty, $actionValue);
                                }
                                $homeegram->actions[$actionType][] = $action;
                            }
                            break;
                        case 'tts_actions':
                            foreach ($actionData as $data) {
                                $action = new TtsAction();
                                foreach ($data as $actionProperty => $actionValue) {
                                    self::setProperty($action, $actionProperty, $actionValue);
                                }
                                $homeegram->actions[$actionType][] = $action;
                            }
                            break;
                        case 'notification_actions':
                            foreach ($actionData as $data) {
                                $action = new NotificationAction();
                                foreach ($data as $actionProperty => $actionValue) {
                                    self::setProperty($action, $actionProperty, $actionValue);
                                }
                                $homeegram->actions[$actionType][] = $action;
                            }
                            break;
                        case 'webhook_actions':
                            foreach ($actionData as $data) {
                                $action = new WebhookAction();
                                foreach ($data as $actionProperty => $actionValue) {
                                    self::setProperty($action, $actionProperty, $actionValue);
                                }
                                $homeegram->actions[$actionType][] = $action;
                            }
                            break;
                        case 'homeegram_actions':
                            foreach ($actionData as $data) {
                                $action = new HomeegramAction();
                                foreach ($data as $actionProperty => $actionValue) {
                                    self::setProperty($action, $actionProperty, $actionValue);
                                }
                                $homeegram->actions[$actionType][] = $action;
                            }
                            break;
                        default:
                            if (!empty($triggerData))
                            file_put_contents(
                                __FILE__.'.log',
                                'not implemented "' . $actionType . '": ' . print_r($actionData, true),
                                FILE_APPEND
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
