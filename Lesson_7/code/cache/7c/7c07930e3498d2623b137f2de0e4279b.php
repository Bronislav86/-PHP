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

/* user-auth.twig */
class __TwigTemplate_91631c31e3038df87f2d3a94eed5f93c extends Template
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
        if (( !($context["auth"] ?? null) - ($context["success"] ?? null))) {
            // line 2
            yield "  ";
            yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape((($context["auth"] ?? null) - ($context["error"] ?? null)), "html", null, true);
            yield "
";
        }
        // line 4
        yield "
<form action=\"/user/login\" method=\"post\">
  <input id=\"csrf_token\" type=\"hidden\" name=\"csrf_token\" value=\"";
        // line 6
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["csrf_token"] ?? null), "html", null, true);
        yield "\"/>
  <p>
    <label for=\"user-login\">Логин:</label>
    <input id=\"user-login\" type=\"text\" name=\"login\"/>
  </p>
  <p>
    <label for=\"user-password\">Пароль:</label>
    <input id=\"user-password\" type=\"password\" name=\"password\"/>
  </p>
  <p><input type=\"submit\" value=\"Войти\"/></p>
</form>";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "user-auth.twig";
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
        return array (  54 => 6,  50 => 4,  44 => 2,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "user-auth.twig", "/data/mysite.local/src/Domain/Views/user-auth.twig");
    }
}
