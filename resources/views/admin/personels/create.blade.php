@extends('admin.layout')

@section('title', 'Tambah Personel')

@section('content')
    <div class="container mx-auto px-4 py-8 max-w-3xl">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center space-x-3 mb-4">
                <a href="{{ route('admin.personels.index') }}"
                    class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition">
                    <i class="fas fa-arrow-left text-xl"></i>
                </a>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Tambah Personel</h1>
            </div>
            <p class="text-gray-600 dark:text-gray-400">Tambahkan data personel militer baru</p>
        </div>

        <!-- Form -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-8">
            <form action="{{ route('admin.personels.store') }}" method="POST">
                @csrf

                <!-- NRP -->
                <div class="mb-6">
                    <label for="nrp" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        NRP <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nrp" id="nrp" value="{{ old('nrp') }}" required
                        class="w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-600 rounded-lg focus:border-green-800 focus:outline-none dark:bg-gray-700 dark:text-white @error('nrp') border-red-500 @enderror"
                        placeholder="Masukkan NRP">
                    @error('nrp')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nama -->
                <div class="mb-6">
                    <label for="nama" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        Nama Lengkap <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required
                        class="w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-600 rounded-lg focus:border-green-800 focus:outline-none dark:bg-gray-700 dark:text-white @error('nama') border-red-500 @enderror"
                        placeholder="Masukkan nama lengkap">
                    @error('nama')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Pangkat -->
                <div class="mb-6">
                    <label for="pangkat" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        Pangkat
                    </label>
                    <select name="pangkat" id="pangkat"
                        class="w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-600 rounded-lg focus:border-green-800 focus:outline-none dark:bg-gray-700 dark:text-white">
                        <option value="">-- Pilih Pangkat --</option>
                        <optgroup label="Perwira Tinggi">
                            <option value="Jenderal" {{ old('pangkat') == 'Jenderal' ? 'selected' : '' }}>Jenderal</option>
                            <option value="Letnan Jenderal" {{ old('pangkat') == 'Letnan Jenderal' ? 'selected' : '' }}>
                                Letnan Jenderal</option>
                            <option value="Mayor Jenderal" {{ old('pangkat') == 'Mayor Jenderal' ? 'selected' : '' }}>Mayor
                                Jenderal</option>
                            <option value="Brigadir Jenderal" {{ old('pangkat') == 'Brigadir Jenderal' ? 'selected' : '' }}>
                                Brigadir Jenderal</option>
                        </optgroup>
                        <optgroup label="Perwira Menengah">
                            <option value="Kolonel" {{ old('pangkat') == 'Kolonel' ? 'selected' : '' }}>Kolonel</option>
                            <option value="Letnan Kolonel" {{ old('pangkat') == 'Letnan Kolonel' ? 'selected' : '' }}>
                                Letnan Kolonel</option>
                            <option value="Mayor" {{ old('pangkat') == 'Mayor' ? 'selected' : '' }}>Mayor</option>
                        </optgroup>
                        <optgroup label="Perwira Pertama">
                            <option value="Kapten" {{ old('pangkat') == 'Kapten' ? 'selected' : '' }}>Kapten</option>
                            <option value="Letnan Satu" {{ old('pangkat') == 'Letnan Satu' ? 'selected' : '' }}>Letnan Satu
                            </option>
                            <option value="Letnan Dua" {{ old('pangkat') == 'Letnan Dua' ? 'selected' : '' }}>Letnan Dua
                            </option>
                        </optgroup>
                        <optgroup label="Bintara">
                            <option value="Pembantu Letnan Satu"
                                {{ old('pangkat') == 'Pembantu Letnan Satu' ? 'selected' : '' }}>Pembantu Letnan Satu
                            </option>
                            <option value="Pembantu Letnan Dua"
                                {{ old('pangkat') == 'Pembantu Letnan Dua' ? 'selected' : '' }}>Pembantu Letnan Dua
                            </option>
                            <option value="Sersan Mayor" {{ old('pangkat') == 'Sersan Mayor' ? 'selected' : '' }}>Sersan
                                Mayor</option>
                            <option value="Sersan Kepala" {{ old('pangkat') == 'Sersan Kepala' ? 'selected' : '' }}>Sersan
                                Kepala</option>
                            <option value="Sersan Satu" {{ old('pangkat') == 'Sersan Satu' ? 'selected' : '' }}>Sersan Satu
                            </option>
                            <option value="Sersan Dua" {{ old('pangkat') == 'Sersan Dua' ? 'selected' : '' }}>Sersan Dua
                            </option>
                        </optgroup>
                        <optgroup label="Tamtama">
                            <option value="Kopral Kepala" {{ old('pangkat') == 'Kopral Kepala' ? 'selected' : '' }}>Kopral
                                Kepala</option>
                            <option value="Kopral Satu" {{ old('pangkat') == 'Kopral Satu' ? 'selected' : '' }}>Kopral Satu
                            </option>
                            <option value="Kopral Dua" {{ old('pangkat') == 'Kopral Dua' ? 'selected' : '' }}>Kopral Dua
                            </option>
                            <option value="Prajurit Kepala" {{ old('pangkat') == 'Prajurit Kepala' ? 'selected' : '' }}>
                                Prajurit Kepala</option>
                            <option value="Prajurit Satu" {{ old('pangkat') == 'Prajurit Satu' ? 'selected' : '' }}>
                                Prajurit Satu</option>
                            <option value="Prajurit Dua" {{ old('pangkat') == 'Prajurit Dua' ? 'selected' : '' }}>Prajurit
                                Dua</option>
                        </optgroup>
                    </select>
                    @error('pangkat')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Jabatan -->
                <div class="mb-6">
                    <label for="jabatan" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        Jabatan
                    </label>
                    <input type="text" name="jabatan" id="jabatan" value="{{ old('jabatan') }}"
                        class="w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-600 rounded-lg focus:border-green-800 focus:outline-none dark:bg-gray-700 dark:text-white"
                        placeholder="Masukkan jabatan">
                    @error('jabatan')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Kesatuan -->
                <div class="mb-8">
                    <label for="kesatuan" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                        Kesatuan
                    </label>
                    <input type="text" name="kesatuan" id="kesatuan" value="{{ old('kesatuan') }}"
                        class="w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-600 rounded-lg focus:border-green-800 focus:outline-none dark:bg-gray-700 dark:text-white"
                        placeholder="Masukkan kesatuan">
                    @error('kesatuan')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('admin.personels.index') }}"
                        class="px-6 py-3 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg font-semibold hover:bg-gray-300 dark:hover:bg-gray-600 transition duration-300">
                        <i class="fas fa-times mr-2"></i>Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-3 bg-green-800 hover:bg-green-900 text-white rounded-lg font-semibold transition duration-300">
                        <i class="fas fa-save mr-2"></i>Simpan Personel
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
