<?php


namespace Modules\OpenAI\Services;

class UseCaseTemplateService
{
    protected $source;

    protected $variables;

    protected $matches = [];

    public function __construct(string $source)
    {
        $this->source = $source;
        $this->extractVariables();
    }

    public function __set($key, $value)
    {
        $this->variables['[['.strtoupper($key).']]'] = $value;
    }

    public function __toString()
    {
        return str_replace(array_keys($this->variables), $this->variables, $this->source);
    }

    public function extractVariables()
    {
        preg_match_all('/\[{2}([a-zA-Z0-9_-]+)\]{2}/', $this->source, $this->matches, PREG_SET_ORDER);

        foreach ($this->matches as $match) {
            $this->variables['[['.strtoupper($match[1]).']]'] = '';
            $this->source = str_replace('[['.$match[1].']]', '[['.strtoupper($match[1]).']]', $this->source);
        }
    }

    public function setVariables($variables)
    {
        foreach ($variables as $key => $value) {
            if (isset($this->variables['[['.strtoupper($key).']]'])) {
                $this->variables['[['.strtoupper($key).']]'] = filteringBadWords($value);
            }
        }
    }

    public function render(): string
    {
        if (!is_null($this->variables)) {
            return str_replace(array_keys($this->variables), $this->variables, $this->source);
        }
        
        return $this->source;
        
    }
}
