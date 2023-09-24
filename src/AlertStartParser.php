<?php

namespace AMoschou\CommonMark\Alert;

use League\CommonMark\Parser\Block\BlockStart;
use League\CommonMark\Parser\Block\BlockStartParserInterface;
use League\CommonMark\Parser\Cursor;
use League\CommonMark\Parser\MarkdownParserStateInterface;

class AlertStartParser implements BlockStartParserInterface
{
    public function tryStart(Cursor $cursor, MarkdownParserStateInterface $parserState): ?BlockStart
    {
        if ($cursor->isIndented()) {
            return BlockStart::none();
        }

        if ($cursor->getNextNonSpaceCharacter() !== '>') {
            return BlockStart::none();
        }

        $cursor->advanceToNextNonSpaceOrTab();
        $cursor->advanceBy(1);
        $cursor->advanceBySpaceOrTab();

        $title = $cursor->match('/\[\!NOTE\]|\[\!IMPORTANT\]|\[\!WARNING\]/');

        if (is_null($title)) {
            return BlockStart::none();
        }

        $match = match ($title) {
            '[!NOTE]' => 'note',
            '[!IMPORTANT]' => 'important',
            '[!WARNING]' => 'warning',
        };

        $cursor->advanceToNextNonSpaceOrTab();

        return BlockStart::of(new AlertParser($match))->at($cursor);
    }
}


