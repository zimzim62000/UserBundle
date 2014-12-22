<?php

namespace ZIMZIM\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ZIMZIMUserBundle extends Bundle
{
    public function getParent(){
        return 'FOSUserBundle';
    }
}
