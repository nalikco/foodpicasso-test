<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Set\ValueObject\SetList;
use Rector\TypeDeclaration\Rector\ClassMethod\AddVoidReturnTypeWhereNoReturnRector;
use Rector\TypeDeclaration\Rector\StmtsAwareInterface\DeclareStrictTypesRector;

return RectorConfig::configure()
    ->withPaths([
        __DIR__.'/app',
        __DIR__.'/public',
        __DIR__.'/src',
    ])
    ->withSkip([
        __DIR__.'/vendor',
        __DIR__.'/storage',
    ])
    ->withAutoloadPaths([
        __DIR__.'/vendor/autoload.php',
    ])
    ->withSets([
        LevelSetList::UP_TO_PHP_83,
        SetList::DEAD_CODE,
        SetList::CODE_QUALITY,
        SetList::PHP_80,
        SetList::PHP_81,
        SetList::PHP_82,
        SetList::PHP_83,
        SetList::TYPE_DECLARATION,
        SetList::EARLY_RETURN,
    ])
    ->withRules([
        AddVoidReturnTypeWhereNoReturnRector::class,
        DeclareStrictTypesRector::class,
    ]);
