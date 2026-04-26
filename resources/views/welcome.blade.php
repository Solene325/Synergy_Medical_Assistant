<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SynergyAI · soins augmentés par l'intelligence artificielle</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    :root {
      --primary: #4f9da6;
      --secondary: #a7d0cd;
      --accent: #f9c7b5;
      --light: #f9f3e8;
      --soft-blue: #d4f1f9;
      --soft-white: #fff9f2;
      --glass-bg: rgba(255, 255, 255, 0.5);
      --glass-border: rgba(255, 255, 255, 0.6);
    }
    
    body {
      font-family: 'Quicksand', sans-serif;
      background-color: var(--soft-white);
      color: #3a4e5e;
      scroll-behavior: smooth;
      overflow-x: hidden;
    }
    
    h1, h2, h3, h4 {
      font-family: 'Inter', sans-serif;
      font-weight: 600;
      letter-spacing: -0.02em;
    }
    
    .header-glass {
      background: rgba(255, 255, 255, 0.6);
      backdrop-filter: blur(12px) saturate(180%);
      -webkit-backdrop-filter: blur(12px) saturate(180%);
      border-bottom: 1px solid rgba(255, 255, 255, 0.5);
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
      transition: transform 0.3s ease;
    }
    
    .header-hidden {
      transform: translateY(-100%);
    }
    
    .hero-soft {
      background: linear-gradient(145deg, #e1f3f0 0%, #f9eae1 100%);
      position: relative;
      overflow: hidden;
    }
    
    .hero-soft::before, .hero-soft::after {
      content: '';
      position: absolute;
      width: 100%;
      height: 100%;
      background-size: 70% 70%, 60% 60%;
      background-position: 10% 90%, 90% 20%;
      opacity: 0.3, 0.2;
      pointer-events: none;
    }
    
    .glass-card {
      background: var(--glass-bg);
      backdrop-filter: blur(8px);
      -webkit-backdrop-filter: blur(8px);
      border: 1px solid var(--glass-border);
      border-radius: 32px;
      box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.1);
      transition: all 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }
    
    .glass-card:hover {
      transform: translateY(-8px) scale(1.02);
      box-shadow: 0 30px 50px -20px rgba(79, 157, 166, 0.2);
      border-color: rgba(255, 255, 255, 0.9);
    }
    
    .stat-card-soft {
      background: rgba(255, 255, 255, 0.7);
      backdrop-filter: blur(4px);
      border: 1px solid rgba(255, 255, 255, 0.8);
      border-radius: 28px;
      padding: 1.8rem;
      transition: all 0.4s ease;
    }
    
    .stat-card-soft:hover {
      background: rgba(255, 255, 255, 0.9);
      box-shadow: 0 25px 40px -18px var(--primary);
    }
    
    .section-title-soft {
      position: relative;
      display: inline-block;
      padding-bottom: 12px;
    }
    
    .section-title-soft::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 80px;
      height: 4px;
      background: linear-gradient(90deg, var(--primary), var(--accent));
      border-radius: 4px;
      opacity: 0.7;
    }
    
    .btn-soft-primary {
      background: var(--primary);
      color: white;
      border: none;
      border-radius: 40px;
      padding: 14px 36px;
      font-weight: 600;
      box-shadow: 0 10px 20px -8px rgba(79, 157, 166, 0.3);
      transition: all 0.3s ease;
    }
    
    .btn-soft-primary:hover {
      background: #3c838c;
      transform: translateY(-3px);
      box-shadow: 0 18px 25px -10px var(--primary);
    }
    
    .btn-soft-secondary {
      background: transparent;
      border: 1.5px solid white;
      color: var(--primary);
      border-radius: 40px;
      padding: 14px 36px;
      font-weight: 600;
      backdrop-filter: blur(5px);
      transition: all 0.3s;
    }
    
    .btn-soft-secondary:hover {
      background: rgba(255, 255, 255, 0.25);
      border-color: white;
      color: #2b5f67;
    }
    
    .blob {
      position: absolute;
      width: 500px;
      height: 500px;
      background: linear-gradient(180deg, var(--secondary) 0%, var(--accent) 100%);
      border-radius: 50%;
      filter: blur(70px);
      opacity: 0.2;
      animation: floatBlob 20s infinite alternate ease-in-out;
      z-index: -1;
    }
    
    @keyframes floatBlob {
      0% { transform: translate(0, 0) scale(1); }
      100% { transform: translate(5%, 5%) scale(1.2); }
    }
    
    .blob2 {
      width: 400px;
      height: 400px;
      background: var(--soft-blue);
      filter: blur(90px);
      opacity: 0.25;
      animation: floatBlob2 18s infinite alternate;
    }
    
    @keyframes floatBlob2 {
      0% { transform: translate(0, 0) scale(1); }
      100% { transform: translate(-7%, 3%) scale(1.3); }
    }
    
    .soft-icon {
      background: rgba(255, 255, 255, 0.6);
      backdrop-filter: blur(4px);
      border-radius: 30px;
      width: 70px;
      height: 70px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 28px;
      color: var(--primary);
      box-shadow: 0 8px 20px rgba(79, 157, 166, 0.1);
      transition: 0.3s;
    }
    
    .soft-icon:hover {
      background: white;
      transform: scale(1.1) rotate(2deg);
    }
    
    .img-soft {
      border-radius: 28px;
      box-shadow: 0 20px 30px -10px rgba(0,0,0,0.05);
      transition: 0.5s;
    }
    
    .img-soft:hover {
      transform: scale(1.02);
      box-shadow: 0 30px 40px -12px rgba(79, 157, 166, 0.2);
    }
    
    .parallax-soft {
      background-attachment: fixed;
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
      position: relative;
    }
    
    .parallax-soft::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(255, 244, 235, 0.7);
      backdrop-filter: blur(2px);
    }
    
    .footer-soft {
      background: #dbe9e6;
      color: #3d5a5d;
    }
    
    /* Mobile menu */
    .mobile-menu {
      position: fixed;
      top: 0;
      right: -100%;
      width: 280px;
      height: 100vh;
      background: rgba(255, 255, 255, 0.8);
      backdrop-filter: blur(20px);
      -webkit-backdrop-filter: blur(20px);
      border-left: 1px solid rgba(255, 255, 255, 0.6);
      box-shadow: -10px 0 30px rgba(0, 0, 0, 0.05);
      transition: right 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      z-index: 60;
      padding: 2rem 1.5rem;
    }
    
    .mobile-menu.open {
      right: 0;
    }
    
    .menu-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.1);
      backdrop-filter: blur(3px);
      z-index: 55;
      opacity: 0;
      visibility: hidden;
      transition: 0.3s;
    }
    
    .menu-overlay.open {
      opacity: 1;
      visibility: visible;
    }
    
    /* Back to top button */
    .back-to-top {
      position: fixed;
      bottom: 30px;
      right: 30px;
      width: 50px;
      height: 50px;
      background: rgba(255, 255, 255, 0.8);
      backdrop-filter: blur(6px);
      border: 1px solid rgba(255, 255, 255, 0.9);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--primary);
      font-size: 20px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
      cursor: pointer;
      transition: all 0.3s;
      z-index: 50;
      opacity: 0;
      visibility: hidden;
    }
    
    .back-to-top.visible {
      opacity: 1;
      visibility: visible;
    }
    
    .back-to-top:hover {
      background: white;
      transform: scale(1.1) translateY(-5px);
    }
    
    /* Carousel témoignages */
    .testimonials-container {
      scroll-behavior: smooth;
      -webkit-overflow-scrolling: touch;
      scrollbar-width: none;
    }
    
    .testimonials-container::-webkit-scrollbar {
      display: none;
    }
    
    .testimonial-dot {
      width: 10px;
      height: 10px;
      border-radius: 50%;
      background: rgba(79, 157, 166, 0.3);
      transition: 0.3s;
      cursor: pointer;
    }
    
    .testimonial-dot.active {
      background: var(--primary);
      transform: scale(1.3);
    }
    
    /* Accordion FAQ */
    .faq-item summary {
      list-style: none;
      cursor: pointer;
      font-weight: 600;
      color: #2d4e57;
      padding: 1rem 0;
      border-bottom: 1px solid rgba(79, 157, 166, 0.2);
      transition: 0.3s;
    }
    
    .faq-item summary::-webkit-details-marker {
      display: none;
    }
    
    .faq-item summary::after {
      content: '\f067';
      font-family: 'Font Awesome 6 Free';
      font-weight: 900;
      float: right;
      transition: transform 0.3s;
      color: var(--primary);
    }
    
    .faq-item[open] summary::after {
      content: '\f068';
    }
    
    .faq-item p {
      padding: 1rem 0;
      color: #527a84;
    }
    
    /* Chat preview */
    .chat-preview {
      position: fixed;
      bottom: 100px;
      right: 30px;
      width: 350px;
      background: rgba(255, 255, 255, 0.85);
      backdrop-filter: blur(15px);
      border: 1px solid rgba(255, 255, 255, 0.7);
      border-radius: 24px;
      box-shadow: 0 20px 40px rgba(0,0,0,0.1);
      z-index: 100;
      transform: translateY(20px) scale(0.95);
      opacity: 0;
      visibility: hidden;
      transition: all 0.3s;
    }
    
    .chat-preview.open {
      transform: translateY(0) scale(1);
      opacity: 1;
      visibility: visible;
    }
    
    .chat-toggle {
      position: fixed;
      bottom: 30px;
      right: 100px;
      width: 60px;
      height: 60px;
      background: var(--primary);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 26px;
      box-shadow: 0 10px 25px rgba(79, 157, 166, 0.4);
      cursor: pointer;
      transition: 0.3s;
      z-index: 101;
    }
    
    .chat-toggle:hover {
      transform: scale(1.1) rotate(5deg);
      background: #3c838c;
    }
  </style>
