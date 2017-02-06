<?php

namespace Gearbox\DateTime;

use PHPUnit_Framework_TestCase;

class MonthImmutableTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return array
     */
    public function getTestDataForConstructor()
    {
        $defaultPreconditions = array(
            'monthString' => '2016-01',
        );

        $defaultExpectations = array(
            'throwsException' => false
        );

        $testCases = array(
            'NC: Month string without hyphen.' => array(
                'preconditions' => array(
                    'monthString' => '201602',
                ),
                'expectations' => array(
                    'throwsException' => true
                )
            ),
            'NC: Year with two digits.' => array(
                'preconditions' => array(
                    'monthString' => '16-02',
                ),
                'expectations' => array(
                    'throwsException' => true
                )
            ),
            'NC: Year with letters.' => array(
                'preconditions' => array(
                    'monthString' => 'MMXV-02',
                ),
                'expectations' => array(
                    'throwsException' => true
                )
            ),
            'NC: Month with one digit.' => array(
                'preconditions' => array(
                    'monthString' => '2016-2',
                ),
                'expectations' => array(
                    'throwsException' => true
                )
            ),
            'NC: Month with letters.' => array(
                'preconditions' => array(
                    'monthString' => '2016-II',
                ),
                'expectations' => array(
                    'throwsException' => true
                )
            ),
            'PC: No Errors' => array(
                'preconditions' => array(
                ),
                'expectations' => array(
                )
            )
        );

        // Merge test data with default data
        foreach ($testCases as &$testCase) {
            $testCase['preconditions'] = array_merge($defaultPreconditions, $testCase['preconditions']);
            $testCase['expectations'] = array_merge($defaultExpectations, $testCase['expectations']);
        }

        return $testCases;
    }



    /**
     * @dataProvider getTestDataForConstructor
     * @param array $preconditions
     * @param array $expectations
     */
    public function testConstructor(array $preconditions, array $expectations)
    {
        if ($expectations['throwsException']) {
            $this->setExpectedException(Exception::class);
        }

        $month = new MonthImmutable($preconditions['monthString']);
    }



    /**
     * @return array
     */
    public function getTestDataForGetNextMonth()
    {
        $defaultPreconditions = array(
        );

        $defaultExpectations = array(
            'throwsException' => false
        );

        $testCases = array(
            'PC: Without change in year.' => array(
                'preconditions' => array(
                    'monthString' => '2016-06',
                ),
                'expectations' => array(
                    'nextMonthString' => '2016-07'
                )
            ),
            'PC: With change in year.' => array(
                'preconditions' => array(
                    'monthString' => '2016-12',
                ),
                'expectations' => array(
                    'nextMonthString' => '2017-01'
                )
            )
        );

        // Merge test data with default data
        foreach ($testCases as &$testCase) {
            $testCase['preconditions'] = array_merge($defaultPreconditions, $testCase['preconditions']);
            $testCase['expectations'] = array_merge($defaultExpectations, $testCase['expectations']);
        }

        return $testCases;
    }



    /**
     * @dataProvider getTestDataForGetNextMonth
     * @param array $preconditions
     * @param array $expectations
     */
    public function testGetNextMonth(array $preconditions, array $expectations)
    {
        if ($expectations['throwsException']) {
            $this->setExpectedException(Exception::class);
        }

        $month = new MonthImmutable($preconditions['monthString']);
        $nextMonth = $month->getNextMonth();

        $this->assertEquals($expectations['nextMonthString'], $nextMonth->getYearMonthString(), 'Method getNextMonth returns wrong value.');
    }



    /**
     * @return array
     */
    public function getTestDataForGetPreviousMonth()
    {
        $defaultPreconditions = array(
        );

        $defaultExpectations = array(
            'throwsException' => false
        );

        $testCases = array(
            'PC: Without change in year.' => array(
                'preconditions' => array(
                    'monthString' => '2016-06',
                ),
                'expectations' => array(
                    'nextMonthString' => '2016-05'
                )
            ),
            'PC: With change in year.' => array(
                'preconditions' => array(
                    'monthString' => '2016-01',
                ),
                'expectations' => array(
                    'nextMonthString' => '2015-12'
                )
            )
        );

        // Merge test data with default data
        foreach ($testCases as &$testCase) {
            $testCase['preconditions'] = array_merge($defaultPreconditions, $testCase['preconditions']);
            $testCase['expectations'] = array_merge($defaultExpectations, $testCase['expectations']);
        }

        return $testCases;
    }



    /**
     * @dataProvider getTestDataForGetPreviousMonth
     * @param array $preconditions
     * @param array $expectations
     */
    public function testGetPreviousMonth(array $preconditions, array $expectations)
    {
        if ($expectations['throwsException']) {
            $this->setExpectedException(Exception::class);
        }

        $month = new MonthImmutable($preconditions['monthString']);
        $nextMonth = $month->getPreviousMonth();

        $this->assertEquals($expectations['nextMonthString'], $nextMonth->getYearMonthString(), 'Method getPreviousMonth returns wrong value.');
    }
}
