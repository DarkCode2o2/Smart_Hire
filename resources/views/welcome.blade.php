<!DOCTYPE html>
<html lang="en" data-theme="light" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartHire AI | Advanced Recruitment Platform</title>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
        .gradient-text { background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .blue-shadow { box-shadow: 0 20px 25px -5px rgba(59, 130, 246, 0.1), 0 8px 10px -6px rgba(59, 130, 246, 0.1); }
    </style>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="text-slate-900" id="top">

    <nav class="px-6 py-4 shadow-sm navbar max-w-7xl mx-auto fixed w-full z-50 bg-white/80 backdrop-blur-md border-b border-slate-100">
        <div class="navbar-start">
            <a href="#top" class="text-2xl font-extrabold tracking-tight text-blue-600">
                SmartHire<span class="text-slate-400">AI</span>
            </a>
        </div>

        <div class="navbar-center gap-8 items-center text-lg sm:flex hidden font-semibold text-slate-600">
                <a href="#features" class="hover:text-blue-600 transition">Features</a>
                <a href="#stats" class="hover:text-blue-600 transition">Why Us</a>
                <a href="#faq" class="hover:text-blue-600 transition">FAQ</a>
        </div>

        <div class="navbar-end sm:hidden flex">
            <div class="dropdown">
                <div tabindex="0" role="button" class="btn btn-ghost btn-circle">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" /> </svg>
                </div>
                <ul
                    tabindex="-1"
                    class="menu menu-sm absolute right-5 dropdown-content bg-base-100 rounded-box z-1 mt-3 w-52 p-2 shadow">
                    <li>
                        <a href="#features" class="hover:text-white hover:bg-blue-600 font-bold text-[15px] transition">Features</a>
                    </li>
                    <li>
                        <a href="#stats" class="hover:text-white hover:bg-blue-600 font-bold text-[15px] transition">Why Us</a>
                    </li>
                    <li>
                        <a href="#faq" class="hover:text-white hover:bg-blue-600 font-bold text-[15px] transition">FAQ</a>
                    </li>
                    <hr class="my-2 text-gray-200">
                    @guest
                        <li>
                            <a href="{{ route('login') }}" class="text-[15px] hover:text-white hover:bg-blue-600 font-semibold transition">Login</a>
                        </li>
                    @endguest
                    <li>
                        <a href="{{ route('register') }}" class="bg-blue-600  mt-2 inline-block text-center hover:bg-blue-700 text-white px-6 py-2.5 rounded-xl text-sm font-bold transition blue-shadow">
                            Get Started
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="navbar-end sm:flex hidden items-center gap-4">
            @guest
                <a href="{{ route('login') }}" class="text-lg font-bold text-slate-700 hover:text-blue-600">Login</a>
            @endguest
            <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-xl text-sm font-bold transition blue-shadow">
                Get Started
            </a>
        </div>
    </nav>

    <header class="sm:pt-40 pt-30 pb-20 px-6">
        <div class="max-w-5xl mx-auto text-center">
            <h1 class="text-5xl md:text-7xl font-extrabold mb-8 tracking-tight text-slate-900">
                Stop Reading Resumes. <br> <span class="gradient-text">Start Hiring Talent.</span>
            </h1>
            <p class="text-xl text-slate-500 mb-10 max-w-3xl mx-auto leading-relaxed">
                SmartHire AI uses world-class artificial intelligence to scan hundreds of resumes, identify top-tier skills, and rank candidates so you can focus on the interview.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-10 py-5 rounded-2xl font-bold text-lg transition-all transform hover:-translate-y-1 blue-shadow">
                    Upload Your First Resume
                </a>
                <div class="flex items-center gap-2 px-6 py-5 text-slate-600 font-medium">
                    <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/></svg>
                    No Credit Card Required
                </div>
            </div>
        </div>
    </header>

    <section id="stats" class="py-16 bg-white border-y border-slate-100">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div>
                <div class="text-4xl font-black text-blue-600 mb-2">98%</div>
                <div class="text-sm font-bold text-slate-400 uppercase tracking-widest">Accuracy Rate</div>
            </div>
            <div>
                <div class="text-4xl font-black text-blue-600 mb-2">10x</div>
                <div class="text-4xl font-black text-blue-600 mb-2">Faster</div>
                <div class="text-sm font-bold text-slate-400 uppercase tracking-widest">Hiring Speed</div>
            </div>
            <div>
                <div class="text-4xl font-black text-blue-600 mb-2">50+</div>
                <div class="text-sm font-bold text-slate-400 uppercase tracking-widest">Skills Tracked</div>
            </div>
            <div>
                <div class="text-4xl font-black text-blue-600 mb-2">AI</div>
                <div class="text-sm font-bold text-slate-400 uppercase tracking-widest">Powered Engine</div>
            </div>
        </div>
    </section>

    <section id="features" class="py-24 px-6 max-w-7xl mx-auto">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold text-slate-900 mb-4">Everything you need to scale</h2>
            <p class="text-slate-500">Built for modern HR teams and tech recruiters.</p>
        </div>
        <div class="grid md:grid-cols-3 gap-12">
            <div class="group">
                <div class="mb-6 p-4 rounded-2xl bg-white border border-slate-100 group-hover:border-blue-200 transition blue-shadow">
                    <h3 class="text-xl font-bold mb-4 text-blue-700">Multi-Resume Upload</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">Don't waste time uploading one by one. Drag and drop multiple PDF resumes and let our engine process them in parallel.</p>
                </div>
            </div>
            <div class="group">
                <div class="mb-6 p-4 rounded-2xl bg-white border border-slate-100 group-hover:border-blue-200 transition blue-shadow">
                    <h3 class="text-xl font-bold mb-4 text-blue-700">Deep Skill Extraction</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">Our Gemini-powered AI goes beyond keywords. It understands the context of experience and projects to score skills accurately.</p>
                </div>
            </div>
            <div class="group">
                <div class="mb-6 p-4 rounded-2xl bg-white border border-slate-100 group-hover:border-blue-200 transition blue-shadow">
                    <h3 class="text-xl font-bold mb-4 text-blue-700">Automated Ranking</h3>
                    <p class="text-slate-500 text-sm leading-relaxed">See your best candidates at the top. The system generates a 0-100 score for every applicant based on your requirements.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="faq" class="py-20 bg-slate-50 px-6">
        <div class="max-w-3xl mx-auto">
            <h2 class="text-3xl font-bold text-center mb-12">Frequently Asked Questions</h2>
            <div class="space-y-6">
                <div class="bg-white p-6 rounded-2xl border border-slate-200">
                    <h4 class="font-bold text-slate-900 mb-2">Which file formats are supported?</h4>
                    <p class="text-slate-500 text-sm">Currently, we support PDF files for the most accurate AI analysis and data extraction.</p>
                </div>
                <div class="bg-white p-6 rounded-2xl border border-slate-200">
                    <h4 class="font-bold text-slate-900 mb-2">How accurate is the AI Ranking?</h4>
                    <p class="text-slate-500 text-sm">Our system uses the latest Gemini Pro models, achieving over 98% accuracy in professional skill identification.</p>
                </div>
            </div>
        </div>
    </section>

    <footer class="py-12 text-center border-t border-slate-200 bg-white">
        <div class="text-xl font-bold text-blue-700 mb-4">SmartHire AI</div>
        <p class="text-slate-400 text-sm">© 2026 SmartHire AI. All rights reserved.</p>
        <p class="text-slate-300 text-xs mt-2">Designed by Omar Abker Adam</p>
    </footer>

</body>
</html>