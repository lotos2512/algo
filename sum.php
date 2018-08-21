<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 28.02.19
 * Time: 22:55
 */


$array = [1,2,3,4,5,6,7,1000,8,9];

function sum(int $a, int $b, array $array) : int
{
    /**
     * допусти оба числа у нас есть
     */
    $indexA = array_search($a,$array);
    $indexB = array_search($b,$array);
    $newArray = [];
    for($i = $indexA; $i <= $indexB; $i++) {
        $newArray[] = $array[$i];
    }
    return _sum($newArray);
}


function _sum(array $array)
{
    $sum = array_shift($array);
    if (!isset($array[0])) {
        return $sum;
    }
    $sum += _sum($array);
    return $sum;
}
echo sum(1, 9, $array);


ini_set('xdebug.max_nesting_level', 1800);
die();

/**
 * @param int $a
 * @param int $b
 * @return array
 * @throws Exception
 */
function searchMaxSquare(int $a ,int $b) : array
{
    if ($b <= 0 | $a <= 0) {
        throw new \Exception("wrong arguments - \$a({$a}), \$b({$b})\n. The arguments can`t accept value less number 1");
    }
    if ($a < $b) {
        $temp = $b;
        $b = $a;
        $a = $temp;
    }
    return _searchMaxSquare($a, $b);
}
/**
 * @param int $a
 * @param int $b
 * @return array
 * @throws Exception
 */
function _searchMaxSquare(int $a ,int $b) : array
{
    if ($a % $b === 0) {;
        return [$b, $b];
    }
    $b = $a - $b;
    $a = $a - $b;
    return searchMaxSquare($a, $b) ;
}

function generator(int $count)
{
    $i = 1;
    yield [2, 365];
    yield [1680, 640];
    yield [640, 1680];
    while ($i <= $count) {
        $i++;
        yield [rand(1800,1000),rand(700,100)];
    }
}

foreach (generator(20) as $resolution) {
    $result = searchMaxSquare($resolution[0], $resolution[1]);
    if ($result[0] > 1) {
        var_dump("resolution {$resolution[0]}X{$resolution[1]} - $result[0]");
    }
}