</head>
<body>

<!-- Blobs flottants -->
<div class="blob fixed top-20 left-10"></div>
<div class="blob2 fixed bottom-20 right-10"></div>

<!-- Header -->
<header class="header-glass sticky top-0 z-50 py-3" id="mainHeader">
  <div class="container mx-auto px-6 flex items-center justify-between">
    <div class="flex items-center gap-3">
      <div class="w-14 h-14 bg-white/80 backdrop-blur rounded-2xl flex items-center justify-center shadow-sm border border-white/50">
        <i class="fas fa-heartbeat text-3xl text-[#4f9da6]"></i>
      </div>
      <div>
        <span class="text-2xl font-semibold text-[#3a4e5e]">SynergyAI</span>
        <span class="block text-xs text-gray-500 tracking-wide">intelligence médicale</span>
      </div>
    </div>
    
    <nav class="hidden md:flex items-center space-x-8">
      <a href="#mission" class="text-[#4f6b73] hover:text-[#4f9da6] font-medium transition-all duration-300">Mission</a>
      <a href="#stats" class="text-[#4f6b73] hover:text-[#4f9da6] font-medium transition-all duration-300">Chiffres</a>
      <a href="#comment" class="text-[#4f6b73] hover:text-[#4f9da6] font-medium transition-all duration-300">Comment ça marche</a>
      <a href="#temoignages" class="text-[#4f6b73] hover:text-[#4f9da6] font-medium transition-all duration-300">Témoignages</a>
      <a href="#faq" class="text-[#4f6b73] hover:text-[#4f9da6] font-medium transition-all duration-300">FAQ</a>
      <a href="{{'login'}}" class="btn-soft-primary text-sm">
        <i class="fas fa-user-md mr-2"></i> Espace
      </a>
    </nav>
    
    <button class="md:hidden text-2xl text-[#4f6b73]" id="menuToggle">
      <i class="fas fa-bars"></i>
    </button>
  </div>
