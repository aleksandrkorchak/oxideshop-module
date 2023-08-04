<?php

namespace Koralex\GoodsOnCredit\Model;

class_alias(\OxidEsales\Eshop\Application\Model\Article::class, 'Koralex\GoodsOnCredit\Model\Article_parent');

class Article extends Article_parent
{
    /**
     * Assigns to oxarticle object some additional parameters/values .
     *
     * @param array $aRecord Array representing current field values
     *
     * @return null
     */
    public function assign($aRecord)
    {
        parent::assign($aRecord);

        startProfile('articleAdditionalAssign');
            $this->assignInstallmentFields();
        stopProfile('articleAdditionalAssign');
    }


    public function isInstallmentable() {
        if ($this->oxarticles__oxprepayment instanceof \OxidEsales\Eshop\Core\Field &&
            $this->oxarticles__oxmonthsremain instanceof \OxidEsales\Eshop\Core\Field &&
            is_numeric($this->oxarticles__oxprepayment->value) &&
            is_numeric($this->oxarticles__oxmonthsremain->value) &&
            $this->oxarticles__oxprepayment->value > 0 &&
            $this->oxarticles__oxmonthsremain->value > 0 &&
            $this->oxarticles__oxprepayment->value <= $this->oxarticles__oxprice->value - 1)
        {
            return true;
        }

        return false;
    }

    public function getInstallmentBalance() {
        $balance = ($this->oxarticles__oxprice->value - $this->oxarticles__oxprepayment->value) / $this->oxarticles__oxmonthsremain->value;
        return round($balance, 2);
    }

    protected function assignInstallmentFields() {
        $this->oxarticles__oxprepayment = new \OxidEsales\Eshop\Core\Field($this->oxarticles__oxprepayment->value);
        $this->oxarticles__oxmonthsremain = new \OxidEsales\Eshop\Core\Field($this->oxarticles__oxmonthsremain->value);
    }


    /**
     * (\OxidEsales\Eshop\Application\Model\Article::_saveArtLongDesc()) save the object using parent::save() method.
     *
     * @return bool
     */
    public function save()
    {
        $this->validateInstallmentFieldsBeforeSave();

        $this->_assignParentDependFields();
        $blRet = parent::save();
        // saving long description
        $this->_saveArtLongDesc();

        return $blRet;
    }

    private function validateInstallmentFieldsBeforeSave() {
        if (isset($this->oxarticles__oxprepayment->value)) {
            if ($this->oxarticles__oxprepayment->value < 0 || !is_numeric($this->oxarticles__oxprepayment->value)) {
                $this->oxarticles__oxprepayment->value = 0;
            } elseif ($this->oxarticles__oxprepayment->value > $this->oxarticles__oxprice->value) {
                $this->oxarticles__oxprepayment->value = $this->oxarticles__oxprice->value;
            }
        }
        if (isset($this->oxarticles__oxmonthsremain->value) && $this->oxarticles__oxmonthsremain->value < 0) {
            $this->oxarticles__oxmonthsremain->value = 0;
        }
    }

}