<?php

declare(strict_types=1);

namespace WandesCardoso\Pix\Enums;

enum TypeKey: string
{
    case CPF = 'cpf';
    case CNPJ = 'cnpj';
    case PHONE = 'phone';
    case EMAIL = 'email';
    case RANDOM = 'random';

}
