<?php
/**
 * Created by PhpStorm.
 * User: Hoang Dang
 * Date: 9/21/2016
 * Time: 10:49 AM
 */

namespace app\Models\Traits;

use Illuminate\Support\Facades\Validator;

/**
 * Class ValidationTrait
 * @package app\Models\Traits
 *
 * declare protected static $rules in model which uses this
 */
trait ValidationTrait
{
    /**
     * get rules of validation model
     *
     * @return mixed
     */
    public static function getRules(){
        return static::$rules;
    }

    /**
     * return result for validation a set of $attributes for model
     * TRUE if pass
     * array if fail
     *
     * @param array $attributes
     * @param array $unique use for add except value for unique rule
     * @return array|bool
     * @throws \Exception
     */
    public static function validate(array $attributes, $unique =[])
    {
        try{
            $f_rules = static::$rules;
        }catch (\Exception $e){
            throw new \Exception('$rule variable is not set in model');
        }
        // modify rules for update unique field
        if (!empty($unique)){
            foreach ($unique as $field => $value){
                $f_rules[$field] .= ','.$value;
            }
        }

        // make a new validator object
        $v = Validator::make($attributes, $f_rules);

        // check for failure
        if ($v->fails())
        {
            $invalidInputs = $v->invalid();
            $defaultMessages = $v->errors()->all();

            return static::makeMessages($invalidInputs, $defaultMessages);
        }

        return TRUE;
    }

    /**
     * generate a custom message string for repository
     *
     * @param array $invalidInputs   get from validator class invalid()
     * @param array $defaultMessages get from validator class errors->all()
     * @return string
     */
    protected static function makeMessages(array $invalidInputs, array $defaultMessages){
        $messages = "";

        $index = 0;
        foreach ($invalidInputs as $field => $input){
            $messages .= str_replace($field, $field. ' "' .$input. '"', $defaultMessages[$index++]);
        }

        return $messages;
    }
}