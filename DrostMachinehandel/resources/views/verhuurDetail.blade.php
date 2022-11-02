@extends('layouts.app')
@section('content')

<hr class="w-full h-2 bg-primary border-none">

<div class="px-5 md:px-20 py-7">
    <div class="page-back-button">
        <a class="back-button" href="{{ route("voorraad") }}"><i class="fas fa-chevron-left back-arrow text-white"></i><span>Terug naar overzicht</span></a>
      </div>

    <div class="detail-wrapper">
        <div class="images-specs-wrapper">
            <div class="images-wrapper">
                <img class="main-image" src="//www.voorraadmodule.nl/i/TMggcgJPmo_NZUvx1_Lo_dijFlq3iD_gkxw4w-RJ5631vw==/Hangcha-stapelaar-elektrische-nieuwe-1.jpg">
            </div>
            <div class="specs-wrapper">
                <div class="vehicle-title">
                    Hangcha stapelaar elektrische nieuwe
                </div>
                <div class="specs">
                    <div class="spec">
                        <div class="spec-type">
                            <span class="type">Carrosserie</span>
                            <span class="colon">:</span>
                        </div>
                        <div class="spec-value">Stapelaar</div>
                    </div>
                    <div class="spec">
                        <div class="spec-type">
                            <span class="type">Bouwjaar</span>
                            <span class="colon">:</span>
                        </div>
                        <div class="spec-value">2022</div>
                    </div>
                    <div class="spec">
                        <div class="spec-type">
                            <span class="type">Bedrijfsuren</span>
                            <span class="colon">:</span>
                        </div>
                        <div class="spec-value">1</div>
                    </div>
                    <div class="spec">
                        <div class="spec-type">
                            <span class="type">Brandstof</span>
                            <span class="colon">:</span>
                        </div>
                        <div class="spec-value">Elektrisch</div>
                    </div>
                    <div class="spec">
                        <div class="spec-type">
                            <span class="type">Hefhoogte</span>
                            <span class="colon">:</span>
                        </div>
                        <div class="spec-value">200 cm</div>
                    </div>
                    <div class="spec">
                        <div class="spec-type">
                            <span class="type">hefcapaciteit</span>
                            <span class="colon">:</span>
                        </div>
                        <div class="spec-value">1000kg</div>
                    </div>
                    <div class="spec">
                        <div class="spec-type">
                            <span class="type">Kleur</span>
                            <span class="colon">:</span>
                        </div>
                        <div class="spec-value">Groen</div>
                    </div>
                </div>
                <div class="price-wrapper">
                    <div class="price">€ 2.950,-</div>
                    <div class="price-btw">Excl. BTW</div>
                </div>
                <div class="contact-wrapper">
                    <button class="contact-button">Contact</button>
                </div>
                <div class="share-wrapper">
                    <div class="share-text">Deel deze pagina:</div>
                    <div class="share-links">
                        <div class="link">
                            <span><i class="fab fa-whatsapp icon"></i></span>
                            <span>Whatsapp</span>
                        </div>
                        <div class="link">
                            <span><i class="far fa-envelope-open icon"></i></span>
                            <span>E-mail</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="notes-wrapper">
            <div class="notes-title">Opmerkingen</div>
            <div class="notes">
                <div>Merk hangcha</div>
                <div>bouwjaar 2022</div>
                <div>draaiuuren 1</div>
                <div>hefcapacitijd stapelfunctie 1000kg</div>
                <div>Lepel lengte 115cm</div>
                <div>Lepel breedte 55 cm euro pallet maat</div>
                <div>Hefhoogte 200cm</div>
                <div>met ingeboude lader</div>
                <div>onderhoudtsvrij accu</div>
            </div>
        </div>
    </div>

</div>

@endsection