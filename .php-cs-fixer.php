<?php

declare(strict_types=1);

return
    (new PhpCsFixer\Config())
        ->setCacheFile(__DIR__.'/storage/framework/.php_cs')
        ->setFinder(
            PhpCsFixer\Finder::create()
                ->in([
                    __DIR__.'/app',
                    __DIR__.'/config',
                    __DIR__.'/public',
                    __DIR__.'/routes',
                    __DIR__.'/tests',
                ])
                ->append([
                    __FILE__,
                ])
        )
        ->setRules([
            '@PSR12' => true,
            '@PhpCsFixer' => true,
            'yoda_style' => false,
        ])
    ;
