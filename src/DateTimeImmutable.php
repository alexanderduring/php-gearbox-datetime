<?php

namespace Gearbox\DateTime;

use DateTime as PhpDateTime;
use Exception as PhpException;

/**
 * Represents a specific moment in time and cannot be changed.
 */
class DateTimeImmutable implements DateTimeInterface
{
    const DATETIME_FOR_FILE_NAME    = 'Y-m-d_H-i-s';
    const GERMAN_DATETIME           = 'd.m.Y H:i:s';
    const GERMAN_DATE               = 'd.m.Y';
    const MYSQL_DATETIME            = 'Y-m-d H:i:s';
    const MYSQL_DATE                = 'Y-m-d';

    /** @var \DateTime */
    protected $phpDateTime = null;



    /**
     * May be called with any date string the php version of DateTime accepts
     * and additionally with a unix timestamp also.
     *
     * @param string $dateString Defaults to 'now'.
     */
    public function __construct($dateString = 'now')
    {
        try {
            $this->phpDateTime = new PhpDateTime($dateString);
        }
        catch (PhpException $exception) {
            // Suspect it is a unixtime that could not be parsed.
            $this->phpDateTime = new PhpDateTime();
            $this->phpDateTime->setTimestamp($dateString);
        }
    }



    public function __clone()
    {
        // Force a clone of phpDateTime, otherwise the cloned DateTime object
        // would point to the same phpDateTime instance.
        $this->phpDateTime = clone $this->phpDateTime;
    }



    /**
     * Returns numeric representation of a day, without leading zeros.
     *
     * @return integer
     */
    public function getDayAsNumber()
    {
        $day = $this->phpDateTime->format('j');

        return $day;
    }



    /**
     * Returns instance of MonthImmutable
     *
     * @return \Gearbox\DateTime\MonthImmutable
     */
    public function getMonth()
    {
        $month = new MonthImmutable($this->phpDateTime->format('Y-m'));

        return $month;
    }



    /**
     * Returns numeric representation of a month, without leading zeros.
     *
     * @return integer
     */
    public function getMonthAsNumber()
    {
        $month = $this->phpDateTime->format('n');

        return $month;
    }



    /**
     * Returns year with four digits
     *
     * @return integer
     */
    public function getYearAsNumber()
    {
        $year = $this->phpDateTime->format('Y');

        return $year;
    }



    /**
     * @param integer $hours
     * @param integer $minutes
     * @param integer $seconds
     * @return \Gearbox\DateTime\DateTimeImmutable
     */
    public function setTime($hours, $minutes, $seconds = 0)
    {
        $phpDateTime = clone $this->phpDateTime;
        $phpDateTime->setTime($hours, $minutes, $seconds);
        $newDateTime = $this->createInstance($phpDateTime);

        return $newDateTime;
    }



    /**
     * Returns true if the DateTime object and the date to compare with represent the same date.
     *
     * @param \Gearbox\DateTime\DateTimeInterface $dateToCompareWith
     * @return boolean
     */
    public function equals(DateTimeInterface $dateToCompareWith)
    {
        $equals = $this->asUnixTimestamp() == $dateToCompareWith->asUnixTimestamp();

        return $equals;
    }



    /**
     * Returns true if the DateTime object is earlier than the date to compare with.
     *
     * @param \Gearbox\DateTime\DateTimeInterface $dateToCompareWith
     * @return boolean
     */
    public function isEarlier(DateTimeInterface $dateToCompareWith)
    {
        $isEarlier = $this->asUnixTimestamp() < $dateToCompareWith->asUnixTimestamp();

        return $isEarlier;
    }



    /**
     * Returns true if the DateTime object is later than the date to compare with.
     *
     * @param \Gearbox\DateTime\DateTimeInterface $dateToCompareWith
     * @return boolean
     */
    public function isLater(DateTimeInterface $dateToCompareWith)
    {
        $isLater = $this->asUnixTimestamp() > $dateToCompareWith->asUnixTimestamp();

        return $isLater;
    }



    /**
     * @param \Gearbox\DateTime\DateTimeInterface $dateToCompareWith
     * @return boolean
     */
    public function isLaterOrEquals(DateTimeInterface $dateToCompareWith)
    {
        $equals = ($this->isLater($dateToCompareWith) || $this->equals($dateToCompareWith));

        return $equals;
    }



    /**
     * @param \Gearbox\DateTime\DateTimeInterface $dateToCompareWith
     * @return boolean
     */
    public function isEarlierOrEquals(DateTimeInterface $dateToCompareWith)
    {
        $equals = ($this->isEarlier($dateToCompareWith) || $this->equals($dateToCompareWith));

        return $equals;
    }



