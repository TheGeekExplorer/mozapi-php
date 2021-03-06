<?php

include_once('mozapi.php');

/**
 * Create a new MozAPI object, and query the API
 * for a domain name.
 */

$moz = new MozAPI;      # Create new Moz object
$moz->initialise();     # Initialise connection (sign)
$r = $moz->queryAPI([   # Query the domain in the API

    # Provide the site URL to be queried
    'url'  => 'http://www.markgreenall.co.uk',

    # Define the modes that should be queried
    'mode' => [
        'Title' => 1,
        'Canonical' => 1,
        'ExternalLinks' => 1,
        'Links' => 1,
        'MozRankURL' => 1,
        'MozRankSubdomain' => 1,
        'HTTPStatusCode' => 1,
        'PageAuthority' => 1,
        'DomainAuthority' => 1,
        'TimeLastCrawled' => 1
    ]
]);

# Dump results
var_dump($r);
