<?php

namespace  App\Traits;

trait GetLang
{
    public function getTranslates($baseField, $lang)
    {
        $field = "{$baseField}_{$lang}";
        return $this->$field;
    }
}
