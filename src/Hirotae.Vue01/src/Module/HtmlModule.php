<?php
namespace Hirotae\Vue01\Module;

use Madapaja\TwigModule\TwigErrorPageModule;
use Madapaja\TwigModule\TwigModule;
use Ray\Di\AbstractModule;
use Hirotae\Vue01\Annotation\Api;
use Hirotae\Vue01\Interceptor\JsonRendererInterceptor;

class HtmlModule extends AbstractModule
{
    protected function configure()
    {
        $this->bindInterceptor(
            $this->matcher->annotatedWith(Api::class),
            $this->matcher->startsWith('on'),
            [JsonRendererInterceptor::class]
        );
    
        $this->install(new TwigModule);
        $this->install(new TwigErrorPageModule);
    }
}
