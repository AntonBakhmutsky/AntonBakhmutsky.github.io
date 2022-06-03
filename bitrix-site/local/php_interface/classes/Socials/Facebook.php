<?php


namespace ITLeague\Socials;


use CSocServFacebook;

class Facebook extends CSocServFacebook
{
    public function getEntityOAuth($code = false): FacebookOAuthTransport
    {
        if (! $this->entityOAuth) {
            $this->entityOAuth = new FacebookOAuthTransport();
        }
        
        if ($code !== false) {
            $this->entityOAuth->setCode($code);
        }
        
        return $this->entityOAuth;
    }
}
