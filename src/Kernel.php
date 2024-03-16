<?php

namespace App;

use App\Trait\ChangeTimeZoneTrait;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;
    use ChangeTimeZoneTrait;

    public function __construct(string $environment, bool $debug)
    {
        
        $this->changeTimeZone($_ENV['TIME_ZONE']);

        parent::__construct($environment, $debug);
    }
}
