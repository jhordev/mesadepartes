@extends('layouts.dasboard')
@section('content')
    <main >
        <h1 class="text-[32px] font-bold">Dashboard</h1>

        <section class="grid grid-cols-12 mt-8 flex gap-3 md:gap-8">
            <x-card>
                <div class="text-[#202224]">
                    <h3 class="text-[16px] font-semibold ">Total de Usuarios</h3>
                    <span id="count-users" class="text-[28px] font-bold h-[34px]">0</span>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 60 60" fill="none">
                    <path opacity="0.21" fill-rule="evenodd" clip-rule="evenodd" d="M0 30V37C0 49.7025 10.2975 60 23 60H30H37C49.7025 60 60 49.7025 60 37V30V23C60 10.2975 49.7025 0 37 0H30H23C10.2975 0 0 10.2975 0 23V30Z" fill="#8280FF"/>
                    <path opacity="0.587821" fill-rule="evenodd" clip-rule="evenodd" d="M20.6667 23.3333C20.6667 26.2789 23.0545 28.6667 26 28.6667C28.9455 28.6667 31.3333 26.2789 31.3333 23.3333C31.3333 20.3878 28.9455 18 26 18C23.0545 18 20.6667 20.3878 20.6667 23.3333ZM34 28.6667C34 30.8758 35.7909 32.6667 38 32.6667C40.2091 32.6667 42 30.8758 42 28.6667C42 26.4575 40.2091 24.6667 38 24.6667C35.7909 24.6667 34 26.4575 34 28.6667Z" fill="#8280FF"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M25.9778 31.3333C19.6826 31.3333 14.5177 34.5687 14.0009 40.9323C13.9727 41.2789 14.6356 42 14.97 42H36.9956C37.9972 42 38.0128 41.194 37.9972 40.9333C37.6065 34.3909 32.3616 31.3333 25.9778 31.3333ZM45.2746 42L40.1333 42C40.1333 38.9988 39.1417 36.2291 37.4683 34.0008C42.0103 34.0505 45.7189 36.3469 45.998 41.2C46.0092 41.3955 45.998 42 45.2746 42Z" fill="#8280FF"/>
                </svg>
            </x-card>
            <x-card>
                <div class="text-[#202224]">
                    <h3 class="text-[16px] font-semibold ">Total de Areas</h3>
                    <span id="count-areas" class="text-[28px] font-bold">0</span>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 60 60" fill="none">
                    <path opacity="0.21" fill-rule="evenodd" clip-rule="evenodd" d="M0 30V37C0 49.7025 10.2975 60 23 60H30H37C49.7025 60 60 49.7025 60 37V30V23C60 10.2975 49.7025 0 37 0H30H23C10.2975 0 0 10.2975 0 23V30Z" fill="#FEC53D"/>
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M15 24.3165L27.9005 31.7646C28.0394 31.8448 28.1851 31.9027 28.3333 31.9395V46.3847L15.9201 39.0385C15.3498 38.701 15 38.0876 15 37.4249V24.3165ZM45 24.1185V37.4249C45 38.0876 44.6502 38.701 44.0799 39.0385L31.6667 46.3847V31.8129C31.6969 31.7978 31.7269 31.7817 31.7566 31.7646L45 24.1185Z" fill="#FEC53D"/>
                    <path opacity="0.499209" fill-rule="evenodd" clip-rule="evenodd" d="M15.4052 20.7014C15.5628 20.5024 15.7617 20.3343 15.9936 20.2108L29.1186 13.2201C29.6695 12.9266 30.3304 12.9266 30.8814 13.2201L44.0064 20.2108C44.1852 20.306 44.3443 20.4277 44.48 20.5697L30.0899 28.8778C29.9953 28.9325 29.908 28.995 29.8285 29.064C29.749 28.995 29.6618 28.9325 29.5671 28.8778L15.4052 20.7014Z" fill="#FEC53D"/>
                </svg>
            </x-card>
            <x-card>
                <div class="text-[#202224]">
                    <h3 class="text-[16px] font-semibold ">Total de Expedientes</h3>
                    <span id="count-expedientes" class="text-[28px] font-bold">0</span>
                </div>
                <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.21" fill-rule="evenodd" clip-rule="evenodd" d="M0 30V37C0 49.7025 10.2975 60 23 60H30H37C49.7025 60 60 49.7025 60 37V30V23C60 10.2975 49.7025 0 37 0H30H23C10.2975 0 0 10.2975 0 23V30Z" fill="#8280FF"/>
                    <path d="M42 45H18C17.1716 45 16.5 44.3284 16.5 43.5V16.5C16.5 15.6716 17.1716 15 18 15H42C42.8284 15 43.5 15.6716 43.5 16.5V43.5C43.5 44.3284 42.8284 45 42 45ZM40.5 42V18H19.5V42H40.5ZM22.5 21H28.5V27H22.5V21ZM22.5 30H37.5V33H22.5V30ZM22.5 36H37.5V39H22.5V36ZM31.5 22.5H37.5V25.5H31.5V22.5Z" fill="#8280FF"/>
                </svg>

            </x-card>
            <x-card>
                <div class="text-[#202224]">
                    <h3 class="text-[16px] font-semibold ">Expedientes Pendientes</h3>
                    <span id="count-pendientes" class="text-[28px] font-bold">0</span>
                </div>
                <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0 30V37C0 49.7025 10.2975 60 23 60H30H37C49.7025 60 60 49.7025 60 37V30V23C60 10.2975 49.7025 0 37 0H30H23C10.2975 0 0 10.2975 0 23V30Z" fill="#FEE2E2"/>
                    <path d="M34.5 18H19.5V42H40.5V24H34.5V18ZM16.5 16.4877C16.5 15.6661 17.1712 15 17.9978 15H36L43.4996 22.5L43.5 43.4888C43.5 44.3234 42.8326 45 42.0099 45H17.9901C17.1671 45 16.5 44.317 16.5 43.5123V16.4877ZM28.5 34.5H31.5V37.5H28.5V34.5ZM28.5 22.5H31.5V31.5H28.5V22.5Z" fill="#A91B2C"/>
                </svg>

            </x-card>
            <x-card>
                <div class="text-[#202224]">
                    <h3 class="text-[16px] font-semibold ">Expedientes en Trámite</h3>
                    <span id="count-en-tramite" class="text-[28px] font-bold">0</span>
                </div>
                <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.21" fill-rule="evenodd" clip-rule="evenodd" d="M0 30V37C0 49.7025 10.2975 60 23 60H30H37C49.7025 60 60 49.7025 60 37V30V23C60 10.2975 49.7025 0 37 0H30H23C10.2975 0 0 10.2975 0 23V30Z" fill="#FEC53D"/>
                    <path d="M17.1667 45.9167H38.75C39.5677 45.9167 40.352 45.5918 40.9302 45.0136C41.5085 44.4353 41.8333 43.6511 41.8333 42.8333V22.7917L34.125 15.0833H20.25C19.4322 15.0833 18.648 15.4082 18.0697 15.9864C17.4915 16.5647 17.1667 17.3489 17.1667 18.1667V24.3333" stroke="#FEC53D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M32.5833 15.0833V21.25C32.5833 22.0678 32.9082 22.852 33.4864 23.4302C34.0647 24.0085 34.8489 24.3333 35.6667 24.3333H41.8333" stroke="#FEC53D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M14.0833 35.125H29.5" stroke="#FEC53D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M24.875 39.75L29.5 35.125L24.875 30.5" stroke="#FEC53D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>

            </x-card>
            <x-card>
                <div class="text-[#202224]">
                    <h3 class="text-[16px] font-semibold ">Expendiente Atendido</h3>
                    <span id="count-atendidos" class="text-[28px] font-bold">0</span>
                </div>

                <svg width="60" height="60" viewBox="0 0 60 60" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.21" fill-rule="evenodd" clip-rule="evenodd" d="M0 30V37C0 49.7025 10.2975 60 23 60H30H37C49.7025 60 60 49.7025 60 37V30V23C60 10.2975 49.7025 0 37 0H30H23C10.2975 0 0 10.2975 0 23V30Z" fill="#4AD991"/>
                    <path d="M18.1667 44.9167H39.75C40.5678 44.9167 41.352 44.5918 41.9303 44.0136C42.5085 43.4353 42.8334 42.6511 42.8334 41.8333V21.7917L35.125 14.0833H21.25C20.4323 14.0833 19.648 14.4082 19.0698 14.9864C18.4915 15.5647 18.1667 16.3489 18.1667 17.1667V23.3333" stroke="#4AD991" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M33.5833 14.0833V20.25C33.5833 21.0678 33.9082 21.852 34.4864 22.4302C35.0646 23.0085 35.8489 23.3333 36.6666 23.3333H42.8333" stroke="#4AD991" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M16.625 34.125L19.7083 37.2083L25.875 31.0417" stroke="#4AD991" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>

            </x-card>
        </section>
    </main>




    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Obtener y actualizar Total de Usuarios
            fetch("{{ route('api.countUsers') }}")
                .then(response => response.json())
                .then(data => {
                    document.getElementById('count-users').innerText = data.count;
                })
                .catch(error => console.error('Error:', error));

            // Obtener y actualizar Total de Áreas
            fetch("{{ route('api.countAreas') }}")
                .then(response => response.json())
                .then(data => {
                    document.getElementById('count-areas').innerText = data.count;
                })
                .catch(error => console.error('Error:', error));

            // Obtener y actualizar Total de Expedientes
            fetch("{{ route('api.countExpedientes') }}")
                .then(response => response.json())
                .then(data => {
                    document.getElementById('count-expedientes').innerText = data.count;
                })
                .catch(error => console.error('Error:', error));

            // Obtener y actualizar Expedientes por Estado
            fetch("{{ route('api.countExpedientesPorEstado') }}")
                .then(response => response.json())
                .then(data => {
                    document.getElementById('count-pendientes').innerText = data.pendientes;
                    document.getElementById('count-en-tramite').innerText = data.en_tramite;
                    document.getElementById('count-atendidos').innerText = data.atendidos;
                })
                .catch(error => console.error('Error:', error));
        });
    </script>
@endsection

