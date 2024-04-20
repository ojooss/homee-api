<?php

/**
 * Rector - Instant Upgrades and Automated Refactoring
 * Rector instantly upgrades and refactors the PHP code of your application.
 * see: https://github.com/rectorphp/rector
 *
 * call like this:  php vendor/bin/rector process  --clear-cache --dry-run
 */

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Doctrine\Set\DoctrineSetList;
use Rector\Php74\Rector\Closure\ClosureToArrowFunctionRector;
use Rector\Php74\Rector\LNumber\AddLiteralSeparatorToNumberRector;
use Rector\Php80\Rector\FunctionLike\MixedTypeRector;
use Rector\PHPUnit\Set\PHPUnitSetList;
use Rector\Renaming\Rector\Name\RenameClassRector;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Symfony\Set\SymfonySetList;
use Rector\Symfony\Symfony30\Rector\ClassMethod\RemoveDefaultGetBlockPrefixRector;
use Rector\ValueObject\PhpVersion;


return static function (RectorConfig $rectorConfig): void {

    $rectorConfig->phpVersion(PhpVersion::PHP_82);

    $rectorConfig->phpstanConfig(__DIR__ . '/phpstan.neon');

    $rectorConfig->sets([
        LevelSetList::UP_TO_PHP_81,

        DoctrineSetList::ANNOTATIONS_TO_ATTRIBUTES,
        DoctrineSetList::DOCTRINE_BUNDLE_210,
        DoctrineSetList::DOCTRINE_COMMON_20,
        DoctrineSetList::DOCTRINE_DBAL_211,
        DoctrineSetList::DOCTRINE_ORM_214,

        SymfonySetList::ANNOTATIONS_TO_ATTRIBUTES,
        SymfonySetList::SYMFONY_CODE_QUALITY,
        SymfonySetList::SYMFONY_CONSTRUCTOR_INJECTION,

        SymfonySetList::SYMFONY_64,
        PHPUnitSetList::PHPUNIT_100,
    ]);

    $rectorConfig->paths([
        __DIR__ . '/example',
        __DIR__ . '/src',
        __DIR__ . '/tests',
    ]);

    $rectorConfig->skip([

        /**
         * @see https://github.com/rectorphp/rector/blob/main/docs/rector_rules_overview.md
         */

        // Preserve legibility
#        ClosureToArrowFunctionRector::class,
#        AddLiteralSeparatorToNumberRector::class,
#        RemoveDefaultGetBlockPrefixRector::class,

        // removes PhpDoc parameter definitions
#        MixedTypeRector::class,
#        RenameClassRector::class,
    ]);

    $rectorConfig->parallel(300);
};
