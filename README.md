[![Total Downloads](https://poser.pugx.org/crease29/openiban-client/downloads)](https://packagist.org/packages/crease29/openiban-client)
[![GitHub issues](https://img.shields.io/github/issues/Crease29/openiban-php-client.svg)](https://github.com/Crease29/openiban-php-client/issues)
[![GitHub stars](https://img.shields.io/github/stars/Crease29/openiban-php-client.svg)](https://github.com/Crease29/openiban-php-client/stargazers)
[![GitHub forks](https://img.shields.io/github/forks/Crease29/openiban-php-client.svg)](https://github.com/Crease29/openiban-php-client/network)
[![License](https://poser.pugx.org/crease29/openiban-client/license)](https://packagist.org/packages/crease29/openiban-client)
[![Twitter](https://img.shields.io/twitter/url/https/github.com/Crease29/openiban-php-client.svg?style=social)](https://twitter.com/intent/tweet?text=Wow:&url=%5Bobject%20Object%5D)

# OpenIBAN.com PHP Client

If you have any questions, drop me an email: [info@webchimp.de](mailto:info@webchimp.de)

Feel free to contribute! :)

Thanks to [@fourcube](https://github.com/fourcube) for providing a simple IBAN API! 


## Install via Composer

    composer install crease29/openiban-client
    
## Usage

openiban.com documentation: [https://openiban.com/](https://openiban.com/)

### Technical validation of IBAN numbers
    
    require 'vendor/autoload.php';
    
    use OpenIban\Client;
    
    $client = new Client();
    $IBAN   = 'DE89370400440532013000';
    
    $check1 = $client->validate($IBAN); // $validateBankCode = false, $getBIC = false
    $check2 = $client->validate($IBAN, true); // $validateBankCode = true, $getBIC = false
    $check3 = $client->validate($IBAN, true, true); // $validateBankCode = true, $getBIC = true
    
### Calculation of IBAN numbers

    require 'vendor/autoload.php';
    
    use OpenIban\Client;
    
    $client = new Client();
    $IBANData = $client->calculate('DE', '37040044', '0532013000');
    
### Running tests with PHPUnit

    $ $(which phpunit) --bootstrap vendor/autoload.php tests
    
## Licence

This project uses the [GNU General Public License v3.0](LICENCE.md).