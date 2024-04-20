<?php /** @noinspection PhpUnused */

/** @noinspection DuplicatedCode */

namespace HomeeApi\Entity;

use DateTimeInterface;
use Exception;
use ReflectionException;

class User
{
    use PropertyFactoryTrait;

    public ?int $id = null;
    public ?string $username = null;
    public ?string $forename = null;
    public ?string $surname = null;
    public ?string $image = null;
    public ?int $role = null;
    public ?int $type = null;
    public ?string $email = null;
    public ?string $phone = null;
    public ?DateTimeInterface $added = null;
    public ?string $homee_image = null;
    public ?int $access = null;
    public ?bool $presence_detection = null;
    public ?int $cube_push_notifications = null;
    public ?int $cube_email_notifications = null;
    public ?int $cube_sms_notifications = null;
    public ?int $warning_push_notifications = null;
    public ?bool $warning_push_notifications_as_critical = null;
    public ?int $warning_email_notifications = null;
    public ?int $warning_sms_notifications = null;
    public ?int $node_push_notifications = null;
    public ?int $node_email_notifications = null;
    public ?int $node_sms_notifications = null;
    public ?int $update_push_notifications = null;
    public ?int $update_email_notifications = null;
    public ?int $update_sms_notifications = null;
    public ?int $homeegram_push_notifications = null;
    public ?int $homeegram_email_notifications = null;
    public ?int $homeegram_sms_notifications = null;
    public ?int $api_push_notifications = null;
    public ?int $api_email_notifications = null;
    public ?int $api_sms_notifications = null;
    public ?int $plan_push_notifications = null;
    public ?int $plan_email_notifications = null;
    public ?int $plan_sms_notifications = null;
    public ?int $watchdog_push_notifications = null;
    public ?int $watchdog_email_notifications = null;
    public ?int $watchdog_sms_notifications = null;
    public ?array $devices = null;

    /**
     * @throws ReflectionException
     * @throws Exception
     */
    public static function factory(string|array $data): User
    {
        if (is_string($data)) {
            $data = json_decode($data, true);
        }
        $user = new User();
        foreach ($data as $property => $value) {
            self::setProperty($user, $property, $value);
        }

        return $user;
    }
}
