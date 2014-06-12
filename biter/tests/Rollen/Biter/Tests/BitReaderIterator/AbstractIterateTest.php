<?php

namespace Rollen\Biter\Tests\BitReaderIterator;

abstract class AbstractIterateTest extends \PHPUnit_Framework_TestCase
{
    public function createResourceFromString($string)
    {
        $resource = fopen('php://memory', "w+");
        
        fwrite($resource, $string);
        
        rewind($resource);
        
        return $resource;
    }
    
    public function getBitSequencesAsArray(\Rollen\Biter\BitReaderIterator $bitReaderIterator)
    {
        $result = [];
        
        foreach ($bitReaderIterator as $bitSequence) {
            $result[] = $bitSequence;
        }
        
        return $result;
    }
    
}
