<?php

namespace Gearbox\DateTime;

interface DateIntervalInterface
{
    const FORMAT_ISO_8601 = 'P%yY%mM%dDT%hH%iM%sS';

    /**
     * @param string $dateString Any date format that PHPs DateInterval can parse.
     */
    public function __construct($dateString);

    /**
     * Returns true, if number of years <> 0.
     */
    public function hasYears();

    /**
     * Returns true, if number of months <> 0.
     */
    public function hasMonths();

    /**
     * Returns true, if number of days <> 0.
     */
    public function hasDays();

    /**
     * Returns true, if number of hours <> 0.
     */
    public function hasHours();

    /**
     * Returns true, if number of minutes <> 0.
     */
    public function hasMinutes();

    /**
     * Returns true, if number of seconds <> 0.
     */
    public function hasSeconds();

    /**
     * Returns true, if the interval has at least years or months or days.
     */
    public function hasDate();

    /**
     * Returns true, if the interval has at least hours or minutes or seconds.
     */
    public function hasTime();

    /**
     * @return integer Returns the number of years.
     */
    public function getYears();

    /**
     * @return integer Returns the number of months.
     */
    public function getMonths();

    /**
     * @return integer Returns the number of days.
     */
    public function getDays();

    /**
     * @return integer Returns the number of hours.
     */
    public function getHours();

    /**
     * @return integer Returns the number of minutes.
     */
    public function getMinutes();

    /**
     * @return integer Returns the number of seconds.
     */
    public function getSeconds();

    /**
     * @return boolean Returns true, if the interval contains only days.
     */
    public function isInDays();

    /**
     * @return boolean Returns true, if the interval contains only months.
     */
    public function isInMonths();

    /**
     * @return boolean Returns true, if the interval is of length zero.
     */
    public function isZero();

    /**
     * @param \Gearbox\DateTime\DateIntervalInterface $dateInterval
     * @return boolean
     */
    public function equals(DateIntervalInterface $dateInterval);

    /**
     * @param string $formatString
     * @return string
     */
    public function format($formatString);

    /**
     * @return \Gearbox\DateTime\DateIntervalInterface Returns an instance of PHPs own DateInterval class
     */
    public function getAsPhpDateInterval();

    /**
     * @return string ISO 8601 duration format (P3Y6M4DT12H30M17S).
     */
    public function asIso8601();
}
