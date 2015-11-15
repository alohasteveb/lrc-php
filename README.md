# LRC PHP is an implementation of Longitudinal Redundancy Check in PHP

## Usage:

```php

require('Lrc.class.php');

$myLrc = new \AlohaSteve\Lrc();

$myLrc->setEndSymbol($endSymbol);

$extendedMessage = $startSymbol . $baseMessage . $endSymbol . $myLrc->getCheck($baseMessage); //LRC calculation includes termination/ending symbol but not start symbol

```
