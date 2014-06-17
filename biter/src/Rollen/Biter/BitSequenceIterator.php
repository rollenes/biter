<?php

namespace Rollen\Biter;

class BitSequenceIterator implements \Iterator {

    private $sequenceLength;

    public function __construct($resource, $sequenceLength) 
    {
        $this->checkResource($resource);
        
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

        public function current() {
        
    }

    public function key() {
        
    }

    public function next() {
        
    }

    public function rewind() {
        
    }

    public function valid() {
        
    }

    public function getSequenceLength() 
    {
        return $this->sequenceLength;
    }

}
