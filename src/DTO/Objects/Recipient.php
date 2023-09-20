<?php

declare(strict_types=1);

namespace WandesCardoso\Pix\DTO\Objects;

use WandesCardoso\Pix\Helpers\Helper;
use WandesCardoso\Pix\Traits\Makeable;

final class Recipient
{
    use Makeable;

    protected function __construct(private readonly ?string $name = null)
    {

        if(strlen(strval($this->name)) > 25) {
            throw new \InvalidArgumentException('The name must be less than 25 characters');
        }

    }

    public function getName(): ?string
    {
        return Helper::strClear((string) $this->name);
    }
}
