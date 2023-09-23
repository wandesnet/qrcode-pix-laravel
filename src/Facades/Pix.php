<?php

declare(strict_types=1);

namespace WandesCardoso\Pix\Facades;

use Illuminate\Support\Facades\Facade;
use WandesCardoso\Pix\Enums\TypeKey;

/**
 * @method static make(TypeKey $typeKey, string $key, float $amount, string $recipient, string $identification, string $city, ?string $description = null, bool $isUniquePayment = false)
 * @method static generateCopyPasteCode()
 * @method static getQrCode(string $output = 'png', bool $base64 = true)
 */
class Pix extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'pix';
    }
}
