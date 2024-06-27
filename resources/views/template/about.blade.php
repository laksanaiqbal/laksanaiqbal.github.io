<section id="about" class="about-section text-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h2 class="text-white mb-4">About Me?</h2>
                <p class="text-white-50">
                    @php
                        // Ambil data about pertama jika ada
                        $about = \App\Models\AboutModel::first();
                    @endphp

                    @if ($about)
                        {!! nl2br(e($about->content)) !!}
                    @else
                        Data about tidak ditemukan.
                    @endif
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col" data-aos="fade-up" data-aos-duration="1200">
                <img src="{{ asset('assets/image/gw.jpg') }}" class="img-fluid" alt="">
            </div>
            <div class="col" data-aos="fade-up" data-aos-duration="1200">
                <img src="{{ asset('assets/image/gw.jpg') }}" class="img-fluid" alt="">
            </div>
            <div class="col" data-aos="fade-up" data-aos-duration="1200">
                <img src="{{ asset('assets/image/gw.jpg') }}" class="img-fluid" alt="">
            </div>
            <div class="col" data-aos="fade-up" data-aos-duration="1200">
                <img src="{{ asset('assets/image/gw.jpg') }}" class="img-fluid" alt="">
            </div>
        </div>
    </div>
</section>
