<?php

namespace WandesCardoso\Pix\Traits;

trait Makeable
{
    public static function make(mixed ...$arguments): self
    {
        if(is_array($arguments[0]) && count($arguments) === 1) {
            $arguments = $arguments[0];
        }

        return new self(...$arguments);
    }
}
