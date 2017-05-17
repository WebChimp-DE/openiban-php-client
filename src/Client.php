<?php

namespace OpenIban;

/**
 * OpenIbanClient is a client for the API under openiban.com.
 *
 * @package    openiban-php-client
 * @author     Kai Neuwerth <info@webchimp.de>
 * @copyright  2017 Kai Neuwerth
 * @license    https://www.gnu.org/licenses/gpl-3.0.en.html
 * @link       https://github.com/Crease29/openiban-php-client
 * @version    1.0.0
 */
class Client
{
    /** @const string CLIENT_VERSION */
    const CLIENT_VERSION = '1.0.0';

    /** @const string API_URL */
    const API_URL = 'https://openiban.com';

    /** @const string ROUTE_VALIDATE */
    const ROUTE_VALIDATE = '/validate';

    /** @const string ROUTE_CALCULATE */
    const ROUTE_CALCULATE = '/calculate';

    /**
     * @param $url
     * @throws \Exception
     *
     * @return bool|array
     */
    private function getApiResponse($url)
    {
        // is cURL installed yet?
        if (!function_exists('curl_init')) {
            throw new \Exception('Sorry cURL is not installed.');
        }

        $res = curl_init();
        curl_setopt($res, CURLOPT_URL, $url);
        curl_setopt($res, CURLOPT_USERAGENT, "openiban-php-client/" . self::CLIENT_VERSION);
        curl_setopt($res, CURLOPT_HEADER, 0);
        curl_setopt($res, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($res, CURLOPT_TIMEOUT, 5);

        $output = curl_exec($res);

        curl_close($res);

        return $output ? json_decode($output, true) : $output;
    }

    /**
     * Adds query string to given URL.
     *
     * @param $url
     * @param array $params
     * @return string
     */
    private function buildUrl($url, $params = [])
    {
        $query = http_build_query($params);

        if (!empty($query)) {
            $url .= '?' . $query;
        }

        return $url;
    }

    /**
     * Technical validation of IBAN numbers.
     *
     * @param string $IBAN
     * @param bool $validateBankCode
     * @param bool $getBIC
     *
     * @return array|bool
     */
    public function validate($IBAN, $validateBankCode = false, $getBIC = false)
    {
        $params = [];

        if ($validateBankCode === true) {
            $params['validateBankCode'] = 'true';
        }

        if ($getBIC === true) {
            $params['getBIC'] = 'true';
        }

        return $this->getApiResponse(
            $this->buildUrl(
                self::API_URL . self::ROUTE_VALIDATE . '/' . $IBAN,
                $params
            )
        );
    }

    /**
     * Calculation of IBAN numbers.
     *
     * @param string $countryCode ALPHA-2 (ISO-3166) country code (e.g. DE, US, GB, RU)
     * @param string $bankCode
     * @param string $accountNumber
     *
     * @return array|bool
     */
    public function calculate($countryCode, $bankCode, $accountNumber)
    {
        return $this->getApiResponse(
            $this->buildUrl(
                self::API_URL . self::ROUTE_CALCULATE . '/'
                . strtoupper($countryCode) . '/'
                . $bankCode . '/'
                . $accountNumber
            )
        );
    }
}