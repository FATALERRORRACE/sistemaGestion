<nav role="navigation" aria-labelledby="block-biblored-tailwind-stable-menuprincipal-menu"
    id="block-biblored-tailwind-stable-menuprincipal" class="settings-tray-editable wrapper bg-white border-gray-200"
    data-drupal-settingstray="editable">
    <div class="flex">
        <div class="flex-none w-64 ">
            <a href="/" rel="home" class="img-001 flex items-center md:max-w-[200px] lg:max-w-[200px]">
                <img src="https://www.biblored.gov.co/sites/default/files/logo-biblored.svg" alt="Inicio"
                    class="mr-3 w-full">
            </a>
        </div>
        <div id="contain-e-t" class="flex-1 w-64 rounded bg-white">
            <div class="flex justify-center">
                <div class="border-solid p-1 rounded-lg border-2 border-indigo-600 container-f-option">
                    <!--First radio-->
                    <div class="me-4 inline-block ">
                        <input class="radio-lg" type="radio" name="acceso" id="acceso-1" value="1"/>
                        <label class="mt-px inline-block ps-[0.15rem] opacity-50 " for="acceso-1">Biblioteca</label>
                    </div>

                    <!--Second radio-->
                    <div class="me-4 inline-block ">
                        <input class="radio-lg" type="radio" name="acceso" id="acceso-2" value="2"/>
                        <label class="mt-px inline-block ps-[0.15rem] opacity-50 " for="acceso-2">Bibloestación</label>
                    </div>

                    <!--Third radio (disabled)-->
                    <div class="me-4 inline-block ">
                        <input class="radio-lg" type="radio" name="acceso" id="acceso-4" value="4"/>
                        <label class="mt-px inline-block ps-[0.15rem] opacity-50 " for="acceso-4">Sala de lectura </label>
                    </div>

                    <div class="me-4 inline-block ">
                        <input class="radio-lg" type="radio" name="acceso" id="acceso-3" value="3" />
                        <label class="mt-px inline-block ps-[0.15rem] opacity-50 " for="acceso-3">
                            PPP
                        </label>
                    </div>
                </div>
            </div>
            <div class="flex justify-center margin-50">
                <select id="espacio" class="base-1-color js-example-basic-single border-bblr-1">
                </select>
            </div>
        </div>
        <div class="flex-none w-64">
            <div class="flex justify-center">11:11</div>
            <div class="flex justify-center">
                <div class="dropdown dropdown-hover">
                    <button data-mdb-button-init data-mdb-ripple-init data-mdb-dropdown-init class="rounded-lg dropdown-toggle btn rounded-lg" type="button" id="user" data-mdb-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-user"></i> {{ session('username') }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-hover" aria-labelledby="">
                        <li>
                            <a class="dropdown-item" href="{{ route('logout') }}" id="end-sess">
                                <i class="fa-solid fa-right-from-bracket"></i> Cerrar Sesión
                            </a>
                            </ulli>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
