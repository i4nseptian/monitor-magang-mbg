# InternTrack — AGENTS.md

## Project
Sistem monitoring magang Diskominfo Makassar untuk mahasiswa FEB UNM.
Laravel 12 + Filament v3 + Tailwind v4 + Vite.

## Desain Guideline
- **Style**: Metronic — clean, card-based, white space, subtle shadows, professional typography
- **Font**: Inter (landing page + panel)
- **Warna brand**: Indigo (#6366f1 / #4f46e5)
- **Gray palette**: gray-25 (#fcfcfd) sampai gray-950 (#0d121c)
- **Dark mode**: wajib, semua elemen harus punya `.dark` variant

## Progress

### Completed
- Landing page (`welcome.blade.php`) — rich text hero, stats, features grid 4 kolom, how it works 3 step, direktori mahasiswa dengan filter divisi & search, CTA dark, footer
- Login page (`resources/views/vendor/filament/pages/auth/login.blade.php`) — split layout, brand panel kiri + form kanan
- Logo (`public/images/logo-mark.svg`) — redesigned clean metronic-style
- CSS (`resources/css/app.css`) — metronic tokens: sidebar, topbar, section, card, table, modal, dropdown, input, tabs, badge, stats, scrollbar, semua ada dark variant + background pattern di main content
- Dashboard header (`dashboard-header.blade.php`) — greeting card + deadlines, dark mode, avatar pake icon orang
- Stat card component — simplified, dark mode penuh
- Settings page — form + petunjuk, dark mode
- Font di panel diganti Inter (sebelumnya Plus Jakarta Sans)
- Theme switching smooth transition via class `html.theme-transition`
- Semua widget & page view sudah punya dark: variant

### Pending / Known Issues
- User report: warna masih tabrakan di beberapa bagian saat ganti theme — butuh info lebih detail dari user
- Background landing page sudah diperkaya dengan mesh gradient + dot grid + grid lines + blur blobs

### Build
```bash
npm run build  # always succeeds
```

## Files Kunci
- `resources/views/welcome.blade.php` — landing page
- `resources/views/vendor/filament/pages/auth/login.blade.php` — custom login
- `resources/css/app.css` — filament styling
- `resources/views/filament/pages/*` — semua halaman dashboard
- `resources/views/filament/widgets/*` — widget dashboard
- `resources/views/components/stat-card.blade.php` — stat card component
- `app/Providers/Filament/AdminPanelProvider.php` — panel config
- `public/images/logo-mark.svg` — logo
- `resources/views/filament/pages/dashboard-header.blade.php` — greeting + deadlines
