@if (session('success'))
    <div class="alert alert-success" data-autohide role="status">
        <x-icon name="check-circle" class="alert-icon" />
        <span>{{ session('success') }}</span>
        <button type="button" class="alert-close" aria-label="Tutup pesan">&times;</button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-error" data-autohide role="alert">
        <x-icon name="alert-circle" class="alert-icon" />
        <span>{{ session('error') }}</span>
        <button type="button" class="alert-close" aria-label="Tutup pesan">&times;</button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-error" role="alert">
        <x-icon name="alert-circle" class="alert-icon" />
        <div>
            <strong>Periksa kembali isian Anda:</strong>
            <ul style="margin:6px 0 0; padding-left:18px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <button type="button" class="alert-close" aria-label="Tutup pesan">&times;</button>
    </div>
@endif
