<?php

namespace WandesCardoso\Pix;

use Illuminate\Support\ServiceProvider;

class PixServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->alias(Pix::class, 'pix');
    }
}
