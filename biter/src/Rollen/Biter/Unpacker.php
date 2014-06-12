<?php

namespace Rollen\Compress;

class Unpacker 
{
    public function unpack($str, $bitCount = 8)
    {
        $totalBits = (strlen($str) * 8);
        echo 'expected: full:' . floor($totalBits / $bitCount) . ' restlen: ' . $totalBits % $bitCount . "\n";
        
        $binstr = $this->getBinaryString($str);
        
        $stats = [];
        
        for ($pos = 0; $pos < strlen($binstr);$pos += $bitCount) {
            $stats[substr($binstr, $pos, $bitCount)][] = $pos;
        }
        
        
        return [
            'distribution' => array_map('count', $stats)
        ];
    }
    
    private function getBinaryString($str)
    {
        $binstr = '';
        
        for ($i=0;$i < strlen($str);$i++) {
            $binstr .= sprintf("%08b", ord($str[$i]));
        }
        
        return $binstr;
    }
}
