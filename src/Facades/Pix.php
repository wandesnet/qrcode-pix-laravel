<?php

declare(strict_types=1);

namespace WandesCardoso\Pix\Facades;

use Illuminate\Support\Facades\Facade;
use WandesCardoso\Pix\Enums\TypeKey;
use WandesCardoso\Pix\Pix as PixQrCode;

/**
 * @method static PixQrCode make(TypeKey $typeKey, string $key, float $amount, string $recipient, string $identification, string $city, ?string $description = null, bool $isUniquePayment = false)
 * @method static mixed getQrCode(string $output = 'png', bool $base64 = true)
 * @method static string generateCopyPasteCode()
 */
class Pix extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'pix';
    }
}
