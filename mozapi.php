<?php
    
    class mozapi
    {
        private $accessId  = '';
        private $expires   = 0;
        private $signature = '';
        private $modeValues  = array(
            'Title' => 1,
            'Canonical' => 4,
            'ExternalLinks' => 32,
            'Links' => 2048,
            'MozRankURL' => 16384,
            'MozRankSubdomain' => 32768,
            'HTTPStatusCode' => 536870912,
            'PageAuthority' => 34359738368,
            'DomainAuthority' => 68719476736,
            'TimeLastCrawled' => 144115188075855872
        );
        
        // Query the API
        public function query($args)
        {
            // Translate Mode
            $modeTranslated = $this->translateMode($args['mode']);
            
            // Query the API for DA and PA
            return $this->runQuery(
                array(
                    'accessId'  => $this->accessId,
                    'expires'   => $this->expires, 
                    'signature' => $this->signature,
                    'mode'      => $modeTranslated,
                    'url'       => $args['url']
                )
            );
        }
        
        // Set the credentials for the API
        public function setCredentials($args)
        {
            if(!is_array($args) || !isset($args['accessId']) || empty($args['accessId']) || !isset($args['expires']) || empty($args['expires']) || !isset($args['signature']) || empty($args['signature']))
                throw new Exception('ERROR. Credentials have not been provided.');
            
            $this->accessId  = $args['accessId'];
            $this->expires   = $args['expires'];
            $this->signature = $args['signature'];
        }
        
        // Build the integer for Mode request
        private function translateMode($mode)
        {
            $modal = 0;
            foreach($mode as $k => $v)
            {
                if(($v == 1 || $v) && isset($this->modeValues[$k]))
                    $modal += $this->modeValues[$k];
            }
            return $modal;
        }
        
        private function runQuery($args)
        {
            $accessId  = $args['accessId'];     $expires = $args['expires'];
            $signature = $args['signature'];    $mode    = $args['mode'];
            $url       = $args['url'];
            
            return file_get_contents("http://lsapi.seomoz.com/linkscape/url-metrics/$url?Cols=$mode&AccessID=$accessId&Expires=$expires&Signature=$signature");
        }
        
        public function signFlow($args)
        {
            // Define expiry time
            $expires = time() + 300;
            
            // Create the string that should be signed...
            $property = $args['accessId'] . "\n" . $expires;
            
            // Create the signature...
            $hashSignature = hash_hmac(
                'sha1', 
                $property, 
                $args['secretKey'], 
                true
            );
            
            return array(
                'accessId'  => $args['accessId'],
                'expires'   => $expires,
                'signature' => urlencode(
                    base64_encode($hashSignature)
                )
            );
        }
        
    }

