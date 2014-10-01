# yuyat\compose

Function to compose functions.

Function-composition is commonly used technique in functional programming.  
You can combine any `callable`'s to build another function.

This library only supports PHP 5.6  later.  
If you use the other version, [igorw/compose](https://github.com/igorw/compose) is useful.

## Usage

### yuyat\compose

`compose($f, $g, $h)` is same as `$h($g($f))`

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

echo $lowerCamelize('foo bar baz'); // => "fooBarBaz"
```

### yuyat\pipeline

This function also combines functions, but the arguments order is reversed.  
Functions are applied in order of your reading.

`pipeline($f, $g, $h)` is same as `$f($g($h))`

## Author

Yuya Takeyama
