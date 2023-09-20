<?php

declare(strict_types=1);

namespace WandesCardoso\Pix\DTO\Objects;

use WandesCardoso\Pix\Helpers\Helper;
use WandesCardoso\Pix\Traits\Makeable;

final class Description
{
    use Makeable;

    protected function __construct(private readonly ?string $description = null)
    {

        if(strlen(strval($this->description)) > 99) {
            throw new \InvalidArgumentException('The description must be less than 99 characters');
        }

    }

    public function getDescription(): ?string
    {
        return Helper::removeSpecialCharacters((string) $this->description);
    }
}
