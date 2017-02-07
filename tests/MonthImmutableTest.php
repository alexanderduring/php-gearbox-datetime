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
            'PC: Without change in year.' => array(
                'preconditions' => array(
                    'monthString' => '2016-11',
                ),
                'expectations' => array(
                    'nextMonthString' => '2016-12'
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
                    'previousMonthString' => '2016-05'
                )
            ),
            'PC: Without change in year.' => array(
                'preconditions' => array(
                    'monthString' => '2016-12',
                ),
                'expectations' => array(
                    'previousMonthString' => '2016-11'
                )
            ),
            'PC: With change in year.' => array(
                'preconditions' => array(
                    'monthString' => '2016-01',
                ),
                'expectations' => array(
                    'previousMonthString' => '2015-12'
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

        $this->assertEquals($expectations['previousMonthString'], $nextMonth->getYearMonthString(), 'Method getPreviousMonth returns wrong value.');
        $this->assertEquals($expectations['previousMonthString'], $nextMonth->getYearMonthString(), 'Method getPreviousMonth returns wrong value.');
    }



    /**
     * @return array
     */
    public function getTestDataForAddMonths()
    {
        $defaultPreconditions = array(
            'monthString' => '2016-05'
        );

        $defaultExpectations = array(
            'throwsException' => false
        );

        $testCases = array(
            'PC: Postitive amount of months without change in year.' => array(
                'preconditions' => array(
                    'addMonths' => 3
                ),
                'expectations' => array(
                    'newMonthString' => '2016-08'
                )
            ),
            'PC: Postitive amount of months without change in year.' => array(
                'preconditions' => array(
                    'addMonths' => 7
                ),
                'expectations' => array(
                    'newMonthString' => '2016-12'
                )
            ),
            'PC: Postitive amount of months with change in year.' => array(
                'preconditions' => array(
                    'addMonths' => 8
                ),
                'expectations' => array(
                    'newMonthString' => '2017-01'
                )
            ),
            'PC: Postitive amount of months with change in year.' => array(
                'preconditions' => array(
                    'addMonths' => 19
                ),
                'expectations' => array(
                    'newMonthString' => '2017-12'
                )
            ),
            'PC: Postitive amount of months with change in year.' => array(
                'preconditions' => array(
                    'addMonths' => 20
                ),
                'expectations' => array(
                    'newMonthString' => '2018-01'
                )
            ),
            'PC: Negative amount of months without change in year.' => array(
                'preconditions' => array(
                    'addMonths' => -3
                ),
                'expectations' => array(
                    'newMonthString' => '2016-02'
                )
            ),
            'PC: Negative amount of months without change in year.' => array(
                'preconditions' => array(
                    'addMonths' => -4
                ),
                'expectations' => array(
                    'newMonthString' => '2016-01'
                )
            ),
            'PC: Negative amount of months with change in year.' => array(
                'preconditions' => array(
                    'addMonths' => -5
                ),
                'expectations' => array(
                    'newMonthString' => '2015-12'
                )
            ),
            'PC: Negative amount of months with change in year.' => array(
                'preconditions' => array(
                    'addMonths' => -16
                ),
                'expectations' => array(
                    'newMonthString' => '2015-01'
                )
            ),
            'PC: Negative amount of months with change in year.' => array(
                'preconditions' => array(
                    'addMonths' => -17
                ),
                'expectations' => array(
                    'newMonthString' => '2014-12'
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
     * @dataProvider getTestDataForAddMonths
     * @param array $preconditions
     * @param array $expectations
     */
    public function testAddMonths(array $preconditions, array $expectations)
    {
        if ($expectations['throwsException']) {
            $this->setExpectedException(Exception::class);
        }

        $month = new MonthImmutable($preconditions['monthString']);
        $nextMonth = $month->addMonths($preconditions['addMonths']);

        $this->assertEquals($expectations['newMonthString'], $nextMonth->getYearMonthString(), 'Method addMonths returns wrong value.');
        $this->assertEquals($expectations['newMonthString'], $nextMonth->getYearMonthString(), 'Method addMonths returns wrong value.');
    }



    /**
     * @return array
     */
    public function getTestDataForSubMonths()
    {
        $defaultPreconditions = array(
            'monthString' => '2016-05'
        );

        $defaultExpectations = array(
            'throwsException' => false
        );

        $testCases = array(
            'PC: Postitive amount of months without change in year.' => array(
                'preconditions' => array(
                    'subMonths' => 3
                ),
                'expectations' => array(
                    'newMonthString' => '2016-02'
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
     * @dataProvider getTestDataForSubMonths
     * @param array $preconditions
     * @param array $expectations
     */
    public function testSubMonths(array $preconditions, array $expectations)
    {
        if ($expectations['throwsException']) {
            $this->setExpectedException(Exception::class);
        }

        $month = new MonthImmutable($preconditions['monthString']);
        $nextMonth = $month->subMonths($preconditions['subMonths']);

        $this->assertEquals($expectations['newMonthString'], $nextMonth->getYearMonthString(), 'Method subMonths returns wrong value.');
        $this->assertEquals($expectations['newMonthString'], $nextMonth->getYearMonthString(), 'Method subMonths returns wrong value.');
    }
}
