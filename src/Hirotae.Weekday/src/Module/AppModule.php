<?php
namespace Hirotae\Weekday\Module;

use BEAR\Package\AbstractAppModule;
use BEAR\Package\PackageModule;
use BEAR\Package\Provide\Router\AuraRouterModule;
use Hirotae\Weekday\MyLogger;
use Hirotae\Weekday\MyLoggerInterface;
use Hirotae\Weekday\Annotation\BenchMark;
use Hirotae\Weekday\Interceptor\BenchMaker;

class AppModule extends AbstractAppModule
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $appDir = $this->appMeta->appDir;
        require_once $appDir . '/env.php';
        $this->install(new AuraRouterModule($appDir . '/var/conf/aura.route.php'));
        $this->bind(MyLoggerInterface::class)->to(MyLogger::class);
        $this->install(new PackageModule);

        $this->bindInterceptor(
            $this->matcher->any(),
            $this->matcher->annotatedWith(BenchMark::class),
            [BenchMaker::class]
        );
    }
}
