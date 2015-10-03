<?php

namespace cdnicoll\solrMusicBundle\Tests\Controller\API;

use cdnicoll\solrMusicBundle\Services\SolrService;
use cdnicoll\solrMusicBundle\Tests\BaseTest;

class SolrServiceTest extends BaseTest
{
    protected $solrServiceObject;

    public function testConstructor()
    {

        $solrServiceObject = new SolrService('mockDbName', 'mockHost', 'mockPort', 'mockPath');
        $this->assertInstanceOf('cdnicoll\solrMusicBundle\Services\SolrService', $solrServiceObject);
        $this->assertInstanceOf('\SolrClient', $this->getProtectedObjectPropertyValue($solrServiceObject,'solrClient'));
    }

    public function testInsertRow()
    {
        // -=========== Mock Data ===========-
        $data = ['foo1'=>'bar1','foo2'=>'bar2'];

        $solrServiceObject = new SolrService('solrMusic', 'localhost', 'mockPort', 'mockPath');
        $complete = $solrServiceObject->insertRow($data);
        $this->assertTrue($complete);
    }

    public function testGetPaginatedTracks()
    {
        /*
        // -=========== Mock Data ===========-
        $data = ['foo1'=>'bar1','foo2'=>'bar2'];

        $solrServiceObject = new SolrService('mockDbName', 'mockHost', 'mockPort', 'mockPath');
        $solrServiceObject->getPaginatedTracks(0,5);
        */
    }


}
