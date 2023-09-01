<footer class="footer section">
    <div class="footer__container container grid">
        <div class="footer__content">
            <h3 class="footer__title">Our information</h3>
            <ul class="footer__list">
                <li>Buenos Aires, Argentina</li>
                <li>Av. Corrientes 1234</li>
                <li>123-456-789</li>
            </ul>
        </div>
        <div class="footer__content">
            <h3 class="footer__title">About Us</h3>
            <ul class="footer__links">
                <li><a href="#" class="footer__link">Support Center</a></li>
                <li><a href="#" class="footer__link">Customer Support</a></li>
                <li><a href="#" class="footer__link">About Us</a></li>
                <li><a href="#" class="footer__link">Copyright</a></li>
            </ul>
        </div>
        <div class="footer__content">
            <h3 class="footer__title">Product</h3>
            <ul class="footer__links">
                <li><a href="#" class="footer__link">Road bikes</a></li>
                <li><a href="#" class="footer__link">Mountain bikes</a></li>
                <li><a href="#" class="footer__link">Electric</a></li>
                <li><a href="#" class="footer__link">Accesories</a></li>
            </ul>
        </div>
        <div class="footer__content">
            <h3 class="footer__title">Social</h3>
            <ul class="footer__social">
                <a href="https://www.facebook.com/" target="_blank" class="footer__social-link">
                    <i class='bx bxl-facebook'></i>
                </a>
                <a href="https://twitter.com/" target="_blank" class="footer__social-link">
                    <i class='bx bxl-twitter'></i>
                </a>
                <a href="https://www.instagram.com/" target="_blank" class="footer__social-link">
                    <i class='bx bxl-instagram'></i>
                </a>
            </ul>
        </div>
    </div>
    <span class="footer__copy">Sad King. 2023.</span>
</footer>

<a href="#" class="scrollup" id="scroll-up">
    <i class='bx bx-up-arrow-alt scrollup__icon'></i>
</a>

{{--  scripts  --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta3/js/bootstrap-select.min.js" integrity="sha512-yrOmjPdp8qH8hgLfWpSFhC/+R9Cj9USL8uJxYIveJZGAiedxyIxwNw4RsLDlcjNlIRR4kkHaDHSmNHAkxFTmgg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ versionedAsset('assets/js/products.js')}}"></script>
{{--  Load User  --}}
<script>
    const logedInUser = [
    "{{ authUser()?->id }}"
    ];
    const websiteUrl = "{{ route('home') }}";
</script>
@stack('scripts')
<script src="{{ versionedAsset('assets/js/main.js')}}"></script>
