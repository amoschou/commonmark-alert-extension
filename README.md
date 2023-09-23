# commonmark-alert-extension

To add this extension to the GFM extension, use the following:

```php
use AMoschou\CommonMark\Alert\AlertExtension;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\GithubFlavoredMarkdownExtension;
use League\CommonMark\MarkdownConverter;

$config = [];

$environment = (new Environment($config))
    ->addExtension(new CommonMarkCoreExtension())
    ->addExtension(new GithubFlavoredMarkdownExtension())
    ->addExtension(new AlertExtension());

$converter = new MarkdownConverter($environment);

$htmlContent = $converter->convert($md);
```

