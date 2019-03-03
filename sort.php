<?php

echo "Быстрая сортировка";

$array  = [1099,21,32,5,31,32,6,34,76,98,21,87,1,2,3,4,5,7,8,0,5,9];

function qSort(array $array) : array
{
    if (count($array) <=1) {
        return $array;
    }
    $pivotIndex = array_rand($array);
    $pivotVal = $array[$pivotIndex];
    unset($array[$pivotIndex]);
    $less = [];
    $greater = [];
    foreach ($array as $key => $value) {
        if ($value < $pivotVal) {
            $less[] = $value;
        } elseif ($value >= $pivotVal) {
            $greater[] = $value;
        }
    }
    return  array_merge(qSort($less),[$pivotVal] ,qSort($greater));
}
var_dump(qSort($array));



echo  "Сортировка пузырьком\n";

$array = [31,1,67,2,675,78,898,9,2,54,2,55,75];

$count = (count($array) - 1);
while (true) {
    $end = true;
    for ($i = 0; $i < $count; $i++) {
        $a = $array[$i];
        $b = $array[$i+1];

        if ($b < $a) {
            $array[$i] = $b;
            $array[$i+1] = $a;
            $end = false;
        }
    }
    if ($end === true) {
        break;
    }
}

print_r($array);

echo  "Сортировка выбором\n";
$array = [31,1,67,2,675,78,898,9,2,54,2,-10000,55,75,43,1,4,6,7,4,2,111211,0,-1,-2,54,54,2];


$lastElementIndex = 0;
$count = count($array)-1;
while (true) {
    $minIndex = $lastElementIndex;
    for ($i = $lastElementIndex; $i <= $count; $i++) {
        if ($array[$minIndex] > $array[$i]) {
            $minIndex = $i;
        }
    }
    if ($lastElementIndex !== $count) {
        $toPlace = $array[$lastElementIndex];
        $array[$lastElementIndex] = $array[$minIndex];
        $array[$minIndex] = $toPlace;
        $lastElementIndex++;
    } else {
        break;
    }
}

print_r($array);


echo "Сортировка вставками\n";

$array = [31,1,67,2,675,78,898,9,2,54,2,-10000,55,75,43,1,4,6,7,4,2,111211,0,-1,-2,54,54,2];

$count = count($array);

for ($i = 1; $i < $count; $i++) {
    $rightValue = $array[$i];
    $leftValue = $i - 1;

    while ($leftValue >= 0 && $array[$leftValue] > $rightValue) {
        $array[$leftValue + 1] = $array[$leftValue];
        $leftValue--;
    }
    $array[++$leftValue] = $rightValue;
}


print_r($array);


echo "Бинарный поиск\n";

$search = 1;

$minIndex = 0;
$maxIndex = count($array)-1;
while (true) {
    $center = (int) (($maxIndex + $minIndex) / 2);
    if ($search == $array[$center]) {
        echo "Нашли - ". $array[$center]. "\n";
        break;
    }


    if ($minIndex === $maxIndex) {
        echo "Значение не найдено\n";
        break;
    } elseif ($search < $array[$center]) {
        $maxIndex = $center-1;
    } elseif ($search > $array[$center]) {
        $minIndex = $center+1;
    }
}


echo "Линейный поиск";

foreach ($array as $key => $value) {
    if ($value === $search) {
        echo "Нашли - ". $value. "\n";
    }
}


/**
 * Class HashMap
 */
class HashMap
{
    private $size = 10;
    private $maxLineElements = 5;

    private $buckets = [];

    public function __construct()
    {
        $this->buckets = array_fill(0, $this->size, null);
    }

    public function set($key, $value)
    {
        $index = $this->createIndex($key);
        if ($this->buckets[$index] === null) {
            $this->buckets[$index] = [$key, $value];
        } else {
           $countElements = count($this->buckets[$index]) / 2;

           if ($countElements <= $this->maxLineElements) {

               $count = count($this->buckets[$index]);
               $this->buckets[$index][$count] = $key;
               $this->buckets[$index][$count+1] = $value;
           } else {
               $this->regenerate();
               $this->set($key, $value);
           }
        }
    }

    private function regenerate()
    {
        $oldBackets = $this->buckets;
        $this->size *= 2;
        $this->buckets = array_fill(0, $this->size, null);
        foreach ($oldBackets as $backet) {
            if ($backet === null) {
                continue;
            }
            $a = count($backet);
            for ($i = 0; $i <= $a; $i += 2) {
                if ($i == $a) {
                    break;
                }
                $key = $backet[$i];
                $value = $backet[$i+1];
                $this->set($key, $value);
            }
        }
    }

    private function createIndex($key)
    {
        $hash = $this->createHash($key);
        return $hash % $this->size;
    }

    private function createHash($key)
    {
        return crc32 ($key);
    }

    public function getValue($key)
    {
        $index = $this->createIndex($key);
        $count = count($this->buckets[$index]);
        if ($count == 2) {
            return $this->buckets[$index][1];
        } else {
            for ($i=0; $i <= $count; $i+=2) {
                if ($key == $this->buckets[$index][$i]) {
                    return $this->buckets[$index][$i+1];
                }
            }
        }
    }
}

$hashMap = new HashMap();

$hashMap->set('Andrey0', 'Привет');
for ($i = 0 ; $i < 1500; $i++) {
    $hashMap->set('Andrey0'.uniqid(), 'Привет'.uniqid());
}

$result = $hashMap->getValue('Andrey0');
$A = 1;
