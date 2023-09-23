<?php

namespace AMoschou\CommonMark\Alert;

use League\CommonMark\Extension\CommonMark\Node\Block\BlockQuote;
use League\CommonMark\Node\Block\Paragraph;
use League\CommonMark\Parser\Inline\InlineParserInterface;
use League\CommonMark\Parser\Inline\InlineParserMatch;
use League\CommonMark\Parser\InlineParserContext;

class AlertParser implements InlineParserInterface
{
    public function getMatchDefinition(): InlineParserMatch
    {
        return InlineParserMatch::oneOf(
            '[!NOTE]',
            '[!IMPORTANT]',
            '[!WARNING]'
        );
    }

    public function parse(InlineParserContext $inlineContext): bool
    {
        $container = $inlineContext->getContainer();

        // Match must come at the beginning of the first paragraph of the block quote
        // Is this correct?
        if (
            $container->hasChildren()
            || ! (
                $container instanceof Paragraph
                && $container->parent()
                && $container->parent() instanceof BlockQuote
            )
        ) {
            return false;
        }

        $cursor = $inlineContext->getCursor();

        $cursor->advanceBy($inlineContext->getFullMatchLength());

        $class = match ($inlineContext->getFullMatch()) {
            '[!NOTE]' => 'note',
            '[!IMPORTANT]' => 'important',
            '[!WARNING]' => 'warning',
        };

        $container->parent()->data->append('attributes/class', "alert-{$class}");

        $child = match ($inlineContext->getFullMatch()) {
            '[!NOTE]' => new AlertHeading('note'),
            '[!IMPORTANT]' => new AlertHeading('important'),
            '[!WARNING]' => new AlertHeading('warning'),
        };

        $inlineContext->getContainer()->appendChild($child));

        return true;
    }
}


