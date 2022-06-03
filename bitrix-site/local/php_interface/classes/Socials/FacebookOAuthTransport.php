<?php


namespace ITLeague\Socials;


class FacebookOAuthTransport extends \CFacebookInterface
{
    protected $scope = [
        'email',
        'public_profile'
    ];
}
