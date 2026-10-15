@extends('layouts.app')
@section('title', 'Portal - SPMB SD')

@section('content')
<div class="hero-spmb">
    <div class="hero-orbit hero-orbit-one"></div>
    <div class="hero-orbit hero-orbit-two"></div>
    <div class="container hero-inner">
        <div class="hero-copy" data-reveal>
            <span class="hero-kicker"><span class="pulse-dot"></span> Pendaftaran 2026/2027 dibuka</span>
            <h1>Langkah pertama<br><span class="typewriter-text" data-typewriter="menuju sekolah impian.|bersama SPMB SD.|untuk masa depan cerah.">menuju sekolah impian.</span></h1>
            <p class="fs-5">Sistem Penerimaan Murid Baru SD yang sederhana, jelas, dan siap membantu keluarga Anda.</p>
            <div class="hero-actions">
                <a href="{{ route('daftar') }}" class="btn btn-spmb">Mulai Pendaftaran <span aria-hidden="true">&#8594;</span></a>
                <a href="{{ route('informasi') }}" class="hero-link">Jelajahi informasi <span aria-hidden="true">&#8595;</span></a>
            </div>
        </div>
        <div class="hero-panel" data-reveal>
            <div class="hero-panel-top">
                <span class="mini-label">SPMB SD</span>
                <span class="status-chip">Aktif</span>
            </div>
            <div class="hero-panel-number">01</div>
            <p>Lengkapi data calon murid dengan tenang. Semua informasi pendaftaran tersedia dalam satu tempat.</p>
            <div class="hero-progress"><span></span></div>
            <div class="hero-panel-foot"><span>Penerimaan murid baru</span><strong>2026/27</strong></div>
        </div>
    </div>
</div>

<div class="container section-soft">
    <div class="section-heading" data-reveal>
        <div>
            <span class="section-kicker">Pusat informasi</span>
            <h2>Semua yang Anda butuhkan,<br><em>lebih dekat.</em></h2>
        </div>
        <p>Mulai dari jadwal hingga pengecekan status, pilih langkah Anda berikutnya.</p>
    </div>
    <div class="row g-4">
        <div class="col-md-4" data-reveal>
            <div class="card card-spmb action-card h-100" data-tilt>
                <div class="card-body d-flex flex-column">
                    <div class="action-icon icon-calendar"><i class="bi bi-calendar2-week-fill"></i></div>
                    <span class="card-index">01 / INFORMASI</span>
                    <h5 class="card-title">Jadwal Terbaru</h5>
                    <div class="action-card-text flex-grow-1">
                        @if($jadwal)
                            <p class="mb-1"><strong>{{ $jadwal->judul }}</strong></p>
                            <p class="text-muted small mb-0">
                                {{ \Carbon\Carbon::parse($jadwal->tanggal_mulai)->translatedFormat('d M Y') }}
                                &mdash;
                                {{ \Carbon\Carbon::parse($jadwal->tanggal_selesai)->translatedFormat('d M Y') }}
                            </p>
                        @else
                            <p class="text-muted mb-0">Belum ada jadwal ditambahkan.</p>
                        @endif
                    </div>
                    <div class="action-card-footer mt-auto pt-3">
                        <a href="{{ route('informasi') }}" class="btn btn-outline-spmb btn-sm">Lihat Semua Jadwal <i class="bi bi-arrow-right" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4" data-reveal>
            <div class="card card-spmb action-card h-100" data-tilt>
                <div class="card-body d-flex flex-column">
                    <div class="action-icon icon-status"><i class="bi bi-patch-check-fill"></i></div>
                    <span class="card-index">02 / PERIKSA</span>
                    <h5 class="card-title">Cek Status Pendaftaran</h5>
                    <div class="action-card-text flex-grow-1">
                        <p class="text-muted mb-0">Sudah mendaftar? Cek status verifikasi dan hasil seleksi Anda di sini.</p>
                    </div>
                    <div class="action-card-footer mt-auto pt-3">
                        <a href="{{ route('cek-status') }}" class="btn btn-outline-spmb btn-sm">Cek Status <i class="bi bi-arrow-right" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4" data-reveal>
            <div class="card card-spmb action-card h-100" data-tilt>
                <div class="card-body d-flex flex-column">
                    <div class="action-icon icon-document"><i class="bi bi-file-earmark-text-fill"></i></div>
                    <span class="card-index">03 / SIAPKAN</span>
                    <h5 class="card-title">Persyaratan Pendaftaran</h5>
                    <div class="action-card-text flex-grow-1">
                        <p class="text-muted mb-0">Lihat dokumen apa saja yang perlu disiapkan sebelum mendaftar.</p>
                    </div>
                    <div class="action-card-footer mt-auto pt-3">
                        <a href="{{ route('informasi') }}" class="btn btn-outline-spmb btn-sm">Lihat Persyaratan <i class="bi bi-arrow-right" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.querySelectorAll('[data-tilt]').forEach((card) => {
        card.addEventListener('pointermove', (event) => {
            const bounds = card.getBoundingClientRect();
            const rotateX = ((event.clientY - bounds.top) / bounds.height - 0.5) * -5;
            const rotateY = ((event.clientX - bounds.left) / bounds.width - 0.5) * 5;
            card.style.setProperty('--rotate-x', `${rotateX}deg`);
            card.style.setProperty('--rotate-y', `${rotateY}deg`);
        });
        card.addEventListener('pointerleave', () => {
            card.style.setProperty('--rotate-x', '0deg');
            card.style.setProperty('--rotate-y', '0deg');
        });
    });

    const revealItems = document.querySelectorAll('[data-reveal]');
    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                revealObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.12 });
    revealItems.forEach((item) => revealObserver.observe(item));

    const typewriter = document.querySelector('[data-typewriter]');
    if (typewriter && !window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        const phrases = typewriter.dataset.typewriter.split('|');
        let phraseIndex = 0;
        let characterIndex = phrases[0].length;
        let deleting = true;

        const writePhrase = () => {
            const phrase = phrases[phraseIndex];
            typewriter.textContent = phrase.slice(0, characterIndex);

            if (deleting) {
                characterIndex -= 1;
                if (characterIndex === 0) {
                    deleting = false;
                    phraseIndex = (phraseIndex + 1) % phrases.length;
                    setTimeout(writePhrase, 450);
                    return;
                }
            } else {
                characterIndex += 1;
                if (characterIndex > phrases[phraseIndex].length) {
                    deleting = true;
                    setTimeout(writePhrase, 1700);
                    return;
                }
            }

            setTimeout(writePhrase, deleting ? 48 : 78);
        };

        setTimeout(writePhrase, 1700);
    }
</script>
@endpush
@endsection
