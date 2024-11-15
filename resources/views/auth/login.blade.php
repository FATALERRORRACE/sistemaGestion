<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <div align="center">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div
                    style="width:100%; margin:0px auto; padding-top:15px; clear: both; background-color: #60269e; color: #FFF; padding-bottom: 12px;">
                    <strong>Acceso: </strong>
                    <input type="radio" name="radio" id="tipo_1" value="1"
                        onchange="mi_serv(this.value);" autocompleted=""> Biblioteca &nbsp; &nbsp; &nbsp;
                    <input type="radio" name="radio" id="tipo_2" value="2"
                        onchange="mi_serv(this.value);">
                    Bibloestación &nbsp; &nbsp; &nbsp;
                    <input type="radio" name="radio" id="tipo_4" value="4"
                        onchange="mi_serv(this.value);">
                    Sala de lectura

                </div>
                <!-- espacio -->
                <div>
                    <x-label for="espacio" :value="__('Espacio')" />
                    <x-input id="espacio" class="block mt-1" type="text" name="espacio"
                        :value="old('espacio')" required autofocus />
                </div>


                <!-- user -->
                <div>
                    <x-label for="user" :value="__('Usuario')" />
                    <x-input id="user" class="block mt-1" type="text" name="user"
                        :value="old('username')" required autofocus />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-label for="password" :value="__('Contraseña')" />
                    <x-input id="password" class="block mt-1 " type="password" name="password" required
                        autocomplete="current-password" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}"> {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <x-button class="ml-3">
                        {{ __('Log in') }}
                    </x-button>
                </div>
            </form>
            <div style="max-width: 850px; margin: 0px auto;" class="bloque-contenido">
                <div style="margin-top: -20px; overflow: hidden; max-height: 65px;">
                    <div class="region footer" style="margin-top: -20px; font-size: 160%; overflow: hidden;">
                        <span style="position: relative; top: -20px; font-weight: bold;">Formulario de
                            Inscripci&oacute;n en L&iacute;nea</span>
                    </div>
                </div>
                <div class="panel-body panel-heading" style="font-size: 140%; width:80%; margin:0px auto;">
                    <div align="justify" style="padding-bottom: 10px; padding-top: 10px;">
                        Solo para funcionarios autorizados de BibloRed. Si pertenece a una de las bibliotecas que
                        prestan el servicio de afiliaci&oacute;n y le ha sido asignado un nombre de usuario y
                        contraseña podrá acceder.
                    </div>
                    <form name="registro" id="registro" method="POST" action="registro.php" autocomplete="off"
                        enctype="multipart/form-data" onsubmit="return validar();">
                        <div
                            style="width:100%; margin:0px auto; padding-top:15px; clear: both; background-color: #60269e; color: #FFF; padding-bottom: 12px;">
                            <strong>Acceso: </strong>
                            <input type="radio" name="radio" id="tipo_1" value="1"
                                onchange="mi_serv(this.value);" <?php if (isset($_POST['radio']) && $_POST['radio'] == 1) {
                                    echo 'checked';
                                } ?> /> Biblioteca &nbsp; &nbsp;
                            &nbsp;
                            <input type="radio" name="radio" id="tipo_2" value="2"
                                onchange="mi_serv(this.value);" <?php if (isset($_POST['radio']) && $_POST['radio'] == 2) {
                                    echo 'checked';
                                } ?> /> Bibloestación &nbsp; &nbsp;
                            &nbsp;
                            <input type="radio" name="radio" id="tipo_4" value="4"
                                onchange="mi_serv(this.value);" <?php if (isset($_POST['radio']) && $_POST['radio'] == 3) {
                                    echo 'checked';
                                } ?> /> Sala de lectura

                        </div>
                    </form>
                </div>
            </div>
            <div style="max-width: 850px; margin: 0px auto;">
                <p align="justify"><strong>Nota:</strong> No almacene la contraseña en el navegador, ya que esta no
                    se corresponderá con el siguiente ingreso a la herramienta. Si el navegador le autocompleta la
                    contraseña, bórrela y digite la asignada.</p>
            </div>
        </div>



        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div
                style="width:100%; margin:0px auto; padding-top:15px; clear: both; background-color: #60269e; color: #FFF; padding-bottom: 12px;">
                <strong>Acceso: </strong>
                <input type="radio" name="radio" id="tipo_1" value="1" onchange="mi_serv(this.value);"
                    autocompleted=""> Biblioteca &nbsp; &nbsp; &nbsp;
                <input type="radio" name="radio" id="tipo_2" value="2" onchange="mi_serv(this.value);">
                Bibloestación &nbsp; &nbsp; &nbsp;
                <input type="radio" name="radio" id="tipo_4" value="4" onchange="mi_serv(this.value);">
                Sala de lectura

            </div>
            <!-- espacio -->
            <div>
                <x-label for="espacio" :value="__('Espacio')" />
                <x-input id="espacio" class="block mt-1 w-full" type="text" name="espacio" :value="old('espacio')"
                    required autofocus />
            </div>


            <!-- user -->
            <div>
                <x-label for="user" :value="__('Usuario')" />
                <x-input id="user" class="block mt-1 w-full" type="text" name="user" :value="old('username')"
                    required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Contraseña')" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900"
                        href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ml-3">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
