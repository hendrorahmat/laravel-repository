<?php

namespace App\Packages\Coupon\Validator;

use App\Packages\Coupon\Validator\RuleValidator;

class CouponValidator
{
    /**
     * @var RuleValidator[]
     */
    private $rules = [];

    public function addRules(RuleValidator ...$ruleValidator)
    {
        $this->rules = array_merge($this->rules, $ruleValidator);

        return $this;
    }

    public function validate()
    {
        foreach ($this->rules as $rule) {
            $rule->validate();
        }
    }
}