</header>

<!-- Menu mobile -->
<div class="mobile-menu" id="mobileMenu">
  <div class="flex justify-end mb-8">
    <button id="closeMenu" class="text-2xl text-[#4f6b73]"><i class="fas fa-times"></i></button>
  </div>
  <nav class="flex flex-col space-y-6 text-lg">
    <a href="#mission" class="text-[#4f6b73] hover:text-[#4f9da6] font-medium">Mission</a>
    <a href="#stats" class="text-[#4f6b73] hover:text-[#4f9da6] font-medium">Chiffres</a>
    <a href="#comment" class="text-[#4f6b73] hover:text-[#4f9da6] font-medium">Comment ça marche</a>
    <a href="#temoignages" class="text-[#4f6b73] hover:text-[#4f9da6] font-medium">Témoignages</a>
    <a href="#faq" class="text-[#4f6b73] hover:text-[#4f9da6] font-medium">FAQ</a>
    <a href="#" class="btn-soft-primary text-center">Espace pro</a>
  </nav>
</div>
<div class="menu-overlay" id="menuOverlay"></div>

<!-- Hero -->
<section class="hero-soft pt-20 pb-28 md:pt-28 md:pb-36 relative">
  <div class="container mx-auto px-6 flex flex-col md:flex-row items-center gap-12 relative z-10">
    <div class="md:w-1/2 text-center md:text-left" data-aos="soft-fade" data-aos-duration="1000">
      <span class="inline-block px-5 py-2 bg-white/40 backdrop-blur-sm rounded-full text-sm font-medium text-[#3a4e5e] mb-6 border border-white/40">✨ soins augmentés par l'IA</span>
      <h1 class="text-5xl md:text-6xl font-bold leading-tight text-[#2d4e57]">
        Une médecine <span class="text-[#f9b8a0] typewriter" id="typewriter">plus humaine</span>
      </h1>
      <p class="text-xl text-[#527a84] mt-8 mb-10 max-w-xl mx-auto md:mx-0 leading-relaxed">Diagnostics précis, suivi personnalisé et tranquillité d'esprit pour les patients comme pour les soignants.</p>
      <div class="flex flex-wrap gap-4 justify-center md:justify-start">
        <a href="#" class="btn-soft-primary"><i class="fas fa-robot mr-3"></i>Découvrir l'assistant</a>
        <a href="#securite" class="btn-soft-secondary bg-white/30 text-[#3a4e5e] border-white/70">Confidentialité</a>
      </div>
    </div>
    
    <div class="md:w-1/2 flex justify-center" data-aos="soft-fade" data-aos-duration="1000" data-aos-delay="200">
      <div class="relative w-full max-w-md">
        <div class="absolute -top-10 -left-10 w-32 h-32 bg-[#f9c7b5] rounded-full mix-blend-multiply filter blur-xl opacity-60 animate-pulse"></div>
        <div class="absolute -bottom-8 -right-8 w-40 h-40 bg-[#a7d0cd] rounded-full mix-blend-multiply filter blur-xl opacity-60 animate-pulse" style="animation-delay: 2s;"></div>
        
        <div class="glass-card p-8 relative">
          <div class="flex items-center gap-2 mb-6">
            <div class="w-3 h-3 rounded-full bg-[#f9c7b5]"></div>
            <div class="w-3 h-3 rounded-full bg-[#a7d0cd]"></div>
            <div class="w-3 h-3 rounded-full bg-[#4f9da6]"></div>
            <span class="ml-2 text-sm text-gray-500">aperçu tableau de bord</span>
          </div>
          
          <div class="bg-white/30 backdrop-blur-sm rounded-2xl p-5 mb-6 border border-white/50">
            <div class="flex justify-between items-center text-sm text-[#3a4e5e] mb-2">
              <span>🫀 patients actifs</span>
              <span class="font-bold">+8%</span>
            </div>
            <p class="text-3xl font-light text-[#2d4e57]">3,842 <span class="text-base font-normal">aujourd'hui</span></p>
            <div class="mt-3 h-2 bg-white/40 rounded-full overflow-hidden">
              <div class="h-full w-3/4 bg-gradient-to-r from-[#4f9da6] to-[#f9c7b5] rounded-full"></div>
            </div>
          </div>
          
          <div class="grid grid-cols-2 gap-4">
            <div class="bg-white/30 backdrop-blur-sm rounded-xl p-4 flex items-center gap-3 border border-white/40">
              <i class="fas fa-stethoscope text-2xl text-[#4f9da6]"></i>
              <div>
                <span class="text-xs text-gray-500">diagnostics IA</span>
                <p class="text-xl font-medium">1.2k</p>
              </div>
            </div>
            <div class="bg-white/30 backdrop-blur-sm rounded-xl p-4 flex items-center gap-3 border border-white/40">
              <i class="fas fa-user-nurse text-2xl text-[#f9b8a0]"></i>
              <div>
                <span class="text-xs text-gray-500">médecins</span>
                <p class="text-xl font-medium">247</p>
              </div>
            </div>
          </div>
          
          <div class="mt-6 flex items-center justify-between text-sm text-[#4f6b73]">
            <span><i class="fas fa-shield-alt mr-2 text-[#a7d0cd]"></i>HDS certifié</span>
            <span><i class="fas fa-lock mr-2 text-[#a7d0cd]"></i>chiffrement AES-256</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Mission -->
