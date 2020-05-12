<?php

namespace AppBundle\Service;

class PhoneNumberMasker
{
  public function mask($inputText)
  {
    return preg_replace('/([\d ]{3,})([\d ]{4})([\d ]{2})/', '$1****$3', $inputText);
  }
}