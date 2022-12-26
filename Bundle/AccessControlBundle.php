<?php

namespace Plugin\AccessControl\Bundle;
/*
 * This file is part of EC-CUBE
 *
 * Copyright(c) EC-CUBE CO.,LTD. All Rights Reserved.
 *
 * http://www.ec-cube.co.jp/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Plugin\AccessControl\DependencyInjection\AccessControlExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class AccessControlBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new AccessControlExtension();
    }
}