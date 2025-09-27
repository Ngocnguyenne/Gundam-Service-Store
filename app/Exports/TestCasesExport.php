<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TestCasesExport implements FromCollection, WithHeadings
{
    protected $testCases;

    public function __construct($testCases)
    {
        $this->testCases = $testCases;
    }

    public function collection()
    {
        return collect($this->testCases);
    }

    public function headings(): array
    {
        return [
            'File',
            'Test Case Name',
            'Description (from comment)',
        ];
    }
}