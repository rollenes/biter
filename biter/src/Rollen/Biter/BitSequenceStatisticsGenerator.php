<?php

namespace Rollen\Biter;

class BitSequenceStatisticsGenerator 
{

    public function generate(BitSequenceIterator $iterator) 
    {
        $sequenceStatistics = new BitSequenceStatistics();
        
        foreach ($iterator as $sequence) {
            $sequenceStatistics->pushSequence($sequence);
        }
        
        return $sequenceStatistics;
    }

}
