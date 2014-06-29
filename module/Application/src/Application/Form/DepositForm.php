<?php
/**
 * DepositForm
 * 
 * @author Vasil Dakov <vasildakov@gmail.com>
 */

namespace Application\Form;

use Zend\Form\Form;

class LoginForm extends Form
{
    public function __construct($name = null)
    {
        parent::__construct('deposit');

        $this->setAttributes( array(
            'role' => 'form', 
            'method' => 'post', 
            'class' => 'form-horizontal') 
        );

        $this->add(array(
            'name' => 'amount',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' => 'Amount',
                'class' => 'form-control'
            ),
            'options' => array(
                'label' => 'Amount',
                'label_attributes' => array(
                    'for' => 'Amount',
                    'class'  => 'control-label col-sm-2'
                ),
            ),
        ));

    }

}