Luhnar
======

Validate personnumer (social security numbers)

Name inspired by the Luhn algorithm used to validate swedish personnummer.

Usage:

    $validator = new Rickard2\Luhnar\Validator();

    $validator->validate('9909193766', 'se'); // true
    $validator->validate('9909193776', 'se'); // false

The swedish validator will accept input in the following formats:

* YYMMDD-NNGC
* YYMMDD-NNGC
* YYMMDD+NNGC
* YYYYMMDDNNGC
* YYYYMMDD-NNGC
* YYYYMMDD+NNGC

Source: http://en.wikipedia.org/wiki/National_identification_number#Sweden

The finnish validator will accept input in the following formats:

* DDMMYYCZZZQ

Source: http://en.wikipedia.org/wiki/National_identification_number#Finland

JavaScript Equivalent: https://github.com/rickard2/luhnarjs

Symfony2 validator: https://github.com/rickard2/luhnar-validator