    /**
     * @param \Gearbox\DateTime\DateTimeInterface $dateTimeToCompareWith
     * @return boolean
     */
    public function isSameMonth(DateTimeInterface $dateTimeToCompareWith)
    {
        $sameMonth = $this->getMonthAsNumber() == $dateTimeToCompareWith->getMonthAsNumber() && $this->getYearAsNumber() == $dateTimeToCompareWith->getYearAsNumber();

        return $sameMonth;
    }



    /**
     * @return boolean
     */
    public function isInThePast()
    {
        $isInThePast = $this->asUnixTimestamp() < time();

        return $isInThePast;
    }



    /**
     * @return boolean
     */
    public function isInTheFuture()
    {
        $isInTheFuture = $this->asUnixTimestamp() > time();

        return $isInTheFuture;
    }



    /**
     * @param \Gearbox\DateTime\DateIntervalInterface $interval
     * @return \Gearbox\DateTime\DateTimeImmutable
     */
    public function add(DateIntervalInterface $interval)
    {
        $phpDateTime = clone $this->phpDateTime;
        $phpDateTime->add($interval->getAsPhpDateInterval());
        $newDateTime = $this->createInstance($phpDateTime);

        return $newDateTime;
    }



    /**
     * @param integer $numberOfDays
     * @return \Gearbox\DateTime\DateTimeImmutable
     */
    public function addDays($numberOfDays)
    {
        $daysInterval = new DateInterval($numberOfDays . ' days');
        $newDateTime = $this->add($daysInterval);

        return $newDateTime;
    }



    /**
     * @param integer $numberOfMonths
     * @return \Gearbox\DateTime\DateTimeImmutable
     */
    public function addMonths($numberOfMonths)
    {
        $monthsInterval = new DateInterval($numberOfMonths . ' months');
        $newDateTime = $this->add($monthsInterval);

        return $newDateTime;
    }



    /**
     * @param \Gearbox\DateTime\DateTimeInterface $dateTime
     * @return \Gearbox\DateTime\DateIntervalInterface
     */
    public function diff(DateTimeInterface $dateTime)
    {
        $phpDateInterval = $this->phpDateTime->diff($dateTime->phpDateTime);
        $dateIntervalAsString = $phpDateInterval->format(DateIntervalInterface::FORMAT_ISO_8601);
        $interval = new DateInterval($dateIntervalAsString);

        return $interval;
    }




    /**
     * @param \Gearbox\DateTime\DateTimeInterface $dateTime
     * @return integer
     */
    public function diffInDays(DateTimeInterface $dateTime)
    {
        $phpDateInterval = $this->phpDateTime->diff($dateTime->phpDateTime);
        $dateIntervalInDays = $phpDateInterval->days;

        return $dateIntervalInDays;
    }



    /**
     * @param \Gearbox\DateTime\DateIntervalInterface $interval
     * @return \Gearbox\DateTime\DateTimeImmutable
     */
    public function sub(DateIntervalInterface $interval)
    {
        $phpDateTime = clone $this->phpDateTime;
        $phpDateTime->sub($interval->getAsPhpDateInterval());
        $newDateTime = $this->createInstance($phpDateTime);

        return $newDateTime;
    }



    /**
     * @param string $formatString
     * @return string
     */
    public function format($formatString)
    {
        return $this->phpDateTime->format($formatString);
    }



    /**
     * @return string 'Y-m-d H:i:s'
     */
    public function asMySqlDateTime()
    {
        return $this->phpDateTime->format(self::MYSQL_DATETIME);
    }



    /**
     * @return string 'Y-m-d'
     */
    public function asMySqlDate()
    {
        return $this->phpDateTime->format(self::MYSQL_DATE);
    }



    /**
     * @return string
     */
    public function asUnixTimestamp()
    {
        return $this->phpDateTime->format('U');
    }



    /**
     * @return string 'd.m.Y'
     */
    public function asGermanDate()
    {
        return $this->phpDateTime->format(self::GERMAN_DATE);
    }



    /**
     * @return string 'd.m.Y H:i:s'
     */
    public function asGermanDateTime()
    {
        return $this->phpDateTime->format(self::GERMAN_DATETIME);
    }



    /**
     * @return string 'Y-m-d_H-i-s'
     */
    public function asDateTimeForFilename()
    {
        return $this->phpDateTime->format(self::DATETIME_FOR_FILE_NAME);
    }



    /**
     * @return string
     */
    public function __toString()
    {
        return $this->phpDateTime->format(self::GERMAN_DATETIME);
    }



    /**
     * @param $phpDateTime
     * @return \Gearbox\DateTime\DateTimeImmutable
     */
    private function createInstance($phpDateTime)
    {
        $newDateTime = new self($phpDateTime->format('Y-m-d H:i:s'));

        return $newDateTime;
    }
}
