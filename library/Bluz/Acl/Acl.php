<?php

/**
 * Copyright (c) 2012 by Bluz PHP Team
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

/**
 * @namespace
 */
namespace Bluz\Acl;

/**
 * Acl
 *
 * @category Bluz
 * @package  Acl
 *
 * @author   Anton Shevchuk
 * @created  11.07.11 15:09
 */
class Acl
{
    use \Bluz\Package;

    const ALLOW = 'allow';
    const DENY = 'deny';

    /**
     * Get flags
     *
     * @return array
     */
    public static function getFlags()
    {
        return array(
            self::ALLOW,
            self::DENY
        );
    }

    /**
     * Is allowed
     *
     * @param string                    $privilege
     * @internal param int $privilegeId
     * @throws AclException
     * @return boolean
     */
    public function isAllowed($privilege)
    {
        if ($privilege) {
            $user = $this->getApplication()->getAuth()->getIdentity();
            if (!$user || !$user->getRole() || !$user->getRole()->hasPrivilege($privilege)) {
                return false;
            }
        }
        return true;
    }
}