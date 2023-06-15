<?php

namespace App\Exports;

use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class InquiryExport extends DefaultValueBinder implements FromCollection, WithHeadings, ShouldAutoSize, WithCustomValueBinder, WithStyles, WithMapping
{
    use Exportable;

    private $records;

    public function __construct($records)
    {
        $this->records = $records;
    }

    public function collection()
    {
        return $this->records;
    }

    public function headings(): array
    {
        return [
            'Ref ID.', 'Type', 'Inquirable Type', 'Inquirable Title', 'Name', 'Contact Number', 'Email', 'Submitted At', 'Message'
        ];
    }

    public function bindValue(Cell $cell, $value)
    {
        if (is_string($value)) {
            $cell->setValueExplicit($value, DataType::TYPE_STRING);

            return true;
        }

        // else return default behavior
        return parent::bindValue($cell, $value);
    }

    public function map($record): array
    {

        return [
            $record->reference, //ref
            $record->type,
            class_basename($record->inquiry()->getRelated()),
            (class_basename($record->inquiry()->getRelated()) == 'Service') ? ((in_array($record->inquiry->id, [6, 7])) ? "Islamic Finance" : $record->inquiry->getTranslation('title', 'en')) : ((class_basename($record->inquiry()->getRelated()) == 'Promotion') ? $record->inquiry->getTranslation('title', 'en') : ''),
            $record->name,
            $record->contact_number,
            $record->email,
            $record->created_at,
            $record->message,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1    => ['font' => ['bold' => true]],
        ];
    }
}
