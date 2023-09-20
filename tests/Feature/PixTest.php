<?php

use WandesCardoso\Pix\Pix;
use WandesCardoso\Pix\Enums\TypeKey;

it('generate QrCode Pix payment not unique', function () {

    $pix = Pix::make(
        typeKey: TypeKey::EMAIL,
        key: 'wandes2030@gmail.com',
        amount: 12,
        recipient: 'Wandes Cardoso',
        identification: '12345678901',
        city: 'Corrente',
        description: 'Pagamento do pedido',
    );

    expect($pix->generateCopyPasteCode())->toEqual('00020126650014BR.GOV.BCB.PIX0120wandes2030@gmail.com0219Pagamento do pedido5204000053039865802BR624950300017BR.GOV.BCB.BRCODE01051.0.0051112345678901540512.005914WANDES CARDOSO6008CORRENTE6304740E');

});

it('generate QrCode Pix unique payment', function () {

    $pix = Pix::make(
        typeKey: TypeKey::EMAIL,
        key: 'wandes2030@gmail.com',
        amount: 12,
        recipient: 'Wandes Cardoso',
        identification: '12345678901',
        city: 'Corrente',
        description: 'Pagamento do pedido',
        isUniquePayment: true
    );

    expect($pix->generateCopyPasteCode())->toEqual('00020126650014BR.GOV.BCB.PIX0120wandes2030@gmail.com0219Pagamento do pedido5204000053039865802BR624950300017BR.GOV.BCB.BRCODE01051.0.0051112345678901540512.000102125914WANDES CARDOSO6008CORRENTE6304F573');

});
