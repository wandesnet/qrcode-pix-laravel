<?php

declare(strict_types=1);

namespace WandesCardoso\Pix\DTO\Objects;

use WandesCardoso\Pix\Traits\Makeable;

final class Identification
{
    use Makeable;

    protected function __construct(private readonly ?string $txtId = null)
    {

        if(strlen(strval($this->txtId)) > 36) {
            throw new \InvalidArgumentException('The txtId must be less than 36 characters');
        }

    }

    public function getIdentifier(): ?string
    {
        return $this->txtId;
    }
}
