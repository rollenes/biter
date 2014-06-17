<?php

namespace Rollen\Biter\Tests\BitSequenceIterator;

use Rollen\Biter\BitSequenceIterator;

class CreateTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function createValid()
    {
        $f = fopen('php://memory', "r");
        
        $sequenceLength = 4;
        
        $iterator = new BitSequenceIterator($f, $sequenceLength);
        
        $this->assertEquals($sequenceLength, $iterator->getSequenceLength());
    }
    
    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function createWithInvalidSequenceLength()
    {
        $f = fopen('php://memory', "r");
        
        new BitSequenceIterator($f, 0);
    }
    
    /**
     * @test
     * @expectedException \InvalidArgumentException
     * @dataProvider invalidResourceDataProvider
     */
    public function createWithInvalidResource($invalidResource)
    {
        new BitSequenceIterator($invalidResource, 4);
    }
    
    public function invalidResourceDataProvider() 
    {
        return [
            'unknownStram' => [$this->createUnknownStream()],
            'unreadableStream' => [$this->createUnreadableStream()],
            'invalidType' => ['invalidTypeTest']
        ];
    }

    private function createUnknownStream() 
    {
        $f = fopen('php://memory', "r");
        fclose($f);
        
        return $f;
    }

    public function createUnreadableStream()
    {
        $f = fopen(__DIR__ . '/../files/empty.file', "w", true);
        
        return $f;
    }

}
