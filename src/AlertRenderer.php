<?php

declare(strict_types=1);

namespace AMoschou\CommonMark\Alert;

use AMoschou\CommonMark\Alert\Alert;
use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;
use League\CommonMark\Util\HtmlElement;
use League\CommonMark\Xml\XmlNodeRendererInterface;

final class AlertRenderer implements NodeRendererInterface, XmlNodeRendererInterface
{
    /**
     * @param Alert $node
     *
     * {@inheritDoc}
     *
     * @psalm-suppress MoreSpecificImplementedParamType
     */
    public function render(Node $node, ChildNodeRendererInterface $childRenderer): \Stringable
    {
        Alert::assertInstanceOf($node);

        $type = $node->getType();
        $svg = $node->getSvg();
        $header = $node->getHeader();
        $title = "<span>{$svg}{$header}</span>";

        $attrs = $node->data->get('attributes');
        $attrs['class'] = "md-alert md-alert-{$type}";

        $filling        = $childRenderer->renderNodes($node->children());
        $innerSeparator = $childRenderer->getInnerSeparator();

        if ($filling === '') {
            $inner = $innerSeparator . $title . $innerSeparator;
        } else {
            $inner = $innerSeparator . $title . $innerSeparator . $filling . $innerSeparator; 
        }

        return new HtmlElement(
            'div',
            $attrs,
            $inner
        );
    }

    public function getXmlTagName(Node $node): string
    {
        return 'md_alert';
    }

    /**
     * @param Alert $node
     *
     * @return array<string, scalar>
     *
     * @psalm-suppress MoreSpecificImplementedParamType
     */
    public function getXmlAttributes(Node $node): array
    {
        return [
            'type' => $node->getType(),
        ];
    }
}
