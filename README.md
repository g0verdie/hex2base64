# Hex to Base64 encoding String Conversion Utility

## Runtime Requirements

PHP Version: ^5-^7

## Usage Instructions

1. Navigate to directory
2. Run `hex2base64.php <input string>`
3. Observe Result

## Known Exception States

* No arguments provided
* Empty input string provided
* Non-hex input string provided
* Uneven length hex input string provided

## Testing

This utility has basic testing functionality built in that generates a certain amount (configurable in input arguments) hexadecimal strings from a certain byte size (configurable in in input arguments).

1. Navigate to directory
2. Run `hex2base64.php test <(optional) number of hex string to generate> <(optional) desired byte size>`
3. Observe results
