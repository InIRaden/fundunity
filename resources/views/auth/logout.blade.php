<x-guest-layout>
    <div class="flex min-h-screen flex-col items-center justify-center bg-slate-50 px-4 font-sans">
        <div class="mb-8 text-center">
            <div class="mx-auto mb-4 flex h-20 w-20 items-center justify-center rounded-full border border-slate-200 bg-white shadow-sm">
                <i class="ph ph-sign-out ml-1 text-[32px] text-slate-400"></i>
            </div>
            <h1 class="text-xl font-bold tracking-tight text-slate-800">System Exit</h1>
            <p class="text-sm font-medium text-slate-400">Klik tombol di bawah untuk mengakhiri sesi.</p>
        </div>

        <button
            id="logoutOpenModal"
            type="button"
            class="rounded-2xl bg-indigo-600 px-8 py-3.5 font-bold text-white shadow-lg shadow-indigo-100 transition-all hover:scale-105 hover:bg-indigo-700 active:scale-95"
        >
            KELUAR DARI PANEL
        </button>
    </div>

    <div id="logoutModal" class="fixed inset-0 z-[200] hidden items-center justify-center bg-slate-900/40 p-4 backdrop-blur-[2px]">
        <div id="logoutModalCard" class="w-full max-w-sm overflow-hidden rounded-3xl bg-white shadow-2xl animate-scale-in">
            <div class="p-8 text-center">
                <div class="mx-auto mb-6 flex h-14 w-14 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600">
                    <i class="ph ph-door-open text-[32px]"></i>
                </div>
                <h2 class="text-xl font-black leading-tight text-slate-900">Konfirmasi Logout</h2>
                <p class="mt-2 text-sm font-medium text-slate-500">Apakah Anda yakin ingin mengakhiri sesi administrasi ini?</p>
            </div>

            <div class="flex flex-col gap-3 px-8 pb-8">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button
                        type="submit"
                        class="w-full rounded-2xl bg-indigo-600 py-3.5 font-bold text-white shadow-md shadow-indigo-100 transition-all hover:bg-indigo-700 active:scale-95"
                    >
                        YA, KELUAR SEKARANG
                    </button>
                </form>
                <button
                    id="logoutCancelModal"
                    type="button"
                    class="w-full rounded-2xl bg-slate-100 py-3.5 font-bold text-slate-600 transition-all hover:bg-slate-200"
                >
                    BATALKAN
                </button>
            </div>
        </div>
    </div>

    @push('head')
    <style>
        @keyframes scale-in {
            from {
                opacity: 0;
                transform: scale(0.95);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .animate-scale-in {
            animation: scale-in 0.2s ease-out forwards;
        }
    </style>
    @endpush

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('logoutModal');
            const modalCard = document.getElementById('logoutModalCard');
            const openButton = document.getElementById('logoutOpenModal');
            const cancelButton = document.getElementById('logoutCancelModal');

            function openModal() {
                modal?.classList.remove('hidden');
                modal?.classList.add('flex');
            }

            function closeModal() {
                modal?.classList.add('hidden');
                modal?.classList.remove('flex');
            }

            openButton?.addEventListener('click', openModal);
            cancelButton?.addEventListener('click', closeModal);

            modal?.addEventListener('click', function (event) {
                if (event.target === modal) {
                    closeModal();
                }
            });

            modalCard?.addEventListener('click', function (event) {
                event.stopPropagation();
            });

            document.addEventListener('keydown', function (event) {
                if (event.key === 'Escape') {
                    closeModal();
                }
            });
        });
    </script>
    @endpush
</x-guest-layout>
