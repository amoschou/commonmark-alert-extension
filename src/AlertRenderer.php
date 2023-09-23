<?php

namespace AMoschou\CommonMark\Alert;

use League\CommonMark\Util\HtmlElement;

class AlertRenderer implements NodeRendererInterface
{
    public function render(Node $node, ChildNodeRendererInterface $childRenderer)
    {
        $header = $node->getHeader();

        return new HtmlElement('span', [], $header);
    }
}
