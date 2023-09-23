<?php

namespace AMoschou\CommonMark\Alert;

use League\CommonMark\Extension\ExtensionInterface;
use League\CommonMark\Environment\ConfigurableEnvironmentInterface;

final class AlertExtension implements ExtensionInterface
{
    public function register(ConfigurableEnvironmentInterface $environment): void
    {
        $environment
            ->addInlineParser(new AlertParser(), 20)
            ->addInlineRenderer(Alert::class, new AlertRenderer(), 0);
    }
}
