<?php
/**
 * hex2base64 encoding utility
 * 2/25/2020
 * ~Ilya Dyskin
 */
    const DEFAULT_TEST_RUNS = 10;
    const DEFAULT_BYTE_SIZE = 8;
    const RESPONSES = array(
        "no_args" => "No arguments have been provided.\n",
        "empty" => "Empty string has been provided.\n",
        "non_hex" => "Non-hexadecimal string has been provided.\n",
        "not_even" => "Input hexadecimal string must have an even length.\n"
    );

    /**
     * getRandomHex function: generated a random hexadecimal string based on the provided byte size
     * @param string $byteSize desired byte size
     * @return string randomly generated hexadecimal string
     */
    function getRandomHex( $byteSize ) {
        return bin2hex( openssl_random_pseudo_bytes( $byteSize ) );
    }

    /**
     * hex2Base64 function: encode input hexademical string with base64
     * @param string $input hexadecimal string to be encoded
     * @return string base64 encoded string
     */
    function hex2Base64( $input ) {
        // automatically convert all non-string inputs to string
        if( !is_string($input)) {
            $input = strval($input);
        }
        // check if the input string is in fact hexadecimal
        if( !ctype_xdigit( $input ) ) {
            throw new Exception("non_hex");
        }
        // check if the input string has an even length (can't convert it to binary otherwise)
        if( strlen( $input ) % 2 != 0 ) {
            throw new Exception("not_even");
        }
        return base64_encode( hex2bin( $input ) );
    }

    /**
     * testHex2Base64 function: test hex2base64 encoding functionality
     * @param int $testRuns optional desired amount of randomly generated strings
     * @param int $byteSize optional desired byte size of a randomly generated string
     */
    function testHex2Base64( $testRuns = 10, $byteSize = 8 ) {
        echo "Starting Hex2Base64 converter test runs...\n";
        echo "Number of runs: " . $testRuns . "\n";
        echo "Desired string byte size: " . $byteSize . "\n\n";
        for( $i = 0; $i < $testRuns; $i++ ) {
            $randHex = getRandomHex( $byteSize );
            $randBase64 = hex2Base64( $randHex );
            echo "Hex:\t" .$randHex . "\tBase64:\t" . $randBase64 . "\n";
        }
        echo "\nEnd test runs\n";
    }



    if( $argc == 1 ) {
        echo RESPONSES[ "no_args" ];
    } elseif( $argv[ 1] !== "test" ) {
        try {
            echo hex2Base64( $argv[ 1 ] ) . "\n";
        } catch( Exception $e ) {
            if( array_key_exists( $e->getMessage(), RESPONSES ) ) {
                echo RESPONSES[ $e->getMessage() ];
            } else {
                echo "Unknown exception:\t" . $e->getMessage() . ".\nTerminating...\n";
            }
        }
    } else {
        $numRuns = !empty( $argv[ 2 ] ) && is_numeric( $argv[ 2 ] ) ? intval( $argv[ 2 ] ) : DEFAULT_TEST_RUNS;
        $byteSize = !empty($argv[ 3 ] ) && is_numeric( $argv[ 3 ] ) ? intval( $argv[ 3 ] ) : DEFAULT_BYTE_SIZE;
        testHex2Base64( $numRuns, $byteSize );
    }