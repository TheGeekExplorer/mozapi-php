<?php

include_once('mozapi.php');


class MozAPI {

    # Provide your API details
    private $accessID = "";     # Provide your AccessID
    private $secretKey = "";    # Provide your SecretKey
    private $moz;

    # Initiate the connection
    public function initialise ()
    {
        # Define new object
        $this->moz = new mozapicore;

        # Prime with Credentials
        $this->moz->setCredentials(

        # Sign the request
            $this->moz->signFlow(array(
                'accessId' => '',      # Provide your AccessID
                'secretKey' => ''       # Provide your SecretKey
            ))
        );
    }

    # Query the Moz API
    public function queryAPI ($query)
    {
        return $this->$moz->query(
            $query
        );
    }
}

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