<section id="mission" class="py-28 bg-[#f9f3e8]">
  <div class="container mx-auto px-6">
    <div class="text-center max-w-3xl mx-auto mb-16" data-aos="soft-fade">
      <h2 class="text-4xl md:text-5xl font-bold text-[#2d4e57] section-title-soft">Notre mission</h2>
      <p class="text-xl text-[#527a84] mt-6">Allier la puissance de l'IA à la bienveillance du soin pour un futur médical plus serein.</p>
    </div>
    
    <div class="grid md:grid-cols-3 gap-8">
      <div class="glass-card p-8 text-center" data-aos="soft-fade" data-aos-delay="100">
        <div class="soft-icon mx-auto mb-6">
          <i class="fas fa-brain"></i>
        </div>
        <h3 class="text-2xl font-semibold text-[#2d4e57] mb-4">Diagnostic assisté</h3>
        <p class="text-[#527a84]">Algorithmes entraînés sur des millions de cas pour épauler les praticiens.</p>
        <img src="https://images.unsplash.com/photo-1576091160550-2173dba999ef?q=80&w=1740&auto=format&fit=crop" class="img-soft mt-6 w-full h-44 object-cover" loading="lazy">
      </div>
      
      <div class="glass-card p-8 text-center" data-aos="soft-fade" data-aos-delay="200">
        <div class="soft-icon mx-auto mb-6">
          <i class="fas fa-heartbeat"></i>
        </div>
        <h3 class="text-2xl font-semibold text-[#2d4e57] mb-4">Suivi prédictif</h3>
        <p class="text-[#527a84]">Anticiper les complications grâce à l'analyse en continu des données.</p>
        <img src="https://media.istockphoto.com/id/2207690669/photo/friendly-female-doctor-smiling-during-a-consultation-in-a-bright-office-setting.jpg?s=1024x1024&w=is&k=20&c=whGN_SgNLGLgbjoGi5uXmSVZh1zfz3inpsSnAZvO4z0=" class="img-soft mt-6 w-full h-44 object-cover" loading="lazy">
      </div>
      
      <div class="glass-card p-8 text-center" data-aos="soft-fade" data-aos-delay="300">
        <div class="soft-icon mx-auto mb-6">
          <i class="fas fa-lock"></i>
        </div>
        <h3 class="text-2xl font-semibold text-[#2d4e57] mb-4">Confidentialité</h3>
        <p class="text-[#527a84]">Vos données médicales sont protégées par les plus hauts standards.</p>
        <img src="https://images.unsplash.com/photo-1623402410068-d17f868beba0?q=80&w=919&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="img-soft mt-6 w-full h-44 object-cover" loading="lazy">
      </div>
    </div>
  </div>
</section>

<!-- Stats -->
<section id="stats" class="py-28 bg-[#e6f3f0]">
  <div class="container mx-auto px-6">
    <div class="text-center max-w-3xl mx-auto mb-16" data-aos="soft-fade">
      <h2 class="text-4xl md:text-5xl font-bold text-[#2d4e57] section-title-soft">Notre impact en chiffres</h2>
      <p class="text-xl text-[#527a84] mt-6">Des résultats concrets, une confiance partagée.</p>
    </div>
    
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
      <div class="stat-card-soft text-center" data-aos="zoom-in" data-aos-duration="800">
        <i class="fas fa-user-injured text-4xl text-[#4f9da6] mb-4"></i>
        <span class="text-5xl font-light text-[#2d4e57] stat-number" data-target="12500">0</span>
        <p class="text-[#4f6b73] mt-2">patients suivis</p>
        <div class="w-16 h-1 bg-[#f9c7b5] mx-auto mt-4 rounded-full"></div>
      </div>
      
      <div class="stat-card-soft text-center" data-aos="zoom-in" data-aos-duration="800" data-aos-delay="100">
        <i class="fas fa-microscope text-4xl text-[#4f9da6] mb-4"></i>
        <span class="text-5xl font-light text-[#2d4e57] stat-number" data-target="2847">0</span>
        <p class="text-[#4f6b73] mt-2">diagnostics / mois</p>
        <div class="w-16 h-1 bg-[#f9c7b5] mx-auto mt-4 rounded-full"></div>
      </div>
      
      <div class="stat-card-soft text-center" data-aos="zoom-in" data-aos-duration="800" data-aos-delay="200">
        <i class="fas fa-hospital text-4xl text-[#4f9da6] mb-4"></i>
        <span class="text-5xl font-light text-[#2d4e57] stat-number" data-target="47">0</span>
        <p class="text-[#4f6b73] mt-2">établissements</p>
        <div class="w-16 h-1 bg-[#f9c7b5] mx-auto mt-4 rounded-full"></div>
      </div>
      
      <div class="stat-card-soft text-center" data-aos="zoom-in" data-aos-duration="800" data-aos-delay="300">
        <i class="fas fa-clock text-4xl text-[#4f9da6] mb-4"></i>
        <span class="text-5xl font-light text-[#2d4e57] stat-number" data-target="32">0</span>
        <p class="text-[#4f6b73] mt-2">temps d'attente -32%</p>
        <div class="w-16 h-1 bg-[#f9c7b5] mx-auto mt-4 rounded-full"></div>
      </div>
    </div>
  </div>
</section>

