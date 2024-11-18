<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* /layouts/main.twig */
class __TwigTemplate_d5cf09635aa45faef0ad032496904c4d extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 1
        yield "<!DOCTYPE html>
<html lang=\"en\">
\t<head>
\t\t<meta charset=\"UTF-8\" />
\t\t<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\" />
\t\t<meta name=\"description\" content=\"Мой первый сайт на PHP\" />
\t\t<title>";
        // line 7
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["title"] ?? null), "html", null, true);
        yield "</title>
\t\t<link rel=\"stylesheet\" href=\"./style.css\" />
\t</head>
\t<body>
\t\t<header class=\"header\">
\t\t\t";
        // line 12
        yield Twig\Extension\CoreExtension::include($this->env, $context, "./layouts/site-header.twig");
        yield "
\t\t</header>
\t\t<div id=\"header\">
\t\t\t";
        // line 15
        yield from         $this->loadTemplate("./layouts/auth-template.twig", "/layouts/main.twig", 15)->unwrap()->yield($context);
        // line 16
        yield "\t\t</div>
\t\t<main class=\"container\">
\t\t\t";
        // line 18
        yield from         $this->loadTemplate(($context["content_template_name"] ?? null), "/layouts/main.twig", 18)->unwrap()->yield($context);
        // line 19
        yield "\t\t</main>
\t\t<footer class=\"footer\">
\t\t\t";
        // line 21
        yield Twig\Extension\CoreExtension::include($this->env, $context, "./layouts/site-footer.twig");
        yield "
\t\t</footer>
\t</body>
</html>
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "/layouts/main.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  76 => 21,  72 => 19,  70 => 18,  66 => 16,  64 => 15,  58 => 12,  50 => 7,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "/layouts/main.twig", "/data/mysite.local/src/Domain/Views/layouts/main.twig");
    }
}
