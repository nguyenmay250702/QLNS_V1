<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;


class StaffExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents, WithColumnFormatting
{
    private $staffs;

    public function __construct($data)
    {
        $this->staffs = $data;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $sortedData = $this->staffs->map(function ($item) {
            return [
                $item['id'],
                $item['username'],
                $item['name'],
                $item['citizen_identity_card'],
                $item['phone_number'],
                $item['birthday'],
                $item['gender'],
                $item['address'],
                $item['department_name'],
                $item['status'],
                $item['created_at'],
                $item['updated_at'],
            ];
        });

        return collect($sortedData);
    }
    public function headings(): array
    {
        return ['mã nhân viên', 'tài khoản', 'tên nhân viên', 'số căn cước công dân', 'số điện thoại', 'ngày sinh', 'giới tính', 'địa chỉ', 'phòng ban', 'trạng thái', 'ngày tạo', 'ngày sửa'];
    }

    public function columnFormats(): array
    {
        return [
            'D' => NumberFormat::FORMAT_NUMBER,
        ];
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getStyle('A1:L1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'color' => ['argb' => 'FFFFFF'], // Màu trắng
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['argb' => '777777'],
                    ],
                ]);
            },
        ];
    }
}