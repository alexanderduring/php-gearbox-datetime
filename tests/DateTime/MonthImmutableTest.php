<?php

namespace Gearbox\DateTime;

use PHPUnit_Framework_TestCase;

class MonthImmutableTest extends PHPUnit_Framework_TestCase
{
    /**
     * @return array
     */
    public static function getTestData()
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
     * @dataProvider getTestData
     * @param array $preconditions
     * @param array $expectations
     */
    public function testConstructor(array $preconditions, array $expectations)
    {
        if ($expectations['throwsException']) {
            $this->setExpectedException('Gearbox\\DateTime\\Exception');
        }

        $month = new MonthImmutable($preconditions['monthString']);
    }
}
