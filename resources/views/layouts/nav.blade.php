<nav class="d-flex flex-xl-row flex-l-row flex-m-row flex-col justify-content-center">
    <br>
    <section class="col-xl-5 col-l-5 col-md-5 d-flex flex-xl-row flex-l-row flex-m-row flex-col justify-content-start">
        
        <section class="col-xl-3 col-l-3 col-md-3">
            <img src="" alt="">
        </section>
        
        <section class="col-xl-5 col-l-5 col-md-5">
            <h2>Prueba Laravel</h2>
        </section>

        <section class="col-xl-4 col-l-4 col-md-4"></section>
    </section>

    <section class="col-xl-1 col-l-1 col-md-1"></section>
    
    <section class="col-xl-6 col-l-6 col-md-6 ">
        <ul class="d-flex flex-xl-row flex-l-row flex-m-row flex-col justify-content-end">
            <li class="col-xl-3 col-l-3 col-md-3 ">
                <a href="/" class="{{ request()->is('/') ? 'link-active' : 'link' }}">Home</a>
            </li>
            <li class="col-xl-3 col-l-3 col-md-3 ">
                <a href="/IDK" class="{{ request()->is('/IDK') ? 'link-active' : 'link' }}">IDK</a>
            </li>
            <li class="col-xl-3 col-l-3 col-md-3 ">
                <a href="/IDK2" class="{{ request()->is('/IDK') ? 'link-active' : 'link' }}">IDK 2</a>
            </li>
        </ul>
    </section>
</nav>