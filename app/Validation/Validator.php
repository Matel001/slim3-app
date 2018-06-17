<?php
/**
 * Created by PhpStorm.
 * User: Kuba
 * Date: 2018-06-16
 * Time: 15:57
 */

namespace App\Validation;
use Respect\Validation\Validator as Respect;
use Respect\Validation\Exceptions\NestedValidationException;
class Validator
{
    protected $errors;

    private function translateMessage($message){
        $language = 'pl';
        $messages = [
            '{{name}} must not be empty' => [
                'pl' => '{{name}} nie może być puste!'
            ],
            '{{name}} must contain only letters (a-z)' => [
                'pl' => '{{name}} może zawierać tylko litery (a-z).'
            ]
        ];
        return $messages[$message][$language];
    }

    public function validate($request, array $rules){
        foreach ($rules as $field => $rule){
            try{
                $rule->setName($field)->assert($request->getParam($field));

            }catch(NestedValidationException $e){
                $this->errors[$field] = $e->getMessages();
                //TO DO: translate messages
            }
        }
        $_SESSION['errors'] = $this->errors;

        return $this;
    }

    public function failed(){
        return !empty($this->errors);
    }

}