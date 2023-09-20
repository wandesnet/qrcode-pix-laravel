<?php

declare(strict_types=1);

namespace WandesCardoso\Pix\DTO\Objects;

use WandesCardoso\Pix\Traits\Makeable;

final class Amount
{
    use Makeable;

    protected function __construct(private readonly ?float $amount = null)
    {

        if (strlen(strval($this->amount)) > 13) {
            throw new \InvalidArgumentException('The amount must be less than 13 digits');
        }

    }

    public function getAmount(): string
    {
        return number_format(floatval($this->amount), 2, '.', '');
    }
}
