<?php
/**
 * Test suite to test functionality of the lib acl-role-resource model
 * 
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Lib_Model
 * @since       File available since release 2.2.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */
/**
 * Test suite to test functionality of the lib acl-role-resource model
 * 
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Lib_Model
 * @since       File available since release 2.2.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */
 
class Tests_Lib_Model_AclRoleResourceTest
extends PHPUnit_Framework_TestCase
{
    /**
     * Test the basics of the acl-role model 
     */
    public function test_basics ( )
    {
        $aclRoleResource = new Lib_Model_AclRoleResource;

        $this->assertTrue(property_exists('Lib_Model_AclRoleResource', 'role'));
        $this->assertTrue(property_exists('Lib_Model_AclRoleResource', 'resource'));
        $this->assertTrue(property_exists('Lib_Model_AclRoleResource', '_table'));
        $this->assertTrue(property_exists('Lib_Model_AclRoleResource', '_fields'));
        
    } // END function test_basics

} // END class Tests_Lib_Model_AclRoleResourceTest