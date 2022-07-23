<?php

namespace Strategio\Helper;

class CareerHelper
{
    /**
     * @param array<int,array{descriptionExtra:string|null}> $items
     * @return array<int,int>
     */
    public static function getSalaries(array $items) : array
    {
        $salaries = [];
        foreach ($items as $item) {
            $salary = (int) $item['descriptionExtra'];
            $salaries[$salary] = $salary;
        }
        
        sort($salaries, SORT_NUMERIC);
        
        return $salaries;
    }
    
    /**
     * @param array<int,array{descriptionShort:string|null}> $items
     * @return array<string,string>
     */
    public static function getShortJobNames(array $items): array
    {
        $jobNames = [];
        foreach ($items as $item) {
            $jobName = $item['descriptionShort'];
            if ($jobName) {
                $jobNames[$jobName] = $jobName;
            }
        }
    
        sort($jobNames, SORT_LOCALE_STRING);
    
        return $jobNames;
    }
}