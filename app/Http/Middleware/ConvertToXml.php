<?php

namespace App\Http\Middleware;

use Closure;

class ConvertToXml
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if ($response->original instanceof \JsonSerializable) {
            // Converter o JSON para XML
            $xml = $this->arrayToXml($response->original);
            $response->header('Content-Type', 'application/xml');
            $response->setContent($xml);
        }

        return $response;
    }

    private function arrayToXml($array, $xml = false)
    {
        if ($xml === false) {
            $xml = new \SimpleXMLElement('<root/>');
        }

        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $this->arrayToXml($value, $xml->addChild($key));
            } else {
                $xml->addChild($key, $value);
            }
        }

        return $xml->asXML();
    }
}

