<div id="dialog-bbltc">
    <div id="btn-header-dialog">
        <button id="new-library" class="btn btn-sm text-white hover:bg-blue-700 bg-blue-600"><i class="fa-solid fa-plus"></i> Nuevo</button>
        <button id="edit-library" class="btn btn-sm text-white hover:bg-slate-500 bg-slate-200 mx-2"><i class="fa-solid fa-pen-to-square"></i> Editar</button>
    </div>
    <div class="relative transform overflow-hidden text-left transition-all w-full h-full">
        <div class="bg-white">
            <div class="sm:flex sm:items-start">
                <form id="nu-form" class="text-left mt-3 mx-2">
                    <div class="justify-center text-center mb-3">
                        <div class="w-100">
                            <label class="font-medium opacity-80" for="nombre">
                                Nombre completo
                            </label>
                        </div>
                        <div class="w-100">
                            <input class="rounded-md shadow-sm border-gray-300 " id="name" type="text"
                                name="name" required="required">
                        </div>
                    </div>
                    <div class="justify-center text-center mb-3">
                        <div class="w-100">
                            <label class="font-medium opacity-80" for="nombre">
                                Iniciales a asignar
                            </label>
                        </div>
                        <div class="mb-2 w-30">
                            <input class="rounded-md shadow-sm border-gray-300 " id="name" type="text" size="10"
                                name="name" required="required">
                        </div>
                    </div>
                    <div class="justify-center text-center mb-3">
                        <div class="w-100">
                            <label class="font-medium opacity-80" for="nombre">
                                Código a asignar
                            </label>
                        </div>
                        <div class="mb-2 w-30">
                            <input class="rounded-md shadow-sm border-gray-300 " id="name" type="text" size="10"
                                name="name" required="required">
                        </div>
                    </div>
                    <div class="justify-center text-center mb-3">
                        <div class="w-100">
                            <label class="font-medium opacity-80" for="nombre">
                                Código a asignar
                            </label>
                        </div>
                        <div class="mb-2 w-30">
                            <input class="rounded-md shadow-sm border-gray-300 " id="name" type="text" size="10"
                                name="name" required="required">
                        </div>
                    </div>
                    <div class="justify-center text-center mb-3">
                        <div class="w-100">
                            <label class="font-medium opacity-80" for="nombre">
                                Tipo de espacio
                            </label>
                        </div>
                        <!--First radio-->
                        <div class="me-4 inline-block ">
                            <input class="bbltc-radio" type="radio" name="bbltc-acceso" id="bbltc-acceso-1" value="1">
                            <label class="mt-px inline-block ps-[0.15rem] " for="acceso-1">Biblioteca</label>
                        </div>
    
                        <!--Second radio-->
                        <div class="me-4 inline-block ">
                            <input class="bbltc-radio" type="radio" name="bbltc-acceso" id="bbltc-acceso-2" value="2">
                            <label class="mt-px inline-block ps-[0.15rem] " for="acceso-2">Bibloestación</label>
                        </div>
    
                        <!--Third radio (disabled)-->
                        <div class="me-4 inline-block ">
                            <input class="bbltc-radio" type="radio" name="bbltc-acceso" id="bbltc-acceso-4" value="4">
                            <label class="mt-px inline-block ps-[0.15rem] " for="acceso-4">Sala de lectura </label>
                        </div>
    
                        <div class="me-4 inline-block ">
                            <input class="bbltc-radio" type="radio" name="bbltc-acceso" id="bbltc-acceso-3" value="3">
                            <label class="mt-px inline-block ps-[0.15rem] " for="acceso-3">
                                PPP
                            </label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                <button id="close-biblioteca-dialog" type="button" class="m-1 rounded-md px-3 btn">Cerrar</button>
                <button id="save-new-biblioteca" type="button" class="bg-009F4D hover:bg-blue-900 m-1 text-white rounded-md px-3 btn"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
                <button id="save-edit-biblioteca" type="button" class="bg-009F4D hover:bg-blue-900 m-1 text-white rounded-md px-3 btn" style="display:none;"><i class="fa-solid fa-floppy-disk"></i> Guardar</button>
            </div>
        </div>
    </div>
</div>