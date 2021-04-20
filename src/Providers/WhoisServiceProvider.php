<?php

declare(strict_types=1);

namespace Exhum4n\Whois\Providers;

use Exhum4n\Components\Providers\AbstractProvider;

class WhoisServiceProvider extends AbstractProvider
{
    public function register(): void
    {
        $this->publishConfig('whois.php');
    }
}
