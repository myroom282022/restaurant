<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Sale;
use Illuminate\Bus\Batchable;
use App\Models\LogHistory;

class ProcessCSVData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Batchable;
    
    public $header;
    public $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data, $header)
    {
        $this->data = $data;
         $this->header = $header;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $id=1;
        foreach ($this->data as $sale) {
            $sellData = array_combine($this->header,$sale);
           $iteam['tone']=$sellData['Tone'];
           $iteam['keyword']=$sellData['Keyword'];
        //    $iteam['description']=$sellData['Hash Tag'];
        //    $iteam['title']=$sellData['Tone'];
           $iteam['hash_tag_name']=$sellData['Hash Tag'];
           $iteam['word_size']=$sellData['Word Size'];
           $iteam['device_type']=$sellData['Tone'];
        //    $iteam['signature']=$sellData['Signature'];
            LogHistory::create($iteam);
            echo $id++;
        }
    }
}
