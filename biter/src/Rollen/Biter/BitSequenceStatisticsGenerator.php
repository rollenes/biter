<?php

namespace Rollen\Biter;

class BitSequenceStatisticsGenerator 
{

    public function generate(BitSequenceIterator $iterator) 
    {
<<<<<<< HEAD
        $sequenceStatistics = new BitSequenceStatistics();
        
        foreach ($iterator as $sequence) {
            $sequenceStatistics->pushSequence($sequence);
        }
        
        return $sequenceStatistics;
=======
        return new BitSequenceStatistics();
>>>>>>> f900a7d16427a921e543fa909bd9a2a825012ad4
    }

}
