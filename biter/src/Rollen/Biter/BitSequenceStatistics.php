<?php

namespace Rollen\Biter;

class BitSequenceStatistics 
{
    
    private $sequenceMap = [];
    
    public function getSequenceMap()
    {
        return $this->sequenceMap;
    }

    public function pushSequence($sequence) 
    {
        $this->sequenceMap[$sequence] = isset($this->sequenceMap[$sequence]) ? $this->sequenceMap[$sequence] + 1 : 1;
    }

    public function getUniqueSequenceLength() 
    {
        return array_sum(array_map('strlen', array_keys($this->sequenceMap)));
    }

}
