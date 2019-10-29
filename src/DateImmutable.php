<?php

namespace Gearbox\DateTime;

use DateTimeImmutable as PhpDateTimeImmutable;

class DateImmutable
{
    /** @var PhpDateTimeImmutable */
    private $phpDateTime;


    /**
     * May be called optionally with a date string like '2019-10-28'
     *
     * @throws Exception
     */
    public function __construct(string $dateString = null, DateTimeZone $timezone = null)
    {
        // Default is today
        if (is_null($dateString)) {
            $dateString = date('Y-m-d');
        }

        try {
            $this->phpDateTime = new PhpDateTimeImmutable($dateString . ' 12:00:00', $timezone);
        } catch (\Exception $exception) {
            throw new Exception('Cannot construct instance of ' . __CLASS__ . ' with parameter "' . $dateString . '". Problem: ' . $exception->getMessage());
        }
    }



    public function isSameDay(DateImmutable $date): bool
    {
        return $date->getDayAsNumber() == $this->getDayAsNumber();
    }



    public function isSameMonth(DateImmutable $date): bool
    {
        return $date->getMontAsNumber() == $this->getMontAsNumber();
    }



    public function isSameYear(DateImmutable $date): bool
    {
        return $date->getYearAsNumber() == $this->getYearAsNumber();
    }



    public function equals(DateImmutable $date): bool
    {
        return $this->isSameDay($date) && $this->isSameMonth($date) && $this->isSameYear($date);
    }



    public function isLastDayOfMonth(): bool
    {
        $month = new MonthImmutable($this->phpDateTime->format('Y-m'));

        return $month->getLastDay()->equals($this);
    }



    public function getDayAsNumber(): int
    {
        return (int) $this->phpDateTime->format('d');
    }



    public function getMonthAsNumber(): int
    {
        return (int) $this->phpDateTime->format('m');
    }



    public function getYearAsNumber(): int
    {
        return (int) $this->phpDateTime->format('Y');
    }



    public function __clone()
    {
        // Force a clone of phpDateTime, otherwise the cloned DateTime object 
        // would point to the same phpDateTime instance.
        $this->phpDateTime = clone $this->phpDateTime;
    }
}
