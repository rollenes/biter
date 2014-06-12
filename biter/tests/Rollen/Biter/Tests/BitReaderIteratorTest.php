<?php

namespace Rollen\Biter\Tests;

class BitReaderIteratorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function createWithValidResource()
    {
        $f = fopen('php://memory', "r");
        
        try {
            new \Rollen\Biter\BitReaderIterator($f);
        } catch (\Exception $e) {
            $this->fail($e->getMessage());
        }
    }
    
    /**
     * @test
     * @expectedException \InvalidArgumentException
     * @dataProvider invalidResourceDataProvider
     */
    public function createWithInvalidResource($invalidResource)
    {
        new \Rollen\Biter\BitReaderIterator($invalidResource);
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
        $f = fopen('test', "w", true);
        
        return $f;
    }

}
