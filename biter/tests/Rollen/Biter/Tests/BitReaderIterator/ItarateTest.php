<?php

namespace Rollen\Biter\Tests\BitReaderIterator;

class ItarateTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function iterateEmpty()
    {
        $resource = $this->createResourceFromString('');
        
        $result = $this->getBitSequencesAsArray(new \Rollen\Biter\BitReaderIterator($resource));

        $this->assertEmpty($result);
    }

    
    
    
    private function createResourceFromString($string)
    {
        $resource = fopen('php://memory', "w+");
        
        fwrite($resource, $string);
        
        rewind($resource);
        
        return $resource;
    }
    
    private function getBitSequencesAsArray(\Rollen\Biter\BitReaderIterator $bitReaderIterator)
    {
        $result = [];
        
        foreach ($bitReaderIterator as $bitSequence) {
            $result[] = $bitSequence;
        }
        
        return $result;
    }
}
