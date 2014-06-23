<?php

namespace Rollen\Biter;

class BitSequenceStatisticsGenerator 
{

    public function generate(BitSequenceIterator $iterator) 
    {
        return new BitSequenceStatistics();
    }

}