<!-- How it works -->
<section id="comment" class="py-28 bg-[#f9f3e8]">
  <div class="container mx-auto px-6">
    <div class="text-center max-w-3xl mx-auto mb-16" data-aos="soft-fade">
      <h2 class="text-4xl md:text-5xl font-bold text-[#2d4e57] section-title-soft">Comment ça marche ?</h2>
      <p class="text-xl text-[#527a84] mt-6">Une intégration simple et transparente dans votre quotidien.</p>
    </div>
    
    <div class="grid md:grid-cols-4 gap-6 relative">
      <div class="glass-card p-6 text-center relative" data-aos="soft-fade" data-aos-delay="0">
        <div class="w-16 h-16 rounded-full bg-[#4f9da6]/20 flex items-center justify-center text-3xl text-[#4f9da6] mx-auto mb-4">1</div>
        <h3 class="text-xl font-semibold text-[#2d4e57] mb-2">Connexion sécurisée</h3>
        <p class="text-[#527a84]">Accès via authentification forte.</p>
      </div>
      <div class="glass-card p-6 text-center relative" data-aos="soft-fade" data-aos-delay="100">
        <div class="w-16 h-16 rounded-full bg-[#4f9da6]/20 flex items-center justify-center text-3xl text-[#4f9da6] mx-auto mb-4">2</div>
        <h3 class="text-xl font-semibold text-[#2d4e57] mb-2">Importation données</h3>
        <p class="text-[#527a84]">Dossiers médicaux, examens, historique.</p>
      </div>
      <div class="glass-card p-6 text-center relative" data-aos="soft-fade" data-aos-delay="200">
        <div class="w-16 h-16 rounded-full bg-[#4f9da6]/20 flex items-center justify-center text-3xl text-[#4f9da6] mx-auto mb-4">3</div>
        <h3 class="text-xl font-semibold text-[#2d4e57] mb-2">Analyse IA</h3>
        <p class="text-[#527a84]">Notre modèle propose diagnostics et alertes.</p>
      </div>
      <div class="glass-card p-6 text-center relative" data-aos="soft-fade" data-aos-delay="300">
        <div class="w-16 h-16 rounded-full bg-[#4f9da6]/20 flex items-center justify-center text-3xl text-[#4f9da6] mx-auto mb-4">4</div>
        <h3 class="text-xl font-semibold text-[#2d4e57] mb-2">Suivi personnalisé</h3>
        <p class="text-[#527a84]">Recommandations et tableau de bord.</p>
      </div>
    </div>
  </div>
</section>

<!-- Témoignages -->
<section id="temoignages" class="py-28 bg-[#e6f3f0]">
  <div class="container mx-auto px-6">
    <div class="text-center max-w-3xl mx-auto mb-16" data-aos="soft-fade">
      <h2 class="text-4xl md:text-5xl font-bold text-[#2d4e57] section-title-soft">Ils nous font confiance</h2>
      <p class="text-xl text-[#527a84] mt-6">Des retours authentiques de soignants et patients.</p>
    </div>
    
    <div class="relative">
      <div class="testimonials-container flex overflow-x-auto gap-6 pb-8 px-2" id="testimonialContainer">
        <div class="glass-card p-8 min-w-[300px] md:min-w-[400px] flex-shrink-0">
          <i class="fas fa-quote-left text-3xl text-[#4f9da6] opacity-30 mb-4"></i>
          <p class="text-[#527a84] italic">"Depuis que nous utilisons SynergyAI, le temps de diagnostic a été réduit de 30% aux urgences."</p>
          <div class="flex items-center mt-6">
            <img src="https://randomuser.me/api/portraits/women/44.jpg" class="w-12 h-12 rounded-full object-cover mr-4">
            <div>
              <p class="font-semibold text-[#2d4e57]">Dr. Sophie Martin</p>
              <p class="text-sm text-[#527a84]">CHU de Casablanca</p>
            </div>
          </div>
        </div>
        <div class="glass-card p-8 min-w-[300px] md:min-w-[400px] flex-shrink-0">
          <i class="fas fa-quote-left text-3xl text-[#4f9da6] opacity-30 mb-4"></i>
          <p class="text-[#527a84] italic">"L'application m'a alerté sur un risque d'infection post-opératoire, nous avons pu agir à temps."</p>
          <div class="flex items-center mt-6">
            <img src="https://images.unsplash.com/photo-1522529599102-193c0d76b5b6?q=80&w=870&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="w-12 h-12 rounded-full object-cover mr-4">
            <div>
              <p class="font-semibold text-[#2d4e57]">Michel IDRISSOU</p>
              <p class="text-sm text-[#527a84]">Patient</p>
            </div>
          </div>
        </div>
        <div class="glass-card p-8 min-w-[300px] md:min-w-[400px] flex-shrink-0">
          <i class="fas fa-quote-left text-3xl text-[#4f9da6] opacity-30 mb-4"></i>
          <p class="text-[#527a84] italic">"Un outil intuitif qui nous fait gagner un temps précieux pour nous concentrer sur l'humain."</p>
          <div class="flex items-center mt-6">
            <img src="https://images.unsplash.com/photo-1637059824899-a441006a6875?q=80&w=452&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="w-12 h-12 rounded-full object-cover mr-4">
            <div>
              <p class="font-semibold text-[#2d4e57]">Dr. Ilyass LESSIQ</p>
              <p class="text-sm text-[#527a84]">Clinique Pasteur</p>
            </div>
          </div>
        </div>
      </div>
      <div class="flex justify-center gap-2 mt-4">
        <span class="testimonial-dot active" data-index="0"></span>
        <span class="testimonial-dot" data-index="1"></span>
        <span class="testimonial-dot" data-index="2"></span>
      </div>
    </div>
  </div>
