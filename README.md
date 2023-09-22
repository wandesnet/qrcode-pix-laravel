## Introdução

Este pacote foi implementado inspirado no repositório do **Renato Monteiro Batista** disponível [aqui](https://github.com/renatomb/php_qrcode_pix) 

O objetivo deste pacote é facilitar a geração de QRCode para pagamentos via PIX.

## Required

- **PHP 8.1+**
- **Laravel 10.0+**

## Instalação via composer

    composer require wandesnet/qrcode-pix-laravel
 
## Usage

```php
use WandesCardoso\Pix\Facades\Pix;
use WandesCardoso\Pix\Enums\TypeKey;
    
    $pix = Pix::make(
        typeKey: TypeKey::EMAIL,
        key: 'wandes2030@gmail.com',
        amount: 12,
        recipient: 'Wandes Cardoso',
        identification: '12345678901',
        city: 'Corrente',
        description: 'Pagamento do pedido',
        isUniquePayment: false
    );
    
    $pix->getQrCode(); //gera a imagem do QRCode em base64
    
    $pix->generateCopyPasteCode(); //gera o código copiar e colar
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email wandes2030@gmail.com
instead of using the issue tracker.

## Tests

    ./vendor/bin/pest

## License MIT. Please see the [license file](LICENSE.md) for more information.

