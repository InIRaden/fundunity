@extends('layouts.landing')

@section('title', 'FAQ')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-r from-green-600 to-green-800 text-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Pertanyaan yang Sering Diajukan</h1>
        <p class="text-xl text-white/90">Temukan jawaban atas pertanyaan Anda</p>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="space-y-6">
            <!-- FAQ Item 1 -->
            <div class="bg-gray-50 rounded-lg overflow-hidden">
                <button class="w-full px-6 py-5 text-left flex justify-between items-center hover:bg-gray-100 transition" onclick="toggleFaq(1)">
                    <h3 class="text-lg font-semibold text-gray-900">Apa itu Komunitas Ruang Berbagi?</h3>
                    <svg id="icon-1" class="w-6 h-6 text-gray-600 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div id="faq-1" class="hidden px-6 pb-5">
                    <p class="text-gray-600">
                        Komunitas Ruang Berbagi adalah organisasi sosial yang berfokus pada penanganan kelaparan dan pemberdayaan masyarakat di Indonesia.
                        Kami bekerja melalui berbagai program seperti distribusi pangan, pendidikan gizi, dan pelatihan keterampilan untuk menciptakan dampak positif yang berkelanjutan.
                    </p>
                </div>
            </div>

            <!-- FAQ Item 2 -->
            <div class="bg-gray-50 rounded-lg overflow-hidden">
                <button class="w-full px-6 py-5 text-left flex justify-between items-center hover:bg-gray-100 transition" onclick="toggleFaq(2)">
                    <h3 class="text-lg font-semibold text-gray-900">Bagaimana cara saya bisa berkontribusi?</h3>
                    <svg id="icon-2" class="w-6 h-6 text-gray-600 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div id="faq-2" class="hidden px-6 pb-5">
                    <p class="text-gray-600">
                        Ada beberapa cara Anda bisa berkontribusi: (1) Menjadi donatur dengan menyumbang dana atau barang,
                        (2) Menjadi relawan untuk membantu kegiatan langsung di lapangan, (3) Menyebarkan informasi tentang program kami
                        ke teman dan keluarga, atau (4) Bermitra dengan kami jika Anda mewakili organisasi atau perusahaan.
                    </p>
                </div>
            </div>

            <!-- FAQ Item 3 -->
            <div class="bg-gray-50 rounded-lg overflow-hidden">
                <button class="w-full px-6 py-5 text-left flex justify-between items-center hover:bg-gray-100 transition" onclick="toggleFaq(3)">
                    <h3 class="text-lg font-semibold text-gray-900">Apakah donasi saya aman dan transparan?</h3>
                    <svg id="icon-3" class="w-6 h-6 text-gray-600 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div id="faq-3" class="hidden px-6 pb-5">
                    <p class="text-gray-600">
                        Ya, sangat aman. Kami memiliki sistem keuangan yang terpercaya dan transparan.
                        Setiap donasi yang masuk akan dicatat dengan baik dan kami memberikan laporan rutin kepada para donatur
                        tentang penggunaan dana. Anda juga akan menerima bukti resmi untuk setiap donasi yang Anda berikan.
                    </p>
                </div>
            </div>

            <!-- FAQ Item 4 -->
            <div class="bg-gray-50 rounded-lg overflow-hidden">
                <button class="w-full px-6 py-5 text-left flex justify-between items-center hover:bg-gray-100 transition" onclick="toggleFaq(4)">
                    <h3 class="text-lg font-semibold text-gray-900">Di mana saja Komunitas Ruang Berbagi beroperasi?</h3>
                    <svg id="icon-4" class="w-6 h-6 text-gray-600 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div id="faq-4" class="hidden px-6 pb-5">
                    <p class="text-gray-600">
                        Saat ini kami berpusat di Bandung, Jawa Barat, namun program kami telah menjangkau berbagai daerah di Indonesia.
                        Kami terus berupaya memperluas jangkauan untuk membantu lebih banyak masyarakat yang membutuhkan.
                    </p>
                </div>
            </div>

            <!-- FAQ Item 5 -->
            <div class="bg-gray-50 rounded-lg overflow-hidden">
                <button class="w-full px-6 py-5 text-left flex justify-between items-center hover:bg-gray-100 transition" onclick="toggleFaq(5)">
                    <h3 class="text-lg font-semibold text-gray-900">Bagaimana cara menjadi relawan?</h3>
                    <svg id="icon-5" class="w-6 h-6 text-gray-600 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div id="faq-5" class="hidden px-6 pb-5">
                    <p class="text-gray-600">
                        Untuk menjadi relawan, Anda bisa mengisi formulir pendaftaran di halaman "Bergabung Bersama Kami" pada website kami.
                        Tim kami akan menghubungi Anda untuk proses selanjutnya. Kami menerima relawan dari berbagai latar belakang
                        dan menyediakan pelatihan bagi relawan baru.
                    </p>
                </div>
            </div>

            <!-- FAQ Item 6 -->
            <div class="bg-gray-50 rounded-lg overflow-hidden">
                <button class="w-full px-6 py-5 text-left flex justify-between items-center hover:bg-gray-100 transition" onclick="toggleFaq(6)">
                    <h3 class="text-lg font-semibold text-gray-900">Apakah perusahaan/organisasi bisa bermitra?</h3>
                    <svg id="icon-6" class="w-6 h-6 text-gray-600 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div id="faq-6" class="hidden px-6 pb-5">
                    <p class="text-gray-600">
                        Tentu! Kami sangat terbuka untuk kemitraan dengan perusahaan maupun organisasi lain.
                        Kemitraan dapat berupa sponsorship program, CSR, kolaborasi acara, atau bentuk kerjasama lainnya.
                        Silakan hubungi kami melalui email atau telepon untuk mendiskusikan peluang kemitraan.
                    </p>
                </div>
            </div>

            <!-- FAQ Item 7 -->
            <div class="bg-gray-50 rounded-lg overflow-hidden">
                <button class="w-full px-6 py-5 text-left flex justify-between items-center hover:bg-gray-100 transition" onclick="toggleFaq(7)">
                    <h3 class="text-lg font-semibold text-gray-900">Bagaimana saya bisa memantau dampak donasi saya?</h3>
                    <svg id="icon-7" class="w-6 h-6 text-gray-600 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div id="faq-7" class="hidden px-6 pb-5">
                    <p class="text-gray-600">
                        Kami secara rutin mengirimkan laporan aktivitas dan dampak program kepada para donatur melalui email.
                        Anda juga dapat mengikuti media sosial kami untuk melihat update terbaru tentang kegiatan dan
                        perkembangan program. Kami berkomitmen untuk memberikan transparansi penuh kepada semua pendukung kami.
                    </p>
                </div>
            </div>

            <!-- FAQ Item 8 -->
            <div class="bg-gray-50 rounded-lg overflow-hidden">
                <button class="w-full px-6 py-5 text-left flex justify-between items-center hover:bg-gray-100 transition" onclick="toggleFaq(8)">
                    <h3 class="text-lg font-semibold text-gray-900">Apakah ada minimum donasi?</h3>
                    <svg id="icon-8" class="w-6 h-6 text-gray-600 transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div id="faq-8" class="hidden px-6 pb-5">
                    <p class="text-gray-600">
                        Tidak ada minimum donasi. Setiap kontribusi, sekecil apapun, sangat berarti bagi kami dan akan
                        digunakan untuk membantu mereka yang membutuhkan. Yang terpenting adalah niat baik untuk berbagi
                        dan berkontribusi pada masyarakat.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Still Have Questions -->
<section class="py-16 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl font-bold mb-4">Masih Ada Pertanyaan?</h2>
        <p class="text-gray-600 text-lg mb-8">
            Tim kami siap membantu menjawab pertanyaan Anda
        </p>
        <a href="{{ route('contact') }}" class="inline-block bg-green-600 text-white px-8 py-4 rounded-full font-semibold hover:bg-green-700 transition">
            Hubungi Kami
        </a>
    </div>
</section>

@endsection

@push('scripts')
<script>
function toggleFaq(id) {
    const content = document.getElementById('faq-' + id);
    const icon = document.getElementById('icon-' + id);

    content.classList.toggle('hidden');
    icon.classList.toggle('rotate-180');
}
</script>
@endpush
