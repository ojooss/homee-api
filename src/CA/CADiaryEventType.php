<?php /** @noinspection PhpUnused */

declare(strict_types=1);

namespace HomeeApi\CA;

class CADiaryEventType extends CA
{
    public const none = 0;
    public const nodeStateChanged = 1;
    public const nodeAttributeChangeSent = 2;
    public const nodeAttributeChangeReceived = 3;
    public const homeegramActionNotExecuted = 100;
    public const homeegramTriggered = 101;
    public const homeegramCanceled = 102;
    public const homeegramActivated = 103;
    public const homeegramDeactivated = 104;
    public const groupSwitched = 200;
    public const systemCubeAdded = 300;
    public const systemCubeRemoved = 301;
    public const systemUserLoginSuccessful = 302;
    public const systemUserLoginFailed = 303;
    public const systemReboot = 304;
    public const systemShutdown = 305;
    public const systemStart = 306;
    public const systemUpdateStarted = 307;
    public const systemUpdateSuccessful = 308;
    public const systemUpdateFailed = 309;
    public const systemInternetConnectionEstablished = 310;
    public const systemInternetConnectionLost = 311;
    public const systemProxyConnectionEstablished = 312;
    public const systemProxyConnectionLost = 313;
    public const systemWeatherUpdateSuccessful = 314;
    public const systemWeatherUpdateFailed = 315;
    public const webhookSent = 400;
    public const pushSent = 500;
    public const pushSentFailed = 501;
    public const mailSent = 510;
    public const mailSentFailed = 511;
    public const systemBackupCreationSuccessful = 316;
    public const systemBackupCreationFailed = 317;
    public const systemBackupExportSuccessful = 318;
    public const systemBackupExportFailed = 319;
    public const systemHistoryExportSuccessful = 320;
    public const systemHistoryExportFailed = 321;
    public const systemCubeUpdateStarted = 322;
    public const systemCubeUpdateSuccessful = 323;
    public const systemCubeUpdateFailed = 324;
    public const ElectricityPriceUpdateSuccessful = 325;
    public const ElectricityPriceUpdateFailed = 326;
    public const EnergyConsumptionUpdateSuccessful = 327;
    public const EnergyConsumptionUpdateFailed = 328;
    public const systemUserPresenceChanged = 329;
    public const planActivated = 600;
    public const planDeactivated = 601;
    public const planScheduleTriggered = 602;
    public const planScheduleRestored = 603;
    public const planScheduleSkipped = 604;
    public const planEventTriggered = 605;
    public const planTemporaryOverriden = 606;
    public const WindMonitoringLinkSuccessful = 650;
    public const WindMonitoringLinkFailed = 651;
    public const WindMonitoringUnlinkSuccessful = 652;
    public const WindMonitoringUnlinkFailed = 653;

    protected static array $mapping = [
        0 => 'none',
        1 => 'nodeStateChanged',
        2 => 'nodeAttributeChangeSent',
        3 => 'nodeAttributeChangeReceived',
        100 => 'homeegramActionNotExecuted',
        101 => 'homeegramTriggered',
        102 => 'homeegramCanceled',
        103 => 'homeegramActivated',
        104 => 'homeegramDeactivated',
        200 => 'groupSwitched',
        300 => 'systemCubeAdded',
        301 => 'systemCubeRemoved',
        302 => 'systemUserLoginSuccessful',
        303 => 'systemUserLoginFailed',
        304 => 'systemReboot',
        305 => 'systemShutdown',
        306 => 'systemStart',
        307 => 'systemUpdateStarted',
        308 => 'systemUpdateSuccessful',
        309 => 'systemUpdateFailed',
        310 => 'systemInternetConnectionEstablished',
        311 => 'systemInternetConnectionLost',
        312 => 'systemProxyConnectionEstablished',
        313 => 'systemProxyConnectionLost',
        314 => 'systemWeatherUpdateSuccessful',
        315 => 'systemWeatherUpdateFailed',
        400 => 'webhookSent',
        500 => 'pushSent',
        501 => 'pushSentFailed',
        510 => 'mailSent',
        511 => 'mailSentFailed',
        316 => 'systemBackupCreationSuccessful',
        317 => 'systemBackupCreationFailed',
        318 => 'systemBackupExportSuccessful',
        319 => 'systemBackupExportFailed',
        320 => 'systemHistoryExportSuccessful',
        321 => 'systemHistoryExportFailed',
        322 => 'systemCubeUpdateStarted',
        323 => 'systemCubeUpdateSuccessful',
        324 => 'systemCubeUpdateFailed',
        325 => 'ElectricityPriceUpdateSuccessful',
        326 => 'ElectricityPriceUpdateFailed',
        327 => 'EnergyConsumptionUpdateSuccessful',
        328 => 'EnergyConsumptionUpdateFailed',
        329 => 'systemUserPresenceChanged',
        600 => 'planActivated',
        601 => 'planDeactivated',
        602 => 'planScheduleTriggered',
        603 => 'planScheduleRestored',
        604 => 'planScheduleSkipped',
        605 => 'planEventTriggered',
        606 => 'planTemporaryOverriden',
        650 => 'WindMonitoringLinkSuccessful',
        651 => 'WindMonitoringLinkFailed',
        652 => 'WindMonitoringUnlinkSuccessful',
        653 => 'WindMonitoringUnlinkFailed',
    ];
}