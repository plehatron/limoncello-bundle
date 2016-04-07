LimoncelloBundle
================

LimoncelloBundle is an integration bundle for [neomerx/json-api](https://github.com/neomerx/json-api) and Symfony.

## Install

1. Download LimoncelloBundle using composer

```
$ composer require plehatron/limoncello-bundle "dev-master@dev"
```

2. Enable the bundle

```
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Plehatron\LimoncelloBundle\PlehatronLimoncelloBundle(),
        // ...
    );
}
```

## Create and register JSON API Schema classes

See [CategorySchema](Tests/Integration/Fixture/ApiBundle/Schema/CategorySchema.php) file from integration tests for an
example on how to write JSON API Schema classes.

Register a map of schema and corresponding entity classes:
```
# app/config.yml
# ...

plehatron_limoncello:
    schemas:
        ApiBundle\Entity\Category: ApiBundle\Schema\CategorySchema
```

## Create and register JSON API Controllers

API controllers should extend abstract `JsonApiController` class which has full JSON API support provided by the
[neomerx/limoncello](https://github.com/neomerx/limoncello) package.

See [CategoryController](Tests/Integration/Fixture/ApiBundle/Controller/CategoryController.php) file for an example on
how to write JSON API Controllers,

## Versioning

This bundle is following [Semantic Versioning](http://semver.org/) scheme.

## Testing

Run tests with:

```
$ vendor/bin/phpunit
```

## Credits

- [Neomerx](https://github.com/neomerx)
- [Drew Clauson](https://github.com/drewclauson)
- [All Contributors](../../contributors)

This bundle is loosely based on [elytus-limoncello-bundle](https://github.com/drewclauson/elytus-limoncello-bundle).

## License

Apache License (Version 2.0). Please see [License File](LICENSE) for more information.
