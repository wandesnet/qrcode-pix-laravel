<?php

declare(strict_types=1);

namespace WandesCardoso\Pix\Services;

use LengthException;
use WandesCardoso\Pix\Contracts\OutputQrCode;
use WandesCardoso\Pix\DTO\Objects\PixTransactionData;

class QrCodeService
{
    /** @var array<mixed> */
    protected array $payload = [];

    public function __construct(readonly PixTransactionData $dto)
    {
        $this->payload = $dto->toArray();
    }

    /** @param array<mixed> $payload */
    protected function prepare(array $payload): string
    {
        $ret = '';
        foreach ($payload as $k => $v) {
            $ret = $this->getRet($v, strval($k), $ret);
        }

        return $ret;
    }

    protected function cpm(string $tx): string
    {
        if (strlen($tx) > 99) {
            throw new LengthException("'{$tx}' the maximum length is 99");
        }

        return $this->c2(strval(strlen($tx)));
    }

    protected function c2(string $input): string
    {
        return str_pad($input, 2, '0', STR_PAD_LEFT);
    }

    protected function charCodeAt(string $str, int $i): int
    {
        return ord(substr($str, $i, 1));
    }

    protected function crcChecksum(string $str): string
    {

        $crc = 0xFFFF;
        $strlen = strlen($str);

        for ($charIndex = 0; $charIndex < $strlen; $charIndex++) {
            $charValue = $this->charCodeAt($str, $charIndex) << 8;
            $crc ^= $charValue;

            for ($bitIndex = 0; $bitIndex < 8; $bitIndex++) {
                if ($crc & 0x8000) {
                    $crc = ($crc << 1) ^ 0x1021;
                } else {
                    $crc = $crc << 1;
                }
            }
        }

        $hex = $crc & 0xFFFF;

        return strtoupper(dechex($hex));
    }

    public function generateCopyPasteCode(): string
    {
        $pix = $this->prepare($this->payload);
        $pix .= '6304';
        $pix .= $this->crcChecksum($pix);

        return $pix;
    }

    public function output(OutputQrCode $outputQrCode): mixed
    {
        return $outputQrCode->output();
    }

    private function getRet(mixed $v, string $k, string $ret): string
    {
        $ret .= $this->c2($k);

        if ( ! is_array($v)) {
            $ret .= $this->cpm(strval($v)).$v; //@phpstan-ignore-line

            return $ret;
        }

        $string = $this->prepare($v);
        $ret .= $this->cpm($string).$string;

        return $ret;
    }
}
