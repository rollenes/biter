<?php

namespace Rollen\Compress;

class FileStatstics 
{
    public function generate($filename)
    {
        if (!file_exists($filename)) {
            throw new MissingFileException('File not found "'.$filename .'"');
        }
        
        $content = file_get_contents($filename);
        
        $length = strlen($content);
        
        $stats = [];
        
        for ($i=0;$i < $length; $i++) {
            $stats[$content[$i]][] = $i;
        }
        
        $counts = [
            'length' => $length,
            'header' => count($stats),
            'distribution' => array_map('count', $stats)
        ];
        
        return $counts;
    }
}
