<?php

namespace Rollen\Biter\Tests;

use Rollen\Biter\BitReader;

class BitReaderTest extends \PHPUnit_Framework_TestCase
{
    private $bitReader;
    
    protected function setUp() 
    {
        $this->bitReader = new BitReader();
    }

    /**
     * @test     
     */
    public function readString()
    {
        $readIterattor = $this->bitReader->read('');
        
        $this->assertInstanceOfBirReaderIterator($readIterattor);
    }
    
    /**
     * @test
     */
    public function readResource()
    {
        $f = fopen('php://memory', "r");
    
        $readIterator = $this->bitReader->read($f);
        
        $this->assertInstanceOfBirReaderIterator($readIterator);
    }
    
    private function assertInstanceOfBirReaderIterator($instance) 
    {
        $this->assertInstanceOf('Rollen\Biter\BitReaderIterator', $instance);
    }

    /**
     * @test
     * 
     * @expectedException Rollen\Biter\BitReaderException
     */
    public function readUnsuported()
    {
        $unsuported = array();
        
        $this->bitReader->read($unsuported);
    }
    
}
