<?php

declare(strict_types=1);

namespace WandesCardoso\Pix\DTO\Objects;

use InvalidArgumentException;
use WandesCardoso\Pix\Contracts\Arrayable;
use WandesCardoso\Pix\Traits\Makeable;

final class PixTransactionData implements Arrayable
{
    use Makeable;

    /** @var array<mixed> */
    protected array $payload = [];

    protected function __construct(
        private readonly ?ToKey $toKey = null,
        private readonly ?Amount $amount = null,
        private readonly ?Recipient $recipient = null,
        private readonly ?Identification $identification = null,
        private readonly ?Address $address = null,
        private readonly ?Description $description = null,
        private readonly ?UniquePayment $isUniquePayment = null,
    ) {

        $this->payload[0] = '01';
        $this->payload[26][0] = 'BR.GOV.BCB.PIX';
        $this->payload[52] = '0000';
        $this->payload[53] = '986';
        $this->payload[58] = 'BR';
        $this->payload[62][50][0] = 'BR.GOV.BCB.BRCODE';
        $this->payload[62][50][1] = '1.0.0';

    }

    /**
     * @return array<mixed>
     * @throws InvalidArgumentException
     */
    public function toArray(): array
    {
        $this->payload[26][1] = $this->toKey?->getKey(); //@phpstan-ignore-line
        $this->payload[54] = $this->amount?->getAmount();
        $this->payload[1] = $this->isUniquePayment?->isUnique();
        $this->payload[26][2] = $this->description?->getDescription(); //@phpstan-ignore-line
        $this->payload[59] = $this->recipient?->getName();
        $this->payload[62][5] = $this->identification?->getIdentifier();
        $this->payload[60] = $this->address?->getCity();

        return array_filter($this->payload);
    }
}
