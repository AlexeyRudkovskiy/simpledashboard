<?php
/**
 * Created by PhpStorm.
 * User: alexey
 * Date: 07.09.18
 * Time: 16:12
 */

namespace ARudkovskiy\Admin\Http\Controllers;


use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class FileManagerController extends Controller
{

    public function index()
    {
        return view('@admin::file_manager.index', []);
    }

    public function getDirectoryInfo(Request $request) {
        $folder = $request->get('folder', '/');
        if (starts_with('/', $folder)) {
            $folder = substr($folder, 1);
        }
        $isNotRootFolder = !empty($folder);
        $folder = '/public/' . $folder;

        $folders = collect(\Storage::directories($folder));
        $files = collect(\Storage::files($folder));

        if (!ends_with($folder, '/')) {
            $folder .= '/';
        }

        $files = $this->processFiles($files, $folder);
        $folders = $this->processFolders($folders, $folder);

        if ($isNotRootFolder) {
            $parentFolder = explode('/', $folder);
            array_pop($parentFolder);
            array_shift($parentFolder);
            array_shift($parentFolder);
            $parentFolder = implode('/', $parentFolder);

            $folders->prepend([
                'name' => '..',
                'path' => $parentFolder
            ]);
        }

        return [
            'folders' => $folders,
            'files' => $files
        ];
    }

    public function processFolders(Collection $folders, string $folder) {
        $folder = substr($folder, 1);
        return $folders
            ->map(function ($item) use ($folder) {
                $folderName = str_replace($folder, '', $item);
                $folderPath = str_replace('public/', '', $item);
                return [
                    'name' => $folderName,
                    'path' => $folderPath
                ];
            });
    }

    public function processFiles(Collection $files, string $folder) {
        $folder = substr($folder, 1);
        return $files->map(function ($file) use ($folder) {
            $fileExtension = pathinfo(storage_path($file), PATHINFO_EXTENSION);
            $filePath = $file;
            $fileName = str_replace($folder, '', $filePath);
            $url = str_replace('public/', '', $filePath);
            $url = '/storage/' . $url;
            return [
                'filename' => $fileName,
                'path' => $filePath,
                'type' => $this->getFileTypeFromExtension($fileExtension),
                'size' => $this->humanFilesize(\Storage::size($filePath)),
                'last_modified' => Carbon::createFromTimestamp(\Storage::lastModified($filePath))->format("d.m.Y H:s:i"),
                'url' => $url
            ];
        });
    }

    public function delete(Request $request) {
        $file = $request->get('file');
        $isSuccess = \Storage::delete($file);

        return [
            'path' => $file,
            'deleted' => $isSuccess
        ];
    }

    protected function humanFilesize($bytes, $decimals = 2) {
        $size = array('B','kB','MB','GB','TB','PB','EB','ZB','YB');
        $factor = floor((strlen($bytes) - 1) / 3);
        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
    }

    protected function getFileTypeFromExtension(string $extension): string {
        $fileExtensionAndTypes = [
            'zip' => 'zip',
            'rar' => 'zip',
            '7z' => 'zip',
            'doc' => 'doc',
            'docx' => 'docx',
            'xls' => 'xls',
            'xlsx' => 'xlsx',
            'exe' => 'exe',
            'txt' => 'txt',
            'html' => 'html',
            'css' => 'css',
            'js' => 'js',
            'iso' => 'iso',
            'jpg' => 'jpg',
            'bmp' => 'jpg',
            'png' => 'png',
            'json' => 'json-file',
            'pdf' => 'pdf',
            'mp3' => 'mp3',
            'mp4' => 'mp4',
            'psd' => 'psd',
            'ppt' => 'ppt',
            'pptx' => 'pptx',
            'rtf' => 'rtf',
            'svg' => 'svg'
        ];

        return $fileExtensionAndTypes[$extension] ?? 'file';
    }

}