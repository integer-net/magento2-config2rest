# IntegerNet_Config2Rest Magento Module
<div align="center">

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
![Supported Magento Versions][ico-compatibility]

[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Maintainability][ico-maintainability]][link-maintainability]
</div>

---

Enables Magento Editors to expose custom config path values via REST API

## Installation

1. Install it into your Magento 2 project with composer:
    ```
    composer require integer-net/magento2-config2rest
    ```

2. Enable module
    ```
    bin/magento setup:upgrade
    ```

## Configuration

Go to

`Stores > Configurations > Services > Config to REST`

and add an item for every config path you'd like to expose. 

Notation example: `contact/email/recipient_email`

## API 

### Config path as object tree (default)

- Call `en/V1/configtorest`
- Method `GET`

**Please note that `en` before `/V1/` is store code. It is important to specify it.**

#### Returns:

Example path: `contact/email/recipient_email`

JSON Object

```json
{ 
  "config": {
    "contact": {
      "email": {
        "recipient_email": "john.doe@my-domain.com"
      }
    }
  }
}
```

### Config path as "flat" key/value pairs 

- Call `en/V1/configtorest/flat`
- Method `GET`

**Please note that `en` before `/V1/` is store code. It is important to specify it.**

#### Returns:

Example path: `contact/email/recipient_email`

JSON Object

```json
{ 
  "config": {
    "contact/email/recipient_email": "john.doe@my-domain.com"
  }
}

```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Testing

### Unit Tests

```
vendor/bin/phpunit tests/unit
```

### Magento Integration Tests

0. Configure test database in `dev/tests/integration/etc/install-config-mysql.php`. [Read more in the Magento docs.](https://devdocs.magento.com/guides/v2.4/test/integration/integration_test_execution.html) 

1. Copy `tests/integration/phpunit.xml.dist` from the package to `dev/tests/integration/phpunit.xml` in your Magento installation.

2. In that directory, run
    ``` bash
    ../../../vendor/bin/phpunit
    ```


## Security

If you discover any security related issues, please email sw@integer-net.de instead of using the issue tracker.

## Credits

- [Sandro Wagner][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.

[ico-version]: https://img.shields.io/packagist/v/integer-net/magento2-config2rest.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/integer-net/magento2-config2rest/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/integer-net/magento2-config2rest?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/integer-net/magento2-config2rest.svg?style=flat-square
[ico-maintainability]: https://img.shields.io/codeclimate/maintainability/integer-net/magento2-config2rest?style=flat-square
[ico-compatibility]: https://img.shields.io/badge/magento-2.4-brightgreen.svg?logo=magento&longCache=true&style=flat-square

[link-packagist]: https://packagist.org/packages/integer-net/magento2-config2rest
[link-travis]: https://travis-ci.org/integer-net/magento2-config2rest
[link-scrutinizer]: https://scrutinizer-ci.com/g/integer-net/magento2-config2rest/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/integer-net/magento2-config2rest
[link-maintainability]: https://codeclimate.com/github/integer-net/magento2-config2rest
[link-author]: https://github.com/integer-net
[link-contributors]: ../../contributors
