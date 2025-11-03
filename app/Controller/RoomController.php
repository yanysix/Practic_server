<?php
namespace Controller;

use Src\View;
use Src\Request;
use Model\Room;
use Model\Building;

class RoomController
{
    // Список комнат с фильтром
    public function index(Request $request): string
    {
        $query = Room::with('building');

        $building_id = $request->get('building_id') ?? '';
        $search = $request->get('search') ?? '';

        if ($building_id) {
            $query->where('fk_building_id', $building_id);
        }

        if ($search) {
            $query->where('name', 'LIKE', "%$search%");
        }

        $rooms = $query->get();
        $buildings = Building::all();

        return new View('room.list', [
            'rooms' => $rooms,
            'buildings' => $buildings,
            'building_id' => $building_id,
            'search' => $search
        ]);
    }


    // Форма создания комнаты
    public function create(Request $request): string
    {
        $buildings = Building::all();
        return new View('room.create', ['buildings' => $buildings]);
    }

    // Сохранение новой комнаты
    public function store(Request $request): string
    {
        $data = $request->all();

        $building_id = $data['fk_building_id'] ?? '';
        $name = $data['name'] ?? '';
        $type = $data['room_type'] ?? '';
        $seats = $data['count_seats'] ?? '';
        $square = $data['square'] ?? '';

        if (!$building_id || !$name || !$type || !$seats || !$square) {
            $buildings = Building::all();
            return new View('room.create', [
                'buildings' => $buildings,
                'message' => 'Все поля обязательны'
            ]);
        }

        Room::create([
            'fk_building_id' => $building_id,
            'name' => $name,
            'room_type' => $type,
            'count_seats' => $seats,
            'square' => $square
        ]);

        $buildings = Building::all();
        return new View('room.create', [
            'buildings' => $buildings,
            'message' => 'Комната успешно добавлена'
        ]);
    }
}
