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
        
        Solo para funcionarios autorizados de BibloRed. Si pertenece a una de las bibliotecas que prestan el servicio de
        afiliación y le ha sido asignado un nombre de usuario y contraseña podrá acceder.
        <x-auth-validation-errors class="" :errors="$errors" />
        <div align="center">

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="opt-log-radio">
                    <strong>Acceso:</strong><br>
                    <input class="radio-lg" type="radio" name="acceso" id="acceso_1" value="1"> Biblioteca
                    <input class="radio-lg" type="radio" name="acceso" id="acceso_2" value="2"> Bibloestación
                    <input class="radio-lg" type="radio" name="acceso" id="acceso_4" value="4"> Sala de lectura
                </div>
                <!-- espacio -->
                <div class="mt-3">
                    <x-label for="espacio" :value="__('Espacio')" />
                    <select name="espacio" id="espacio"
                        class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1">
                        <option value="">Seleccione primero el tipo de acceso</option>
                    </select>
                </div>
                <!-- user -->
                <div class="mt-2">
                    <x-label for="nombre_usuario" :value="__('Usuario')" />
                    <x-input id="nombre_usuario" class="block mt-1" type="text" name="nombre_usuario" :value="old('username')" required
                        autofocus />
                </div>

                <!-- Password -->
                <div class="mt-2">
                    <x-label for="password" :value="__('Contraseña')" />
                    <x-input id="password" class="block mt-1 " type="password" name="password" required
                        autocomplete="current-password" />
                </div>

                <!-- Remember Me -->
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900"
                        href="{{ route('password.request') }}"> {{ __('¿Olvidaste tu contraseña?') }}
                    </a>
                @endif
                <div class="flex items-center justify-center mt-3">
                    <x-button class="ml-3 bg-60269e">
                        {{ __('Acceder') }}
                    </x-button>
                </div>
            </form>
            <!--<div style="max-width: 850px; margin: 0px auto;" class="bloque-contenido">
                <div style="margin-top: -20px; overflow: hidden; max-height: 65px;">
                    <div class="region footer" style="margin-top: -20px; font-size: 160%; overflow: hidden;">
                        <span style="position: relative; top: -20px; font-weight: bold;">Formulario de
                            Inscripci&oacute;n en L&iacute;nea</span>
                    </div>
                </div>
            </div>-->
        </div>
        <div style="max-width: 850px; margin: 0px auto;">
            <p align="justify"><strong>Nota:</strong> No almacene la contraseña en el navegador, ya que esta no
                se corresponderá con el siguiente ingreso a la herramienta. Si el navegador le autocompleta la
                contraseña, bórrela y digite la asignada.</p>
        </div>
    </x-auth-card>
</x-guest-layout>
