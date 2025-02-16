@extends('layouts.app')

@section('content')
  <div class="container-login ">
      <div class="mt-20 container max-w-[1050px] px-5 lg:px-0 mx-auto  flex justify-center items-center">
          <section class="w-fit px-8 flex flex-col md:flex-row justify-center items-center gap-16 relative py-6 bg-white rounded-lg shadow-2xl">
              <img class="hidden md:block w-[300px] h-[300px]" src="{{asset('logo.png')}}" >
              <div class="  flex flex-col bg-white  py-8 rounded-md w-full md:w-[350px] ">

                  <!-- Alertas de sesión -->
                  @if(session('success'))
                      <div class="alert-auto-close p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
                          <span class="font-medium">¡Muy bien!</span> {{ session('success') }}
                      </div>
                  @endif

                  @if(session('error'))
                      <div class="alert-auto-close p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
                          <span class="font-medium">¡Error!</span> {{ session('error') }}
                      </div>
                  @endif

                  @if(session('info'))
                      <div class="alert-auto-close p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50" role="alert">
                          <span class="font-medium">¡Información!</span> {{ session('info') }}
                      </div>
                  @endif

                  @if(session('warning'))
                      <div class="alert-auto-close p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50" role="alert">
                          <span class="font-medium">¡Advertencia!</span> {{ session('warning') }}
                      </div>
                  @endif

                  @if(session('dark'))
                      <div class="alert-auto-close p-4 mb-4 text-sm text-gray-800 rounded-lg bg-gray-50" role="alert">
                          <span class="font-medium">¡Oscuro!</span> {{ session('dark') }}
                      </div>
                  @endif

                  <!-- Alerta para errores de validación -->
                  @if($errors->any())
                      <div class="alert-auto-close p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
                          <ul class="mt-2 list-disc list-inside">
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>

                      </div>
                  @endif

                  <div class="font-medium self-center uppercase text-xl sm:text-2xl uppercase text-gray-800">
                      ¡bienvenido!
                  </div>
                  <div class="relative mt-10 h-px bg-gray-300">
                      <div class="absolute left-0 top-0 flex justify-center w-full -mt-2">
                    <span class="bg-white  md:px-4 text-xs text-gray-500 uppercase">
                        Por favor ingresa tus credenciales
                    </span>
                      </div>
                  </div>
                  <div class="mt-10">
                      <form action="{{ route('login.post') }}" method="POST">
                          @csrf
                          <div class="flex flex-col mb-6">
                              <label for="email" class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                  Usuario:
                              </label>
                              <div class="relative">
                                  <div class="inline-flex items-center justify-center absolute left-0 top-0 h-full w-10 text-gray-400">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-user-round"><path d="M18 20a6 6 0 0 0-12 0"/><circle cx="12" cy="10" r="4"/><circle cx="12" cy="12" r="10"/></svg>
                                  </div>
                                  <input id="email" type="email" name="email" required autofocus
                                         class="text-sm sm:text-base placeholder-gray-500 pl-10 pr-4 rounded-lg border border-gray-400 w-full py-2 focus:outline-none focus:border-blue-400"
                                         placeholder="usuario@gmail.com" />
                              </div>
                          </div>
                          <div class="flex flex-col mb-6">
                              <label for="password" class="mb-1 text-xs sm:text-sm tracking-wide text-gray-600">
                                  Contraseña:
                              </label>
                              <div class="relative">
                                  <!-- Ícono a la izquierda -->
                                  <div class="inline-flex items-center justify-center absolute left-0 top-0 h-full w-10 text-gray-400">
                                      <svg class="h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                           stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                          <path d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                      </svg>
                                  </div>
                                  <!-- Input de contraseña. Se aumenta el padding a la derecha para dar espacio al ícono -->
                                  <input id="password" type="password" name="password" required
                                         class="text-sm sm:text-base placeholder-gray-500 pl-10 pr-10 rounded-lg border border-gray-400 w-full py-2 focus:outline-none focus:border-blue-400"
                                         placeholder="Contraseña" />
                                  <!-- Ícono para ver/ocultar contraseña -->
                                  <div class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer" id="togglePassword">
                                      <svg id="eyeIcon" class="h-6 w-6 text-gray-400" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                           stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                          <!-- Ícono "ojo" para mostrar la contraseña -->
                                          <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                          <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                      </svg>
                                  </div>
                              </div>
                          </div>

                          <div class="flex w-full">
                              <button type="submit"
                                      class="flex mt-3 items-center justify-center focus:outline-none text-white text-sm sm:text-base bg-[#007423] hover:bg-green-900 rounded py-2 w-full transition duration-150 ease-in">
                                  <span class="mr-2 uppercase">Login</span>
                                  <svg class="h-6 w-6" fill="none" stroke-linecap="round" stroke-linejoin="round"
                                       stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                                      <path d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                  </svg>
                              </button>
                          </div>
                      </form>
                  </div>
              </div>

          </section>
      </div>

  </div>

@endsection



<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Efecto fade-out para alertas después de 2 segundos
        setTimeout(() => {
            document.querySelectorAll('.alert-auto-close').forEach(alert => {
                alert.style.transition = "opacity 0.5s ease-out";
                alert.style.opacity = "0";
                setTimeout(() => alert.remove(), 500);
            });
        }, 2000);

        // Toggle para mostrar/ocultar contraseña
        const togglePassword = document.getElementById('togglePassword');
        const passwordField = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        if (togglePassword && passwordField && eyeIcon) {
            togglePassword.addEventListener('click', () => {
                const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordField.setAttribute('type', type);

                if (type === 'text') {
                    // Ícono para "ocultar contraseña" (ojo tachado)
                    eyeIcon.innerHTML = `
          <path d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a10.05 10.05 0 012.136-3.291M6.88 6.88A9.953 9.953 0 0112 5c4.477 0 8.268 2.943 9.542 7a10.05 10.05 0 01-1.043 1.858"/>
          <path d="M3 3l18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>`;
                } else {
                    // Ícono para "mostrar contraseña" (ojo normal)
                    eyeIcon.innerHTML = `
          <path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
          <path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>`;
                }
            });
        }
    });
</script>


