<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
// 
class SocketUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $socket_id, $socket_nombre, $socket_cantidad;

    public function __construct($socket_id, $socket_nombre, $socket_cantidad)
    {
        $this->socket_id = $socket_id;
        $this->socket_nombre = $socket_nombre;
        $this->socket_cantidad = $socket_cantidad;
    }

    public function broadcastOn(): array
    {
        return [
            new Channel('items-socket'),
        ];
    }

    public function broadcastAs()
    {
        return 'SocketUpdated';
    }
}
