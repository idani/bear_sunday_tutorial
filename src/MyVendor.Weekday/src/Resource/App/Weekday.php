<?php
namespace MyVendor\Weekday\Resource\App;

use BEAR\Resource\ResourceObject;
use MyVendor\Weekday\MyLoggerInterface;
use MyVendor\Weekday\Annotation\BenchMark;

class Weekday extends ResourceObject
{
	/**
	 * @var MyLoggerInterface
	 */
	private $logger;

	public function __construct(MyLoggerInterface $logger)
	{
		$this->logger = $logger;
	}

	/**
	 * Undocumented function
	 * @BenchMark
	 *
	 * @param integer $year
	 * @param integer $month
	 * @param integer $day
	 * @return ResourceObject
	 */
    public function onGet(int $year, int $month, int $day) : ResourceObject
    {
        $weekday = \DateTime::createFromFormat('Y-m-d', "$year-$month-$day")->format('D');
        $this->body = [
            'weekday' => $weekday
		];
		
		$this->logger->log("$year-$month-$day {$weekday}");

        return $this;
    }
}
