<?php

namespace AMoschou\CommonMark\Alert;

use League\CommonMark\Extension\ExtensionInterface;
use League\CommonMark\Environment\EnvironmentBuilderInterface;

final class AlertExtension implements ExtensionInterface
{
    public function register(EnvironmentBuilderInterface $environment): void
    {
        $environment
            ->addInlineParser(new AlertParser(), 20)
            ->addRenderer(Alert::class, new AlertRenderer(), 0);
    }
}
