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

/* user-form.twig */
class __TwigTemplate_762078c47c007a0b85e976399cf685f7 extends Template
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
        yield "<form action=\"/user/save/\" method=\"post\">
  <input id=\"csrf_token\" type=\"hidden\" name=\"csrf_token\" value=\"";
        // line 2
        yield $this->env->getRuntime('Twig\Runtime\EscaperRuntime')->escape(($context["csrf_token"] ?? null), "html", null, true);
        yield "\"/>
  <p>
    <label for=\"user-name\">Имя:</label>
    <input id=\"user-name\" type=\"text\" name=\"name\"/>
  </p>
  <p>
    <label for=\"user-lastname\">Фамилия:</label>
    <input id=\"user-lastname\" type=\"text\" name=\"lastname\"/>
  </p>
  <p>
    <label for=\"user-birthday\">День рождения:</label>
    <input id=\"user-birthday\" type=\"text\" name=\"birthday\" placeholder=\"ДД-ММ-ГГГГ\"/>
  </p>
  <p><input type=\"submit\" value=\"Сохранить\"/></p>
</form>";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "user-form.twig";
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
        return array (  45 => 2,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "user-form.twig", "/data/mysite.local/src/Domain/Views/user-form.twig");
    }
}
