# Very short description of the package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/anthony-dee/collection-macros.svg?style=flat-square)](https://packagist.org/packages/anthony-dee/collection-macros)
This package houses some macros that extend the Laravel `Collection`. It currently only contains one, `pluckThenGroupBy` 

## Installation

You can install the package via composer:

```bash
composer require anthony-dee/collection-macros
```

## Usage
### `pluckThenGroupBy`
A combination of the native `groupBy` and `pluck` methods. It takes up to three keys and at least two. The first is the `$groupBy` key, the second (`$pluckValue`) is value to pluck and the third, if given, is used to key the plucked values.

A good use for this is to prepare a collection to be used as a data source for `optgroup` labels and `option` values and text. 
```php
$collection = collect([
            ['id' => 1, 'name' => 'Lesson 1', 'module' => 'Basics', 'reward' => 'gold'],
            ['id' => 2, 'name' => 'Lesson 2', 'module' => 'Basics', 'reward' => 'silver'],
            ['id' => 3, 'name' => 'Lesson 3', 'module' => 'Advanced', 'reward' => 'silver'],
            ['id' => 4, 'name' => 'Lesson 4', 'module' => 'Advanced', 'reward' => 'gold'],
            ['id' => 5, 'name' => 'Lesson 4', 'module' => 'Advanced', 'reward' => 'silver'],
        ]);

$collection->pluckThenGroupBy('module', 'reward', 'name');

// [
//   "Basics" =>  [
//     "Lesson 1" => "gold"
//     "Lesson 2" => "silver"
//   ]
//   "Advanced" =>  [
//     "Lesson 3" => "silver"
//     "Lesson 4" => "silver"
//   ]
// ]
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

-   [Anthony Douglas](https://github.com/     anthony-dee)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
