<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SiswaProfilRequest extends FormRequest
{
    public function authorize()
    {
        // You can add authorization logic here if needed
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'penghasilan_perbulan_ayah' => $this->input('penghasilan_perbulan_ayah') ?: '0',
            'penghasilan_perbulan_ibu' => $this->input('penghasilan_perbulan_ibu') ?: '0',
        ]);
    }

    public function rules()
    {
        return [
            'nama_lengkap' => 'nullable|string|max:255',
            'nama_panggilan' => 'nullable|string|max:255',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:L,P',
            'agama' => 'nullable|in:islam,budha,hindu,kristen',
            'kewarganegaraan' => 'nullable|string|max:255',
            'anak_ke_berapa' => 'nullable|integer',
            'jumlah_saudara_kandung' => 'nullable|integer',
            'jumlah_saudara_tiri' => 'nullable|integer',
            'jumlah_saudara_angkat' => 'nullable|integer',
            'bahasa_sehari_hari_di_rumah' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
            'nomor_telepon' => 'nullable|string|max:20',
            'tinggal_dengan' => 'nullable|in:orang tua,menumpang,di asrama,kost',
            'jarak_tempat_tinggal_ke_sekolah' => 'nullable|numeric',
            'alat_transportasi_ke_sekolah' => 'nullable|string|max:255',
            'berat_badan' => 'nullable|numeric',
            'tinggi_badan' => 'nullable|numeric',
            'golongan_darah' => 'nullable|string|max:3',
            'penyakit_yang_pernah_diderita' => 'nullable|string|max:255',
            'asal_SD' => 'nullable|string|max:255',
            'nomor_sttb_SD' => 'nullable|string|max:255',
            'tanggal_sttb_SD' => 'nullable|date',
            'lama_belajar_SD' => 'nullable|string|max:255',
            'asal_SMP' => 'nullable|string|max:255',
            'nomor_sttb_SMP' => 'nullable|string|max:255',
            'tanggal_sttb_SMP' => 'nullable|date',
            'nama_ayah' => 'nullable|string|max:255',
            'tempat_lahir_ayah' => 'nullable|string|max:255',
            'tanggal_lahir_ayah' => 'nullable|date',
            'alamat_ayah' => 'nullable|string',
            'nomor_telepon_ayah' => 'nullable|string|max:20',
            'pekerjaan_ayah' => 'nullable|string|max:255',
            'penghasilan_perbulan_ayah' => 'nullable|numeric',
            'pendidikan_ayah' => 'nullable|string|max:255',
            'kewarganegaraan_ayah' => 'nullable|string|max:255',
            'nama_ibu' => 'nullable|string|max:255',
            'tempat_lahir_ibu' => 'nullable|string|max:255',
            'tanggal_lahir_ibu' => 'nullable|date',
            'alamat_ibu' => 'nullable|string',
            'nomor_telepon_ibu' => 'nullable|string|max:20',
            'pekerjaan_ibu' => 'nullable|string|max:255',
            'penghasilan_perbulan_ibu' => 'nullable|numeric',
            'pendidikan_ibu' => 'nullable|string|max:255',
            'kewarganegaraan_ibu' => 'nullable|string|max:255',
            'nama_wali' => 'nullable|string|max:255',
            'alamat_wali' => 'nullable|string',
            'nomor_telepon_wali' => 'nullable|string|max:20',
            'kegemaran_olah_raga' => 'nullable|string|max:255',
            'kegemaran_kemasyarakatan' => 'nullable|string|max:255',
            'kegemaran_hasta_karya' => 'nullable|string|max:255',
            'jurusan' => 'nullable|in:TBSM,TKR,TITL,TP,TKJ',
        ];
    }
}
