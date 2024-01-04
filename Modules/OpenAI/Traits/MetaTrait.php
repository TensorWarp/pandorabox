<?php


 namespace Modules\OpenAI\Traits;

use Illuminate\Database\Eloquent\Collection;

trait MetaTrait
{
    public function __get($name)
    {
        if (!isset($this->attributes['id'])) {
            return parent::__get($name);
        }
        $val = parent::__get($name);

        if ($val <> null) {
            return $val;
        }
        if (!$this->metaFetched) {
            $this->getMeta();
        }

        if (isset($this->metaArray[$name])) {
            return $this->metaArray[$name];
        }

        return null;
    }

    public function getMeta()
    {
        if (!isset($this->relations['metadata'])) {
            $this->relations['metadata'] = $this->getMetaCollection();
        }
        $this->metaArray = $this->relations['metadata']->pluck('value', 'key')->toArray();
        $this->metaFetched = true;
        return $this->metaArray;
    }

    public function getMetaCollection()
    {
        if (!isset($this->relations['metadata'])) {
            $this->relations['metadata'] = $this->metadata()->get();
        }
        return $this->relations['metadata'];
    }
}
