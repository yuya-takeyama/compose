# compose

Function to compose functions.

Function-composition is commonly used technique in functional programming.  
You can combine any `callable`'s to build another function.'  

All of composed functions should take only one argument and return result.

## Usage

```php
<?php
use function yuyat\compose;

$splitAsWords = function ($str) {
    return \preg_split('/\s+/u', $str);
};
$camelizeWords = function ($words) {
    return \array_map('ucfirst', $words);
};
$join = function ($words) {
    return \join('', $words);
};
$lowerCamelize = compose('lcfirst', $join, $camelizeWords, $splitAsWords);

echo $lowerCamelize(); // => "fooBarBaz"

## Author

Yuya Takeyama
