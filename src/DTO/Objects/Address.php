<?php

declare(strict_types=1);

namespace WandesCardoso\Pix\DTO\Objects;

use WandesCardoso\Pix\Helpers\Helper;
use WandesCardoso\Pix\Traits\Makeable;

final class Address
{
    use Makeable;

    protected function __construct(private readonly ?string $city = null)
    {
        if (strlen(strval($this->city)) > 15) {
            throw new \InvalidArgumentException('City must be less than 15 characters');
        }
    }

    public function getCity(): ?string
    {
        return Helper::strClear((string) $this->city);
    }
}