</section>

<!-- Parallax -->
<div class="parallax-soft" style="background-image: url('https://images.unsplash.com/photo-1631815589968-fdb09a223b1e?q=80&w=1632&auto=format&fit=crop'); height: 450px;">
  <div class="relative z-10 h-full flex items-center justify-center text-center px-4">
    <div>
      <h2 class="text-4xl md:text-5xl font-bold text-[#2d4e57] mb-4" data-aos="soft-fade">247 médecins & 35 data scientists</h2>
      <p class="text-xl text-[#4f6b73] max-w-2xl" data-aos="soft-fade" data-aos-delay="150">Une collaboration unique pour affiner nos modèles chaque jour.</p>
    </div>
  </div>
</div>

<!-- Confidentialité -->
<section id="securite" class="py-28 bg-[#f9f3e8]">
  <div class="container mx-auto px-6">
    <div class="text-center max-w-3xl mx-auto mb-16" data-aos="soft-fade">
      <h2 class="text-4xl md:text-5xl font-bold text-[#2d4e57] section-title-soft">Vos données, notre priorité</h2>
      <p class="text-xl text-[#527a84] mt-6">Une sécurité sans faille, une transparence totale.</p>
    </div>
    
    <div class="grid md:grid-cols-2 gap-8">
      <div class="glass-card p-8 flex gap-6 items-start" data-aos="soft-fade">
        <div class="soft-icon shrink-0">
          <i class="fas fa-key"></i>
        </div>
        <div>
          <h3 class="text-2xl font-semibold text-[#2d4e57] mb-3">Authentification forte</h3>
          <p class="text-[#527a84]">Double facteur obligatoire pour accéder aux dossiers patients.</p>
        </div>
      </div>
      
      <div class="glass-card p-8 flex gap-6 items-start" data-aos="soft-fade" data-aos-delay="100">
        <div class="soft-icon shrink-0">
          <i class="fas fa-shield-virus"></i>
        </div>
        <div>
          <h3 class="text-2xl font-semibold text-[#2d4e57] mb-3">Chiffrement total</h3>
          <p class="text-[#527a84]">AES-256 et anonymisation avant tout entraînement.</p>
        </div>
      </div>
      
      <div class="glass-card p-8 flex gap-6 items-start" data-aos="soft-fade" data-aos-delay="200">
        <div class="soft-icon shrink-0">
          <i class="fas fa-notes-medical"></i>
        </div>
        <div>
          <h3 class="text-2xl font-semibold text-[#2d4e57] mb-3">Traçabilité</h3>
          <p class="text-[#527a84]">Chaque consultation est horodatée et accessible.</p>
        </div>
      </div>
      
      <div class="glass-card p-8 flex gap-6 items-start" data-aos="soft-fade" data-aos-delay="300">
        <div class="soft-icon shrink-0">
          <i class="fas fa-bell"></i>
        </div>
        <div>
          <h3 class="text-2xl font-semibold text-[#2d4e57] mb-3">Alerte incident</h3>
          <p class="text-[#527a84]">Signalement discret disponible 24h/24.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FAQ -->
<section id="faq" class="py-28 bg-[#e6f3f0]">
  <div class="container mx-auto px-6 max-w-4xl">
    <div class="text-center max-w-3xl mx-auto mb-16" data-aos="soft-fade">
      <h2 class="text-4xl md:text-5xl font-bold text-[#2d4e57] section-title-soft">Questions fréquentes</h2>
      <p class="text-xl text-[#527a84] mt-6">Tout ce que vous devez savoir sur SynergyAI.</p>
    </div>
    
    <div class="space-y-4">
      <details class="faq-item glass-card p-6" open>
        <summary class="font-semibold text-lg">Comment mes données sont-elles protégées ?</summary>
        <p class="text-[#527a84]">Toutes les données sont chiffrées de bout en bout avec AES-256. L'accès est protégé par authentification à deux facteurs et nous sommes certifiés HDS (Hébergeur de Données de Santé).</p>
      </details>
      <details class="faq-item glass-card p-6">
        <summary class="font-semibold text-lg">L'IA remplace-t-elle le médecin ?</summary>
        <p class="text-[#527a84]">Non, l'IA est un outil d'aide à la décision. Elle fournit des suggestions et alertes, mais le diagnostic final revient toujours au professionnel de santé.</p>
      </details>
      <details class="faq-item glass-card p-6">
        <summary class="font-semibold text-lg">Quels sont les coûts pour un établissement ?</summary>
        <p class="text-[#527a84]">Nous proposons une tarification adaptée à la taille de l'établissement. Contactez-nous pour un devis personnalisé.</p>
      </details>
      <details class="faq-item glass-card p-6">
        <summary class="font-semibold text-lg">Puis-je accéder à mon dossier patient depuis mon mobile ?</summary>
        <p class="text-[#527a84]">Oui, elle est disponible sur votre navigateur. Une version mobile est en cours de création.</p>
      </details>
    </div>
  </div>
</section>

