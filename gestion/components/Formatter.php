<?php
namespace app\components;

class Formatter extends \yii\i18n\Formatter
{
    public function asRoundedCurrency($value, $currency)
    {
        return $this->asInteger(round($value)) . ' ' . $currency;
    }
}