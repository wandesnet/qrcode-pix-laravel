<?php

declare(strict_types=1);

namespace WandesCardoso\Pix\Output;

use WandesCardoso\Pix\Contracts\OutputQrCode;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;

class OutputImagePng implements OutputQrCode
{
    public function __construct(private readonly string $string, private readonly  bool $base64 = false)
    {
    }

    public function output(): mixed
    {
        $options = new QROptions([
            'outputType' => 'png',
            'imageBase64' => $this->base64,
        ]);

        return (new QRCode($options))->render($this->string);
    }
}