<!-- Actualités -->
<section class="py-28 bg-[#f9f3e8]">
  <div class="container mx-auto px-6">
    <div class="text-center max-w-3xl mx-auto mb-16" data-aos="soft-fade">
      <h2 class="text-4xl md:text-5xl font-bold text-[#2d4e57] section-title-soft">Actualités & innovations</h2>
      <p class="text-xl text-[#527a84] mt-6">Les dernières avancées de SynergyAI.</p>
    </div>
    
    <div class="grid md:grid-cols-3 gap-8">
      <div class="glass-card p-6" data-aos="soft-fade" data-aos-delay="100">
        <img src="https://images.unsplash.com/photo-1581595219315-a187dd40c322?q=80&w=1740&auto=format&fit=crop" class="img-soft w-full h-48 object-cover mb-6" loading="lazy">
        <span class="text-sm bg-white/40 px-3 py-1 rounded-full text-[#4f9da6]">Recherche</span>
        <h3 class="text-xl font-semibold text-[#2d4e57] mt-4 mb-2">Détection précoce à 94%</h3>
        <p class="text-[#527a84]">Notre modèle de rétinopathie franchit un cap.</p>
      </div>
      
      <div class="glass-card p-6" data-aos="soft-fade" data-aos-delay="200">
        <img src="https://images.unsplash.com/photo-1638202993928-7267aad84c31?q=80&w=1740&auto=format&fit=crop" class="img-soft w-full h-48 object-cover mb-6" loading="lazy">
        <span class="text-sm bg-white/40 px-3 py-1 rounded-full text-[#4f9da6]">Partenariat</span>
        <h3 class="text-xl font-semibold text-[#2d4e57] mt-4 mb-2">CHU de Lyon nous rejoint</h3>
        <p class="text-[#527a84]">Déploiement dans les services d'urgence.</p>
      </div>
      
      <div class="glass-card p-6" data-aos="soft-fade" data-aos-delay="300">
        <img src="https://images.unsplash.com/photo-1579684385127-1ef15d508118?q=80&w=1780&auto=format&fit=crop" class="img-soft w-full h-48 object-cover mb-6" loading="lazy">
        <span class="text-sm bg-white/40 px-3 py-1 rounded-full text-[#4f9da6]">Fonctionnalité</span>
        <h3 class="text-xl font-semibold text-[#2d4e57] mt-4 mb-2">Assistant vocal pour médecins</h3>
        <p class="text-[#527a84]">Dictez, l'IA structure vos comptes rendus.</p>
      </div>
    </div>
  </div>
</section>

<!-- Newsletter & CTA combiné -->
<section class="py-24 bg-gradient-to-r from-[#a7d0cd] to-[#f9c7b5]">
  <div class="container mx-auto px-6 text-center">
    <div class="max-w-2xl mx-auto glass-card p-12 border-white/60" data-aos="soft-fade">
      <h2 class="text-4xl font-bold text-[#2d4e57] mb-4">Prêt à rejoindre l'aventure ?</h2>
      <p class="text-lg text-[#4f6b73] mb-8">Inscrivez-vous à notre newsletter pour suivre nos innovations.</p>
      <form class="flex flex-col sm:flex-row gap-3 mb-6" onsubmit="event.preventDefault(); alert('Merci de votre intérêt !');">
        <input type="email" placeholder="votre@email.com" class="flex-1 px-6 py-3 rounded-full border-0 bg-white/70 backdrop-blur-sm focus:ring-2 focus:ring-[#4f9da6] outline-none text-[#2d4e57]">
        <button type="submit" class="btn-soft-primary whitespace-nowrap">S'inscrire</button>
      </form>
      <a href="#" class="inline-flex items-center gap-3 text-lg text-[#2d4e57] underline-offset-4 hover:underline">
        <i class="fas fa-lock"></i> Espace sécurisé
      </a>
      <p class="text-sm text-[#527a84] mt-6"><i class="fas fa-shield-alt mr-2"></i>Certifié HDS · RGPD</p>
    </div>
  </div>
</section>

<!-- Footer -->
<footer class="footer-soft py-16">
  <div class="container mx-auto px-6">
    <div class="grid md:grid-cols-4 gap-10">
      <div>
        <div class="flex items-center gap-3 mb-6">
          <i class="fas fa-heartbeat text-3xl text-[#4f9da6]"></i>
          <span class="text-2xl font-semibold text-[#2d4e57]">SynergyAI</span>
        </div>
        <p class="text-[#4f6b73] text-sm">L'IA au service du soin, avec humanité.</p>
      </div>
      
      <div>
        <h4 class="font-semibold text-[#2d4e57] mb-4">Liens</h4>
        <ul class="space-y-2 text-[#527a84]">
          <li><a href="#" class="hover:text-[#4f9da6]">Mentions légales</a></li>
          <li><a href="#" class="hover:text-[#4f9da6]">Confidentialité</a></li>
          <li><a href="#" class="hover:text-[#4f9da6]">FAQ</a></li>
        </ul>
      </div>
      
      <div>
        <h4 class="font-semibold text-[#2d4e57] mb-4">Contact</h4>
        <ul class="space-y-2 text-[#527a84]">
          <li><i class="fas fa-map-marker-alt mr-2"></i> Bouskoura-Maroc</li>
          <li><i class="fas fa-phone mr-2"></i> +212 44 56 78 90</li>
          <li><i class="fas fa-envelope mr-2"></i> support@synergy.ma</li>
        </ul>
      </div>
      
      <div>
        <h4 class="font-semibold text-[#2d4e57] mb-4">Suivez-nous</h4>
        <div class="flex space-x-4 text-2xl text-[#4f9da6]">
          <a href="#" class="hover:text-[#2d4e57]"><i class="fab fa-twitter"></i></a>
          <a href="#" class="hover:text-[#2d4e57]"><i class="fab fa-linkedin"></i></a>
          <a href="#" class="hover:text-[#2d4e57]"><i class="fab fa-instagram"></i></a>
        </div>
      </div>
    </div>
    
    <div class="border-t border-white/40 mt-12 pt-8 text-center text-sm text-[#527a84]">
      © 2026 MediAI – Tous droits réservés – v2.0
    </div>
  </div>
