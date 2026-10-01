@extends('layouts.app')

@section('content')
    <x-hero-slide
        identifier="home"
        :background="asset('assets/img/hero-main.png')"
        header="We just know how"
        subheader="DOWNLOAD MEDIAKIT"
        :subheader-action="asset('assets/pdf/IDOOH_Full_Media_Kit_2026.pdf')"
    />

    <section class="slide slideSmall" id="about">
        <div class="slideContainer">
            <div class="aboutContainer">
                <div class="aboutBody">
                    <img src="{{ asset('assets/img/about-circle.png') }}" alt="IDOOH circle" class="aboutBodyImage">
                    <div class="aboutText">
                        IDOOH operates a premium network of large-format billboards across Dubai, giving brands the space and visibility to make a lasting impression.
                    </div>
                </div>
                <div class="aboutFooter">And it’s only the beginning!</div>
            </div>
        </div>
    </section>

    <section class="slide slideRed slideSmall">
        <div class="slideContainer">
            <div class="footerHeader">
                20+ years <br>
                of experience
            </div>
        </div>
    </section>

    <x-hero-slide
        :background="asset('assets/img/hero-about.jpg')"
        header="About us"
        :parallax="true"
    />

    <section class="slide">
        <div class="slideContainer">
            <div class="leadershipTitle">Our leadership team</div>
            <div class="leadershipText">
                Our team brings over 20 years of international experience in media and outdoor advertising across Europe and the Middle East. We know how to build and develop advertising networks, from selecting locations to delivering solutions with proven effectiveness.
            </div>
            <div class="leadershipText">
                We combine this international experience with a practical understanding of Dubai’s outdoor advertising market, its audiences, and local requirements. For us, high standards of client service mean understanding each client’s goals, paying attention to detail, and managing every stage of a placement with care and precision. Our years in the industry have taught us to value both the results of each project and the relationships built along the way. These are the foundations of our reputation and the trust clients place in our team.
            </div>
            <div class="leadershipList">
                @foreach($leaders as $leader)
                    <div class="contactCard">
                        <div class="flipCard">
                            <div class="flipCardInner">
                                <div
                                    class="flipCardFront"
                                    style="background-image: url('{{ asset($leader['image']) }}')"
                                ></div>
                                <div class="flipCardBack">
                                    {{ $leader['description'] }}
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="contactName">{{ $leader['name'] }}</div>
                            <div class="contactTitle">{{ $leader['title'] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <x-hero-slide
        :background="asset('assets/img/hero-locations.png')"
        header="Locations"
        identifier="locations"
        :parallax="true"
    />

    <section class="slide slideSmall">
        <div class="slideContainer">
            <div
                class="mapCanvas js-units-map"
                data-units='@json($inventory)'
                data-marker="{{ asset('assets/img/maker-drop.png') }}"
                data-unit-url="{{ url('/locations') }}"
                data-fit-bounds="true"
            ></div>
        </div>
    </section>


    <section class="slide unitGallery">
        <video
                    class="unitPhoto"
                    autoplay
                    muted
                    loop
                    playsinline
                >
                    <source src="{{ asset('assets/videos/mirdif-output.mp4') }}" type="video/mp4">
        </video>
    </section>

    <section class="slide">
        <div class="slideContainer">
            <div class="creativeList">
                @foreach($inventory as $unit)
                    <a
                        class="creativeCard"
                        href="{{ route('locations.show', $unit['id']) }}"
                    >
                        <div
                            class="creativeCardImage"
                            style="background-image: url('{{ asset($unit['card_photo'] ?? $unit['photos'][0]) }}')"
                        ></div>
                        <div>
                            {{ $unit['street'] }} {{ $unit['name'] }}
                            @if($unit['name'] === 'Silicon Oasis')
                                <span style="color: var(--primary)">NEW!</span>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <x-hero-slide
        :background="asset('assets/img/hero-clients.png')"
        header="Trusted By"
        identifier="clients"
        :parallax="true"
        subheader="Our clients and partners choose us for prominent locations, high standards of service, and the confidence that every placement is in experienced hands."
    />

    @php
        $clientLogos = [
            'al futtaim.svg', 'al khoory.svg', 'al_naboodah.webp', 'Al Shaali moto.png',
            'ala-logo.png', 'amit_care.png', 'arabian_oud.webp', 'arcfox.png',
            'baic.webp', 'creative_closets.svg', 'dongfeng.png', 'dof-logo-white.svg',
            'di-logo-en.webp', 'dubaiscools.png', 'eds.webp', 'etisalat-logo.svg', 'fkh.webp',
            'fnpae_logo.png', 'fusion.webp', 'gold_apple.png', 'gwh.png',
            'hearts-united.svg', 'hikaya.webp', 'homecentre.svg', 'huntefood.png', 'initiative.webp',
            'kfc.png', 'lexus.png', 'mag.webp', 'magna.webp', 'malabar.svg',
            'mediaplus.webp', 'middle-east-energy.webp', 'new_balance.svg', 'nissan.jpg',
            'omd.svg', 'oura.png', 'phd.webp', 'pubilink.svg', 'ram.webp',
            'ssmc.webp', 'subary.png', 'taleem.svg', 'um.webp', 'ECUC_Logo.png',
            'virgin.svg', 'wasl.webp', 'youtong.svg',
        ];
    @endphp

    <section class="clientsList">
        @foreach ($clientLogos as $logo)
            <div class="clientCard">
                <img src="{{ asset('assets/img/logo/' . $logo) }}" alt="{{ pathinfo($logo, PATHINFO_FILENAME) }} logo">
            </div>
        @endforeach
    </section>

    <section class="slide slideRed slideSmall">
        <div class="slideContainer">
            <div class="landingHeader">
                Shall we talk <br>
                about your brand?
            </div>
        </div>
    </section>

    <section class="slide" id="contacts">
        <div class="slideContainer">
            <div class="contactsContainer">
                <div class="contactsTitle">Contacts</div>

                <div class="contactsItem">
                    <div class="contactsItemTitle">Office</div>
                    <button
                        type="button"
                        class="contactsItemValue"
                        data-link="https://www.google.com/maps/search/1301-0165,+floor+13,+The+One+Tower,+Sheik+Zayed+Road,+Barsha+Heights,+TECOM,+Dubai,+UAE/@25.0992687,55.1745348,1021m/data=!3m2!1e3!4b1?entry=ttu&g_ep=EgoyMDI1MDQwNi4wIKXMDSoASAFQAw=="
                    >
                        1301-0165, floor 13, The One Tower, <br>
                        Sheik Zayed Road, Barsha Heights, <br>
                        TECOM, Dubai, UAE
                    </button>
                </div>

                <div class="contactsItem">
                    <div class="contactsItemTitle">Email</div>
                    <button type="button" class="contactsItemValue" data-link="mailto:faldina@idooh.ae">
                        faldina@idooh.ae
                    </button>
                </div>

                <div class="contactsItem">
                    <div class="contactsItemTitle">Phone 1</div>
                    <button type="button" class="contactsItemValue" data-link="tel:971581733443">
                        + 971 581 733 443
                    </button>
                </div>

                <div class="contactsItem">
                    <div class="contactsItemTitle">Phone 2</div>
                    <button type="button" class="contactsItemValue" data-link="tel:971553599699">
                        + 971 553 599 699
                    </button>
                </div>

                <div class="contactsItem">
                    <div class="contactsItemTitle">LinkedIn</div>
                    <button type="button" class="contactsItemValue" data-link="https://www.linkedin.com/company/idooh-advertising/">
                        IDOOH
                    </button>
                </div>

                <div class="contactsFooter">
                    <div>© Copyright {{ date('Y') }} IDOOH LLC.</div>
                    <div>All rights reserved.</div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('body-end')
    <script>
        window.IDOOH = window.IDOOH || {};
        window.IDOOH.inventory = @json($inventory);
    </script>
@endpush
