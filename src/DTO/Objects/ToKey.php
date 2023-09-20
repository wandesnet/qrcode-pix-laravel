<?php

declare(strict_types=1);

namespace WandesCardoso\Pix\DTO\Objects;

use WandesCardoso\Pix\Enums\TypeKey;
use WandesCardoso\Pix\Traits\Makeable;

final class ToKey
{
    use Makeable;

    protected function __construct(
        private readonly ?string $key = null,
        private readonly ?TypeKey $type = null,
    ) {
    }

    public function getKey(): ?string
    {
        return $this->key;
    }

    public function getType(): ?TypeKey
    {
        return $this->type;
    }
}
