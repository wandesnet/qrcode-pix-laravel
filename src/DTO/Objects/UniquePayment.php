<?php

declare(strict_types=1);

namespace WandesCardoso\Pix\DTO\Objects;

use WandesCardoso\Pix\Traits\Makeable;

final class UniquePayment
{
    use Makeable;

    protected function __construct(private readonly ?bool $bool = null)
    {

    }

    public function isUnique(): ?string
    {
        return $this->bool ? '12' : null;
    }
}
