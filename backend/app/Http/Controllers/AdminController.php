<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\KycSubmission;
use App\Models\Transaction;
use App\Models\ChatServiceSetting;
use App\Models\BackupLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Artisan;
use ZipArchive;

class AdminController extends Controller
{
    public function index()
    {
        return User::with('kyc')->paginate(20);
    }

    public function approveKyc(KycSubmission $kycSubmission)
    {
        $kycSubmission->update([
            'status' => 'approved',
            'reviewed_by' => auth()->id(),
            'reviewed_at' => now()
        ]);
        
        return response()->json(['message' => 'KYC approved successfully']);
    }

    public function getTransactions()
    {
        return Transaction::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(50);
    }

    // Chat system configuration
    public function updateChatSettings(Request $request)
    {
        $validated = $request->validate([
            'service_provider' => 'required|in:Pusher,Firebase,Firestore',
            'api_key' => 'required|string',
            'api_secret' => 'required|string',
            'project_id' => 'nullable|string',
            'active' => 'boolean'
        ]);

        ChatServiceSetting::updateOrCreate(
            ['id' => 1],
            $validated
        );

        return response()->json(['message' => 'Chat settings updated successfully']);
    }

    // Backup management
    public function generateBackup()
    {
        try {
            $fileName = 'backup-'.date('Y-m-d-His').'.zip';
            $backupPath = storage_path('app/backups/'.$fileName);
            
            // Ensure backup directory exists
            Storage::makeDirectory('backups');
            
            $zip = new ZipArchive;
            if ($zip->open($backupPath, ZipArchive::CREATE) === true) {
                // Add database dump
                Artisan::call('snapshot:create', ['name' => $fileName]);
                $zip->addFile(storage_path('app/snapshots/'.$fileName.'.sql'), 'database.sql');
                
                // Add important directories
                $this->addDirectoryToZip($zip, app_path());
                $this->addDirectoryToZip($zip, config_path());
                $this->addDirectoryToZip($zip, database_path('migrations'));
                $this->addDirectoryToZip($zip, resource_path('views'));
                $this->addDirectoryToZip($zip, public_path());
                
                $zip->close();
                
                // Log backup
                BackupLog::create(['backup_file_path' => $backupPath]);
                
                return response()->json([
                    'download_url' => url("backups/download/$fileName"),
                    'message' => 'Backup created successfully'
                ]);
            }
            
            return response()->json(['error' => 'Could not create backup'], 500);
            
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    private function addDirectoryToZip(ZipArchive $zip, $path, $parent = '')
    {
        $files = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($path),
            \RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($files as $name => $file) {
            if (!$file->isDir()) {
                $filePath = $file->getRealPath();
                $relativePath = $parent . substr($filePath, strlen($path) + 1);
                $zip->addFile($filePath, $relativePath);
            }
        }
    }

    public function getBackupLogs()
    {
        return BackupLog::orderBy('created_at', 'desc')->paginate(10);
    }
}
