@extends('layouts.app')

@section('content')
    <x-hero-slide
        identifier="home"
        :background="asset('assets/img/hero-main.png')"
        header="We just know how"
        subheader="DOWNLOAD MEDIAKIT"
        :subheader-action="asset('assets/pdf/IDOOH_MediaKit.pdf')"
    />

    <section class="slide slideSmall" id="about">
        <div class="slideContainer">
            <div class="aboutContainer">
                <div class="aboutBody">
                    <img src="{{ asset('assets/img/about-circle.png') }}" alt="IDOOH circle" class="aboutBodyImage">
                    <div class="aboutText">
                        IDOOH is a new provider of outdoor advertising in Dubai, dedicated to delivering high-quality billboard solutions.
                    </div>
                </div>
                <div class="aboutFooter">It’s only the beginning!</div>
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
                With 20 years of international experience in media and outdoor advertising across Europe and the MENA region, our team is dedicated to delivering exceptional results by creating advertising solutions with proven effectiveness. We leverage our accumulated expertise to develop strategic approach for building effective advertising networks.
            </div>
            <div class="leadershipText">
                Our commitment to high standards of customer service ensures mutually beneficial collaboration with our clients. Creativity is at the heart of what we do, driving campaigns that truly work for your business.
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


    <section class="unitGallery">
        <video
                    class="unitPhoto"
                    autoplay
                    muted
                    loop
                    playsinline
                >
                    <source src="{{ asset('assets/videos/all_locations.mp4') }}" type="video/mp4">
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
                            style="background-image: url('{{ asset($unit['photos'][0]) }}')"
                        ></div>
                        <div>{{ $unit['street'] }} {{ $unit['name'] }}</div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <x-hero-slide
        :background="asset('assets/img/hero-clients.png')"
        header="Brands That Choose Us"
        identifier="clients"
        :parallax="true"
        subheader="We work with companies that value high-quality placement and strong visibility in Dubai.
Below is a selection of brands that have chosen us for their outdoor campaigns."
    />

    <section class="clientsList">
            <div
                class="clientCard"
                style="background-image: url('{{ asset('assets/img/logo/amit_care.png') }}')"
            ></div>
            <div
                class="clientCard"
                style="background-image: url('{{ asset('assets/img/logo/baic.webp') }}')"
            ></div>
            <div
                class="clientCard"
                style="background-image: url('{{ asset('assets/img/logo/creative_closets.svg') }}')"
            ></div>
            <div
                class="clientCard"
                style="background-image: url('{{ asset('assets/img/logo/dongfeng.png') }}')"
            ></div>
            <div
                class="clientCard"
                style="background-image: url('{{ asset('assets/img/logo/fkh.webp') }}')"
            ></div>
            <div
                class="clientCard"
                style="background-image: url('{{ asset('assets/img/logo/fnpae_logo.png') }}')"
            ></div>
            <div
                class="clientCard"
                style="background-image: url('{{ asset('assets/img/logo/gold_apple.png') }}')"
            ></div>
            <div
                class="clientCard"
                style="background-image: url('{{ asset('assets/img/logo/huntefood.png') }}')"
            ></div>
            <div
                class="clientCard"
                style="background-image: url('{{ asset('assets/img/logo/kfc.png') }}')"
            ></div>
            <div
                class="clientCard"
                style="background-image: url('{{ asset('assets/img/logo/malabar.svg') }}')"
            ></div>
            <div
                class="clientCard"
                style="background-image: url('{{ asset('assets/img/logo/new_balance.svg') }}')"
            ></div>
            <div
                class="clientCard"
                style="background-image: url('{{ asset('assets/img/logo/nissan.jpg') }}')"
            ></div>
        @for($i = 0; $i < 8; $i++)
            <div
                class="clientCard"
                style="background-image: url('{{ asset('assets/img/grey-logo.svg') }}')"
            ></div>
        @endfor
    </section>

    <section class="slide slideRed slideSmall">
        <div class="slideContainer">
            <div class="footerHeader">
                Our Dubai story <br>
                is just beginning
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
                    <div>© Copyright 2024 IDOOH LLC.</div>
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

