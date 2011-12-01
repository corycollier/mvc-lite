<?php
/**
 * Test suite to test functionality of the lib acl-role model
 * 
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Lib_Model
 * @since       File available since release 2.2.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */
/**
 * Test suite to test functionality of the lib acl-role model
 * 
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Lib_Model
 * @since       File available since release 2.2.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */
 
class Tests_Lib_Model_AclRoleTest
extends PHPUnit_Framework_TestCase
{
    /**
     * Test the basics of the acl-role model 
     */
    public function test_basics ( )
    {
        $aclRole = new Lib_Model_AclRole;

        $this->assertTrue(property_exists('Lib_Model_AclRole', 'resources'));
        $this->assertTrue(property_exists('Lib_Model_AclRole', 'parent'));
        $this->assertTrue(property_exists('Lib_Model_AclRole', '_table'));
        $this->assertTrue(property_exists('Lib_Model_AclRole', '_fields'));
        
    } // END function test_basics

} // END class Tests_Lib_Model_AclRoleTest