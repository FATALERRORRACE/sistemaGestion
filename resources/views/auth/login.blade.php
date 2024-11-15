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
                        prestan el servicio de afiliaci&oacute;n y le ha sido asignado un nombre de usuario y contraseña
                        podrá acceder.
                    </div>
                    <form name="registro" id="registro" method="POST" action="registro.php" autocomplete="off"
                        enctype="multipart/form-data" onsubmit="return validar();">
                        <div
                            style="width:100%; margin:0px auto; padding-top:15px; clear: both; background-color: #60269e; color: #FFF; padding-bottom: 12px;">
                            <strong>Acceso: </strong>
                            <input type="radio" name="radio" id="tipo_1" value="1"
                                onchange="mi_serv(this.value);" <?php if (isset($_POST['radio']) && $_POST['radio'] == 1) {
                                    echo 'checked';
                                } ?> /> Biblioteca &nbsp; &nbsp; &nbsp;
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
                        <div style="padding: 0px 100px 20px">
                            <div
                                style="width:100%; padding-top:15px; clear: both; display:flex; justify-content: space-between;">
                                <div><strong>Espacio: &nbsp; </strong></div>
                                <div>
                                    <select name="sel_bib" id="sel_bib" style="width: 20rem;">
                                        <?php
                                                if (isset($_POST["radio"]) && $_POST["radio"] > 0) {
                                                    if (mysqli_num_rows($bib) > 0) {
                                                ?>
                                        <option value="">Seleccione el nombre del espacio</option>
                                        <?php
                                                        for ($i = 0; $i < mysqli_num_rows($bib); $i++) {
                                                            $row = mysqli_fetch_array($bib);
                                                        ?>
                                        <option value="<?php echo $row['Id_Biblioteca']; ?>"><?php echo $row['Biblioteca']; ?></option>
                                        <?php
                                                        }
                                                    }
                                                } else { ?>
                                        <option value="">Seleccione primero el tipo de acceso</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div
                                style="width:100%; padding-top:15px; clear: both; display:flex; justify-content: space-between;">
                                <div><strong>Usuario: &nbsp; </strong></div>
                                <div><input name="usuario" type="text" size="30" autocomplete="off"
                                        style="width: 20rem;" /></div>
                            </div>

                            <div
                                style="width:100%; padding-top:15px; clear: both; display:flex; justify-content: space-between;">
                                <div><strong>Contrase&ntilde;a: &nbsp; </strong></div>
                                <div><input name="serial" type="password" size="30" autocomplete="off"
                                        style="width: 20rem;" /></div>
                            </div>
                            <div style="width:100%; margin:0px auto;clear: both;">
                                <div id="mi_confirm"
                                    style="width:100%; max-height:50px;margin:0px auto; padding-top: 20px;">

                                </div>
                            </div>

                            <div style="width:100%; margin:0px auto; padding-top:20px; clear: both;"
                                <?php if (strlen($msn) > 0) {
                                    echo "bgcolor='#FF3300'";
                                } ?>>
                                <?php
                                if (strlen($msn) > 0) {
                                    echo $msn;
                                }
                                ?>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
            <div style="max-width: 850px; margin: 0px auto;">
                <p align="justify"><strong>Nota:</strong> No almacene la contraseña en el navegador, ya que esta no se
                    corresponderá con el siguiente ingreso a la herramienta. Si el navegador le autocompleta la
                    contraseña, bórrela y digite la asignada.</p>
            </div>
        </div>


        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

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
