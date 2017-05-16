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
    
    use OpenIban\OpenIbanClient;
    
    $client = new OpenIbanClient();
    $IBAN   = 'DE89370400440532013000';
    
    $check1 = $client->validate($IBAN); // $validateBankCode = false, $getBIC = false
    $check2 = $client->validate($IBAN, true); // $validateBankCode = true, $getBIC = false
    $check3 = $client->validate($IBAN, true, true); // $validateBankCode = true, $getBIC = true
    
### Calculation of IBAN numbers

    require 'vendor/autoload.php';
    
    use OpenIban\OpenIbanClient;
    
    $client = new OpenIbanClient();
    $IBANData = $client->calculate('DE', '37040044', '0532013000');
    
## Licence

This project uses the (GNU General Public License v3.0)[LICENCE.md].
