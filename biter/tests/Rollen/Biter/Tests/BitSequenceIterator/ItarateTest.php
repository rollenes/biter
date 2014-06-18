<?php

namespace Rollen\Biter\Tests\BitSequenceIterator;

use Rollen\Biter\BitSequenceIterator;

class ItarateTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider iterateDataProvider
     */
    public function iterate($resource, $sequenceLength, $expectedArray)
    {
        $iterator = new BitSequenceIterator($resource, $sequenceLength);
        
        $resultArray = $this->getBitSequencesAsArray($iterator);
        
        $this->assertEquals($expectedArray, $resultArray);
    }
    
    public function iterateDataProvider() 
    {
        return[
            [$this->createResourceFromString(''), 4, []],
            [$this->createResourceFromString(''), 8, []],
            
            [$this->createResourceFromString("\x0"), 4, ['0000', '0000']],
            [$this->createResourceFromString("\x0"), 8, ['00000000']],

            [$this->createResourceFromString("\x1"), 4, ['0000', '0001']],
            [$this->createResourceFromString("\x1"), 8, ['00000001']],
            
            [$this->createResourceFromString("\x0\x0"), 4, ['0000', '0000', '0000', '0000']],
            [$this->createResourceFromString("\x0\x0"), 8, ['00000000', '00000000']],
            
            [$this->createResourceFromString("\x1\x0"), 4, ['0000', '0001', '0000', '0000']],
            [$this->createResourceFromString("\x1\x0"), 8, ['00000001', '00000000']]
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
