@extends('layouts.app')

@section('content')
<div class="container">

    <!-- TOMBOL -->
    <button class="btn btn-primary"
            data-bs-toggle="modal"
            data-bs-target="#modalEditBobot">
        Edit Bobot
    </button>

</div>

<!-- MODAL EDIT BOBOT -->
<div class="modal fade" id="modalEditBobot" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <form method="POST" action="{{ route('tpk.kriteria.updateBobot') }}">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Edit Bobot Kriteria</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="alert alert-info">
                        Catatan: Total bobot harus sama dengan <b>1.0</b>
                    </div>

                    {{-- 🔥 INI YANG KEMARIN KOSONG --}}
                    @foreach($kriterias as $k)
                        <div class="mb-3">
                            <label class="fw-semibold">
                                C{{ $loop->iteration }} - {{ $k->nama_kriteria }}
                            </label>
                            <input type="number"
                                   step="0.01"
                                   name="bobot[{{ $k->id }}]"
                                   value="{{ $k->bobot }}"
                                   class="form-control bobot-input">
                        </div>
                    @endforeach

                    <hr>
                    <div class="d-flex justify-content-between">
                        <strong>Total Bobot:</strong>
                        <strong id="totalBobot" class="text-success">1.000</strong>
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button class="btn btn-primary" id="btnSimpan">
                        Simpan Bobot
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<script>
    const inputs = document.querySelectorAll('.bobot-input');
    const totalText = document.getElementById('totalBobot');
    const btn = document.getElementById('btnSimpan');

    function hitungTotal() {
        let total = 0;
        inputs.forEach(i => total += parseFloat(i.value) || 0);
        totalText.innerText = total.toFixed(3);
        btn.disabled = total.toFixed(3) != 1.000;
    }

    inputs.forEach(i => i.addEventListener('input', hitungTotal));
    hitungTotal();
</script>
@endsection
