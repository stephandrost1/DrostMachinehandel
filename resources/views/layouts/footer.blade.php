<footer class="footer">
    <hr class="w-full h-2 bg-primary border-none">
    <div class="footer-content flex flex-wrap justify-between md:px-8 py-5 items-center">
        <div class="content-wrapper">
            <div class="col-1">
                <div class="col-header">
                    <h2>{{ __('content/footer.address-info') }}</h2>
                </div>
                <div class="col-body">
                    <div class="footer-item flex items-center gap-2"><p>Boslandweg 148</p></div>
                    <div class="footer-item flex items-center gap-2"><p>3911 VE</p></div>
                    <div class="footer-item flex items-center gap-2"><p>Rhenen</p></div>
                    <div class="footer-item flex items-center gap-2"><p>Nederland</p></div>
                </div>
            </div>
            <div class="col-2">
                <div class="col-header">
                    <h2>{{ __('content/footer.contact-info') }}</h2>
                </div>
                <div class="col-body">
                    <div class="footer-item flex items-center gap-2"><p>info@drostmachinehandel.com</p></div>
                    <div class="footer-item flex items-center gap-2"><p>+31 0(6) 498 275 16</p></div>
                </div>
            </div>
        </div>

        <div class="logo-wrapper">
            <div class="logo">
                
                @if (Request::is('verhuur') || Request::is('verhuur/*'))
                    <img src="{{ asset('/img/logo-verhuur.png') }}" class="footer-logo" alt="logo-verhuur" loading="lazy"/>
                @else
                    <img src="{{ asset('/img/logo.png') }}" class="footer-logo" alt="logo" loading="lazy"/>
                @endif
            </div>
        </div>
    </div>
</footer>