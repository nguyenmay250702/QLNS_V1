<?php

namespace App\Repositories\Repository;

use App\Position;
use App\Repositories\BaseRepository;
use App\Repositories\Interfaces\PositionRepositoryInterface;


class PositionRepository extends BaseRepository implements PositionRepositoryInterface
{
    public function __construct(Position $position)
    {
        parent::__construct($position);
    }

    public function search(array $request)
    {
        $data = collect();
        if ($request != []) {
            $data = $this->model->where(function ($query) use ($request) {
                if ($request['txt_name'] !== null) {
                    $query->where('name', 'like', '%' . $request['txt_name'] . '%');
                }
                if ($request['txt_status'] !== "-1") {
                    $query->where('status', '=', $request['txt_status']);
                }
            })->orderBy('updated_at', 'desc')->get();
        }
        return $data;
    }
}

?>
