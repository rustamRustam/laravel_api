<?php

namespace App\Services;


class CheckSerialNumberService
{
    static public function execute($mask, $serial_number) {
      // N – цифра от 0 до 9; \d
      // A – прописная буква латинского алфавита; [A-Z]
      // a – строчная буква латинского алфавита; [a-z]
      // X – прописная буква латинского алфавита либо цифра от 0 до 9;[A-Z0-9]
      // Z –символ из списка: “-“, “_”, “@”.[\-_@]
      $pattern = '/';
      foreach (mb_str_split($mask) as $char) {
        switch ($char) {
          case 'N':
            $pattern .= '\d';
            break;
          case 'A':
            $pattern .= '[A-Z]';
            break;
          case 'a':
            $pattern .= '[a-z]';
            break;
          case 'X':
            $pattern .= '[A-Z0-9]';
            break;
          case 'Z':
            $pattern .= '[\-_@]';
            break;
        }
      };
      $pattern .= '/';

      return preg_match($pattern, $serial_number);

    }

}
