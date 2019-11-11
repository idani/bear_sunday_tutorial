<?php
namespace Hirotae\Weekday\Interceptor;

use Hirotae\Weekday\MyLoggerInterface;
use Ray\Aop\MethodInterceptor;
use Ray\Aop\MethodInvocation;

class BenchMaker implements MethodInterceptor
{
    private $logger;

    public function __construct(MyLoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function invoke(MethodInvocation $invocation)
    {
        $start = microtime(true);
        $result = $invocation->proceed();
        $time = microtime(true) - $start;
        $message = sprintf('%s: %0.5f(μs)', $invocation->getMethod()->getName(), $time);
        $this->logger->log($message);

        return $result;
    }
}