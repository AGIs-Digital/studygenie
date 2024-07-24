<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class RenameAssets extends Command
{
    protected $signature = 'assets:rename';
    protected $description = 'Rename asset files and update references in resources files';

    protected $assetPath = 'public/asset';
    protected $resourcesPath = 'resources';
    protected $replacements = [
        'ä' => 'ae',
        'ö' => 'oe',
        'ü' => 'ue',
        'ß' => 'ss',
        ' ' => '_'
    ];
    protected $renamedFiles = [];

    public function handle()
    {
        $this->renameFiles($this->assetPath);

        $this->updateReferences($this->resourcesPath);
        $this->generateReport();
        $this->info('Assets renaming and references updating completed.');
    }

    protected function renameFiles($directory)
    {
        $files = File::allFiles($directory);
        foreach ($files as $file) {
            $originalName = $file->getFilename();
            $newName = $this->getNewName($originalName);
            if ($originalName !== $newName) {
                $newPath = $file->getPath() . DIRECTORY_SEPARATOR . $newName;
                File::move($file->getPathname(), $newPath);
                $this->renamedFiles[$originalName] = $newName;
                $this->info("Renamed: $originalName -> $newName");
            }
        }
    }

    protected function getNewName($filename)
    {
        return strtr($filename, $this->replacements);
    }

    protected function updateReferences($directory)
    {
        $files = File::allFiles($directory);
        foreach ($files as $file) {
            $content = File::get($file->getPathname());
            $updated = false;
            foreach ($this->renamedFiles as $original => $new) {
                // Make sure $new is treated as a string when outputting
                $newName = is_array($new) ? $new[0] : $new;
                if (strpos($content, $original) !== false) {
                    $this->info("Found reference: $original in " . $file->getPathname() . "; Replacing with " . $newName);
                    $content = str_replace($original, $newName, $content);
                    $this->info("Updated reference: $original -> $newName in " . $file->getPathname());

                    // Initialize the array if it doesn't exist
                    if (!is_array($this->renamedFiles[$original])) {
                        $this->renamedFiles[$original] = [$new];
                    }

                    $this->renamedFiles[$original][] = $file->getPathname();
                    $updated = true;
                }
            }
            if ($updated) {
                File::put($file->getPathname(), $content);
            }
        }
    }


    protected function generateReport()
    {
        $report = "Renamed Files Report\n\n";
        foreach ($this->renamedFiles as $original => $data) {
            if (is_array($data)) {
                $newName = $data[0];
                $report .= "File: $original -> $newName\n";
                $report .= "Referenced in:\n";
                foreach ($data as $referenceFile) {
                    $report .= "- $referenceFile\n";
                }
                $report .= "\n";
            }
        }
        File::put(storage_path('logs/renaming_report.txt'), $report);
    }
}
