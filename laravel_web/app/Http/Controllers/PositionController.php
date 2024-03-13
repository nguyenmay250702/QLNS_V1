<?php

namespace App\Http\Controllers;

use App\Http\Requests\PositionRequest;
use App\Position;

class PositionController extends CommonController
{
    public function store(PositionRequest $request)
    {
        $data = $request->validated();

        $this->positionRepository->store($data);
        return redirect()->route("positions.search")->with('success', 'Thêm mới vị trí công việc thành công.');
    }

    public function update(PositionRequest $request, Position $position)
    {
        $data = $request->validated();
        $this->positionRepository->update($position->id, $data);
        return redirect()->route('positions.search')->with('success', 'Cập nhật thông tin vị trí công việc thành công.');
    }

    public function destroy(Position $position)
    {
        $this->positionRepository->update($position->id, ["status" => 0]);
        return redirect()->back()->with('success', 'Xóa thông tin vị trí công việc thành công.');
    }
}
