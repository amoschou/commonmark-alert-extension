# commonmark-alert-extension

## GitHub documentation

See here:\
[https://docs.github.com/en/get-started/writing-on-github/getting-started-with-writing-and-formatting-on-github/basic-writing-and-formatting-syntax#alerts](https://docs.github.com/en/get-started/writing-on-github/getting-started-with-writing-and-formatting-on-github/basic-writing-and-formatting-syntax#alerts)


## Markdown 

```md
> [!NOTE]
> Highlights information that users should take into account, even when skimming.

> [!IMPORTANT]
> Crucial information necessary for users to succeed.

> [!WARNING]
> Critical content demanding immediate user attention due to potential risks.
```

## PHP

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

