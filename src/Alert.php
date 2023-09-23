<?php

namespace AMoschou\CommonMark\Alert;

use League\CommonMark\Node\Inline\AbstractInline;

class Alert extends AbstractInline
{
    private string $type;

    public function __construct(string $type)
    {
        parent::__construct();

        $this->setType($type);
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

    public function getHeader()
    {
        return match ($this->getType()) {
            'note' => 'Note',
            'important' => 'Important',
            'warning' => 'Warning',
        };
    }

    public function getIcon()
    {
        return match ($this->getType()) {
            'note' => 'info',
            'important' => 'report',
            'warning' => 'alert',
        };
    }
}
