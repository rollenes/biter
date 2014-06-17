<?php

namespace Rollen\Biter\Tests\BitSequenceIterator;

use Rollen\Biter\BitSequenceIterator;

class ItarateTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider iterateDataProvider
     */
    public function iterate($string, $sequenceLength, $expectedArray)
    {
        $iterator = new BitSequenceIterator($this->createResourceFromString($string), $sequenceLength);
        
        $resultArray = $this->getBitSequencesAsArray($iterator);
        
        $this->assertEquals($expectedArray, $resultArray);
    }
    
    public function iterateDataProvider() 
    {
        return[
            ['', 1, []],
            ['', 3, []],
        ];
    }
    
    private function createResourceFromString($string)
    {
        $resource = fopen('php://memory', "w+");
        
        fwrite($resource, $string);
        
        rewind($resource);
        
        return $resource;
    }
    
    private function getBitSequencesAsArray(\Rollen\Biter\BitSequenceIterator $bitReaderIterator)
    {
        $result = [];
        
        foreach ($bitReaderIterator as $bitSequence) {
            $result[] = $bitSequence;
        }
        
        return $result;
    }
}
