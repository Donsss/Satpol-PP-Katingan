<x-user-components.layout :pageTitle="$pageTitle">
    <section class="py-5" style="background-color: #f8f9fa;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="document-detail-card">
                        <div class="detail-header">
                            <div class="header-icon">
                                @php
                                    $fileIcons = ['pdf'=>'file-pdf','doc'=>'file-word','docx'=>'file-word','xls'=>'file-excel','xlsx'=>'file-excel','ppt'=>'file-powerpoint','pptx'=>'file-powerpoint','txt'=>'file-alt','zip'=>'file-archive','rar'=>'file-archive'];
                                    $iconName = $fileIcons[$document->file_extension] ?? 'file';
                                @endphp
                                <i class="fas fa-{{ $iconName }}"></i>
                            </div>
                            <div class="header-content">
                                <p class="category">{{ $document->kategori ?? 'Dokumen Umum' }}</p>
                                <h1 class="document-title">{{ $document->judul }}</h1>
                                <form action="{{ route('dokumen.user.downloadUser', $document) }}" method="POST" class="mt-4">
                                    @csrf
                                    <button type="submit" class="btn btn-dark btn-lg px-4">
                                        <i class="fas fa-download me-2"></i> Unduh Dokumen
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="detail-content">
                            @if($document->deskripsi)
                            <div class="content-section">
                                <h4>Deskripsi Dokumen</h4>
                                <p class="text-muted">{!! $document->deskripsi !!}</p>
                            </div>
                            <hr>
                            @endif

                            <div class="content-section">
                                <h4>Detail File</h4>
                                <ul class="file-specs">
                                    <li>
                                        <i class="fas fa-file-alt"></i>
                                        <strong>Format File:</strong>
                                        <span>{{ strtoupper($document->file_extension) }}</span>
                                    </li>
                                    <li>
                                        <i class="fas fa-weight-hanging"></i>
                                        <strong>Ukuran File:</strong>
                                        <span>{{ $document->formatted_size }}</span>
                                    </li>
                                    <li>
                                        <i class="fas fa-cloud-download-alt"></i>
                                        <strong>Total Unduh:</strong>
                                        <span>{{ $document->download_count }} kali</span>
                                    </li>
                                    <li>
                                        <i class="fas fa-calendar-alt"></i>
                                        <strong>Tanggal Upload:</strong>
                                        <span>{{ $document->created_at->translatedFormat('d F Y') }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="detail-footer">
                            <a href="{{ route('dokumen.user.indexUser') }}" class="back-link">
                                <i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar Dokumen
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('styles')
    <style>
        :root {
            --brand-color: #FDB813;
            --brand-color-dark: #e4a60b;
        }

        .document-detail-card {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden; /* Penting untuk border-radius */
        }

        .detail-header {
            background-color: var(--brand-color);
            padding: 40px;
            display: flex;
            align-items: center;
            color: #212529;
        }

        .header-icon {
            font-size: 4rem;
            margin-right: 30px;
            opacity: 0.5;
        }
        
        .header-content .category {
            font-weight: 500;
            margin-bottom: 5px;
            opacity: 0.8;
        }

        .header-content .document-title {
            font-weight: 700;
            font-size: 2.2rem;
            line-height: 1.2;
            margin: 0;
        }

        .btn-dark {
            background-color: #212529 !important;
            border-color: #212529 !important;
            color: #fff !important;
            transition: opacity 0.3s ease;
        }
        .btn-dark:hover {
            opacity: 0.85;
        }

        .detail-content {
            padding: 40px;
        }
        
        .content-section h4 {
            font-weight: 600;
            margin-bottom: 20px;
        }
        
        hr {
            margin: 30px 0;
            border-top: 1px solid #e9ecef;
        }

        .file-specs {
            list-style: none;
            padding: 0;
        }
        .file-specs li {
            display: flex;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #f8f9fa;
        }
        .file-specs li:last-child {
            border-bottom: none;
        }
        .file-specs i {
            color: var(--brand-color);
            width: 30px;
            text-align: center;
            margin-right: 15px;
        }
        .file-specs strong {
            width: 150px; /* Lebar tetap untuk label */
        }

        .detail-footer {
            padding: 20px 40px;
            background-color: #f8f9fa;
            text-align: center;
            border-top: 1px solid #e9ecef;
        }
        .back-link {
            color: #6c757d;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s ease;
        }
        .back-link:hover {
            color: var(--brand-color);
        }

        @media (max-width: 767px) {
            .detail-header {
                flex-direction: column;
                text-align: center;
            }
            .header-icon {
                margin-right: 0;
                margin-bottom: 20px;
            }
            .header-content .document-title {
                font-size: 1.8rem;
            }
            .detail-content, .detail-header {
                padding: 30px;
            }
            .file-specs strong {
                width: 120px;
            }
        }
    </style>
    @endpush
</x-user-components.layout>