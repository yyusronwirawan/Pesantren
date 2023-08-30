<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Konten;
use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        User::create([
            'name' => 'Admin Aplikasi',
            'username' => 'admin',
            'level' => 'admin',
            'email' => 'adminalmuntadhor@gmail.com',
            'password' => bcrypt('@Dhoradmin123'),
            'remember_token' => Str::random(60),
        ]);

        User::create([
            'name' => 'Pengurus Aplikasi',
            'username' => 'pengurus',
            'level' => 'pengurus',
            'email' => 'pengurus@gmail.com',
            'password' => bcrypt('@Dhorpengurus123'),
            'remember_token' => Str::random(60),
        ]);

        User::create([
            'name' => 'Guru Matematika',
            'username' => 'matematika',
            'level' => 'pendidik',
            'email' => 'matematika@gmail.com',
            'password' => bcrypt('@Dhormatematika123'),
            'remember_token' => Str::random(60),
            'kelas' => 'Matematika',
        ]);

        User::create([
            'name' => 'Guru Fiqh',
            'username' => 'fiqh',
            'level' => 'pendidik',
            'email' => 'fiqh@gmail.com',
            'password' => bcrypt('@Dhorfiqh123'),
            'remember_token' => Str::random(60),
            'kelas' => 'Fiqh',
        ]);

        User::create([
            'name' => 'Guru Aqidah',
            'username' => 'aqidah',
            'level' => 'pendidik',
            'email' => 'aqidah@gmail.com',
            'password' => bcrypt('@Dhoraqidah123'),
            'remember_token' => Str::random(60),
            'kelas' => 'Aqidah',
        ]);

        User::create([
            'name' => 'Guru Akhlak',
            'username' => 'akhlak',
            'level' => 'pendidik',
            'email' => 'akhlak@gmail.com',
            'password' => bcrypt('@Dhorakhlak123'),
            'remember_token' => Str::random(60),
            'kelas' => 'Akhlak',
        ]);

        User::create([
            'name' => 'Guru Nahwu',
            'username' => 'nahwu',
            'level' => 'pendidik',
            'email' => 'nahwu@gmail.com',
            'password' => bcrypt('@Dhornahwu123'),
            'remember_token' => Str::random(60),
            'kelas' => 'Nahwu',
        ]);

        User::create([
            'name' => 'Guru Tauhid',
            'username' => 'tauhid',
            'level' => 'pendidik',
            'email' => 'tauhid@gmail.com',
            'password' => bcrypt('@Dhortauhid123'),
            'remember_token' => Str::random(60),
            'kelas' => 'Tauhid',
        ]);

        User::create([
            'name' => 'Guru Hadis',
            'username' => 'hadis',
            'level' => 'pendidik',
            'email' => 'hadis@gmail.com',
            'password' => bcrypt('@Dhorhadis123'),
            'remember_token' => Str::random(60),
            'kelas' => 'Hadis',
        ]);

        User::create([
            'name' => 'Guru Tasawuf',
            'username' => 'tasawuf',
            'level' => 'pendidik',
            'email' => 'tasawuf@gmail.com',
            'password' => bcrypt('@Dhortasawuf123'),
            'remember_token' => Str::random(60),
            'kelas' => 'Tasawuf',
        ]);

        User::create([
            'name' => 'Guru Tahajji',
            'username' => 'tahajji',
            'level' => 'pendidik',
            'email' => 'tahajji@gmail.com',
            'password' => bcrypt('@Dhortahajji123'),
            'remember_token' => Str::random(60),
            'kelas' => 'Tahajji',
        ]);

        User::create([
            'name' => 'Guru Imla',
            'username' => 'imla',
            'level' => 'pendidik',
            'email' => 'imla@gmail.com',
            'password' => bcrypt('@Dhorimla123'),
            'remember_token' => Str::random(60),
            'kelas' => 'Imla',
        ]);

        User::create([
            'name' => 'Guru Inggris',
            'username' => 'inggris',
            'level' => 'pendidik',
            'email' => 'inggris@gmail.com',
            'password' => bcrypt('@Dhoringgris123'),
            'remember_token' => Str::random(60),
            'kelas' => 'Bahasa Inggris',
        ]);

        User::create([
            'name' => 'Guru Kromo',
            'username' => 'kromo',
            'level' => 'pendidik',
            'email' => 'kromo@gmail.com',
            'password' => bcrypt('@Dhorkromo123'),
            'remember_token' => Str::random(60),
            'kelas' => 'Bahasa Kromo',
        ]);

        User::create([
            'name' => 'Guru Teknologi Informasi',
            'username' => 'teknologi',
            'level' => 'pendidik',
            'email' => 'teknologis@gmail.com',
            'password' => bcrypt('@Dhorteknologi123'),
            'remember_token' => Str::random(60),
            'kelas' => 'Teknologi Informasi',
        ]);

        Setting::create([
            'nama_aplikasi' =>'AlHuda', 
            'nama_pesantren' =>'AlHuda', 
            'alamat' =>'Jl.Merdeka', 
            'telp'=>'0989878953', 
            'website'=>'www.alhuda.web.id', 
            'pengasuh'=>'KH. Burhanuddin', 
            'izin'=>'12/izin', 
            'logo_aplikasi'=>'logo_default.png', 
            'maintenance'=>'TIDAK AKTIF', 
            'nominal_syariyyah'=>'350000', 
            'nominal_daftarulang'=>'750000',

        ]);

        Konten::create([
            'judul'=>'Slide 1',
            'kategori'=>'Dashboard',
            'gambar'=>'893667819.jpg',
            'deskripsi'=>'Slide 1'
        ]);
        Konten::create([
            'judul'=>'Slide 2',
            'kategori'=>'Dashboard',
            'gambar'=>'893667819.jpg',
            'deskripsi'=>'Slide 2'
        ]);
        Konten::create([
            'judul'=>'Slide 2',
            'kategori'=>'Dashboard',
            'gambar'=>'893667819.jpg',
            'deskripsi'=>'Slide 2'
        ]);
    }
}
