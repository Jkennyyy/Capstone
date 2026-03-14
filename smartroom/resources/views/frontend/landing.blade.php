<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>SmartRoom – PSU Asingan Campus</title>
<link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&family=Space+Grotesk:wght@500;600;700&display=swap" rel="stylesheet"/>
<style>
  :root {
    --navy: #0b1640;
    --navy-mid: #112060;
    --navy-light: #1a2f80;
    --gold: #f5c518;
    --gold-deep: #d4a10a;
    --gold-pale: #fde97a;
    --white: #ffffff;
    --off-white: #f0f4ff;
    --muted: rgba(255,255,255,0.55);
    --card-bg: rgba(255,255,255,0.04);
    --card-border: rgba(245,197,24,0.18);
  }

  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  html { scroll-behavior: smooth; }

  body {
    font-family: 'DM Sans', sans-serif;
    background: var(--navy);
    color: var(--white);
    overflow-x: hidden;
  }

  /* ── NOISE TEXTURE OVERLAY ── */
  body::before {
    content: '';
    position: fixed; inset: 0;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");
    pointer-events: none; z-index: 0; opacity: 0.35;
  }

  /* ── SCROLL ANIMATIONS ── */
  .reveal {
    opacity: 0;
    transform: translateY(40px);
    transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1), transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
  }
  .reveal.visible {
    opacity: 1;
    transform: translateY(0);
  }
  .reveal-delay-1 { transition-delay: 0.1s; }
  .reveal-delay-2 { transition-delay: 0.2s; }
  .reveal-delay-3 { transition-delay: 0.3s; }
  .reveal-delay-4 { transition-delay: 0.4s; }
  .reveal-delay-5 { transition-delay: 0.5s; }
  .reveal-delay-6 { transition-delay: 0.6s; }

  /* ── NAV ── */
  nav {
    position: fixed; top: 0; left: 0; right: 0; z-index: 100;
    display: flex; align-items: center; justify-content: space-between;
    padding: 0 5vw;
    height: 72px;
    background: rgba(11,22,64,0.82);
    backdrop-filter: blur(20px) saturate(1.4);
    border-bottom: 1px solid rgba(245,197,24,0.1);
    transition: background 0.3s, box-shadow 0.3s;
  }
  nav.scrolled {
    background: rgba(11,22,64,0.95);
    box-shadow: 0 4px 30px rgba(0,0,0,0.4);
  }
  .nav-logo {
    display: flex; align-items: center; gap: 12px;
    text-decoration: none;
  }
  .nav-logo-icon {
    width: 50px; height: 50px;
    background: linear-gradient(135deg, #0d1a4a 0%, #0b1640 100%);
    border-radius: 14px;
    display: flex; align-items: center; justify-content: center;
    position: relative;
    overflow: visible;
    box-shadow: 0 2px 12px rgba(0,0,0,0.3), 0 0 0 1px rgba(245,197,24,0.15);
    transition: transform 0.3s, box-shadow 0.3s;
  }
  .nav-logo:hover .nav-logo-icon {
    transform: scale(1.05);
    box-shadow: 0 4px 20px rgba(0,0,0,0.4), 0 0 0 1px rgba(245,197,24,0.3);
  }
  .nav-logo-text {
    font-family: 'Space Grotesk', 'Sora', sans-serif;
    font-weight: 700; font-size: 1.45rem;
    color: var(--white);
    letter-spacing: -0.03em;
    transition: color 0.2s;
  }
  .nav-logo-text span { color: var(--gold); }
  .nav-links {
    display: flex; gap: 36px; list-style: none;
    align-items: center;
  }
  .nav-links a {
    color: var(--muted); text-decoration: none;
    font-size: 0.9rem; font-weight: 500;
    transition: color 0.2s;
    letter-spacing: 0.02em;
    position: relative;
  }
  .nav-links a::after {
    content: '';
    position: absolute; bottom: -4px; left: 0;
    width: 0; height: 2px;
    background: var(--gold);
    border-radius: 2px;
    transition: width 0.3s ease;
  }
  .nav-links a:hover { color: var(--gold); }
  .nav-links a:hover::after { width: 100%; }
  .nav-cta {
    background: var(--gold);
    color: var(--navy) !important;
    font-weight: 700 !important;
    padding: 10px 24px;
    border-radius: 10px;
    font-size: 0.88rem !important;
    transition: all 0.25s !important;
    box-shadow: 0 4px 15px rgba(245,197,24,0.25);
  }
  .nav-cta::after { display: none !important; }
  .nav-cta:hover {
    background: var(--gold-pale) !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 8px 25px rgba(245,197,24,0.4) !important;
  }

  /* ── HERO ── */
  .hero {
    position: relative;
    min-height: 100vh;
    display: flex; align-items: center;
    padding: 120px 5vw 80px;
    overflow: hidden;
  }

  /* ── HERO BACKGROUND IMAGE ── */
  .hero-bg {
    position: absolute;
    inset: 0;
    z-index: 0;
  }

  .hero-bg img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center 30%;
    display: block;
    filter: brightness(0.4) contrast(1.1) saturate(0.5);
    animation: slowZoom 25s ease-in-out infinite alternate;
  }

  @keyframes slowZoom {
    0% { transform: scale(1); }
    100% { transform: scale(1.08); }
  }

  /* Multi-layer gradient overlays */
  .hero-bg::after {
    content: '';
    position: absolute;
    inset: 0;
    background:
      linear-gradient(
        to right,
        rgba(11, 22, 64, 0.96) 0%,
        rgba(11, 22, 64, 0.9) 18%,
        rgba(11, 22, 64, 0.65) 40%,
        rgba(17, 32, 96, 0.35) 62%,
        rgba(26, 48, 112, 0.35) 100%
      ),
      linear-gradient(
        to bottom,
        transparent 0%,
        transparent 45%,
        rgba(11, 22, 64, 0.4) 65%,
        rgba(11, 22, 64, 0.85) 85%,
        rgba(11, 22, 64, 1) 100%
      ),
      linear-gradient(
        to bottom,
        rgba(11, 22, 64, 0.8) 0%,
        rgba(11, 22, 64, 0.2) 12%,
        transparent 25%
      ),
      radial-gradient(
        ellipse 50% 50% at 68% 42%,
        rgba(245, 197, 24, 0.07) 0%,
        transparent 70%
      );
    pointer-events: none;
    z-index: 1;
  }

  /* Vignette */
  .hero-bg::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(
      ellipse 85% 75% at 55% 50%,
      transparent 20%,
      rgba(22, 48, 151, 0.65) 100%
    );
    pointer-events: none;
    z-index: 2;
  }

  /* Background grid */
  .hero::after {
    content: '';
    position: absolute; inset: 0;
    background-image:
      linear-gradient(rgba(245,197,24,0.03) 1px, transparent 1px),
      linear-gradient(90deg, rgba(245,197,24,0.03) 1px, transparent 1px);
    background-size: 60px 60px;
    mask-image: radial-gradient(ellipse 80% 80% at 50% 50%, black 0%, transparent 75%);
    pointer-events: none;
    z-index: 1;
  }

  /* Glow orbs */
  .orb {
    position: absolute; border-radius: 50%;
    filter: blur(90px); pointer-events: none;
    z-index: 1;
  }
  .orb-1 {
    width: 550px; height: 550px;
    background: radial-gradient(circle, rgba(245,197,24,0.1) 0%, transparent 70%);
    top: -120px; right: 8%;
    animation: float 10s ease-in-out infinite;
  }
  .orb-2 {
    width: 400px; height: 400px;
    background: radial-gradient(circle, rgba(26,47,128,0.4) 0%, transparent 70%);
    bottom: 8%; left: -60px;
    animation: float 12s ease-in-out infinite reverse;
  }
  .orb-3 {
    width: 250px; height: 250px;
    background: radial-gradient(circle, rgba(245,197,24,0.06) 0%, transparent 70%);
    top: 40%; left: 30%;
    animation: float 14s ease-in-out infinite 2s;
  }
  @keyframes float {
    0%,100% { transform: translateY(0px) translateX(0px); }
    33% { transform: translateY(-20px) translateX(10px); }
    66% { transform: translateY(-10px) translateX(-10px); }
  }

  .hero-content {
    position: relative; z-index: 3;
    max-width: 680px;
  }

  .hero-badge {
    display: inline-flex; align-items: center; gap: 8px;
    background: rgba(245,197,24,0.1);
    border: 1px solid rgba(245,197,24,0.3);
    border-radius: 100px;
    padding: 7px 18px;
    font-size: 0.78rem; font-weight: 600;
    color: var(--gold);
    letter-spacing: 0.06em;
    text-transform: uppercase;
    margin-bottom: 28px;
    animation: fadeUp 0.6s ease both;
    backdrop-filter: blur(10px);
  }
  .hero-badge::before {
    content: '';
    width: 7px; height: 7px;
    background: var(--gold);
    border-radius: 50%;
    box-shadow: 0 0 8px var(--gold);
    animation: pulse 2s infinite;
  }
  @keyframes pulse {
    0%,100% { opacity: 1; } 50% { opacity: 0.3; }
  }

  .hero-title {
    font-family: 'Sora', sans-serif;
    font-size: clamp(2.8rem, 6vw, 4.5rem);
    font-weight: 800;
    line-height: 1.08;
    letter-spacing: -0.03em;
    margin-bottom: 24px;
    animation: fadeUp 0.6s 0.1s ease both;
    text-shadow: 0 4px 30px rgba(0,0,0,0.5);
  }
  .hero-title .accent {
    color: var(--white);
    text-shadow: 0 0 40px rgba(245,197,24,0.2), 0 4px 30px rgba(0,0,0,0.5);
  }
  .hero-title .line-2 {
    display: block;
    -webkit-text-stroke: 2px rgba(245, 197, 24, 0.55);
    color: rgba(245,197,24,0.06);
    text-shadow:
      0 0 50px rgba(245,197,24,0.15),
      0 0 100px rgba(245,197,24,0.05);
    transition: all 0.4s ease;
  }
  .hero-title:hover .line-2 {
    -webkit-text-stroke: 2px rgba(245, 197, 24, 0.75);
    color: rgba(245,197,24,0.1);
    text-shadow:
      0 0 50px rgba(245,197,24,0.25),
      0 0 100px rgba(245,197,24,0.1);
  }

  .hero-desc {
    font-size: 1.1rem; font-weight: 300;
    color: rgba(255,255,255,0.75);
    line-height: 1.75;
    max-width: 540px;
    margin-bottom: 40px;
    animation: fadeUp 0.6s 0.2s ease both;
    text-shadow: 0 2px 12px rgba(0,0,0,0.4);
  }

  .hero-actions {
    display: flex; gap: 14px; flex-wrap: wrap;
    animation: fadeUp 0.6s 0.3s ease both;
  }
  .btn-primary {
    display: inline-flex; align-items: center; gap: 9px;
    background: var(--gold);
    color: var(--navy);
    font-family: 'Sora', sans-serif;
    font-weight: 700; font-size: 0.95rem;
    padding: 15px 30px;
    border-radius: 12px;
    text-decoration: none;
    transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    box-shadow: 0 8px 30px rgba(245,197,24,0.3), inset 0 1px 0 rgba(255,255,255,0.2);
    position: relative;
    overflow: hidden;
  }
  .btn-primary::before {
    content: '';
    position: absolute; inset: 0;
    background: linear-gradient(135deg, rgba(255,255,255,0.2) 0%, transparent 50%);
    opacity: 0;
    transition: opacity 0.3s;
  }
  .btn-primary:hover {
    background: var(--gold-pale);
    transform: translateY(-3px);
    box-shadow: 0 16px 40px rgba(245,197,24,0.4), inset 0 1px 0 rgba(255,255,255,0.3);
  }
  .btn-primary:hover::before { opacity: 1; }

  .btn-secondary {
    display: inline-flex; align-items: center; gap: 9px;
    background: rgba(255,255,255,0.06);
    color: var(--white);
    font-family: 'Sora', sans-serif;
    font-weight: 600; font-size: 0.95rem;
    padding: 15px 30px;
    border-radius: 12px;
    border: 1.5px solid rgba(255,255,255,0.15);
    text-decoration: none;
    transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    backdrop-filter: blur(8px);
  }
  .btn-secondary:hover {
    border-color: var(--gold);
    color: var(--gold);
    background: rgba(245,197,24,0.06);
    transform: translateY(-3px);
    box-shadow: 0 8px 30px rgba(245,197,24,0.15);
  }

  @keyframes fadeUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
  }

  /* ── STATS STRIP ── */
  .stats-strip {
    position: relative; z-index: 2;
    border-top: 1px solid rgba(245,197,24,0.08);
    border-bottom: 1px solid rgba(245,197,24,0.08);
    background: linear-gradient(135deg, rgba(17,32,96,0.5) 0%, rgba(11,22,64,0.6) 100%);
    backdrop-filter: blur(12px);
    padding: 40px 5vw;
    display: flex; justify-content: center; gap: 4vw; flex-wrap: wrap;
  }
  .stat-item {
    text-align: center;
    padding: 8px 16px;
    transition: transform 0.3s;
  }
  .stat-item:hover { transform: translateY(-4px); }
  .stat-num {
    font-family: 'Sora', sans-serif;
    font-size: 2.4rem; font-weight: 800;
    background: linear-gradient(135deg, var(--gold) 0%, var(--gold-pale) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    line-height: 1;
    display: block; margin-bottom: 8px;
  }
  .stat-label {
    font-size: 0.8rem; color: rgba(255,255,255,0.5); font-weight: 400;
    text-transform: uppercase; letter-spacing: 0.08em;
  }
  .stat-divider {
    width: 1px;
    background: linear-gradient(to bottom, transparent, rgba(245,197,24,0.2), transparent);
    align-self: stretch;
  }

  /* ── SECTION BASE ── */
  section { position: relative; z-index: 2; }
  .section-label {
    display: inline-flex; align-items: center; gap: 10px;
    color: var(--gold); font-size: 0.76rem; font-weight: 700;
    letter-spacing: 0.14em; text-transform: uppercase;
    margin-bottom: 16px;
  }
  .section-label::before {
    content: '';
    width: 28px; height: 2px;
    background: linear-gradient(90deg, var(--gold), rgba(245,197,24,0.3));
    border-radius: 2px;
  }
  .section-title {
    font-family: 'Sora', sans-serif;
    font-size: clamp(1.8rem, 3.5vw, 2.8rem);
    font-weight: 800; line-height: 1.1;
    letter-spacing: -0.025em;
    margin-bottom: 16px;
  }
  .section-desc {
    font-size: 1rem; color: rgba(255,255,255,0.55);
    line-height: 1.75; max-width: 500px;
  }

  /* ── PROBLEM SECTION ── */
  .problem-section {
    padding: 120px 5vw;
    background: linear-gradient(180deg, var(--navy) 0%, var(--navy-mid) 100%);
    position: relative;
  }
  .problem-section::before {
    content: '';
    position: absolute;
    top: -1px; left: 0; right: 0; height: 200px;
    background: linear-gradient(to bottom, var(--navy) 0%, transparent 100%);
    pointer-events: none;
    z-index: 1;
  }
  .problem-grid {
    display: grid; grid-template-columns: 1fr 1fr;
    gap: 20px; margin-top: 56px;
    max-width: 1100px; margin-left: auto; margin-right: auto;
    position: relative; z-index: 2;
  }
  .problem-card {
    background: linear-gradient(135deg, rgba(17,32,96,0.5) 0%, rgba(11,22,64,0.6) 100%);
    border: 1px solid rgba(245,197,24,0.12);
    border-radius: 18px;
    padding: 34px;
    transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    position: relative;
    overflow: hidden;
  }
  .problem-card::before {
    content: '';
    position: absolute; top: 0; left: 0; right: 0;
    height: 2px;
    background: linear-gradient(90deg, transparent, var(--gold), transparent);
    opacity: 0;
    transition: opacity 0.4s;
  }
  .problem-card::after {
    content: '';
    position: absolute; top: 0; right: 0;
    width: 120px; height: 120px;
    background: radial-gradient(circle, rgba(245,197,24,0.04) 0%, transparent 70%);
    pointer-events: none;
    opacity: 0;
    transition: opacity 0.4s;
  }
  .problem-card:hover {
    transform: translateY(-6px);
    border-color: rgba(245,197,24,0.35);
    box-shadow: 0 24px 60px rgba(0,0,0,0.4), 0 0 0 1px rgba(245,197,24,0.1);
  }
  .problem-card:hover::before { opacity: 1; }
  .problem-card:hover::after { opacity: 1; }
  .problem-card .icon {
    width: 52px; height: 52px; border-radius: 14px;
    display: flex; align-items: center; justify-content: center;
    font-size: 24px; margin-bottom: 20px;
    background: rgba(245,197,24,0.1);
    border: 1px solid rgba(245,197,24,0.18);
    transition: all 0.3s;
  }
  .problem-card:hover .icon {
    background: rgba(245,197,24,0.15);
    border-color: rgba(245,197,24,0.35);
    transform: scale(1.05);
  }
  .problem-card h3 {
    font-family: 'Sora', sans-serif;
    font-weight: 700; font-size: 1.08rem; margin-bottom: 10px;
  }
  .problem-card p {
    font-size: 0.88rem; color: rgba(255,255,255,0.55); line-height: 1.7;
  }

  /* ── FEATURES ── */
  .features-section {
    padding: 120px 5vw;
    background: var(--navy);
    position: relative;
  }
  .features-section::before {
    content: '';
    position: absolute;
    top: 50%; left: 50%;
    transform: translate(-50%, -50%);
    width: 800px; height: 800px;
    background: radial-gradient(circle, rgba(245,197,24,0.03) 0%, transparent 60%);
    pointer-events: none;
  }
  .features-header {
    text-align: center; max-width: 600px;
    margin: 0 auto 72px;
    display: flex; flex-direction: column; align-items: center;
  }
  .features-grid {
    display: grid; grid-template-columns: repeat(3, 1fr);
    gap: 24px; max-width: 1100px; margin: 0 auto;
    position: relative; z-index: 1;
  }
  .feature-card {
    background: linear-gradient(145deg, rgba(17,32,96,0.7) 0%, rgba(11,22,64,0.85) 100%);
    border: 1px solid rgba(245,197,24,0.1);
    border-radius: 20px; padding: 36px 28px;
    position: relative; overflow: hidden;
    transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
  }
  .feature-card::before {
    content: '';
    position: absolute; top: 0; left: 0; right: 0;
    height: 2px;
    background: linear-gradient(90deg, transparent, var(--gold), transparent);
    opacity: 0; transition: opacity 0.4s;
  }
  .feature-card::after {
    content: '';
    position: absolute; bottom: -50px; right: -50px;
    width: 150px; height: 150px;
    background: radial-gradient(circle, rgba(245,197,24,0.05) 0%, transparent 70%);
    opacity: 0;
    transition: opacity 0.4s;
  }
  .feature-card:hover {
    transform: translateY(-8px);
    border-color: rgba(245,197,24,0.3);
    box-shadow: 0 30px 60px rgba(0,0,0,0.35);
  }
  .feature-card:hover::before { opacity: 1; }
  .feature-card:hover::after { opacity: 1; }
  .feature-num {
    font-family: 'Sora', sans-serif;
    font-size: 3.5rem; font-weight: 800;
    color: rgba(245,197,24,0.06);
    line-height: 1; margin-bottom: -8px;
    display: block;
    transition: color 0.3s;
  }
  .feature-card:hover .feature-num { color: rgba(245,197,24,0.1); }
  .feature-icon {
    font-size: 32px; margin-bottom: 16px; display: block;
    transition: transform 0.3s;
  }
  .feature-card:hover .feature-icon { transform: scale(1.1); }
  .feature-card h3 {
    font-family: 'Sora', sans-serif;
    font-size: 1.1rem; font-weight: 700;
    margin-bottom: 10px; color: var(--white);
  }
  .feature-card p {
    font-size: 0.87rem; color: rgba(255,255,255,0.55); line-height: 1.7;
  }
  .feature-tag {
    display: inline-block; margin-top: 20px;
    padding: 5px 14px; border-radius: 100px;
    background: rgba(245,197,24,0.08); border: 1px solid rgba(245,197,24,0.18);
    font-size: 0.68rem; font-weight: 600; color: var(--gold);
    text-transform: uppercase; letter-spacing: 0.08em;
    transition: all 0.3s;
  }
  .feature-card:hover .feature-tag {
    background: rgba(245,197,24,0.15);
    border-color: rgba(245,197,24,0.35);
  }

  /* ── HOW IT WORKS ── */
  .how-section {
    padding: 120px 5vw;
    background: linear-gradient(180deg, var(--navy-mid) 0%, var(--navy) 100%);
  }
  .how-header {
    text-align: center; max-width: 600px;
    margin: 0 auto 80px;
    display: flex; flex-direction: column; align-items: center;
  }
  .steps {
    display: grid; grid-template-columns: repeat(4, 1fr);
    gap: 0; max-width: 1100px; margin: 0 auto;
    position: relative;
  }
  .steps::before {
    content: '';
    position: absolute; top: 42px; left: 12.5%; right: 12.5%;
    height: 2px;
    background: linear-gradient(90deg, var(--gold), rgba(245,197,24,0.3), rgba(245,197,24,0.1));
    z-index: 0;
  }
  .step {
    text-align: center; padding: 0 16px;
    position: relative; z-index: 1;
  }
  .step-num {
    width: 84px; height: 84px; border-radius: 50%;
    background: linear-gradient(135deg, var(--navy-mid) 0%, var(--navy) 100%);
    border: 2px solid rgba(245,197,24,0.5);
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 24px;
    font-family: 'Sora', sans-serif;
    font-size: 1.5rem; font-weight: 800; color: var(--gold);
    transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    box-shadow: 0 4px 20px rgba(0,0,0,0.3);
  }
  .step:hover .step-num {
    background: var(--gold); color: var(--navy);
    border-color: var(--gold);
    box-shadow: 0 0 40px rgba(245,197,24,0.4), 0 8px 30px rgba(0,0,0,0.3);
    transform: scale(1.08);
  }
  .step h3 {
    font-family: 'Sora', sans-serif;
    font-size: 1rem; font-weight: 700; margin-bottom: 10px;
  }
  .step p { font-size: 0.82rem; color: rgba(255,255,255,0.5); line-height: 1.65; }

  /* ── OBJECTIVES ── */
  .objectives-section {
    padding: 100px 5vw;
    background: var(--navy);
    display: grid; grid-template-columns: 1fr 1fr;
    gap: 60px; align-items: center;
    max-width: 1200px; margin: 0 auto;
  }
  .obj-list { margin-top: 32px; display: flex; flex-direction: column; gap: 18px; }
  .obj-item {
    display: flex; gap: 16px; align-items: flex-start;
    padding: 22px;
    background: linear-gradient(135deg, rgba(17,32,96,0.4) 0%, rgba(11,22,64,0.5) 100%);
    border: 1px solid rgba(245,197,24,0.08);
    border-radius: 16px;
    transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
  }
  .obj-item:hover {
    border-color: rgba(245,197,24,0.3);
    background: linear-gradient(135deg, rgba(245,197,24,0.06) 0%, rgba(17,32,96,0.5) 100%);
    transform: translateX(6px);
    box-shadow: -4px 0 0 var(--gold), 0 10px 30px rgba(0,0,0,0.2);
  }
  .obj-check {
    width: 34px; height: 34px; border-radius: 10px;
    background: linear-gradient(135deg, var(--gold) 0%, var(--gold-deep) 100%);
    color: var(--navy);
    display: flex; align-items: center; justify-content: center;
    font-size: 16px; flex-shrink: 0; font-weight: 900;
    box-shadow: 0 4px 12px rgba(245,197,24,0.25);
  }
  .obj-item p { font-size: 0.9rem; color: rgba(255,255,255,0.7); line-height: 1.65; }

  .obj-visual {
    position: relative;
  }
  .access-card {
    background: linear-gradient(145deg, rgba(17,32,96,0.85), rgba(11,22,64,0.95));
    border: 1px solid rgba(245,197,24,0.2);
    border-radius: 22px; padding: 34px;
    box-shadow: 0 40px 80px rgba(0,0,0,0.5), 0 0 0 1px rgba(245,197,24,0.08);
    position: relative;
    overflow: hidden;
  }
  .access-card::before {
    content: '';
    position: absolute; top: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, transparent, var(--gold), transparent);
  }
  .access-title {
    font-family: 'Sora', sans-serif;
    font-size: 1.1rem; font-weight: 700; margin-bottom: 24px;
    display: flex; align-items: center; gap: 10px;
  }
  .access-title span { color: var(--gold); }
  .access-rooms { display: flex; flex-direction: column; gap: 10px; }
  .access-room {
    display: flex; align-items: center; gap: 14px;
    padding: 14px 16px;
    background: rgba(255,255,255,0.03);
    border-radius: 14px;
    border: 1px solid rgba(255,255,255,0.06);
    transition: all 0.3s;
  }
  .access-room:hover {
    background: rgba(255,255,255,0.06);
    border-color: rgba(245,197,24,0.15);
    transform: translateX(4px);
  }
  .room-light {
    width: 14px; height: 14px; border-radius: 50%; flex-shrink: 0;
  }
  .light-on { background: var(--gold); box-shadow: 0 0 12px var(--gold), 0 0 24px rgba(245,197,24,0.4); animation: blink-on 2s infinite; }
  .light-off { background: rgba(255,255,255,0.15); }
  @keyframes blink-on { 0%,100% { opacity: 1; } 50% { opacity: 0.6; } }
  .access-room-info { flex: 1; }
  .access-room-name { font-family: 'Sora', sans-serif; font-size: 0.85rem; font-weight: 600; }
  .access-room-sub { font-size: 0.72rem; color: rgba(255,255,255,0.4); margin-top: 2px; }
  .access-room-status {
    font-size: 0.68rem; font-weight: 700;
    padding: 4px 12px; border-radius: 100px;
    letter-spacing: 0.03em;
  }
  .status-live { background: rgba(245,197,24,0.12); color: var(--gold); }
  .status-free { background: rgba(39,201,63,0.12); color: #27c93f; }
  .status-lock { background: rgba(255,80,80,0.1); color: #ff7878; }

  /* ── CTA ── */
  .cta-section {
    padding: 120px 5vw;
    text-align: center;
    position: relative; overflow: hidden;
    background: linear-gradient(180deg, var(--navy) 0%, var(--navy-mid) 50%, var(--navy) 100%);
  }
  .cta-section::before {
    content: '';
    position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);
    width: 700px; height: 700px;
    background: radial-gradient(circle, rgba(245,197,24,0.1) 0%, transparent 60%);
    pointer-events: none;
    animation: float 15s ease-in-out infinite;
  }
  .cta-section::after {
    content: '';
    position: absolute; inset: 0;
    background-image:
      linear-gradient(rgba(245,197,24,0.02) 1px, transparent 1px),
      linear-gradient(90deg, rgba(245,197,24,0.02) 1px, transparent 1px);
    background-size: 60px 60px;
    mask-image: radial-gradient(ellipse 60% 60% at 50% 50%, black 0%, transparent 100%);
    pointer-events: none;
  }
  .cta-section .section-title {
    font-size: clamp(2rem, 4vw, 3.2rem);
    position: relative; z-index: 1;
  }
  .cta-section .section-desc {
    max-width: 520px; margin: 0 auto 44px; position: relative; z-index: 1;
  }
  .cta-actions { display: flex; justify-content: center; gap: 16px; flex-wrap: wrap; position: relative; z-index: 1; }

  /* ── FOOTER ── */
  footer {
    background: rgba(6,12,36,0.98);
    border-top: 1px solid rgba(245,197,24,0.08);
    padding: 48px 5vw 32px;
    display: flex; justify-content: space-between; align-items: center;
    flex-wrap: wrap; gap: 20px;
  }
  .footer-brand {
    font-family: 'Space Grotesk', 'Sora', sans-serif;
    font-size: 1.25rem; font-weight: 700; color: var(--white);
    letter-spacing: -0.03em;
  }
  .footer-brand span { color: var(--gold); }
  .footer-sub {
    font-size: 0.78rem; color: rgba(255,255,255,0.4); margin-top: 4px;
  }
  .footer-copy { font-size: 0.78rem; color: rgba(255,255,255,0.35); }

  /* ── RESPONSIVE ── */
  @media (max-width: 1100px) {
    .features-grid { grid-template-columns: 1fr 1fr; }
    .steps { grid-template-columns: 1fr 1fr; gap: 40px; }
    .steps::before { display: none; }
    .objectives-section { grid-template-columns: 1fr; }
  }
  @media (max-width: 700px) {
    nav { padding: 0 20px; }
    .nav-links { display: none; }
    .problem-grid { grid-template-columns: 1fr; }
    .features-grid { grid-template-columns: 1fr; }
    .steps { grid-template-columns: 1fr 1fr; }
    .stats-strip { gap: 32px; }
    .stat-divider { display: none; }
  }
</style>
</head>
<body>

<!-- NAV -->
<nav>
  <a href="#" class="nav-logo">
    <div class="nav-logo-icon">
      <svg width="30" height="30" viewBox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
        <rect x="6" y="6" width="3.5" height="16" rx="1" fill="#f5c518"/>
        <rect x="16.5" y="6" width="3.5" height="16" rx="1" fill="#f5c518"/>
        <rect x="10.5" y="9" width="2" height="13" rx="0.5" fill="#f5c518"/>
        <rect x="13.5" y="9" width="2" height="13" rx="0.5" fill="#f5c518"/>
        <path d="M6 8 C6 4, 20 4, 20 8" stroke="#f5c518" stroke-width="2.2" stroke-linecap="round" fill="none"/>
        <line x1="5" y1="22" x2="21" y2="22" stroke="#f5c518" stroke-width="1.8" stroke-linecap="round"/>
      </svg>
    </div>
    <span class="nav-logo-text"><span>Smart</span>Room</span>
  </a>
  <ul class="nav-links">
    <li><a href="#">Home</a></li>
    <li><a href="#features">Features</a></li>
    <li><a href="#" class="nav-cta">Sign In</a></li>
  </ul>
</nav>

<!-- HERO -->
<section class="hero">
  <div class="hero-bg">
    <img src="{{ asset('images/psu.png') }}" alt="PSU Asingan Campus" />
  </div>

  <div class="orb orb-1"></div>
  <div class="orb orb-2"></div>
  <div class="orb orb-3"></div>

  <div class="hero-content">
    <div class="hero-badge">Pangasinan State University – Asingan Campus</div>
    <h1 class="hero-title">
      Intelligent Rooms,<br>
      <span class="accent">Zero Conflicts.</span>
      <span class="line-2">Seamless Access.</span>
    </h1>
    <p class="hero-desc">
      SmartRoom is a web-based classroom scheduling system with RFID-controlled smart door access — eliminating double bookings, unauthorized entry, and classroom confusion at Pangasinan State University.
    </p>
    <div class="hero-actions">
      <a href="#features" class="btn-primary">
        <span>Explore Features</span>
        <span>→</span>
      </a>
      <a href="#how" class="btn-secondary">
        <span>▶ See How It Works</span>
      </a>
    </div>
  </div>
</section>

<!-- STATS -->
<div class="stats-strip">
  <div class="stat-item reveal">
    <span class="stat-num">0</span>
    <span class="stat-label">Scheduling Conflicts</span>
  </div>
  <div class="stat-divider"></div>
  <div class="stat-item reveal reveal-delay-1">
    <span class="stat-num">100%</span>
    <span class="stat-label">Real-time Visibility</span>
  </div>
  <div class="stat-divider"></div>
  <div class="stat-item reveal reveal-delay-2">
    <span class="stat-num">RFID</span>
    <span class="stat-label">Smart Door Access</span>
  </div>
  <div class="stat-divider"></div>
  <div class="stat-item reveal reveal-delay-3">
    <span class="stat-num">24/7</span>
    <span class="stat-label">Access Logs</span>
  </div>
</div>

<!-- PROBLEM SECTION -->
<section class="problem-section" id="problems">
  <div style="max-width:1100px;margin:0 auto;position:relative;z-index:2;">
    <div class="section-label reveal">The Problem</div>
    <h2 class="section-title reveal">Why PSU Asingan Needs SmartRoom</h2>
    <p class="section-desc reveal">Traditional classroom management creates recurring problems that disrupt learning and administrative efficiency.</p>
    <div class="problem-grid">
      <div class="problem-card reveal reveal-delay-1">
        <div class="icon">⚠️</div>
        <h3>Scheduling Conflicts & Double Booking</h3>
        <p>Classroom schedules prepared in advance still result in conflicts due to human error, no real-time tracking, and lack of a centralized conflict-prevention system.</p>
      </div>
      <div class="problem-card reveal reveal-delay-2">
        <div class="icon">🚪</div>
        <h3>Unauthorized Room Use</h3>
        <p>Without automated access control, classrooms can be entered by unauthorized individuals during or outside scheduled hours, compromising security and proper room utilization.</p>
      </div>
      <div class="problem-card reveal reveal-delay-3">
        <div class="icon">📋</div>
        <h3>No Centralized Monitoring</h3>
        <p>Faculty and administrators have no unified view of room availability, reservations, and access logs — leading to inefficient decision-making and communication breakdowns.</p>
      </div>
      <div class="problem-card reveal reveal-delay-4">
        <div class="icon">⏱️</div>
        <h3>Delays & Classroom Inefficiency</h3>
        <p>Confusion from conflicting schedules leads to class delays, wasted classroom time, and reduced overall productivity for students and instructors alike.</p>
      </div>
    </div>
  </div>
</section>

<!-- FEATURES -->
<section class="features-section" id="features">
  <div class="features-header">
    <div class="section-label reveal">Core Features</div>
    <h2 class="section-title reveal">Everything You Need to Run Smarter Classrooms</h2>
    <p class="section-desc reveal">A complete, integrated system covering scheduling, access control, monitoring, and analytics.</p>
  </div>
  <div class="features-grid">
    <div class="feature-card reveal reveal-delay-1">
      <span class="feature-num">01</span>
      <span class="feature-icon">📊</span>
      <h3>Admin Dashboard</h3>
      <p>Centralized control panel with real-time room availability, visual schedule management, conflict detection, and automated double-booking prevention.</p>
      <span class="feature-tag">Real-time</span>
    </div>
    <div class="feature-card reveal reveal-delay-2">
      <span class="feature-num">02</span>
      <span class="feature-icon">📡</span>
      <h3>RFID Smart Door Access</h3>
      <p>Instructors tap their RFID card to unlock their assigned classroom only during their scheduled time slot — automatically denied outside of schedule.</p>
      <span class="feature-tag">Hardware</span>
    </div>
    <div class="feature-card reveal reveal-delay-3">
      <span class="feature-num">03</span>
      <span class="feature-icon">📅</span>
      <h3>Room Reservation System</h3>
      <p>Authorized faculty can request and confirm reservations for available classrooms, reducing informal bookings and manual coordination overhead.</p>
      <span class="feature-tag">Self-service</span>
    </div>
    <div class="feature-card reveal reveal-delay-1">
      <span class="feature-num">04</span>
      <span class="feature-icon">💡</span>
      <h3>Occupancy Indicator Light</h3>
      <p>Physical LED indicator on each room shows green when vacant and yellow when occupied — giving anyone in the hallway instant situational awareness.</p>
      <span class="feature-tag">IoT</span>
    </div>
    <div class="feature-card reveal reveal-delay-2">
      <span class="feature-num">05</span>
      <span class="feature-icon">🗂️</span>
      <h3>Centralized Access Logs</h3>
      <p>All RFID scan events — granted or denied — are automatically logged with timestamps, instructor identity, and room details for auditing and review.</p>
      <span class="feature-tag">Audit Trail</span>
    </div>
    <div class="feature-card reveal reveal-delay-3">
      <span class="feature-num">06</span>
      <span class="feature-icon">🔐</span>
      <h3>RFID Card Registration</h3>
      <p>Admin registers and manages faculty RFID credentials through the web interface. Cards can be enabled, suspended, or revoked at any time instantly.</p>
      <span class="feature-tag">Security</span>
    </div>
  </div>
</section>

<!-- HOW IT WORKS -->
<section class="how-section" id="how">
  <div class="how-header">
    <div class="section-label reveal">How It Works</div>
    <h2 class="section-title reveal">Simple. Automated. Secure.</h2>
    <p class="section-desc reveal">From schedule setup to physical door access — SmartRoom handles it end to end.</p>
  </div>
  <div class="steps">
    <div class="step reveal reveal-delay-1">
      <div class="step-num">1</div>
      <h3>Admin Builds Schedule</h3>
      <p>Registrar uploads class schedules and assigns rooms via the dashboard with conflict detection active.</p>
    </div>
    <div class="step reveal reveal-delay-2">
      <div class="step-num">2</div>
      <h3>RFID Cards Issued</h3>
      <p>Faculty receive RFID cards registered to their identity and linked to their room assignments in the system.</p>
    </div>
    <div class="step reveal reveal-delay-3">
      <div class="step-num">3</div>
      <h3>Tap to Unlock</h3>
      <p>Instructors tap their card at the door reader. Access is granted only during their assigned schedule — denied otherwise.</p>
    </div>
    <div class="step reveal reveal-delay-4">
      <div class="step-num">4</div>
      <h3>Live Monitoring</h3>
      <p>The dashboard updates in real time showing room occupancy, access events, and upcoming schedules for all stakeholders.</p>
    </div>
  </div>
</section>

<!-- OBJECTIVES -->
<section id="objectives" style="padding: 120px 5vw; background: var(--navy);">
  <div class="objectives-section" style="padding: 0;">
    <div>
      <div class="section-label reveal">Objectives</div>
      <h2 class="section-title reveal">What SmartRoom Sets Out to Achieve</h2>
      <p class="section-desc reveal">Each goal is designed to directly address the core inefficiencies in PSU's current classroom management workflow.</p>
      <div class="obj-list">
        <div class="obj-item reveal reveal-delay-1">
          <div class="obj-check">✓</div>
          <p>Monitor and manage classroom schedules via an admin dashboard with real-time availability, conflict/double-booking prevention, and centralized records.</p>
        </div>
        <div class="obj-item reveal reveal-delay-2">
          <div class="obj-check">✓</div>
          <p>Enable authorized faculty members to make classroom reservations for available rooms directly through the system.</p>
        </div>
        <div class="obj-item reveal reveal-delay-3">
          <div class="obj-check">✓</div>
          <p>Implement RFID-based time-sensitive door unlocking so only the scheduled instructor can access the room during their assigned period.</p>
        </div>
        <div class="obj-item reveal reveal-delay-4">
          <div class="obj-check">✓</div>
          <p>Deploy occupancy indicator lights (ON = occupied, OFF = vacant) to give immediate visual feedback on room status in the hallway.</p>
        </div>
      </div>
    </div>
    <div class="obj-visual reveal reveal-delay-2">
      <div class="access-card">
        <div class="access-title">🏫 <span>Live Room Status</span> — PSU Asingan</div>
        <div class="access-rooms">
          <div class="access-room">
            <div class="room-light light-on"></div>
            <div class="access-room-info">
              <div class="access-room-name">Room 101 – CIT Laboratory</div>
              <div class="access-room-sub">Prof. Santos · BSIT 2A · 7:30–9:00 AM</div>
            </div>
            <div class="access-room-status status-live">OCCUPIED</div>
          </div>
          <div class="access-room">
            <div class="room-light light-off"></div>
            <div class="access-room-info">
              <div class="access-room-name">Room 102 – Lecture Hall A</div>
              <div class="access-room-sub">Next: Prof. Reyes · 10:00 AM</div>
            </div>
            <div class="access-room-status status-free">VACANT</div>
          </div>
          <div class="access-room">
            <div class="room-light light-on"></div>
            <div class="access-room-info">
              <div class="access-room-name">Room 201 – Lecture Hall B</div>
              <div class="access-room-sub">Prof. Cruz · BSED 3B · 8:00–9:30 AM</div>
            </div>
            <div class="access-room-status status-live">OCCUPIED</div>
          </div>
          <div class="access-room">
            <div class="room-light light-off"></div>
            <div class="access-room-info">
              <div class="access-room-name">Room 203 – Science Lab</div>
              <div class="access-room-sub">Reserved: Prof. Lim · 1:00 PM</div>
            </div>
            <div class="access-room-status status-lock">LOCKED</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="cta-section">
  <div class="section-label reveal" style="justify-content:center;">Get Started</div>
  <h2 class="section-title reveal">Ready to Modernize Your Campus?</h2>
  <p class="section-desc reveal" style="margin-left:auto;margin-right:auto;">SmartRoom brings intelligent scheduling and secure access control to Pangasinan State University — Asingan Campus.</p>
  <div class="cta-actions reveal reveal-delay-1">
    <a href="#" class="btn-primary" style="font-size:1rem;padding:16px 34px;">Access the System →</a>
    <a href="#features" class="btn-secondary" style="font-size:1rem;padding:16px 34px;">Learn More</a>
  </div>
</section>

<!-- FOOTER -->
<footer>
  <div>
    <div class="footer-brand">Smart<span>Room</span></div>
    <div class="footer-sub">Pangasinan State University – Asingan Campus</div>
  </div>
  <div class="footer-copy">© 2025 SmartRoom. All rights reserved.</div>
</footer>

<!-- SCROLL REVEAL & NAV SCROLL JS -->
<script>
  // Intersection Observer for scroll reveal animations
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
      }
    });
  }, {
    threshold: 0.1,
    rootMargin: '0px 0px -40px 0px'
  });

  document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

  // Nav background on scroll
  const nav = document.querySelector('nav');
  window.addEventListener('scroll', () => {
    if (window.scrollY > 60) {
      nav.classList.add('scrolled');
    } else {
      nav.classList.remove('scrolled');
    }
  }, { passive: true });
</script>

</body>
</html>