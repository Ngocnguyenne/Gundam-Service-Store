<?php

namespace Tests\Listeners;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PHPUnit\Framework\Test;
use PHPUnit\Framework\TestListener;
use PHPUnit\Framework\TestListenerDefaultImplementation;
use PHPUnit\Framework\TestSuite;

class ExcelTestListener implements TestListener
{
    use TestListenerDefaultImplementation;

    private array $results = [];

    public function addFailure(Test $test, \Throwable $t, float $time): void
    {
        $this->results[] = [
            'test' => $test->getName(),
            'status' => 'FAILED',
            'time' => $time,
            'message' => $t->getMessage(),
        ];
    }

    public function addError(Test $test, \Throwable $t, float $time): void
    {
        $this->results[] = [
            'test' => $test->getName(),
            'status' => 'ERROR',
            'time' => $time,
            'message' => $t->getMessage(),
        ];
    }

    public function addIncompleteTest(Test $test, \Throwable $t, float $time): void
    {
        $this->results[] = [
            'test' => $test->getName(),
            'status' => 'INCOMPLETE',
            'time' => $time,
            'message' => $t->getMessage(),
        ];
    }

    public function addSkippedTest(Test $test, \Throwable $t, float $time): void
    {
        $this->results[] = [
            'test' => $test->getName(),
            'status' => 'SKIPPED',
            'time' => $time,
            'message' => $t->getMessage(),
        ];
    }

    public function endTest(Test $test, float $time): void
    {
        // Nếu test chưa ghi kết quả lỗi, mặc định là PASSED
        $exists = array_filter($this->results, fn($r) => $r['test'] === $test->getName());
        if (!$exists) {
            $this->results[] = [
                'test' => $test->getName(),
                'status' => 'PASSED',
                'time' => $time,
                'message' => '',
            ];
        }
    }

    public function endTestSuite(TestSuite $suite): void
    {
        if ($suite->getName() === '') {
            // Xuất ra Excel khi chạy xong toàn bộ
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setTitle('Test Results');

            // Header
            $sheet->setCellValue('A1', 'Test Name');
            $sheet->setCellValue('B1', 'Status');
            $sheet->setCellValue('C1', 'Time (s)');
            $sheet->setCellValue('D1', 'Message');

            // Ghi data
            $row = 2;
            foreach ($this->results as $result) {
                $sheet->setCellValue("A{$row}", $result['test']);
                $sheet->setCellValue("B{$row}", $result['status']);
                $sheet->setCellValue("C{$row}", round($result['time'], 4));
                $sheet->setCellValue("D{$row}", $result['message']);
                $row++;
            }

            $writer = new Xlsx($spreadsheet);
            $writer->save(base_path('test-report.xlsx'));
        }
    }
}
