<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;

class KhsController extends Controller
{
    public function cetakKhs($userId)
    {
        // $mahasiswa = Mahasiswa::findOrFail($mahasiswaId);
        $user = User::with('mahasiswa')->findOrFail($userId);
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();
        dd($mahasiswa);

        $templatePath = storage_path('app/templates/khs_template.docx');
        $templateProcessor = new TemplateProcessor($templatePath);

        $templateProcessor->setValue('nama', $mahasiswa->User->nama);
        $templateProcessor->setValue('nim', $mahasiswa->nim);
        $templateProcessor->setValue('kelas', $mahasiswa->kelas->nama);
        $templateProcessor->setValue('semester', $mahasiswa->semester->nama);
        $templateProcessor->setValue('prodi', $mahasiswa->prodi->nama);

        $nilaiData = [];
        foreach ($mahasiswa->khs->nilai as $item) {
            $nilaiData[] = [
                'matkul' => $item->matkul->nama,
                'nilai' => $item->nilai,
            ];
        }

        $templateProcessor->cloneBlock('nilai_loop', count($nilaiData), true, false, $nilaiData);

        $outputPath = storage_path('app/khs_mahasiswa_' . $mahasiswa->id . '.docx');
        $templateProcessor->saveAs($outputPath);

        return response()->download($outputPath)->deleteFileAfterSend(true);
    }
}
