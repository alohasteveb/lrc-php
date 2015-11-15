<?php

namespace AlohaSteve;

/**
* Implementation of Longitudinal Redundancy Check.
*
* @author Steve Be
* @version 0.1.0
*
*/

class Lrc {
  private $endSymbol = NULL;

/**
* @param string $symbol A 1-byte or 1-character end symbol. Use a single-byte character set.
* @throws \LrcConfigurationException If parameter is not a single character/byte
*/
  public function setEndSymbol($symbol = NULL) {
    if (is_null($symbol) || (strlen($symbol) !== 1)) throw new LrcConfigurationException("End symbol must be exactly 1 byte long.");

    $this->endSymbol = $symbol;
  }


  /**
  * @param string $message A non-empty message for which to generate the check byte/character. Use a single-byte character set.
  * @throws \LrcConfigurationException If end symbol is not set or message is empty.
  */

  public function getCheck($message = NULL) {
    if (is_null($this->endSymbol)) throw new LrcConfigurationException("End Symbol must be set to generate a check.");
    if (is_null($message) || (strlen($message) === 0)) throw new LrcConfigurationException("Messages must be at least 1 byte long.");

    $extendedMessage = $message . $this->endSymbol;

    $extendedMessageLength = strlen($extendedMessage);

    $check = substr($extendedMessage, 0, 1);
    for ($i = 1; $i < $extendedMessageLength ; $i++) {
            $check ^= substr($extendedMessage, $i, 1);
    }
    return $check;
  }
}


class LrcException extends \Exception {};
class LrcConfigurationException extends LrcException {};
