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
     */
    public function canGenerate()
    {
        $this->statisticGenerator->generate($this->createBitSequenceIterator('', 8));
    }
    
    /**
     * @test
     * @dataProvider bitSequenceIteratorProvider
     */
    public function generate(BitSequenceIterator $iterator, $result)
    {
        $statistics = $this->statisticGenerator->generate($iterator);
        
        $this->assertInstanceOf('Rollen\Biter\BitSequenceStatistics', $statistics);
    }
    
    public function bitSequenceIteratorProvider()
    {
        return [
            [$this->createBitSequenceIterator('', 3), $this->createGenerateStatisticsResult()]
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

    private function createGenerateStatisticsResult() 
    {
        
    }

}