</footer>

<!-- Back to top button -->
<div class="back-to-top" id="backToTop"><i class="fas fa-arrow-up"></i></div>

<!-- Chat preview toggle (optionnel) -->
<div class="chat-toggle" id="chatToggle"><i class="fas fa-comment-medical"></i></div>
<div class="chat-preview p-4" id="chatPreview">
  <div class="flex justify-between items-center mb-3">
    <span class="font-semibold text-[#2d4e57]">Assistant Synergy</span>
    <button id="closeChat"><i class="fas fa-times text-gray-500"></i></button>
  </div>
  <div class="h-40 overflow-y-auto mb-3 text-sm text-[#527a84] bg-white/40 rounded-xl p-3">
    <p class="mb-2"><span class="font-semibold">IA :</span> Bonjour ! Comment puis-je vous aider ?</p>
    <p class="text-right"><span class="bg-[#4f9da6] text-white rounded-xl px-3 py-1 inline-block">Quels sont vos services ?</span></p>
    <p><span class="font-semibold">IA :</span> Nous proposons des diagnostics assistés, du suivi prédictif et bien plus.</p>
  </div>
  <div class="flex gap-2">
    <input type="text" placeholder="Écrivez ici..." class="flex-1 px-4 py-2 rounded-full bg-white/70 border-0 text-sm">
    <button class="bg-[#4f9da6] text-white rounded-full px-4 py-2"><i class="fas fa-paper-plane"></i></button>
  </div>
</div>

<script>
  // Initialisation AOS
  AOS.init({ duration: 1000, easing: 'ease-out-cubic', once: true, offset: 50 });

  // Menu mobile
  const menuToggle = document.getElementById('menuToggle');
  const closeMenu = document.getElementById('closeMenu');
  const mobileMenu = document.getElementById('mobileMenu');
  const menuOverlay = document.getElementById('menuOverlay');

  function openMobileMenu() {
    mobileMenu.classList.add('open');
    menuOverlay.classList.add('open');
  }

  function closeMobileMenu() {
    mobileMenu.classList.remove('open');
    menuOverlay.classList.remove('open');
  }

  menuToggle.addEventListener('click', openMobileMenu);
  closeMenu.addEventListener('click', closeMobileMenu);
  menuOverlay.addEventListener('click', closeMobileMenu);

  // Back to top
  const backToTop = document.getElementById('backToTop');
  window.addEventListener('scroll', () => {
    if (window.scrollY > 300) {
      backToTop.classList.add('visible');
    } else {
      backToTop.classList.remove('visible');
    }
  });
  backToTop.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });

  // Chat preview
  const chatToggle = document.getElementById('chatToggle');
  const chatPreview = document.getElementById('chatPreview');
  const closeChat = document.getElementById('closeChat');

  chatToggle.addEventListener('click', () => {
    chatPreview.classList.toggle('open');
  });
  closeChat.addEventListener('click', () => {
    chatPreview.classList.remove('open');
  });

  // Smooth scroll pour les ancres
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute('href'));
      if (target) {
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        closeMobileMenu(); // ferme le menu mobile si ouvert
      }
    });
  });

  // Compteurs stats avec IntersectionObserver
  const statNumbers = document.querySelectorAll('.stat-number');
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const el = entry.target;
        const target = parseInt(el.getAttribute('data-target'));
        let current = 0;
        const step = Math.ceil(target / 60);
        const timer = setInterval(() => {
          current += step;
          if (current >= target) {
            current = target;
            clearInterval(timer);
          }
          el.innerText = current.toLocaleString('fr-FR');
        }, 25);
        observer.unobserve(el);
      }
    });
  }, { threshold: 0.5 });

  statNumbers.forEach(el => observer.observe(el));

  // Carousel témoignages
  const container = document.getElementById('testimonialContainer');
  const dots = document.querySelectorAll('.testimonial-dot');
  dots.forEach((dot, index) => {
    dot.addEventListener('click', () => {
      const scrollAmount = container.children[index].offsetLeft - container.offsetLeft;
      container.scrollTo({ left: scrollAmount, behavior: 'smooth' });
      dots.forEach(d => d.classList.remove('active'));
      dot.classList.add('active');
    });
  });

  container.addEventListener('scroll', () => {
    const scrollPos = container.scrollLeft;
    const children = Array.from(container.children);
    for (let i = 0; i < children.length; i++) {
      const child = children[i];
      if (child.offsetLeft - container.offsetLeft <= scrollPos + 10 && child.offsetLeft + child.offsetWidth > scrollPos + 10) {
        dots.forEach(d => d.classList.remove('active'));
        dots[i].classList.add('active');
        break;
      }
    }
  });

  // Typewriter simple pour le hero
  const phrases = ['plus humaine', 'prédictive', 'collaborative', 'sécurisée'];
  let i = 0;
  const typewriter = document.getElementById('typewriter');
  setInterval(() => {
    i = (i + 1) % phrases.length;
    typewriter.style.opacity = 0;
    setTimeout(() => {
      typewriter.textContent = phrases[i];
      typewriter.style.opacity = 1;
    }, 200);
  }, 3000);

  // Confetti sur les boutons CTA
  document.querySelectorAll('.btn-soft-primary').forEach(btn => {
    btn.addEventListener('click', function(e) {
      if (this.getAttribute('href') === '#') {
        e.preventDefault();
        confetti({ particleCount: 80, spread: 55, origin: { y: 0.5 }, colors: ['#a7d0cd', '#f9c7b5', '#ffffff'] });
        setTimeout(() => window.location.href = '#', 700);
      }
    });
  });
</script>

</body>
</html>