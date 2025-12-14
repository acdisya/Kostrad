<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Perkara - {{ $perkara->nomor_perkara }} - SIPERKARA DIV-2</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .tab-button.active {
            background-color: #166534;
            color: white;
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-gradient-to-r from-green-900 via-green-800 to-green-900 shadow-lg fixed w-full top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-18 py-3">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-md">
                        <svg class="w-7 h-7 text-green-800" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-white font-bold text-lg">SIPERKARA DIV-2</h1>
                        <p class="text-green-200 text-xs">Divisi 2 Kostrad</p>
                    </div>
                </div>
                <div class="hidden md:flex space-x-8">
                    <a href="{{ route('landing') }}" class="text-white hover:text-green-300 font-medium transition duration-300">Beranda</a>
                    <a href="{{ route('perkara.public') }}" class="text-white hover:text-green-300 font-medium transition duration-300">Data Perkara Publik</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Header Section -->
    <section class="pt-32 pb-8 bg-gradient-to-r from-green-900 via-green-800 to-green-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <div>
                    <a href="{{ route('perkara.public') }}" class="text-green-200 hover:text-white mb-4 inline-flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Kembali ke Daftar Perkara
                    </a>
                    <h1 class="text-3xl md:text-4xl font-extrabold text-white mb-2">Detail Perkara</h1>
                    <p class="text-lg text-green-100">{{ $perkara->nomor_perkara }}</p>
                </div>
                <div>
                    <span class="px-4 py-2 text-sm font-semibold rounded-full {{ $perkara->status === 'Selesai' ? 'bg-green-500 text-white' : 'bg-yellow-500 text-white' }}">
                        {{ $perkara->status }}
                    </span>
                </div>
            </div>
        </div>
    </section>

    <!-- Tabs Navigation -->
    <section class="bg-white border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex space-x-2 overflow-x-auto">
                <button onclick="showTab('data-umum')" class="tab-button active px-6 py-4 font-semibold text-gray-700 hover:bg-gray-100 border-b-2 border-transparent hover:border-green-800 transition duration-300 whitespace-nowrap">
                    Data Umum
                </button>
                <button onclick="showTab('penetapan')" class="tab-button px-6 py-4 font-semibold text-gray-700 hover:bg-gray-100 border-b-2 border-transparent hover:border-green-800 transition duration-300 whitespace-nowrap">
                    Penetapan
                </button>
                <button onclick="showTab('saksi')" class="tab-button px-6 py-4 font-semibold text-gray-700 hover:bg-gray-100 border-b-2 border-transparent hover:border-green-800 transition duration-300 whitespace-nowrap">
                    Saksi
                </button>
                <button onclick="showTab('barang-bukti')" class="tab-button px-6 py-4 font-semibold text-gray-700 hover:bg-gray-100 border-b-2 border-transparent hover:border-green-800 transition duration-300 whitespace-nowrap">
                    Barang Bukti
                </button>
                <button onclick="showTab('riwayat')" class="tab-button px-6 py-4 font-semibold text-gray-700 hover:bg-gray-100 border-b-2 border-transparent hover:border-green-800 transition duration-300 whitespace-nowrap">
                    Riwayat Perkara
                </button>
            </div>
        </div>
    </section>

    <!-- Content Section -->
    <section class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- TAB: Data Umum -->
            <div id="tab-data-umum" class="tab-content">
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Data Umum Perkara</h2>

                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Tanggal Pendaftaran -->
                        <div class="bg-green-50 p-4 rounded-lg">
                            <label class="block text-sm font-semibold text-green-800 mb-1">Tanggal Pendaftaran</label>
                            <p class="text-gray-900">{{ $perkara->tanggal_pendaftaran ? $perkara->tanggal_pendaftaran->format('d F Y') : '-' }}</p>
                        </div>

                        <!-- Klasifikasi Perkara -->
                        <div class="bg-green-50 p-4 rounded-lg">
                            <label class="block text-sm font-semibold text-green-800 mb-1">Klasifikasi Perkara</label>
                            <p class="text-gray-900">{{ $perkara->klasifikasi_perkara ?: '-' }}</p>
                        </div>

                        <!-- Nomor Perkara -->
                        <div class="bg-green-50 p-4 rounded-lg">
                            <label class="block text-sm font-semibold text-green-800 mb-1">Nomor Perkara</label>
                            <p class="text-gray-900 font-bold">{{ $perkara->nomor_perkara }}</p>
                        </div>

                        <!-- Jenis Perkara -->
                        <div class="bg-green-50 p-4 rounded-lg">
                            <label class="block text-sm font-semibold text-green-800 mb-1">Jenis Perkara</label>
                            <p class="text-gray-900">{{ $perkara->jenis_perkara }}</p>
                        </div>

                        <!-- Kategori -->
                        <div class="bg-green-50 p-4 rounded-lg">
                            <label class="block text-sm font-semibold text-green-800 mb-1">Kategori</label>
                            <p class="text-gray-900">{{ $perkara->kategori->nama }}</p>
                        </div>

                        <!-- Prioritas -->
                        <div class="bg-green-50 p-4 rounded-lg">
                            <label class="block text-sm font-semibold text-green-800 mb-1">Prioritas</label>
                            @php
                                $priorityLabel = [
                                    'Low' => 'Rendah',
                                    'Medium' => 'Sedang',
                                    'High' => 'Tinggi',
                                    'Urgent' => 'Mendesak',
                                ];
                            @endphp
                            <p class="text-gray-900">{{ $priorityLabel[$perkara->priority] ?? $perkara->priority }}</p>
                        </div>

                        <!-- Tanggal Masuk -->
                        <div class="bg-green-50 p-4 rounded-lg">
                            <label class="block text-sm font-semibold text-green-800 mb-1">Tanggal Masuk</label>
                            <p class="text-gray-900">{{ $perkara->tanggal_masuk->format('d F Y') }}</p>
                        </div>

                        <!-- Tanggal Selesai -->
                        <div class="bg-green-50 p-4 rounded-lg">
                            <label class="block text-sm font-semibold text-green-800 mb-1">Tanggal Selesai</label>
                            <p class="text-gray-900">{{ $perkara->tanggal_selesai ? $perkara->tanggal_selesai->format('d F Y') : 'Belum Selesai' }}</p>
                        </div>
                    </div>

                    <!-- Informasi Surat -->
                    <div class="mt-8 pt-8 border-t border-gray-200">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Informasi Surat</h3>
                        <div class="grid md:grid-cols-2 gap-6">
                            <!-- Surat Pelimpahan -->
                            <div class="bg-green-50 p-4 rounded-lg">
                                <label class="block text-sm font-semibold text-green-800 mb-1">Nomor Surat Pelimpahan</label>
                                <p class="text-gray-900">{{ $perkara->nomor_surat_pelimpahan ?: '-' }}</p>
                            </div>

                            <div class="bg-green-50 p-4 rounded-lg">
                                <label class="block text-sm font-semibold text-green-800 mb-1">Tanggal Surat Pelimpahan</label>
                                <p class="text-gray-900">{{ $perkara->tanggal_surat_pelimpahan ? $perkara->tanggal_surat_pelimpahan->format('d F Y') : '-' }}</p>
                            </div>

                            <!-- Surat Dakwaan -->
                            <div class="bg-green-50 p-4 rounded-lg">
                                <label class="block text-sm font-semibold text-green-800 mb-1">Nomor Surat Dakwaan</label>
                                <p class="text-gray-900">{{ $perkara->nomor_surat_dakwaan ?: '-' }}</p>
                            </div>

                            <div class="bg-green-50 p-4 rounded-lg">
                                <label class="block text-sm font-semibold text-green-800 mb-1">Tanggal Surat Dakwaan</label>
                                <p class="text-gray-900">{{ $perkara->tanggal_surat_dakwaan ? $perkara->tanggal_surat_dakwaan->format('d F Y') : '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tempat & Waktu Kejadian -->
                <div class="bg-white rounded-2xl shadow-lg p-8 mt-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">Tempat & Waktu Kejadian</h3>
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="bg-green-50 p-4 rounded-lg">
                            <label class="block text-sm font-semibold text-green-800 mb-1">Tanggal Kejadian</label>
                            <p class="text-gray-900">{{ $perkara->tanggal_kejadian ? $perkara->tanggal_kejadian->format('d F Y') : '-' }}</p>
                        </div>

                        <div class="bg-green-50 p-4 rounded-lg">
                            <label class="block text-sm font-semibold text-green-800 mb-1">Tempat Kejadian</label>
                            <p class="text-gray-900">{{ $perkara->tempat_kejadian ?: '-' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Pasal Dakwaan -->
                <div class="bg-white rounded-2xl shadow-lg p-8 mt-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Pasal Dakwaan</h3>
                    <div class="bg-green-50 p-4 rounded-lg">
                        <p class="text-gray-900 whitespace-pre-line">{{ $perkara->pasal_dakwaan ?: '-' }}</p>
                    </div>
                </div>
            </div>

            <!-- TAB: Penetapan -->
            <div id="tab-penetapan" class="tab-content hidden">
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Data Penetapan</h2>

                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Tanggal Kejadian -->
                        <div class="bg-green-50 p-4 rounded-lg">
                            <label class="block text-sm font-semibold text-green-800 mb-1">Tanggal Kejadian</label>
                            <p class="text-gray-900">{{ $perkara->tanggal_kejadian ? $perkara->tanggal_kejadian->format('d F Y') : '-' }}</p>
                        </div>

                        <!-- Tempat Kejadian -->
                        <div class="bg-green-50 p-4 rounded-lg">
                            <label class="block text-sm font-semibold text-green-800 mb-1">Tempat Kejadian</label>
                            <p class="text-gray-900">{{ $perkara->tempat_kejadian ?: '-' }}</p>
                        </div>

                        <!-- Tanggal Skeppera -->
                        <div class="bg-green-50 p-4 rounded-lg">
                            <label class="block text-sm font-semibold text-green-800 mb-1">Tanggal Skeppera</label>
                            <p class="text-gray-900">{{ $perkara->tanggal_skeppera ? $perkara->tanggal_skeppera->format('d F Y') : '-' }}</p>
                        </div>

                        <!-- Nomor Skeppera -->
                        <div class="bg-green-50 p-4 rounded-lg">
                            <label class="block text-sm font-semibold text-green-800 mb-1">Nomor Skeppera</label>
                            <p class="text-gray-900">{{ $perkara->nomor_skeppera ?: '-' }}</p>
                        </div>

                        <!-- Pejabat Skeppera -->
                        <div class="bg-green-50 p-4 rounded-lg md:col-span-2">
                            <label class="block text-sm font-semibold text-green-800 mb-1">Pejabat Skeppera</label>
                            <p class="text-gray-900">{{ $perkara->pejabat_skeppera ?: '-' }}</p>
                        </div>

                        <!-- Tanggal Surat Dakwaan -->
                        <div class="bg-green-50 p-4 rounded-lg">
                            <label class="block text-sm font-semibold text-green-800 mb-1">Tanggal Surat Dakwaan</label>
                            <p class="text-gray-900">{{ $perkara->tanggal_surat_dakwaan ? $perkara->tanggal_surat_dakwaan->format('d F Y') : '-' }}</p>
                        </div>

                        <!-- Nomor Surat Dakwaan -->
                        <div class="bg-green-50 p-4 rounded-lg">
                            <label class="block text-sm font-semibold text-green-800 mb-1">Nomor Surat Dakwaan</label>
                            <p class="text-gray-900">{{ $perkara->nomor_surat_dakwaan ?: '-' }}</p>
                        </div>
                    </div>

                    <!-- Pasal Dakwaan -->
                    <div class="mt-8">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Pasal Dakwaan</h3>
                        <div class="bg-green-50 p-4 rounded-lg">
                            <p class="text-gray-900 whitespace-pre-line">{{ $perkara->pasal_dakwaan ?: '-' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Penyidik Militer -->
                <div class="bg-white rounded-2xl shadow-lg p-8 mt-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-6">Penyidik Militer</h3>
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="bg-green-50 p-4 rounded-lg">
                            <label class="block text-sm font-semibold text-green-800 mb-1">Nomor BAP Penyidik</label>
                            <p class="text-gray-900">{{ $perkara->nomor_bap_penyidik ?: '-' }}</p>
                        </div>

                        <div class="bg-green-50 p-4 rounded-lg">
                            <label class="block text-sm font-semibold text-green-800 mb-1">Tanggal BAP Penyidik</label>
                            <p class="text-gray-900">{{ $perkara->tanggal_bap_penyidik ? $perkara->tanggal_bap_penyidik->format('d F Y') : '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB: Saksi -->
            <div id="tab-saksi" class="tab-content hidden">
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Data Saksi</h2>
                    <div class="text-center py-12 text-gray-500">
                        <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <p>Data saksi belum tersedia untuk perkara ini</p>
                    </div>
                </div>
            </div>

            <!-- TAB: Barang Bukti -->
            <div id="tab-barang-bukti" class="tab-content hidden">
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Data Barang Bukti</h2>
                    <div class="text-center py-12 text-gray-500">
                        <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                        <p>Data barang bukti belum tersedia untuk perkara ini</p>
                    </div>
                </div>
            </div>

            <!-- TAB: Riwayat -->
            <div id="tab-riwayat" class="tab-content hidden">
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Riwayat Perkara</h2>

                    <!-- Oditur & Terdakwa -->
                    <div class="grid md:grid-cols-2 gap-6 mb-8">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-4">Oditur (Jaksa Militer)</h3>
                            <div class="bg-green-50 p-4 rounded-lg">
                                @if($perkara->oditur && is_array($perkara->oditur))
                                    @foreach($perkara->oditur as $oditur)
                                        <div class="mb-2">• {{ $oditur }}</div>
                                    @endforeach
                                @else
                                    <p class="text-gray-500">-</p>
                                @endif
                            </div>
                        </div>

                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-4">Terdakwa</h3>
                            <div class="bg-green-50 p-4 rounded-lg">
                                @if($perkara->terdakwa && is_array($perkara->terdakwa))
                                    @foreach($perkara->terdakwa as $terdakwa)
                                        <div class="mb-2">• {{ $terdakwa }}</div>
                                    @endforeach
                                @else
                                    <p class="text-gray-500">-</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Progress -->
                    <div class="mb-8">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Progress Perkara</h3>
                        <div class="bg-green-50 p-4 rounded-lg">
                            <div class="flex items-center">
                                <div class="flex-1">
                                    <div class="w-full bg-gray-200 rounded-full h-4">
                                        <div class="bg-green-600 h-4 rounded-full flex items-center justify-center text-xs text-white font-bold" style="width: {{ $perkara->progress ?? 0 }}%">
                                            {{ $perkara->progress ?? 0 }}%
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Keterangan -->
                    @if($perkara->keterangan)
                    <div class="mb-8">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Keterangan</h3>
                        <div class="bg-green-50 p-4 rounded-lg">
                            <p class="text-gray-900 whitespace-pre-line">{{ $perkara->keterangan }}</p>
                        </div>
                    </div>
                    @endif

                    <!-- Deskripsi -->
                    @if($perkara->deskripsi)
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Deskripsi</h3>
                        <div class="bg-green-50 p-4 rounded-lg">
                            <p class="text-gray-900 whitespace-pre-line">{{ $perkara->deskripsi }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

        </div>
    </section>

    <script>
        function showTab(tabName) {
            // Hide all tabs
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.add('hidden');
            });

            // Remove active class from all buttons
            document.querySelectorAll('.tab-button').forEach(btn => {
                btn.classList.remove('active');
            });

            // Show selected tab
            document.getElementById('tab-' + tabName).classList.remove('hidden');

            // Add active class to clicked button
            event.target.classList.add('active');
        }
    </script>
</body>

</html>
