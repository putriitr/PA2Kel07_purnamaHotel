<?php

namespace App\Jobs;

use App\Models\Room;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class RoomAvailabilityUpdateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $roomId;

    public function __construct($roomId)
    {
        $this->roomId = $roomId;
    }

    public function handle()
    {
        $room = Room::find($this->roomId);
        if ($room) {
            $room->available += 1;
            $room->save();
        }
    }
}
