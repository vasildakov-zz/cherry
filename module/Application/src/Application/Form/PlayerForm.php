<?php
/**
 * LoginForm
 * 
 * @author Vasil Dakov <vasildakov@gmail.com>
 */

namespace Application\Form;

use Zend\Form\Form;

class PlayerForm extends Form
{
    public function __construct($name = null)
    {
        // we want to ignore the name passed
        parent::__construct('player');
        // $this->setAttribute('method', 'post');
        // $this->setAttribute('role', 'form');

        $this->setAttributes( array(
            'role' => 'form', 
            'method' => 'post', 
            'class' => 'form-horizontal') 
        );
        
        $this->add(array(
            'name' => 'some_hidden_field',
            'attributes' => array(
                'type'  => 'hidden',
            ),
        ));


        $this->add(array(
            'name' => 'name',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' => 'Name',
                'class' => 'form-control'
            ),
            'options' => array(
                'label' => 'Name',
                'label_attributes' => array(
                    'for' => 'Name',
                    'class'  => 'control-label col-sm-2'
                ),
            ),
        ));

        $this->add(array(
            'name' => 'surname',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' => 'Surname',
                'class' => 'form-control'
            ),
            'options' => array(
                'label' => 'Surname',
                'label_attributes' => array(
                    'for' => 'Surname',
                    'class'  => 'control-label col-sm-2'
                ),
            ),
        ));


        $this->add(array(
            'name' => 'email',
            'attributes' => array(
                'type'  => 'text',
                'placeholder' => 'Email',
                'class' => 'form-control'
            ),
            'options' => array(
                'label' => 'Email',
                'label_attributes' => array(
                    'for' => 'Email',
                    'class'  => 'control-label col-sm-2'
                ),
            ),
        ));
        
        
        $this->add(array(
            'name' => 'password',
            'attributes' => array(
                'type'  => 'password',
                'placeholder' => 'Password',
                'class' => 'form-control'
            ),
            'options' => array(
                'label' => 'Password',
                'label_attributes' => array(
                    'class'  => 'control-label col-sm-2'
                ),
            ),
        ));
               
        
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Save',
                'id' => 'submitbutton',
                'class' => 'btn btn-default'
            ),
        ));
    }

}