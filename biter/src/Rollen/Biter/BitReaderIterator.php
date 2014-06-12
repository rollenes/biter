<?php

namespace Rollen\Biter;

class BitReaderIterator implements \Iterator {

    public function __construct($input) {
        if (!$this->isStreamResource($input)) {
            throw new \InvalidArgumentException('Invalid input. Stream expected.');
        }

        if (!$this->isSreamReadable($input)) {
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

}
