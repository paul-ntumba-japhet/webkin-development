<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExportBackendActionsInventoryCommand extends Command
{
    protected $signature = 'docs:export-backend-actions-xlsx
                            {--path=BACKEND_NEXT_STEPS_BEFORE_FRONTEND.md : Markdown path relative to the application base}
                            {--output=docs/backend-actions-inventory.xlsx : Output .xlsx path relative to the application base}';

    protected $description = 'Export all `*Action` names from BACKEND_NEXT_STEPS appendix into an Excel workbook.';

    public function handle(): int
    {
        $mdPath = base_path($this->option('path'));
        if (! is_file($mdPath)) {
            $this->error("File not found: {$mdPath}");

            return self::FAILURE;
        }

        $content = file_get_contents($mdPath);
        $start = strpos($content, '## Appendix');
        $end = strpos($content, '## Suggested order');
        if ($start === false || $end === false || $end <= $start) {
            $this->error('Could not find "## Appendix" or "## Suggested order" section markers.');

            return self::FAILURE;
        }

        $section = substr($content, $start, $end - $start);
        $lines = preg_split("/\r\n|\n|\r/", $section);

        $currentSection = '';
        $seen = [];
        $rows = [];

        foreach ($lines as $line) {
            if (preg_match('/^###\s+(.+)/', $line, $m)) {
                $currentSection = trim($m[1]);

                continue;
            }

            if (preg_match_all('/`([A-Za-z0-9]+Action)`/', $line, $matches)) {
                foreach ($matches[1] as $name) {
                    if ($name === 'XxxAction') {
                        continue;
                    }
                    if (isset($seen[$name])) {
                        continue;
                    }
                    $seen[$name] = true;
                    $rows[] = [
                        'section' => $currentSection,
                        'action' => $name,
                    ];
                }
            }
        }

        $spreadsheet = new Spreadsheet;
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Actions');
        $sheet->fromArray(['#', 'Module / section', 'Action name'], null, 'A1');

        $rowIndex = 2;
        $n = 1;
        foreach ($rows as $row) {
            $sheet->setCellValue("A{$rowIndex}", $n++);
            $sheet->setCellValue("B{$rowIndex}", $row['section']);
            $sheet->setCellValue("C{$rowIndex}", $row['action']);
            $rowIndex++;
        }

        $sheet->getColumnDimension('A')->setWidth(6);
        $sheet->getColumnDimension('B')->setWidth(44);
        $sheet->getColumnDimension('C')->setWidth(50);

        $out = base_path($this->option('output'));
        $dir = dirname($out);
        if (! is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        (new Xlsx($spreadsheet))->save($out);

        $this->info(sprintf('Wrote %d unique actions to %s', count($rows), $out));

        return self::SUCCESS;
    }
}
