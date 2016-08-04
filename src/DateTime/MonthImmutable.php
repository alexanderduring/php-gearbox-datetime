<?php

namespace Gearbox\DateTime;

/**
 * Represents a specific month of a year, e.g. July 2016
 */
class MonthImmutable
{
    /** @var integer */
    private $month;

    /** @var integer */
    private $year;



    /**
     * @param string $monthString Optional description of the month in the format 'YYYY-MM'.
     * @throws Exception
     */
    public function __construct($monthString = null)
    {
        // If constructed without parameters it represents todays month
        if (is_null($monthString)) {
            $monthString = date('Y-m');
        }

        // Split string at '-' into $year and $month
        list($year, $month) = explode('-', $monthString);

        // Make sure that strings have correct length and contain only digits
        if (strlen($year) == 4 && ctype_digit($year) && strlen($month) == 2 && ctype_digit($month)) {
            $this->month = (int) $month;
            $this->year = (int) $year;
        } else {
            throw new Exception('Cannot construct instance of '.__CLASS__.' with parameter "'.$monthString.'".');
        }
    }



    /**
     * @param MonthImmutable $monthToCompareWith
     * @return boolean
     */
    public function isSameYear(MonthImmutable $monthToCompareWith)
    {
        $isSameYear = $this->getYearAsNumber() == $monthToCompareWith->getYearAsNumber();

        return $isSameYear;
    }



    /**
     * @param MonthImmutable $monthToCompareWith
     * @return boolean
     */
    public function isLaterYear(MonthImmutable $monthToCompareWith)
    {
        $isLaterYear = $this->getYearAsNumber() > $monthToCompareWith->getYearAsNumber();

        return $isLaterYear;
    }



    /**
     * @param MonthImmutable $monthToCompareWith
     * @return boolean
     */
    public function isSameMonthInYear(MonthImmutable $monthToCompareWith)
    {
        $isSameMonthInYear = $this->getMonthAsNumber() == $monthToCompareWith->getMonthAsNumber();

        return $isSameMonthInYear;
    }



    /**
     * @param MonthImmutable $monthToCompareWith
     * @return boolean
     */
    public function isLaterMonthInYear(MonthImmutable $monthToCompareWith)
    {
        $isLaterMonthInYear = $this->getMonthAsNumber() > $monthToCompareWith->getMonthAsNumber();

        return $isLaterMonthInYear;
    }



    /**
     * @param MonthImmutable $monthToCompareWith
     * @return boolean
     */
    public function isLaterMonthInSameYear(MonthImmutable $monthToCompareWith)
    {
        $isLaterMonthInSameYear = $this->isSameYear($monthToCompareWith) && $this->isLaterMonthInYear($monthToCompareWith);

        return $isLaterMonthInSameYear;
    }



    /**
     * Returns true if the given month represents the same month as this one.
     * 
     * @param MonthImmutable $monthToCompareWith
     * @return boolean
     */
    public function equals(MonthImmutable $monthToCompareWith)
    {
        $isEqual = $this->isSameMonthInYear($monthToCompareWith) && $this->isSameYear($monthToCompareWith);

        return $isEqual;
    }



    /**
     * @param MonthImmutable $monthToCompareWith
     * @return boolean
     */
    public function isLater(MonthImmutable $monthToCompareWith)
    {
        $isLater = $this->isLaterMonthInSameYear($monthToCompareWith) || $this->isLaterYear($monthToCompareWith);

        return $isLater;
    }
}
