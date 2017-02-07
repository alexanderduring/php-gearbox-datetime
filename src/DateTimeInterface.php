<?php

namespace Gearbox\DateTime;

interface DateTimeInterface
{
    /**
     * @param string $dateString Defaults to 'now'.
     */
    public function __construct($dateString = 'now');

    /**
     * @return integer
     */
    public function getDayAsNumber();

    /**
     * @return \Gearbox\DateTime\MonthImmutable
     */
    public function getMonth();

    /**
     * @return integer
     */
    public function getMonthAsNumber();

    /**
     * @return integer
     */
    public function getYearAsNumber();

    /**
     * @param integer $hours
     * @param integer $minutes
     * @param integer $seconds
     * @return \Gearbox\DateTime\DateTimeInterface
     */
    public function setTime($hours, $minutes, $seconds = 0);

    /**
     * @param \Gearbox\DateTime\DateTimeInterface $dateTimeToCompareWith
     * @return boolean
     */
    public function equals(DateTimeInterface $dateTimeToCompareWith);

    /**
     * @param \Gearbox\DateTime\DateTimeInterface $dateTimeToCompareWith
     * @return boolean
     */
    public function isEarlier(DateTimeInterface $dateTimeToCompareWith);

    /**
     * @param \Gearbox\DateTime\DateTimeInterface $dateTimeToCompareWith
     * @return boolean
     */
    public function isLater(DateTimeInterface $dateTimeToCompareWith);

    /**
     * @param \Gearbox\DateTime\DateTimeInterface $dateTimeToCompareWith
     * @return boolean
     */
    public function isLaterOrEquals(DateTimeInterface $dateTimeToCompareWith);

    /**
     * @param \Gearbox\DateTime\DateTimeInterface $dateTimeToCompareWith
     * @return boolean
     */
    public function isEarlierOrEquals(DateTimeInterface $dateTimeToCompareWith);

    /**
     * @return boolean
     */
    public function isSameMonth();

    /**
     * @return boolean
     */
    public function isInThePast();

    /**
     * @return boolean
     */
    public function isInTheFuture();

    /**
     * @param \Gearbox\DateTime\DateIntervalInterface $interval
     * @return \Gearbox\DateTime\DateTimeInterface
     */
    public function add(DateIntervalInterface $interval);

    /**
     * @param int $numberOfDays
     * @return \Gearbox\DateTime\DateTimeImmutable
     */
    public function addDays($numberOfDays);

    /**
     * @param int $numberOfMonths
     * @return \Gearbox\DateTime\DateTimeImmutable
     */
    public function addMonths($numberOfMonths);

    /**
     * @param \Gearbox\DateTime\DateTimeInterface $dateTime
     * @return \Gearbox\DateTime\DateIntervalInterface
     */
    public function diff(DateTimeInterface $dateTime);

    /**
     * @param \Gearbox\DateTime\DateTimeInterface $dateTime
     * @return integer
     */
    public function diffInDays(DateTimeInterface $dateTime);

    /**
     * @param \Gearbox\DateTime\DateIntervalInterface $interval
     * @return \Gearbox\DateTime\DateTimeInterface
     */
    public function sub(DateIntervalInterface $interval);

    /**
     * @param string $formatString
     * @return string
     */
    public function format($formatString);

    /**
     * @return string "Y-m-d H:i:s"
     */
    public function asMySqlDateTime();

    /**
     * @return string "Y-m-d"
     */
    public function asMySqlDate();

    /**
     * @return integer
     */
    public function asUnixTimestamp();

    /**
     * @return string "d.m.Y"
     */
    public function asGermanDate();

    /**
     * @return string "d.m.Y H:i:s"
     */
    public function asGermanDateTime();

    /**
     * @return string "Y-m-d_H-i-s"
     */
    public function asDateTimeForFilename();

    /**
     * @return string
     */
    public function __toString();
}
