<?php
/**
 * Test suite to test functionality of the lib acl-resource model
 * 
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Lib_Model
 * @since       File available since release 2.2.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */
/**
 * Test suite to test functionality of the lib acl-resource model
 * 
 * @category    MVCLite
 * @package     Tests
 * @subpackage  Lib_Model
 * @since       File available since release 2.2.0
 * @author      Cory Collier <corycollier@corycollier.com>
 */
 
class Tests_Lib_Model_AclResourceTest
extends PHPUnit_Framework_TestCase
{
    /**
     * Test the basics of the acl-resource model 
     */
    public function test_basics ( )
    {
        $aclResource = new Lib_Model_AclResource;

        $this->assertTrue(property_exists('Lib_Model_AclResource', '_table'));
        $this->assertTrue(property_exists('Lib_Model_AclResource', '_fields'));

    } // END function test_basics

} // END class Tests_Lib_Model_AclResourceTest