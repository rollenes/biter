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
        
        $this->assertSame($expectedArray, $resultArray);
    }
    
    public function iterateDataProvider() 
    {
        return[
            [$this->createResourceFromString(''), 3, []],
            [$this->createResourceFromString(''), 4, []],
            [$this->createResourceFromString(''), 8, []],
            [$this->createResourceFromString(''), 9, []],
            [$this->createResourceFromString(''), 16, []],
            
            [$this->createResourceFromString("\x0"), 3, ['000', '000', '00']],
            [$this->createResourceFromString("\x0"), 4, ['0000', '0000']],
            [$this->createResourceFromString("\x0"), 8, ['00000000']],
            [$this->createResourceFromString("\x0"), 9, ['00000000']],
            [$this->createResourceFromString("\x0"), 16, ['00000000']],

            [$this->createResourceFromString("\x1"), 3, ['000', '000', '01']],
            [$this->createResourceFromString("\x1"), 4, ['0000', '0001']],
            [$this->createResourceFromString("\x1"), 8, ['00000001']],
            [$this->createResourceFromString("\x1"), 9, ['00000001']],
            [$this->createResourceFromString("\x1"), 16, ['00000001']],
            
            [$this->createResourceFromString("\x0\x0"), 3, ['000', '000', '000', '000', '000', '0']],
            [$this->createResourceFromString("\x0\x0"), 4, ['0000', '0000', '0000', '0000']],
            [$this->createResourceFromString("\x0\x0"), 8, ['00000000', '00000000']],
            [$this->createResourceFromString("\x0\x0"), 9, ['000000000', '0000000']],
            [$this->createResourceFromString("\x0\x0"), 16, ['0000000000000000']],

            [$this->createResourceFromString("\x1\x0"), 3, ['000', '000', '010', '000', '000', '0']],            
            [$this->createResourceFromString("\x1\x0"), 4, ['0000', '0001', '0000', '0000']],
            [$this->createResourceFromString("\x1\x0"), 8, ['00000001', '00000000']],
            [$this->createResourceFromString("\x1\x0"), 9, ['000000010', '0000000']],
            [$this->createResourceFromString("\x1\x0"), 16, ['0000000100000000']],
            
            [$this->createResourceFromString("\x1\x0\x10"), 3, ['000', '000', '010', '000', '000', '000', '010', '000']],            
            [$this->createResourceFromString("\x1\x0\x10"), 4, ['0000', '0001', '0000', '0000', '0001', '0000']],
            [$this->createResourceFromString("\x1\x0\x10"), 8, ['00000001', '00000000', '00010000']],
            [$this->createResourceFromString("\x1\x0\x10"), 9, ['000000010', '000000000', '010000']],
            [$this->createResourceFromString("\x1\x0\x10"), 16, ['0000000100000000', '00010000']]
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
