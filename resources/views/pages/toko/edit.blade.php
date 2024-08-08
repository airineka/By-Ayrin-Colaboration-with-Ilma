<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Edit Toko') }}
    </h2>
  </x-slot>
  
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-2">
        <form method="post" action="{{ route('toko.update',$data['id']) }}">
          @csrf
          @method('PUT')
          <div class="row">
            <div class="mb-3">
              <label for="nama_toko" class="form-label fw-bold">{{ __('Id Toko') }}</label>
              <input id="nama_toko" name="nama_toko" type="text" class="form-control disabled" value="{{ $data['id'] }}" placeholder="Jas merah" readonly autocomplete="nama_toko">
            </div>
            <div class="mb-3">
              <label for="nama_toko" class="form-label fw-bold">{{ __('Nama Toko') }}</label>
              <input id="nama_toko" name="nama_toko" type="text" class="form-control" value="{{ $data['nama_toko'] }}" placeholder="Jas merah" required autocomplete="nama_toko">
            </div>
            <div class="col-span-6 sm:col-span-4">
              <label for="address" class="form-label fw-bold">{{ __('Address Toko') }}</label>
              <input id="address" name="address" type="text" class="form-control" value="{{ $data['address'] }}" placeholder="Soekarno" required autocomplete="address">
            </div>
          </div>
          <div class="col col-span-6 sm:col-span-4 text-end mt-2">
            <button class="col btn btn-primary" type="submit">{{ __('Simpan')}}</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-app-layout>

<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Edit Pesanan')}}
    </h2>
  </x-slot>
  
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-2">
        <form method="post" action="{{ route('pesanan.update',$data['id']) }}">
          @csrf
          @method('PUT')
          <div class="row">
            <div class="mb-3">
              <label for="nama_pesanan" class="form-label fw-bold">{{ __('Id Pesanan') }}</label>
              <input id="nama_pesanan" name="nama_pesanan" type="text" class="form-control disabled" value="{{ $data['id'] }}" placeholder="Mukena" readonly autocomplete="nama_pesanan">
            </div>
            <div class="mb-3">
              <label for="nama_pesanan" class="form-label fw-bold">{{ __('Nama Pesanan') }}</label>
              <input id="nama_pesanan" name="nama_pesanan" type="text" class="form-control" value="{{ $data['nama_pesanan'] }}" placeholder="Pakaian" required autocomplete="nama_pesanan">
            </div>
            <div class="col-span-6 sm:col-span-4">
              <label for="Address" class="form-label fw-bold">{{ __('Address Toko') }}</label>
              <input id="Address" name="Address" type="text" class="form-control" value="{{ $data['lokasi'] }}" placeholder="Jl. Ahmad Yani, Blitar" required autocomplete="lokasi">
            </div>
          </div>
          <div class="col col-span-6 sm:col-span-4 text-end mt-2">
            <button class="col btn btn-primary" type="submit">{{ __('Simpan')}}</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-app-layout>