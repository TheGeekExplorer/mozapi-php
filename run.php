<?php
    
    include_once('mozapi.php');
    
    // Define new object
    $__MOZAPI = new mozapi;

    // Prime with Credentials
    $__MOZAPI->setCredentials(
        $__MOZAPI->signFlow(array(
            'accessId'  => 'member-8d8a9f5907',
            'secretKey' => '7bfa73c021e576c3ef5a27c3faf052c1'
        ))
    );

    // Query the API
    $r = $__MOZAPI->query(array(
        'url'  => 'http://www.booker.co.uk', 
        'mode' => array(
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
        )
    ));

    // Dump returned...
    var_dump($r);
