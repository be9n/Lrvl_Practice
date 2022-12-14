<?php

namespace App\Listeners;

use App\Events\VideoViewer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class IncreaseCounter
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(VideoViewer $event)
    {
        if (!session() -> has('videoIsVisited'))
        $this->updateViews($event -> video);
        else{
            return false;
        }
    }

    public function updateViews($video){

        $video -> views = $video -> views + 1;
        $videoData = $video -> save();
        session()->put('videoIsVisited', $video->id);
    }
}
