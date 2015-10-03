<?php

namespace cdnicoll\solrMusicBundle\Tests\Controller\API;

use cdnicoll\solrMusicBundle\Controller\Api\SolrQueryController;
use Symfony\Component\HttpFoundation\Response;
use cdnicoll\solrMusicBundle\Tests\BaseTest;

class SolrQueryControllerTest extends BaseTest
{
    public function testConstructor()
    {
        //$api = $this->getConstructorDisabledMock('cdnicoll\solrMusicBundle\Controller\Api\SolrQueryController');
        $api = new SolrQueryController();
        $this->assertInstanceOf('cdnicoll\solrMusicBundle\Controller\Api\SolrQueryController', $api);
    }

    public function testGetPaginatedTracks()
    {
        // -=========== Setup Mocks ===========-
        $solrServiceMock = $this->getConstructorDisabledMock('cdnicoll\solrMusicBundle\Services\SolrService');
        $apiControllerMock = $this->getMock('cdnicoll\solrMusicBundle\Controller\Api\SolrQueryController',['get']);

        $mockSolrData = ['foo'=>'bar'];
        $solrObject = (object) ['response'=>(object)['docs'=>$mockSolrData]];



        // -=========== Setup expectations ===========-
        $apiControllerMock->expects($this->any())
            ->method('get')
            ->will($this->returnValue($solrServiceMock));


        $solrServiceMock->expects($this->any())
            ->method('getPaginatedTracks')
            ->will($this->returnValue($solrObject));

        $response = $apiControllerMock->getPaginatedTracksAction(0,20)->getContent();
        $this->assertEquals(json_encode($mockSolrData), $response);
    }
}
