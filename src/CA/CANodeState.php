<?php /** @noinspection PhpUnused */

declare(strict_types=1);

namespace HomeeApi\CA;

class CANodeState extends CA
{
    public const CANodeStateNone = 0;
    public const CANodeStateAvailable = 1;
    public const CANodeStateUnavailable = 2;
    public const CANodeStateUpdateInProgress = 3;
    public const CANodeStateWaitingForAttributes = 4;
    public const CANodeStateInitializing = 5;
    public const CANodeStateUserInteractionRequired = 6;
    public const CANodeStatePasswordRequired = 7;
    public const CANodeStateHostUnavailable = 8;
    public const CANodeStateDeleteInProgress = 9;
    public const CANodeStateCosiConnected = 10;
    public const CANodeStateLocked = 11;
    public const CANodeStateWaitingForWakeup = 12;
    public const CANodeStateRemoteNodeDeleted = 13;
    public const CANodeStateNodeFirmwareUpdateInProgress = 14;

    protected static array $mapping = [
        0 => 'None',
        1 => 'Available',
        2 => 'Unavailable',
        3 => 'UpdateInProgress',
        4 => 'WaitingForAttributes',
        5 => 'Initializing',
        6 => 'UserInteractionRequired',
        7 => 'PasswordRequired',
        8 => 'HostUnavailable',
        9 => 'DeleteInProgress',
        10 => 'CosiConnected',
        11 => 'Locked',
        12 => 'WaitingForWakeup',
        13 => 'RemoteNodeDeleted',
        14 => 'NodeFirmwareUpdateInProgress',
    ];
}
