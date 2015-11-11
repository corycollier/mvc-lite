<?php
/**
 * Class to contain ACL logic
 * 
 * @category    MVCLite
 * @package     Lib
 * @subpackage  Acl
 * @since       File available since release 2.0.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */
/**
 * Class to contain ACL logic
 * 
 * @category    MVCLite
 * @package     Lib
 * @subpackage  Acl
 * @since       File available since release 2.0.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */
 
class Lib_Acl
extends Lib_Object_Singleton
{
    /**
     *
     *
     */
    public function init ( )
    {
        
    } // END function init

    /**
     * method to determine if a role is allowed to access a resource
     *
     * @param Lib_Model $role
     * @param Lib_Model $resource
     * @return boolean
     */
    public function isAllowed (Lib_Model $role, Lib_Model $resource)
    {
        foreach ($role->resources as $allowedResources) {
            if ($resource == $allowedResource) {
                return true;
            }
        }
        
        return false;
        
    } // END function isAllowed

} // END class Lib_Acl