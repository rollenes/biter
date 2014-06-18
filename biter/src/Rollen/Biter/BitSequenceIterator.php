<?php

namespace Rollen\Biter;

class BitSequenceIterator implements \Iterator {

    private $sequenceLength;

    private $resource;
    
    private $current = 0;
    
    private $buffer = '';
    
    private $currentCharacter;

    public function __construct($resource, $sequenceLength) 
    {
        $this->checkResource($resource);
        $this->resource = $resource;
        
        $this->checkSequenceLength($sequenceLength);
        $this->sequenceLength = $sequenceLength;
    }

    private function checkResource($resource)
    {
        if (!$this->isStreamResource($resource)) {
            throw new \InvalidArgumentException('Invalid input. Stream expected.');
        }

        if (!$this->isSreamReadable($resource)) {
            throw new \InvalidArgumentException('Stream is not readable');
        }
    }
    
    private function isStreamResource($input) 
    {
        return (is_resource($input) and get_resource_type($input) == 'stream');
    }

    private function isSreamReadable($input)
    {
        $mode = stream_get_meta_data($input)['mode'];

        return (preg_match('/[r\+]/', $mode));
    }

    private function checkSequenceLength($sequenceLength)
    {
        if (!$this->isSequenceLengthValid($sequenceLength)) {
            throw new \InvalidArgumentException('Invalid sequence length');
        }
    }
    
    private function isSequenceLengthValid($sequenceLength)
    {
        return is_int($sequenceLength) and $sequenceLength > 0;
    }

    public function current() 
    {
        return $this->pop();
    }

    public function key() 
    {
        return $this->current;
    }

    public function next() 
    {
        $this->current++;
    }

    public function rewind() 
    {
        rewind($this->resource);
        $this->current = 0;
    }

    public function valid() 
    {
        $this->push();
        
        return (bool)$this->buffer;
    }

    private function push()
    {
        $c = fgetc($this->resource);
        
        if ($c !== false) {
            $this->buffer .= sprintf('%08b', ord($c));
        }
    }
    
    private function pop()
    {
        $sequence = substr($this->buffer, 0, $this->sequenceLength);
        
        $this->buffer = substr($this->buffer, $this->sequenceLength);
        
        return $sequence;
    }
    
    
    public function getSequenceLength() 
    {
        return $this->sequenceLength;
    }
}
