<?php

namespace Rollen\Biter\Tests;

use Rollen\Biter\BitSequenceStatisticsGenerator;
use Rollen\Biter\BitSequenceIterator;

class BitSequenceStatisticsTest extends \PHPUnit_Framework_TestCase
{
    private $statisticGenerator;
    
    protected function setUp() 
    {
        $this->statisticGenerator = new BitSequenceStatisticsGenerator();
    }
    
    /**
     * @test
     * @dataProvider bitSequenceIteratorProvider
     */
    public function generate(BitSequenceIterator $iterator, $sequenceMap, $uniqueSequenceLength)
    {
        $statistics = $this->statisticGenerator->generate($iterator);
        
        $this->assertInstanceOf('Rollen\Biter\BitSequenceStatistics', $statistics);
        
        $this->assertSame($sequenceMap, $statistics->getSequenceMap());
        $this->assertEquals($uniqueSequenceLength, $statistics->getUniqueSequenceLength());
    }
    
    public function bitSequenceIteratorProvider()
    {
        return [
            [$this->createBitSequenceIterator('', 3), [], 0],
            [$this->createBitSequenceIterator("\x0", 3), ['000' => 2, '00' => 1], 5],
            [$this->createBitSequenceIterator("\x0\x1", 4), ['0000' => 3, '0001' => 1], 8],
            [$this->createBitSequenceIterator("\x1\x1", 7), ['0000000' => 1, '1000000' => 1, '01' => 1], 16]
        ];
    }
    
    private function createBitSequenceIterator($string, $sequenceLength)
    {
        return new BitSequenceIterator($this->createResourceFromString($string), $sequenceLength);
    }
    
    private function createResourceFromString($string)
    {
        $resource = fopen('php://memory', "w+");
        
        fwrite($resource, $string);
        
        rewind($resource);
        
        return $resource;
    }

}
