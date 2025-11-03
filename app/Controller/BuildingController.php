<?php
namespace Controller;

use Src\View;
use Src\Request;
use Model\Building;

class BuildingController
{
    // Форма добавления здания
    public function create(Request $request): string
    {
        return new View('building.create');
    }

    // Обработка POST-запроса
    public function store(Request $request): string
    {
        $data = $request->all();

        $name = $data['name'] ?? '';
        $address = $data['address'] ?? '';
        $total_number_seats = $data['total_number_seats'] ?? '';
        $total_auditorium_square = $data['total_auditorium_square'] ?? '';

        if (!$name || !$address || !$total_number_seats || !$total_auditorium_square) {
            return new View('building.create', [
                'message' => 'Все поля обязательны',
                'name' => $name,
                'address' => $address,
                'total_number_seats' => $total_number_seats,
                'total_auditorium_square' => $total_auditorium_square
            ]);
        }

        // Создаем запись в БД
        Building::create([
            'name' => $name,
            'address' => $address,
            'total_number_seats' => $total_number_seats,
            'total_auditorium_square' => $total_auditorium_square
        ]);

        return new View('building.create', [
            'message' => 'Здание успешно добавлено'
        ]);
    }

    // Список зданий
    public function index(): string
    {
        // Подгружаем здания с комнатами
        $buildings = Building::with('rooms')->get();

        $totalInstitutionSeats = 0;
        $totalInstitutionSquare = 0;

        foreach ($buildings as $building) {
            // Считаем общее количество мест и площадь по комнатам здания
            $building->total_seats = $building->rooms->sum('count_seats');
            $building->total_square = $building->rooms->sum('square');

            // Суммируем для всего учебного заведения
            $totalInstitutionSeats += $building->total_seats;
            $totalInstitutionSquare += $building->total_square;
        }

        return new View('building.list', [
            'buildings' => $buildings,
            'totalInstitutionSeats' => $totalInstitutionSeats,
            'totalInstitutionSquare' => $totalInstitutionSquare
        ]);
    }
}
