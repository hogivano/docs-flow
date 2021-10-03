<section>
    <div class="container py-5">
        <div class="relative my-5">
            <div>
                <h2 class="w-100 w-md-50 mb-6 animate__animated animate__flipInX">
                    <b clsss="text-warning z-index-2">Cek</b> Status Permintaan Penelitian Yang Kamu Percayakan Pada Kami
                </h2>
                <button class="btn-primary rounded-pill shadow px-4 py-2 animate__delay-1s animate__animated animate__fadeIn">
                    Cek Disini
                </button>
            </div>
            <img class="d-md-block d-none absolute top-0 right-5 z-index-0 w-50 animate__animated animate__fadeInUp" src="{{ asset('assets/img/login-work.png') }}" />
        </div>
        <div class="relative mb-5" style="margin-top: 10rem; height: 160px;">
            <div class="row" style="height: 115px;">
                <div class="card">
                    <div class="card-body p-3">
                        <h3 class="text-center">Track Status Permintaan</h3>
                    </div>
                </div>
            </div>
            <div class="input-group absolute left-0 right-0 bottom-0 mx-auto w-100 w-md-50">
                <div class="d-flex w-100">
                    <div class="w-80 px-3">
                        <input type="search" wire:model.lazy="code" placeholder="Tulis disini..."
                            class="form-control rounded-pill px-3 w-100" style="height: 50px;"/>
                    </div>
                    <button wire:click="getData()" class="w-20 btn bg-gradient-primary" style="height: 50px;">Cari</button>
                </div>
            </div>
        </div>
        <div class="py-5 w-100">
            @if(sizeof($data) == 0 && $afterSearch)
                <div class="w-100 d-flex">
                    <img src="{{ asset('assets/img/on-search.png') }}" class="w-100 w-md-50 mx-auto mb-4" alt="on search" />
                </div>
                <h4 class="text-center mb-2">Opps!</h4>
                <p class="text-center">Kode permohonan tidak ditemukan.</p>
            @elseif(!$code)
                <div class="w-100 d-flex">
                    <img src="{{ asset('assets/img/on-search.png') }}" class="w-100 w-md-50 mx-auto mb-4" alt="on search" />
                </div>
                <h4 class="text-center mb-2">Pencarian</h4>
                <p class="text-center">Mohon isi kode permintaanmu.</p>
            @elseif ($afterSearch)
                <div class="card list-process w-100 w-md-50 mx-auto">
                    <div class="card-body p-3">
                        <div>
                            <h5 class="font-weight-normal">Kode Permohonan : <b>{{ $code }}</b></h5>
                        </div>
                        @php
                            $countDone = 0;
                            $lastDone = true;
                        @endphp
                        @foreach($data as $pro)
                            <div class="timeline timeline-one-side">
                                <div class="timeline-block mb-3">
                                    <span class="timeline-step">
                                        @if(sizeof($pro->processAction) > 0)
                                            @php
                                                $count = 0;
                                            @endphp
                                            @foreach($pro->processAction as $action)
                                                @php
                                                    if (sizeof($action->processActionUser) > 0) {
                                                        $count++;
                                                    }
                                                @endphp
                                            @endforeach
                                            {{-- untuk mengecek apakah telah diisi --}}
                                            @if($count == sizeof($pro->processAction))
                                                @php
                                                    $countDone++;
                                                @endphp
                                                <i class="fas fa-check-circle text-success"></i>
                                            @else
                                                <i class="fas fa-ellipsis-h text-secondary"></i>
                                            @endif
                                        @endif
                                    </span>
                                    <div class="timeline-content pb-4">
                                        <h5 class="text-dark font-weight-bold mb-0">{{ $pro->title }}</h5>
                                        @if($count == sizeof($pro->processAction))
                                            <h6 class="text-success mb-0">{{ $pro->message_success }}</h6>
                                        @elseif($lastDone)
                                            <h6 class="text-secondary mb-0">{{ $pro->message_pending }}</h6>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @php
                                $lastDone = ($count == sizeof($pro->processAction));
                            @endphp
                        @endforeach
                        <div class="timeline timeline-one-side">
                            <div class="timeline-block mb-3">
                                <span class="timeline-step">
                                    @if($countDone == sizeof($data))
                                        <i class="fas fa-check-circle text-success"></i>
                                    @else
                                        <i class="fas fa-ellipsis-h text-secondary"></i>
                                    @endif
                                </span>
                                <div class="timeline-content">
                                    <h5 class="text-dark font-weight-bold mb-0">Selesai</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
<section>