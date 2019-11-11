<?php
namespace Hirotae\Vue01\Module;

use BEAR\Package\AbstractAppModule;
use BEAR\Package\PackageModule;
use Hirotae\Vue01\Annotation\Api;
use Hirotae\Vue01\Interceptor\JsonRendererInterceptor;

class AppModule extends AbstractAppModule
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $appDir = $this->appMeta->appDir;
        require_once $appDir . '/env.php';

        $this->bindInterceptor(
            $this->matcher->any(),
            $this->matcher->annotatedWith(Api::class),
            // $this->matcher->startsWith('on'),
            [JsonRendererInterceptor::class]
        );

        $this->install(new PackageModule);
    }
}
