<?php

namespace AMoschou\CommonMark\Alert;

use League\CommonMark\Extension\ExtensionInterface;
use League\CommonMark\Environment\EnvironmentBuilderInterface;

final class AlertExtension implements ExtensionInterface
{
    public function register(EnvironmentBuilderInterface $environment): void
    {
        $environment
            ->addBlockStartParser(new AlertStartParser(), 80)
            ->addRenderer(Alert::class, new AlertRenderer());
    }
}
