<?php

class Model_Message
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $company;
    /**
     * @var string
     */
    private $subject;
    /**
     * @var string
     */
    private $message;
    
    /**
     * @var string
     */
    private $sendDate;

    public function __construct(array $data){
        foreach($data as $key => $value){
            $methodName = 'set' . ucfirst($key);
            if (method_exists($this, $methodName)){
                $this->$methodName($value);
            }
        }
        $this->setSendDate(new Zend_Date());
    }
    
    
	/**
     * @return the $name
     */
    public function getName()
    {
        return $this->name;
    }

	/**
     * @return the $email
     */
    public function getEmail()
    {
        return $this->email;
    }

	/**
     * @return the $company
     */
    public function getCompany()
    {
        return $this->company;
    }

	/**
     * @return the $subject
     */
    public function getSubject()
    {
        return $this->subject;
    }

	/**
     * @return the $message
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return the $sendDate
     */
    public function getSendDate()
    {
        return $this->sendDate;
    }    
    
	/**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;        
    }

	/**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

	/**
     * @param string $company
     */
    public function setCompany($company)
    {
        $this->company = $company;
        return $this;        
    }

	/**
     * @param string $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;        
    }

	/**
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;        
    }

    /**
     * @param string $sendDate
     */
    public function setSendDate($sendDate)
    {
        $this->sendDate = $sendDate;
        return $this;
    }
    
    public function toArray(){
        return array(
            'name' => $this->getName(),
            'email' => $this->getEmail(),
            'company' => $this->getCompany(),
            'subject' => $this->getSubject(),
            'message' => $this->getMessage(),
            'sendDate' => $this->getSendDate(),
        );
    }
    
}