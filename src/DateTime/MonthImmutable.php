<?php

namespace Gearbox\DateTime;

class MonthImmutable
{
    /** @var integer */
    private $month;

    /** @var integer */
    private $year;



    /**
     * @param string $monthString Optional description of the month in the format 'YYYY-MM'.
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
}
