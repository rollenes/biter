<?php

namespace Rollen\Biter\Tests\BitReaderIterator;

class ItarateTest extends AbstractIterateTest
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
    
    
}
