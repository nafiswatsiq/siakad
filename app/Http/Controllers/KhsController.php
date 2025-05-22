<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\NilaiMatkul;
use App\Models\TahunAjaran;
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
        $nilaiMatkul = NilaiMatkul::where('mahasiswa_id', $mahasiswa->id)->get();

        $templatePath = 'templates/khs_template.docx';
        $templateProcessor = new TemplateProcessor($templatePath);

        $templateProcessor->setValue('nama', $user->name);
        $templateProcessor->setValue('nim', $mahasiswa->nim);
        $templateProcessor->setValue('kelas', $mahasiswa->kelas->nama);
        $templateProcessor->setValue('semester', $mahasiswa->semester->nama);
        $templateProcessor->setValue('prodi', $mahasiswa->prodi->nama);
        $templateProcessor->setValue('ipk', optional($mahasiswa->nilai)->ipk ?? '-');
        $templateProcessor->setValue('ips', optional($mahasiswa->nilai)->ips ?? '-');
        $status = optional($mahasiswa->nilai)->status == 1 ? 'LULUS' : 'TIDAK LULUS';
        $templateProcessor->setValue('status', $status);
                
        // Persiapan looping nilai
        $nilaiData = [];
        $totalSks = 0;
        $totalMutu = 0;

        foreach ($nilaiMatkul as $index => $item) {
            $sks = $item->matkul->sks;
            $mutu = $item->nilai;

            $totalSks += $sks;
            $totalMutu += $mutu;

            $nilaiData[] = [
                'no' => $index + 1,
                'kode_matkul' => $item->matkul->kode_matkul,
                'matkul' => $item->matkul->nama,
                'sks' => $sks,
                'nilai' => $mutu,
            ];
        }

        // dd($nilaiMatkul, $nilaiData, $mahasiswa); 
        $templateProcessor->cloneRowAndSetValues('no', $nilaiData);

         // Isi total sks dan mutu ke template
         $templateProcessor->setValue('jumlah_sks', $totalSks);
         $templateProcessor->setValue('jumlah_mutu', $totalMutu);
  

        // $templateProcessor->cloneBlock('nilai_loop', count($nilaiData), true, false, $nilaiData); (kalo pake ini perlu ${nilai_loop} dan ${/nilai_loop} di word nya)

        $outputPath = storage_path('app/public/khs_mahasiswa_' . $mahasiswa->id . '.docx');
        $templateProcessor->saveAs($outputPath);

        return response()->download($outputPath)->deleteFileAfterSend(true);
    }
}
