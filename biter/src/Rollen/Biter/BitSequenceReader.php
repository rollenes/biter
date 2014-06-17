<?php

namespace Rollen\Biter;

class BitSequenceReader 
{

    public function read($input, $bitsPerItem = 8)
    {
        try {
            $resource = $this->createResourceFromInput($input);

            return new BitSequenceIterator($resource, $bitsPerItem);
        } catch (\InvalidArgumentException $e) {
            throw new BitSequenceReaderException('Reading from input is imposible', null, $e);
        }
    }

    private function createResourceFromInput($input) 
    {
        if (is_string($input)) {
            return $this->createResourceFromString($input);
        }
        
        return $input;
    }

    private function createResourceFromString($input) 
    {
        $resource = fopen('php://memory', "w+");
        fwrite($resource, $input);
        rewind($resource);
        
        return $resource;
    }

}
