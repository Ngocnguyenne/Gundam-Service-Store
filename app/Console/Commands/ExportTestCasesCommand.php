<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TestCasesExport;
use ReflectionClass;

class ExportTestCasesCommand extends Command
{
    protected $signature = 'export:testcases';
    protected $description = 'Export all test cases to an Excel file.';

    public function handle()
    {
        $this->info('Scanning test files...');
        $testFiles = File::allFiles(base_path('tests'));
        $allTestCases = [];

        foreach ($testFiles as $file) {
            // Chỉ xử lý file PHP
            if ($file->getExtension() !== 'php') continue;

            $className = 'Tests\\' . str_replace(['/', '.php'], ['\\', ''], $file->getRelativePathname());

            if (!class_exists($className)) continue;

            $reflection = new ReflectionClass($className);

            foreach ($reflection->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
                $methodName = $method->getName();
                // Lấy các test case (tên bắt đầu bằng test hoặc có doc comment @test)
                if (strpos($methodName, 'test') === 0 || strpos($method->getDocComment(), '@test') !== false) {
                    $allTestCases[] = [
                        'file' => $file->getFilename(),
                        'name' => $methodName,
                        'description' => $this->getDocCommentSummary($method->getDocComment()),
                    ];
                }
            }
        }

        $fileName = 'test-cases-report.xlsx';
        Excel::store(new TestCasesExport($allTestCases), $fileName);

        $this->info('Successfully exported ' . count($allTestCases) . ' test cases to ' . $fileName);
        return 0;
    }

    private function getDocCommentSummary($comment)
    {
        if ($comment === false) return '';
        $lines = explode("\n", $comment);
        $summary = '';
        foreach ($lines as $line) {
            $cleanedLine = trim($line, "/* \t\n\r\0\x0B");
            if (!empty($cleanedLine)) {
                $summary = $cleanedLine;
                break;
            }
        }
        return $summary;
    }
}