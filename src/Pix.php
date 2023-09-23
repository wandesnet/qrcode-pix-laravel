<?php

declare(strict_types=1);

namespace WandesCardoso\Pix;

use Exception;
use WandesCardoso\Pix\Enums\TypeKey;
use WandesCardoso\Pix\Output\OutputImagePng;
use WandesCardoso\Pix\Services\QrCodeService;
use WandesCardoso\Pix\DTO\Objects\Address;
use WandesCardoso\Pix\DTO\Objects\Amount;
use WandesCardoso\Pix\DTO\Objects\Description;
use WandesCardoso\Pix\DTO\Objects\Identification;
use WandesCardoso\Pix\DTO\Objects\PixTransactionData;
use WandesCardoso\Pix\DTO\Objects\Recipient;
use WandesCardoso\Pix\DTO\Objects\ToKey;
use WandesCardoso\Pix\DTO\Objects\UniquePayment;

class Pix
{
    private readonly QrCodeService $service;

    public function __construct(
        private readonly ?TypeKey $typeKey = null,
        private readonly ?string $key = null,
        private readonly ?float $amount = null,
        private readonly ?string $recipient = null,
        private readonly ?string $identification = null,
        private readonly ?string $city = null,
        private readonly ?string $description = null,
        private readonly bool $isUniquePayment = false,
    ) {

        $this->service = new QrCodeService(
            PixTransactionData::make(
                ToKey::make($this->key, $this->typeKey),
                Amount::make($this->amount),
                Recipient::make($this->recipient),
                Identification::make($this->identification),
                Address::make($this->city),
                Description::make($this->description),
                UniquePayment::make($this->isUniquePayment)
            )
        );

    }

    /**
     * @param  TypeKey  $typeKey the type of key
     * @param  string  $key the key that will receive the payment
     * @param  float  $amount the amount
     * @param  string  $recipient the recipient name
     * @param  string  $identification the identification
     * @param  string  $city the city of the payer
     * @param  string|null  $description the description
     * @param  bool  $isUniquePayment determines whether the payment is a single payment
     */
    public function make(TypeKey $typeKey, string $key, float $amount, string $recipient, string $identification, string $city, ?string $description = null, bool $isUniquePayment = false): self
    {
        return new self($typeKey, $key, $amount, $recipient, $identification, $city, $description, $isUniquePayment);
    }

    public function generateCopyPasteCode(): string
    {
        return $this->service->generateCopyPasteCode();
    }

    /** @throws Exception */
    public function getQrCode(string $output = 'png', bool $base64 = true): mixed
    {
        return match ($output) {
            'png' => $this->service->output(new OutputImagePng($this->generateCopyPasteCode(), $base64)),
            default => throw new Exception('Output type not supported'),
        };
    }
}
