<?php

namespace App\Exports;

use App\Models\Baddeb;
use App\Models\Incidents;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class BaddebExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings(): array
    {
        return [
            'Tanggal Incident',
            'No Incident',
            'Nama Incident',
            'Lokasi',
            'Basecamp',
            'Mitra',
            'Jenis Material',
            'Jumlah Material'
        ];
    }

    public function map($row): array
    {
        return [
            $row->tgl_incident,
            $row->no_incident,
            $row->nama_incident,
            $row->lokasi,
            $row->basecamp->nama_basecamp,
            $row->user->name,
            $row->material->jenis_material,
            $row->jumlah_material
        ];
    }

    public function collection()
    {
        return Incidents::with(['user','basecamp','mitra', 'material'])->get();
    }
}
