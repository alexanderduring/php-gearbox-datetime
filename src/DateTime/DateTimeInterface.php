<?php

namespace Gearbox\DateTime;

interface DateTimeInterface
{
    /**
     * @param string $dateString Defaults to 'now'.
     */
    public function __construct($dateString = 'now');

    /**
     * @param \Gearbox\DateTime\DateIntervalInterface $interval
     * @return \Gearbox\DateTime\DateTimeInterface
     */
    public function add(DateIntervalInterface $interval);

    /**
     * @param \Gearbox\DateTime\DateIntervalInterface $interval
     * @return \Gearbox\DateTime\DateTimeInterface
     */
    public function sub(DateIntervalInterface $interval);

    /**
     * @param \Gearbox\DateTime\DateTimeInterface $dateTime
     * @return integer
     */
    public function diffInDays(DateTimeInterface $dateTime);

    /**
     * @param integer $hours
     * @param integer $minutes
     * @param integer $seconds
     * @return \Gearbox\DateTime\DateTimeInterface
     */
    public function setTime($hours, $minutes, $seconds = 0);

    /**
     * @return string "Y-m-d H:i:s"
     */
    public function asMySqlDateTime();

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
    public function equals(DateTimeInterface $dateTimeToCompareWith);

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
    public function isInThePast();

    /**
     * @return boolean
     */
    public function isInTheFuture();

    /**
     * @return string
     */
    public function __toString();
}
